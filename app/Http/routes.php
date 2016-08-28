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



//////////profile///////////////////////////////////
Route::get('user/{name}','profileController@show');
Route::get('profile/',function(){redirect()->route('home');});
Route::get('profile/edit','profileController@edit');
Route::patch('profile/edit','profileController@update');


////////////status controller///////////////////////
Route::get("status",function(){return redirect()->route('home');});
Route::get("status/{status}","statusController@show");
Route::post('status/store','statusController@create');
Route::get("status/{status}/edit","statusController@edit");
Route::patch("status/{status}","statusController@update");
Route::get("status/{status}/delete","statusController@showDelete");
Route::delete("status/{status}","statusController@delete");

////////////comment controller///////////////////////
Route::post('comment/store','commentController@create');
Route::get("comment/{comment}/edit","commentController@edit");
Route::patch("comment/{comment}","commentController@update");
Route::get("comment/{comment}/delete","commentController@deleteShow");
Route::delete("comment/{comment}","commentController@delete");


/////////////////////////***[friends]***/////////////////////////
Route::get('/friend/send/{user}','friendController@sendOffer');
Route::get('friend/accept/{offer}','friendController@acceptOffer');