<?php

namespace App\Http\Controllers\Signature;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SignatureController extends Controller
{
    //
    public function signature()
    {
        $api_key='1810_2019'; //双方协商好的key , 共用
        $oid='1810_'.mt_rand(11111,99999);
        //要发送的数据
        $a_date=[
            'oid'           =>$oid,
            'order_name'    =>'zhangsan'.$oid,
            'amount'        =>mt_rand(1,10000),
            'addd_time'     =>time(),
            'year'          =>date("Y"),
            'create_time'   =>date("md")
        ];
        // 1 排序
        ksort($a_date);
        //2 拼接待签名字符串
        $b_date='';
        foreach ($a_date as $k=>$v){
            $b_date.=$k.'='.$v.'&';
        }
        //拼接key
        $stringSignTemp=$b_date.'key='.$api_key;
        echo '待签名字符串: '. $stringSignTemp;echo '</br>';
       // dd($c_data);
        // 3做签名  strtoupper(md5($stringSignTemp))
        $sign=strtoupper(md5($stringSignTemp));   //签名值
        echo '签名： '.$sign;echo '</br>';
        $a_date['sign']=$sign;
        echo '<hr>';
        echo '待发送的数据及签名： ';
        echo '<pre>';print_r($a_date);echo '</pre>';
        $param="";
        foreach ($a_date as $k=>$v){
            //echo urlencode($v) ; die;
            $param .= $k . '=' .urlencode($v) .'&';     //通过url传递参数 urlencode处理
        }
        $param=rtrim($param,'&');
        echo 'param: '.$param;echo '</br>';
        //发送数据
        //GET发送
        $api="http://zhb.1810.com/signature?".$param;
        echo '<hr>';
        echo '请求的接口地址： '.$api;
    }
}
