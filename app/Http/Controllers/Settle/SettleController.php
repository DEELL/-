<?php

namespace App\Http\Controllers\Settle;

use App\Model\CartModel;
use App\Model\OrderModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;

class SettleController extends Controller
{
    /**
     * 结算
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settle()
    {
        //取出 用户id
        $user=session('infouser');
        $commodity  = \DB::table('cart')
            ->join("goods",'goods.goods_id','=','cart.goods_id')
            ->where(['user_id'=>$user['id'],'cart_status'=>1])
            ->get();
        $cartar=json_decode($commodity,true);
        $money=0;
        foreach ($cartar as $k=>$v){
            $cartar[$k]['money']=$v['buy_number']*$v['goods_price'];//小计
            $money+=$v['buy_number']*$v['goods_price'];//总价
        }
        return view('settle/settle',compact('cartar','money'));
    }

    public function addsettle(Request $request)
    {
        $reg=$request->input();
        $reg['gap']='在线支付';
        $user=session('infouser');
        $commodity  = \DB::table('cart')
            ->join("goods",'goods.goods_id','=','cart.goods_id')
            ->where(['user_id'=>$user['id'],'cart_status'=>1])
            ->get();
        $cartar=json_decode($commodity,true);
        $str=time().rand(1111,9999).$user['id'];//订单号
            foreach ($cartar as $k=>$v){
                $cartar[$k]['name']=$reg['name'];
                $cartar[$k]['email']=$reg['email'];
                $cartar[$k]['company']=$reg['company'];
                $cartar[$k]['addr']=$reg['addr'];
                $cartar[$k]['city']=$reg['city'];
                $cartar[$k]['country']=$reg['country'];
                $cartar[$k]['postcode']=$reg['postcode'];
                $cartar[$k]['tel']=$reg['tel']; //联系方式
                $cartar[$k]['gap']=$reg['gap'];//支付方式
                $cartar[$k]['transaction']=$str;//订单号
            }
            foreach ($cartar as $k=>$v){
                $order=OrderModel::insertGetId(['order_name'=>$v['name'],'order_email'=>$v['email'],'order_company'=>$v['company'],'order_addr'=>$v['addr'],'order_city'=>$v['city'],'order_country'=>$v['country'],'order_postcode'=>$v['postcode'],'order_tel'=>$v['tel'],'goods_id'=>$v['goods_id'],'u_id'=>$v['user_id'],'goods_name'=>$v['desc'],'buy_number'=>$v['buy_number'],'goods_price'=>$v['goods_price'],'goods_img'=>$v['goods_img'],'carete_time'=>time(),'order_transaction'=>$v['transaction']]);
            }
        if($order){
            $info=[
                'error' =>0002,
                'msg'   =>'正在去算'
            ];
            return json_encode($info);
        }else{
            $info=[
                'error' =>0001,
                'msg'   =>'结算失败'
            ];
            return json_encode($info);
        }

    }

//    支付
    public function payment()
    {
        $user=session('infouser');
       $data= OrderModel::where(['u_id'=>$user['id'],'order_status'=>1])->get();
       $money=0;
       foreach ($data as $k=>$v){
           $money+=$v->buy_number*$v->goods_price;
       }
       $trade_no='';
        foreach ($data as $k=>$v){
            $trade_no=$v->order_transaction;
        }
        app_path('libs/alipay/pagepay/service/AlipayTradeService.php');
        require_once app_path('libs/alipay/pagepay/service/AlipayTradeService.php');
        require_once app_path('libs/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');

        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no =$trade_no;

        //订单名称，必填
        $subject = '商品';

        //付款金额，必填
        $total_amount = $money;

        //商品描述，可空
        $body =  '商品';

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
         */
        $aop = new \AlipayTradeService(config('alipay'));
        $response = $aop->pagePay($payRequestBuilder,config('alipay.return_url'),config('alipay.notify_url'));
        //输出表单
        var_dump($response);
        echo '支付';

    }

    //    支付宝同步
    public  function returnpay(){
        /* *
         * 功能：支付宝页面跳转同步通知页面
         * 版本：2.0
         * 修改日期：2017-05-01
         * 说明：
         * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。

         *************************页面功能说明*************************
         * 该页面可在本机电脑测试
         * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
         */
        $config=config('alipay');
        require_once app_path('libs/alipay/pagepay/service/AlipayTradeService.php');


        $arr=$_GET;
        $alipaySevice = new\AlipayTradeService($config);
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码

            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号
            $where['order_no'] = htmlspecialchars($_GET['out_trade_no']);
            //商户订单金额
            $where['order_amount'] = htmlspecialchars($_GET['total_amount']);
//            取数据库查询
            $count=DB::table('shop_order')->where($where)->count();

            $money=json_encode($arr);
            if(!$count){
                Log::channel('alipay')->info('订单号和金额不符合，没有当前记录'.$money);
            }

            if(htmlspecialchars($_GET['seller_id'])!=config('alipay.seller_id')||htmlspecialchars($_GET['app_id'])!=config('alipay.app_id')){
                Log::channel('alipay')->info('订单商户不符'.$money);
            }
            //支付宝交易号
            $trade_no = htmlspecialchars($_GET['trade_no']);
            Log::channel('alipay')->info("验证成功<br />支付宝交易号：".$trade_no);
//                return redirect('/zhubao/car');
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            echo "验证失败";
        }
    }
}
