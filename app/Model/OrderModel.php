<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table="order";
    public $primaryKey='order_id';
    public $timestamps=false;
}
