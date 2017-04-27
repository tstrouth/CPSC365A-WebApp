<?php

class AdminController extends Controller {

  public function loginView(){
    $error = Session::get("error");
    return View::make("login", compact('error'));
  }

  public function login(){
    $username = Input::get("username");
    $password = Input::get("password");
    $adminFound = $this->authAdmin($username, $password);
  }


  public function createAdmin(){
    $username = Input::get("username");
    $password = Input::get("password");
    $type = Input::get("user-type");
    $hashpassword = Hash::make($password);

    //enter user into database
    $admin = new User;
    $admin->username = $username;
    $admin->user_type = $type;//What is the integer that should be added
    $admin->hashpassword = $hashpassword;
    $admin->save();
  }


  public function authAdmin($username, $password){
      $hashedPassword = User::where('username', $username)->where("user_type", "!=", 1)->get();
      if (Hash::check($password, $hashedPassword) {
        echo "We worked";
      }
      else {
          Redirect::action("AdminController@loginView")->with("error", "Login Failed");
      }
  }

}
