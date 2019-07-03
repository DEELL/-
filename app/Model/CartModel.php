<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    protected $table="cart";
    public $primaryKey='cart_id';
    public $timestamps=false;
}
