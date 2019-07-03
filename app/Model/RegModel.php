<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RegModel extends Model
{
    protected $table="reg";
        public $primaryKey='id';
        public $timestamps=false;
}
