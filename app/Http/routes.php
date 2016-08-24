<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'profileController@index')->name('home');

Route::post('status/store','statusController@create');
Route::post('comment/store','commentController@create');

//profile
//
Route::get('user/{name}','profileController@show');
Route::get('profile/',function(){redirect()->route('home');});
Route::get('profile/edit','profileController@edit');
Route::patch('profile/edit','profileController@update');
// Route::get('test',function(){
// 	return view('test');
// });
// Route::patch('test',function(Illuminate\Http\Request $req){
// 	$rules = 
// 	return $req->all();
// });