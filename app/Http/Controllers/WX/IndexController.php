<?php

namespace App\Http\Controllers\WX;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    //


    public function  index(){
        $echostr = request()->get("echostr", "");
        if ($this->checkSignature() && !empty($echostr)) {

            //第一次接入
            echo $echostr;
        }else{

            $access_token=$this->get_access_token();  //跳方法  调 access_token
//            file_put_contents("bbb.txt",$access_token["access_token"]);
            dd($access_token);
        }



    }




    private function checkSignature()
    {
        $signature = request()->get("signature");
        $timestamp = request()->get("timestamp");
        $nonce = request()->get("nonce");

        $token ="lishang";
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

}
