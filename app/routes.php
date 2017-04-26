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
Route::get("/dashboard", function(){
	return View::make("dashboard");
});

Route::get("/createroom", function(){
	$tasks = Task::all()->orderBy("task_name");
	//var_dump ($tasks->toArray());
	return View::make("create");
});

Route::get("/showroom/{id?}", function($id=-1){
	return View::make("showRooms");
});

Route::get("/histogram", "histogramController@whateveryouwant");


Route::get("/login", function(){
	return View::make("login");
});

Route::post("new_admin", "AdminController@createAdmin");

Route::post("/login_auth", "AdminController@login");
Route::get("/api/user/create", "APIController@createUser");
Route::get("/api/user/show/{id}", "APIController@getUser");
Route::get("/api/user/types", "APIController@getUserTypes");
Route::get("/api/room/show/{code}", "APIController@getRoom");
Route::get("/api/response/create", "APIController@createResponse");


// Rooms
//Route::resource('rooms', 'RoomController');
Route::get("/rooms/create", "RoomController@create");
Route::post("/rooms/store", "RoomController@store");
Route::get("/rooms/viewopen", "RoomController@viewOpenRooms");
Route::post("rooms/close", "RoomController@close");
Route::get("rooms/viewclosed", "RoomController@viewClosedRooms");
Route::get("rooms/roomdata/{roomId}", "RoomController@viewRoomData");

Route::post("rooms/deletedata/{roomId}/{responseId}", "RoomController@deleteRoomData")


Route::get("/hypothesis", "StatController@hypoTestView");
Route::post("/hypothesis/test", "StatController@hypoTest");

Route::get("rooms/deletedata/{roomId}/{responseId}", "RoomController@deleteRoomData"); 

