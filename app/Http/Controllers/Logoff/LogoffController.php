<?php

namespace App\Http\Controllers\Logoff;

use App\Model\XiaXianModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use App\Model\TokenModel;

class LogoffController extends Controller
{
//    pc登录
    public function pcLogin(Request $request)
    {
        if($request->Post()){
           $reg= $request->input();
           $name= XiaXianModel::where(['name'=>$reg['name']])->first();
           if($reg['pass']==$name->pass){
//               登录表 修改成pc登录 也就修改状态
               $info= XiaXianModel::where(['name'=>$reg['name']])->update(['status'=>1,'create_time'=>time()]);
//               生成token
               $toke=substr(Str::random(10).time().rand(1,999999),2, 10);
//               toke 存入cookie
               setcookie('b',$toke,time()+130);
               $data=[
                   'u_id'=>$name->u_id,//用户ID
                   'token'=>$toke,//token
                   'create_time'=>time()+120//当前时间加上两分钟
               ];
//               数据存入token表
               $u=TokenModel::insertGetId($data);
//               用户ID存入cookie
               setcookie('a',$name->u_id);
               if($u){
                   $b=[
                       'error'=>'001',
                       'msg'=>'登录成功',
                       'id'=>$name->u_id
                   ];
                   return json_encode($b);
               }else{
                   $b=[
                       'errer'=>'002',
                       'msg'=>'登录失败',
                   ];
                   return json_encode($b);
               }
           }
        }else {
            return view('user/pclogin');
        }
    }
//app 登录
    public function appLogin(Request $request)
    {
        if($request->Post()){
            $reg= $request->input();
            $name= XiaXianModel::where(['name'=>$reg['name']])->first();
            if($reg['pass']==$name->pass){
//                登录表 修改成app登录
               XiaXianModel::where(['name'=>$reg['name']])->update(['status'=>2,'create_time'=>time()]);
//                生成token
                $toke=substr(Str::random(10).time().rand(1,999999),2, 10);
//                把token存入cookie
                setcookie('b',$toke,time()+130);
                $data=[
                    'u_id'=>$name->u_id,//用户ID
                    'token'=>$toke,//token
                    'create_time'=>time()+120 //当前时间加上两分钟
                ];
//                数据添加到token表
               $u= TokenModel::insertGetId($data);
//               用户ID存入 cookie
                setcookie('a',$name->u_id);
                if($u){
                    $b=[
                        'error'=>'001',
                        'msg'=>'登录成功',
                        'id'=>$name->u_id
                    ];
                    return json_encode($b);
                }else{
                    $b=[
                        'errer'=>'002',
                        'msg'=>'登录失败',
                    ];
                    return json_encode($b);
                }
            }
        }else {
            return view('user/applogin');
        }
    }
//    个人中心
    public function Loginlist(Request $request)
    {
            $id=$_COOKIE['a'];
//            $id = $_GET['id'];
            $u= XiaXianModel::where(['u_id'=>$id])->first();

            return view('user/loginlist',compact('u'));
    }

//实时去数据库查询
    public function LoginlistDo()
    {
        $id=$_COOKIE['a'];
//        dd($id);
        $u=TokenModel::where(['u_id'=>$id])->orderBy('id','desc')->first()->toarray();
//        dump(date("Y-m-d H:i:s",$u['create_time']));
        $t=  $_COOKIE['b'];//从cookie取出token
//        token 表的时间变成0  是被强制下线的
        if($u['create_time']!='0'){
//            判断token 表的 token 和cookie是否一致
            if($u['token']!=$t){
                $info=[
                    'error'=>'0001',
                    'msg'=> 'ip已在其他地方登陆'
                ];
                return json_encode($info);
            }else{
//            $p=$u['create_time'];
//            dd($p);
//                判断当前时间 是否大于token表 的时间
                if($u['create_time']<time()){
                    $toke=substr(Str::random(10).time().rand(1,999999),2, 10);
                    TokenModel::where('id',$u['id'])->update(['token'=>$toke]);
                    $info=[
                        'error'=>'0002',
                        'msg'=> '长时间不操作 已被强制下线'
                    ];
                    return json_encode($info);
                }
            }
        }else{
//            toke 时间为0   是被强制下线的
            $info=[
                'error'=>'0003',
                'msg'=> '已被强制下线'
            ];
            return json_encode($info);
        }
    }

//    强制下线
    public function Downline()
    {
        $id=$_COOKIE['a'];//从cookie 取出id
//        根据ID查询 最后一条数据
        $u=TokenModel::where(['u_id'=>$id])->orderBy('id','desc')->first()->toarray();
//        时间修改成0
       $a= TokenModel::where(['id'=>$u['id']])->update(['create_time'=>0]);
    }
}
