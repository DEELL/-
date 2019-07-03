<?php

namespace App\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use App\Model\RegModel;
use GuzzleHttp\Client;
class RegisterController extends Controller
{
    //
    public function reg(Request $request)
    {
        if($request->Post()){

            $reg=$request->input();
            if(empty($reg['name'])){
                header('Refresh:2;url='."http://www.1810laravel.com/register/reg");
                echo "<script>alert('账号不能能为空')</script>";die;
            }
            if(empty($reg['tel'])){
                header('Refresh:2;url='."http://www.1810laravel.com/register/reg");
                echo "<script>alert('手机号不能为空')</script>";die;
            }
            if(empty($reg['email'])){
                header('Refresh:2;url='."http://www.1810laravel.com/register/reg");
                echo "<script>alert('邮箱不能为空')</script>";die;
            }
            if(empty($reg['password'])){
                header('Refresh:2;url='."http://www.1810laravel.com/register/reg");
                echo "<script>alert('密码不能为空')</script>";die;
            }
            if(empty($reg['password1'])){
                header('Refresh:2;url='."http://www.1810laravel.com/register/reg");
                echo "<script>alert('确认密码不能为空')</script>";die;
            }
            if($reg['password1']!=$reg['password']) {
                header('Refresh:2;url=' . "http://www.1810laravel.com/register/reg");
                echo "<script>alert('确认密码和密码不一致')</script>";
                die;
            }
            //            验证唯一
            $name=RegModel::where('name',$reg['name'])->first();
            if($name) {
                header('Refresh:2;url='."http://www.1810laravel.com/register/reg");
                echo "<script>alert('账号已存在，请换一个');</script>";
                die;
            }
            $tel=RegModel::where('tel',$reg['tel'])->first();
            if($tel) {
                header('Refresh:2;url='."http://www.1810laravel.com/register/reg");
                echo "<script>alert('手机号已存在，请换一个')</script>";
                die;
            }
            $email=RegModel::where('email',$reg['email'])->first();
            if($email) {
                header('Refresh:2;url='."http://www.1810laravel.com/register/reg");
                echo "<script>alert('邮箱已存在，请换一个')</script>";
                die;
            }


//            $file=$request->file('file_url');//接收文件name值
//            $save_path=date('Ymd');//创建文件目录
//            $file_name=substr(time().Str::random(10).mt_rand(111,99999),6,10);//随机文件名
//            $ext=$file->getClientOriginalExtension();//获取 原文件后缀名
//            $f_name=$file_name.'.'.$ext;//文件名拼接
//            $file->storeAs($save_path,$f_name);
//
//            dump($f_name);
//            dump($ext);
//            dump($file_name);
//            dump($save_path);
//            dd($file);





                //            调用文件上传 方法
                $path=$this->upload('file_url');
//            生成  APPID
                $str=date('YmdHis',time()).'abcde'; //时间拼上abcde
                $a=str_shuffle($str); //用随机打乱字符串  打乱拼接好的随机数
                $appid='la'.$a; //拼接上一个 la
//         生成   APPSecret
                $strs='a0123456789f'.date('YmdHis',time()).'abcdef'; //拼接成32位字符串
                $b=str_shuffle($strs);//字符串 打乱
                $data=[
                    'file_url'=>$path,
                    'name'=>$reg['name'], //账号
                    'password'=>password_hash($reg['password1'],PASSWORD_BCRYPT),//密码
                    'appid'=>$appid, //APPID
                    'appsecret'=>$b, //APPSecret
                    'tel'=>$reg['tel'], //APPSecret
                    'email'=>$reg['email'], //APPSecret
                ];
                $info=RegModel::insertGetId($data);
                if($info){
                    header('Refresh:2;url='."http://www.1810laravel.com/register/login");
                    echo "<script>alert('注册成功，去登陆中')</script>";die;
                }else{
                    header('Refresh:2;url='."http://www.1810laravel.com/register/reg");
                    echo "<script>alert('注册失败')</script>";die;
                }
        }else{
            return view('register.register');
        }
    }

    //    图片上传
    public function upload($name){
        if (request()->hasFile($name) && request()->file($name)->isValid()) {
            $photo = request()->file($name);
            // 返回文件后缀
            $extension = $photo->getClientOriginalExtension();
            // 创建目录 根据时间创建
//            $store_result = $photo->store('upload/'.date('Ymd'));
            // 文件自定义名字 str随机数
            $name = time().Str::random(10);
            $store_result = $photo->storeAs('upload/'.date('Ymd'), $name.'.'.$extension);
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }


    /**
     * 登录和登录执行
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        if($request->Post()){
            $reg= $request->input();
            $info= RegModel::where('name',$reg['name'])->orwhere('tel',$reg['name'])->orwhere('email',$reg['name'])->first(); //orwhere有一个条件满足就执行
            if(empty($info)){
                header('Refresh:2;url='."http://www.1810laravel.com/register/login");
                echo "<script>alert('账号或密码错误')</script>";die;
            }else{
                if(password_verify($reg['password'],$info->password)){
                    $a=$info->id;
                    setcookie('u_id',$a);
                    header('Refresh:2;url='."http://www.1810laravel.com/register/personal");
                    echo "<script>alert('登录成功')</script>";die;
                }else{
                    header('Refresh:2;url='."http://www.1810laravel.com/register/login");
                    echo "<script>alert('账号或密码错误')</script>";die;
                }
            }
        }else{
            return view('register.login');
        }
    }
//    个人中心
    public function personal(Request $request)
    {
        $id= $_COOKIE['u_id'];
        $info=RegModel::where('id',$id)->first()->toArray();
        return view('register.personal',compact('info'));
    }
//    生成access_token
    public function token(Request $request)
    {
       $reg= $request->input();
        $info=RegModel::where('appid',$reg['appid'])->first();
        if($reg['appsecret']==$info->appsecret){
            $token=substr(md5($info->u_id.Str::random(8).mt_rand(1111,9999)),10,10);
            Redis::set($info->id,$token);
            Redis::expire($info->id,86400);
            $token=Redis::get($info->id);
            dd($token);
        }else{
            header('Refresh:2;url='."/register/token");
            echo "<script>alert('不合法的APPID或APPSecret')</script>";die;
        }
    }


    /**
     * 天气 Postman测试 域名zhb.lumen.com
     * @param Request $request
     * @return string
     */
    public function weather(Request $request){
//        获取查询天气的城市
        $city=$request->input('city');
        $token=$request->input('token');
        $id= $_COOKIE['u_id'];//登录时存的id
        $access_token=Redis::get($id);  //redis 取出来的token
        if($token!=$access_token){ //判断token是否和传过来的一致
            header('Refresh:2;url='."/register/personal");
            echo "<script>alert('不合法的token')</script>";die;
        }
//        调用天气接口   K780
        $url="http://api.k780.com:88/?app=weather.future&weaid={$city}&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json";
//        get请求
        $data=file_get_contents($url);
//        对象转数组
        $ppl=json_decode($data ,true);
//        如果success为0
        if($ppl['success']==0){
            var_dump('请输入要查询天气的城市');
//            success不为0
        }else{
//            定义一个空的变量
            $msg='';
//            foreach get请求返回回来的数组
            foreach($ppl['result'] as $k=>$v){
//                想要的数据 拼接
                $msg.='日期：'.$v['days'].'，星期：'.$v['week'].'，城市：'.$v['citynm'].'，当日温度区间：'.$v['temperature'].'，天气：'.$v['weather'].'，风向：'.$v['wind'].'，风力:'.$v['winp']."<br>";
            }
            return $msg;
        }
    }
}
