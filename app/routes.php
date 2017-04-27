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


Route::get('/', array("before"=>"auth", function()
{
	return View::make('dashboard');
}));
Route::get("/dashboard", array("as"=>"dashboard","before"=>"auth", function(){
	return View::make("dashboard");
}));
Route::get("/showroom/{id?}", "RoomController@showData");


Route::get("/login", "AdminController@loginView");
Route::post("/login_auth", "AdminController@login");
Route::get("/admin", array("before"=>"auth", "uses"=>"AdminController@adminDashboard"));
Route::post("new_admin", array("before"=>"auth", "uses"=>"AdminController@createAdmin"));

Route::get("/getstatdata/{id}", array("as"=>"getStatData","before"=>"auth", "uses"=>"StatController@getData"));
Route::get("/getstattest/{id}", array("as"=>"getStatTest","before"=>"auth", "uses"=>"StatController@getStatTest"));

Route::get("/api/user/create", "APIController@createUser");
Route::get("/api/user/show/{id}", "APIController@getUser");
Route::get("/api/user/types", "APIController@getUserTypes");
Route::get("/api/room/show/{code}", "APIController@getRoom");
Route::get("/api/response/create", "APIController@createResponse");
// Rooms
Route::get("/rooms/create", array("as"=>"createroom","before"=>"auth", "uses"=>"RoomController@create"));
Route::post("/rooms/store", array("before"=>"auth", "uses"=>"RoomController@store"));
Route::get("/rooms/viewopen",array("as"=>"openrooms","before"=>"auth", "uses"=> "RoomController@viewOpenRooms"));
Route::get("rooms/close/{roomId}", array("before"=>"auth", "uses"=>"RoomController@close"));
Route::get("rooms/deletedata/{roomId}/{responseId}", array("before"=>"auth", "uses"=>"RoomController@deleteRoomData"));
Route::get("rooms/viewclosed", array("as"=>"viewclosed","before"=>"auth", "uses"=>"RoomController@viewClosedRooms"));
Route::get("rooms/roomdata/{roomId}", array("before"=>"auth", "uses"=>"RoomController@viewRoomData"));



//Route::get("/hypothesis", "StatController@hypoTestView");
//Route::post("/hypothesis/test", "StatController@hypoTest");
