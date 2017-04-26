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
	return View::make('hello');
});

Route::get("/test", function(){
    echo "no";
});


Route::get("/api/user/create", "APIController@createUser");
Route::get("/api/user/show/{id}", "APIController@getUser");
Route::get("/api/user/types", "APIController@getUserTypes");
Route::get("/api/room/show/{code}", "APIController@getRoom");
Route::get("/api/response/create", "APIController@createResponse");

// Rooms
Route::resource('rooms', 'RoomController');
Route::get("/rooms/create", "RoomController@create");
Route::post("/rooms/store", "RoomController@store");
Route::get("/rooms/viewopen", "RoomController@viewOpenRooms");
Route::post("rooms/close", "RoomController@close");
Route::get("rooms/viewclosed", "RoomController@viewClosedRooms");
Route::get("rooms/roomdata/{roomId}", "RoomController@viewRoomData");
Route::post("rooms/deletedata/{roomId}/{responseId}", "RoomController@deleteRoomData")
