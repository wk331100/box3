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
use System\Route;

Route::get('/', 'IndexController@index');
Route::get('/link', 'LinkController@index');
Route::get('/about', 'LinkController@about');
Route::get('/history', 'LinkController@history');
Route::get('/feedback', 'LinkController@feedback');
Route::post('/submitFeedBack', 'LinkController@feedback');


Route::get('/tools', 'IndexController@tools');
Route::get('/base64', 'IndexController@base64');
Route::get('/urlEncode', 'IndexController@urlEncode');
Route::get('/jsonEncode', 'IndexController@jsonEncode');
Route::get('/timeFormate', 'IndexController@timeFormate');


Route::get('/randPwd', 'IndexController@randPwd');
Route::get('/md5', 'IndexController@md5');
Route::get('/qrcode', 'IndexController@qrcode');
Route::get('/qrcodeImg', 'IndexController@qrcodeImg');
Route::get('/shuffle', 'IndexController@shuffle');

Route::post('/execute', 'ExecController@index');
Route::post('/executeImg', 'ExecController@img');
















