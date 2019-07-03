<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TokenModel extends Model
{
    protected $table="token";
    public $primaryKey='id';
    public $timestamps=false;
}
