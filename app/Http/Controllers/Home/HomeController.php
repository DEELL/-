<?php

namespace App\Http\Controllers\Home;

use App\Model\DatumModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function index()
    {
        $now=DatumModel::where(['is_discount'=>1])->get();//新产品
        $apex=DatumModel::where(['is_top'=>1])->get();//顶尖商品
        return view('home/index',compact('now','apex'));
    }
}
