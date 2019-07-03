<?php

namespace App\Http\Controllers\Exam;

use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use phpDocumentor\Reflection\Location;

class ExamController extends Controller
{
    //
//    注册
    public function reg(Request $request)
    {
            return view('exam/reg');
    }

    public function code(Request $request)
    {
        $reg= $request->input('name');
        $u=Redis::get($reg);
        if ($u){
            $res=[
                'error' =>0002,
                'msg'   =>'一分钟只能发一次，清一分钟后再试'
            ];
            return json_encode($res);
        }

     $mm=UserModel::where(['u_email'=>$reg])->first();//查询数据库  有没有这个账号
        if($mm){
            $res=[
                'error' =>0002,
                'msg'   =>'请换一个邮箱'
            ];
            return json_encode($res);
        }
       $code=mt_rand(1111,9999);//随机数

       Redis::set($reg,$code);//验证码 存入redis
       Redis::expire($reg,60);//验证码 存时间
//        发送邮箱
        $res=Mail::send('exam/code',['code'=>$code], function ($message) use ($reg) {
//                设置主题
            $message->subject("调用接口");
//                设置接受方
            $message->to($reg);
        });
        if($res==null){
            $res=[
                'error' =>0001,
                'msg'   =>'发送成功'
            ];
            return json_encode($res);
        }else{
            $res=[
                'error' =>0002,
                'msg'   =>'发送失败'
            ];
            return json_encode($res);
        }
    }

    /**
     * 注册执行
     * @param Request $request
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function regDo(Request $request)
    {
        $reg=$request->input();
        if(empty($reg['name'])){
            $res=[
                'error' =>0002,
                'msg'   =>'请填写账号'
            ];
            return json_encode($res);
        }
        if(empty($reg['code'])){
            $res=[
                'error' =>0002,
                'msg'   =>'请填写验证码'
            ];
            return json_encode($res);
        }
        if(empty($reg['password'])){
            $res=[
                'error' =>0002,
                'msg'   =>'请填写密码'
            ];
            return json_encode($res);
        }
        if(empty($reg['password1'])){
            $res=[
                'error' =>0002,
                'msg'   =>'请填写确认密码'
            ];
            return json_encode($res);
        }
        if($reg['password']!=$reg['password1']){
            $res=[
                'error' =>0002,
                'msg'   =>'确认密码和密码不一致'
            ];
            return json_encode($res);
        }
        $cd=Redis::get($reg['name']);
        if($cd!=$reg['code']){
            $res=[
                'error' =>0002,
                'msg'   =>'不正确验证码'
            ];
            return json_encode($res);
        }
        if(empty($cd)){
            $res=[
                'error' =>0002,
                'msg'   =>'验证码已过期'
            ];
            return json_encode($res);
        }
        unset($reg['password1']);
        unset($reg['code']);
        $key="password";
        $method="AES-128-CBC";//密码学方式
        $iv="adminadminadmin1";//非 NULL 的初始化向量
        $k=json_encode($reg);//发送的数据转成json   数组不能发
        $a=openssl_get_privatekey("file://".storage_path('rsa_private_key.pem')); //获取秘钥
        openssl_sign($k,$exer,$a);//生成签名
        $url="http://zhb.1810laravel.com/code?url=".urlencode($exer);//签名拼接到路由  发送到服务端
        $app=openssl_encrypt($k,$method,$key,OPENSSL_RAW_DATA,$iv);// 对称加密
        $clinet= new Client();//实例化 Guzzle
//        Guzzle 发送
        $response=$clinet->request("POST",$url,[
            'body'=>$app
        ]);
        echo $response->getBody();
    }

    /**
     * 登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('exam/login');
    }

    /**
     * 登录执行
     * @param Request $request
     * @return false|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function loginDo(Request $request)
    {
        $reg=$request->input();
            $key="passwords";
            $method="AES-128-CBC";//密码学方式
            $iv="adminadminadmin2";//非 NULL 的初始化向量
            $k=json_encode($reg);//发送的数据转成json 数组不能发
            $a=openssl_get_privatekey("file://".storage_path('rsa_private_key.pem')); //获取秘钥
            openssl_sign($k,$exer,$a);//生成签名
            $url="http://zhb.1810laravel.com/logins?url=".urlencode($exer);//签名拼接到路由  发送到服务端
            $app=openssl_encrypt($k,$method,$key,OPENSSL_RAW_DATA,$iv);// 对称加密
            $clinet= new Client();//实例化 Guzzle
//        Guzzle 发送
            $response=$clinet->request("POST",$url,[
                'body'=>$app
            ]);
//            echo $response->getBody();

            $a= $response->getBody();//服务端返回来的数据
            $u=json_decode($a,true);//返回来的数据 转成对象
            session(['u_id'=>$u['u_id'],'token'=>$u['token']]);//存session
            $key=$u['u_id'];//redis 键名
            Redis::set($key,$u['token']);//token存入redis
            Redis::expire($key,3600);//redis 过期时间
                return json_encode($u); //服务端返回来的数据返回给 登录页面
        }


    /**
     *首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $id=session('u_id');//session 取出用户id
        $token=session('token');//session中取出token
        $redis_toekn=Redis::get($id);//redis中 取出token
        if($redis_toekn!=$token){
            echo "<script>alert('账号在别的地方登陆');location.href='/exam/login'</script>>";die;
        }elseif ($redis_toekn=='-2'){
            echo "<script>alert('token已过期')</script>>";
        }
        return view('exam/lndex');
    }
}
