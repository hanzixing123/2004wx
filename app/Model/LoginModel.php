<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    //
	    protected $table ='wetch_login';

    protected  $primaryKey ='wetch_id';

    public $timestamps=false;

// 黑名单属性
    protected $guarded=[];







}
