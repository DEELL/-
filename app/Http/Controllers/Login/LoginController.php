<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\XiaXianModel;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use App\Model\TokenModel;

class LoginController extends Controller
{
    //
    //app 登录
    public function appLogin(Request $request)
    {
        if($request->Post()){
            $reg= $request->input();
            $name= XiaXianModel::where(['name'=>$reg['name']])->first();
            if($reg['pass']==$name->pass){
//                生成token
                $toke=substr(Str::random(10).time().rand(1,999999),2, 10);
//                把token和用户id存入session
                session(['u_id'=>$name->u_id,'token'=>$toke]);
//                把token存入redis
                $key='token'.$name->u_id;
                Redis::set($key,$toke);
//                redis 过期时间
                Redis::expire($key,1800);
                    $b=[
                        'error'=>'001',
                        'msg'=>'登录成功',
                    ];
                    return json_encode($b);
                }else{
                    $b=[
                        'errer'=>'002',
                        'msg'=>'登录失败',
                    ];
                    return json_encode($b);
                }
        }else {
            return view('login/applogin');
        }
    }


    //    个人中心
    public function Loginlist(Request $request)
    {
        echo __METHOD__;

    }


    public function logout()
    {
        session('u_id')->flash();
        echo "成功推出";

    }


}
