<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('layouts.app');
//    phpinfo();
//});
//首页
Route::get('/','Home\HomeController@index');
//注册页面
Route::get('/user/reg','User\UserController@reg');
//注册执行
Route::post('/user/reg','User\UserController@reg');
//登陆页面
Route::get('/user/login','User\UserController@login');
//登录执行
Route::post('/user/login','User\UserController@login');
//心愿单
Route::get('/wishlist/wish','Wish\WishController@wish');
//购物车
Route::get('/cart/cart','Cart\CartController@cart');
//修改购买的数量
Route::post('/cart/updatecart','Cart\CartController@updatecart');
//购物车商品删除
Route::post('/cart/cartdel','Cart\CartController@cartdel');
//商品详情
Route::get('/cart/commodity','Cart\CartController@commodity');
//加入购物车
Route::post('/cart/addcart','Cart\CartController@addcart');
//联系
Route::get('/contact/contact','Contact\ContactController@contact');
//产品
Route::get('/product/product','Product\ProductController@product');
//结算
Route::get('/settle/settle','Settle\SettleController@settle');
//结算执行
Route::post('/settle/settle','Settle\SettleController@addsettle');
//支付
Route::get('/settle/payment','Settle\SettleController@payment');
//异步通知
Route::get('/settle/alipay','Settle\SettleController@alipay');


//练习
Route::get('/register/reg','Register\RegisterController@reg');//注册
Route::post('/register/reg','Register\RegisterController@reg');//注册执行
Route::get('/register/login','Register\RegisterController@login');//登录
Route::post('/register/login','Register\RegisterController@login');//登录
Route::get('/register/personal','Register\RegisterController@personal');//个人中心
Route::post('/register/token','Register\RegisterController@token');//token
Route::get('/register/weather','Register\RegisterController@weather');//天气接口   http://www.1810laravel.com/register/weather?city=%E5%8C%97%E4%BA%AC&token=a6c9ccd775




//单点登录  自己的
Route::get('/app/pcLogin','Logoff\LogoffController@pcLogin');// 电脑登录
Route::post('/app/pcLogin','Logoff\LogoffController@pcLogin');// 电脑登录
Route::get('/app/Loginlist','Logoff\LogoffController@Loginlist');// 登录展示
Route::post('/app/LoginlistDo','Logoff\LogoffController@LoginlistDo');// 登录展示
Route::post('/app/Downline','Logoff\LogoffController@Downline');// 强制下线
Route::get('/app/appLogin','Logoff\LogoffController@appLogin');//Android登录
Route::post('/app/appLogin','Logoff\LogoffController@appLogin');//Android登录




Route::get('wx/signature','Signature\SignatureController@signature');//验签
//老师的单点登录
Route::get('/app/login','Login\LoginController@applogin');//单点登录
Route::post('/app/login','Login\LoginController@applogin');//单点登录执行
Route::get('/app/loginlist','Login\LoginController@Loginlist')->middleware('check.session','token.fresh');// 登录展示





Route::get('curlimg','Img\ImgController@curlimg');//curl上传文件
Route::post('isimg','Img\ImgController@isimg');//curl上传文件

Route::get('/exam/reg','Exam\ExamController@reg');//注册
Route::post('/exam/regDo','Exam\ExamController@regDo');//执行注册
Route::post('/exam/code','Exam\ExamController@code');//验证码

Route::post('/exam/loginDo','Exam\ExamController@loginDo');//登录执行
Route::get('/exam/login','Exam\ExamController@login');//登录
Route::get('/exam/index','Exam\ExamController@index');//登录










