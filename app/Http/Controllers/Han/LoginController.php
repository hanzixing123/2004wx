<?php

namespace App\Http\Controllers\Han;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LoginModel;//LoginModel
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    //
		public function Login(){

			if(request()->isMethod("get")){
				return view("Login/login");
			}
			if(request()->isMethod("post")){
				  $wetch_user = request()->wetch_user;

				   $wetch_pwd = request()->wetch_pwd;
//				    $wdan=Md5("wdan");
//                return json_encode(['error_no'=>1,'error_msg'=>"$wdan"]);

				   $rember = [
			
					 'wetch_user'=>$wetch_user,
					 'wetch_pwd'=>$wetch_pwd
			
				   ];
	  				if(empty($wetch_user)){
                        return json_encode(['error_no'=>1,'error_msg'=>"用户名不能为空"]);exit;
                    }
				    if(empty($wetch_pwd)){
                        return json_encode(['error_no'=>1,'error_msg'=>"密码不能为空"]);exit;
				    }
			
				  $login=LoginModel::where('wetch_user',$wetch_user)->first();
				  if(!$login){
                      return json_encode(['error_no'=>1,'error_msg'=>"用户名或者密码错误"]);exit;
				  }
				  if(md5($wetch_pwd)==$login['wetch_pwd']){
					   if(isset(request()->rember)){
 			                   Cookie::queue('rember',serialize($rember),60*24*7);
 			           }
					   session(['users'=>$rember]);
                      return  json_encode(['error_no'=>0,'error_msg'=>"登陆成功"]);
 			          //success("登陆成功");
				}else{
                      return json_encode(['error_no'=>1,'error_msg'=>"用户名或者密码错误"]);exit;
//				       error("用户名或者密码错误!");
				}
			
			
			
		}


		}
}
