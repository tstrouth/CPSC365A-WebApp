<?php

class APIController extends Controller {

  public function getUserTypes(){
    $userTypes = UserType::all();

    return Response::json($userTypes);
  }


  public function createUser(){
    $user = new User;
    $user->username = Input::get("username");
    $user->user_type = Input::get("user_type");
    $user->save();


    return Response::json(array("id"=>$user->id));
  }

  public function getUser($id){

    $user = User::find($id);
    if(count($user) > 0){
      return Response::json($user);
    }else{
      return Response::json(array("Error"=>"No user found"));
    }

  }

  public function getRoom($code){
    $room = Room::where("room_code", $code)->first();
    if(count($room) > 0){
      return Response::json($room);
    }else{
      return Response::json(array("Error"=>"No room found"));
    }
  }

  public function createResponse(){
    $room_fkey = Input::get("room_fkey");
    $user_fkey = Input::get("user_fkey");
    $room = Room::find($room_fkey);
    $user = User::find($user_fkey);
    if(count($room) < 1){
      return Response::json(array("Error"=>"No room found"));
    }
    if(count($user) < 1){
      return Response::json(array("Error"=>"No user found"));
    }

    $response = new ResponseDB;
    $response->user_fkey = $user_fkey;
    $response->room_fkey = $room_fkey;
    $response->task_fkey = $room->task_fkey;
    $response->save();

    $data = Input::get("data");
    if(is_array($data)){
      foreach($data as $d){
        $new_response = new ResponseData;
        $new_response->response_data = $d;
        $new_response->response_fkey = $response->id;
        $new_response->save();
      }
    }else{
      $new_response = new ResponseData;
      $new_response->response_data = $d;
      $new_response->response_fkey = $response->id;
      $new_response->save();
    }

    return Response::json($response);


  }



}
