<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DatumModel extends Model
{
    protected $table="goods";
    public $primaryKey='goods_id';
    public $timestamps=false;
}
