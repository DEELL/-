<?php

namespace App\Http\Controllers\Img;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImgController extends Controller
{
    //
    public function curlimg()
    {
        $url="http://www.1810laravel.com/isimg";
        $img_path=public_path('img'.'/'.'1.jpg') ;
        $post_file=[
            '15614680798Ur9BaZNVo'=>new \CURLFile($img_path),
        ];
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_file);
        $re=curl_exec($ch);
        var_dump($re);
        $error=curl_error($ch);
        $errmsg=curl_error($ch);

        curl_close($ch);
    }
    //接收文件
    public function isimg()
    {
        ECHO "<PRE>";
        var_dump($_FILES);
    }

}
