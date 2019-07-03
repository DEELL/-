<?php

namespace App\Http\Controllers\Wish;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishController extends Controller
{
    public function wish()
    {
        return view('wishlist/wishlist');
    }
}
