<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::any("/Han","WX\IndexController@index");
Route::any("/Login","Han\LoginController@Login");//登录
Route::any("/list","Han\IndexController@Index");//列表
Route::any("/Caidan","WX\IndexController@Caidan");//列表
