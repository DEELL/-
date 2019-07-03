<?php

namespace App\Http\Controllers\User;

use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;


class UserController extends Controller
{
    /**
     *  注册页面和注册执行
     * @param Request $request
     * @return false|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function reg(Request $request)
    {
//        判断 如果是post 走添加
        if($request->Post()){
//            接收数据
            $reg=$request->input();
//            账号不为空
            if(empty($reg['name'])){
                $info=[
                    'error' =>0001,
                    'msg'   =>'NAME不能为为空'
                ];
                return json_encode($info);
            }
//            邮箱不为空
            if(empty($reg['email'])){
                $info=[
                    'error' =>0001,
                    'msg'   =>'EMAIL不能为为空'
                ];
                return json_encode($info);
            }
//            密码不为空
            if(empty($reg['password'])){
                $info=[
                    'error' =>0001,
                    'msg'   =>'PASSWORD不能为为空'
                ];
                return json_encode($info);
            }
//            确认密码不为空
            if($reg['password']!=$reg['password1']){
                $info=[
                    'error' =>0001,
                    'msg'   =>'PASSWORD与PASSWORD1不一致'
                ];
                return json_encode($info);
            }
//            密码哈希加密
            $pwss=password_hash($reg['password'],PASSWORD_BCRYPT);
//            入库参数
            $data=[
                'u_name'    =>$reg['name'],
                'u_email'     =>$reg['email'],
                'u_password'=>$pwss
            ];
            $res=UserModel::insertGetId($data);
//            判断成功失败
            if($res){
                $info=[
                    'error' =>0002,
                    'msg'   =>'注册成功啦'
                ];
                return json_encode($info);
            }else{
                $info=[
                    'error' =>0001,
                    'msg'   =>'很遗憾，注册失败'
                ];
                return json_encode($info);
            }
        }else{
//            不是post方式  显示视图
            return view('user/reg');
        }

    }

    /**
     * 登陆页面和登录执行
     * @param Request $request
     * @return false|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function login(Request $request)
    {
//        判断 如果是post 走添加
        if($request->Post()){
//            接收数据
            $reg=$request->input();
//            账号不为空
            if(empty($reg['name'])){
                $info=[
                    'error' =>0001,
                    'msg'   =>'USERNAME不能为为空'
                ];
                return json_encode($info);
            }
//            密码不为空
            if(empty($reg['pass'])){
                $info=[
                    'error' =>0001,
                    'msg'   =>'PASSWORD不能为为空'
                ];
                return json_encode($info);
            }
//            传过来的账号 先去数据库查询
            $name=UserModel::where(['u_name'=>$reg['name']])->first();
//            有数据
            if($name){
//                 从数据库取出的密码和传过来的密码对比   哈希值
               $pass= password_verify($reg['pass'],$name->u_password);
               if($pass==true){
//                   账号和密码正确
                   $user=[
                       'id'     =>$name->u_id,
                       'name'   =>$name->u_name,
                   ];
                   session(['infouser'=>$user]);//用户信息 存session
                   $info=[
                       'error' =>0002,
                       'msg'   =>'登录成功'
                   ];
                   return json_encode($info);
               }else{
//                   密码错误
                   $info=[
                       'error' =>0001,
                       'msg'   =>'USERNAME或PASSWORD错误'
                   ];
                   return json_encode($info);
               }
            }else{
//                账号错误
                $info=[
                    'error' =>0001,
                    'msg'   =>'USERNAME或PASSWORD错误'
                ];
                return json_encode($info);
            }

        }else{
//            不是post方式  显示视图
            return view('user/login');
        }
    }
}
