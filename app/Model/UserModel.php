<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table="userss";
    public $primaryKey='u_id';
    public $timestamps=false;
}
