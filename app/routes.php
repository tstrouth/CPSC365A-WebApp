<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('dashboard');
});
Route::get("/admin", function(){
	return View::make("admin");
});

Route::get("/test", function(){
    echo "no";
});

Route::get("/createroom", function(){
	return View::make("create");
});

Route::get("/showroom/{id}", function($id){
	return View::make("showRooms");
});

Route::get("/api/user/create", "APIController@createUser");
Route::get("/api/user/show/{id}", "APIController@getUser");
Route::get("/api/user/types", "APIController@getUserTypes");
Route::get("/api/room/show/{code}", "APIController@getRoom");
Route::get("/api/response/create", "APIController@createResponse");
