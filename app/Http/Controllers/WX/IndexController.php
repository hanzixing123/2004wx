<?php

namespace App\Http\Controllers\WX;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    //


    public function  index(){
    	// $data=["name"=>"LZY","pwd"=>123456];

    	// $res=DB::table("user")->insert($data);
    	// if($res){
    	// $res=	DB::table("user")->get();
    	// 	dd($res);

    	//}
		//echo "杨楠吃屎";
        Redis::set("lzy","ok");
        echo    Redis::get("lzy");

    }
    public function list(){

    }


}
