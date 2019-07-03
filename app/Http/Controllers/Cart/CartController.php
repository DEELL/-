<?php

namespace App\Http\Controllers\Cart;

use App\Model\CartModel;
use App\Model\DatumModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use DB;

class CartController extends Controller
{
    /**
     * 购物车
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cart()
    {
        //取出 用户id
        $user=session('infouser');
        $commodity  = DB::table('cart')
                    ->join("goods",'goods.goods_id','=','cart.goods_id')
                    ->where(['user_id'=>$user['id'],'cart_status'=>1])
                    ->get();
        $cartar=json_decode($commodity,true);
        $money=0;
        foreach ($cartar as $k=>$v){
            $cartar[$k]['money']=$v['buy_number']*$v['goods_price'];//小计
            $money+=$v['buy_number']*$v['goods_price'];//总价
        }
        return view('cart.cart',compact('cartar','money'));
    }

    /**
     * 加入购物车
     * @param Request $request
     * @return false|string
     */
    public function addcart(Request $request)
    {
        $res=$request->input();
        //取出 用户id
        $user=session('infouser');
//        根据 商品id 用户id 未删除的 查询
        $cart=CartModel::where(['goods_id'=>$res['id'],'cart_status'=>1,'user_id'=>$user['id']])->first();
//        查询不到 走添加
        if($cart==null){
            $ppl=CartModel::insertGetId(['goods_id'=>$res['id'],'buy_number'=>$res['buy_number'],'create_time'=>time(),'user_id'=>$user['id']]);
            if($ppl){
                $info=[
                    'error' =>0002,
                    'msg'   =>'加入购物车成功'
                ];
                return json_encode($info);
            }else{
                $info=[
                    'error' =>0001,
                    'msg'   =>'加入购物车失败'
                ];
                return json_encode($info);
            }
//            数据库查询 到
        }else{
//            根据商品id 用户id查询数据库 获取已经购买的数量
            $ppl=CartModel::where(['goods_id'=>$res['id'],'user_id'=>$user['id'],'cart_status'=>1])->first();
//            用户购买的数量加上 数据库的数量
            $buy_number=$ppl->buy_number+$res['buy_number'];
//            修改购买数量
            $ppl=CartModel::where(['goods_id'=>$res['id'],'user_id'=>$user['id']])->update(['buy_number'=>$buy_number,'create_time'=>time()]);
            if($ppl){
                $info=[
                    'error' =>0002,
                    'msg'   =>'加入购物车成功'
                ];
                return json_encode($info);
            }else{
                $info=[
                    'error' =>0001,
                    'msg'   =>'加入购物车失败'
                ];
                return json_encode($info);
            }
        }
    }

    /**
     * 商品详情
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function commodity(Request $request)
    {
        $id=$request->all();
//        传过来的id  查询
        $plp=DatumModel::where(['goods_id'=>$id['good_id']])->first();
//        查询得到  显示视图
        if($plp){
            $goods= DatumModel::where(['goods_id'=>$id['good_id']])->first();
            return view('cart.commodity',compact('goods'));
//            查询不到
        }else{
           echo  "<script>alert('非法id');location.herf='/user/login'</script>";
        }


    }

    /**
     * 修改购买的数量
     * @param Request $request
     */
    public function updatecart(Request $request)
    {

       $reg= $request->input();
        $ppl= CartModel::where('goods_id',$reg['goods_id'])->update(['buy_number'=>$reg['buy_number']]);
        if($ppl){
           echo 1;
        }else{
            echo 2;
        }
    }

    /**
     *     删除购物车商品
     * @param Request $request
     * @return false|string
     */
    public function cartdel(Request $request)
    {
        $goods_id=$request->input('goods_id');
        $ppl=CartModel::where(['goods_id'=>$goods_id])->update(['cart_status'=>2]);
        if($ppl){
            $info=[
                'error' =>0002,
                'msg'   =>'删除成功'
            ];
            return json_encode($info);
        }else{
            $info=[
                'error' =>0001,
                'msg'   =>'删除失败'
            ];
            return json_encode($info);
        }

    }





}
