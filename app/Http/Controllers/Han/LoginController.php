<?php

namespace App\Http\Controllers\Han;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
		public function Login(){

			if(request()->isMethod("get")){
				return view("Login/login");
			}
			if(request()->isMethod("post")){

			}


		}
}
