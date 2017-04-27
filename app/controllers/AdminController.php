<?php

class AdminController extends Controller {

  public function adminDashboard(){
    $user = User::find($_COOKIE["stats_id"]);
    if($user->user_type == 3){
      return View::make("admin");
    }
    else{
      return  Redirect::action("AdminController@loginView");
    }
  }

  public function loginView(){
    $error = Session::get("error");
    return View::make("login", compact('error'));
  }

  public function login(){
    $username = Input::get("username");
    $password = Input::get("password");
    $adminFound = $this->authAdmin($username, $password);
    return $adminFound;
  }


  public function createAdmin(){
    $user = User::find($_COOKIE["stats_id"]);
    if($user->user_type == 3){
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

      return Redirect::action("AdminController@adminDashboard");
    }else{
      return  Redirect::action("AdminController@loginView");
    }
  }


  public function authAdmin($username, $password){
      $hashedPassword = User::where('username', $username)->where("user_type", "!=", 1)->first();
      if(count($hashedPassword) > 0){
        $id = $hashedPassword->ID;
        $hashedPassword = $hashedPassword->hashpassword;
        if (Hash::check($password, $hashedPassword)) {
          setcookie("stats_username", Hash::make($username), time()+60*60);
          setcookie("stats_id", $id, time()+60*60);
          return Redirect::route("dashboard");
        }
        else {
          return  Redirect::action("AdminController@loginView")->with("error", "Login Failed");
        }
      }
      else {
        return  Redirect::action("AdminController@loginView")->with("error", "Login Failed");
      }
  }

  public function logout(){
    setcookie("stats_username", "", time()-60*60);
    setcookie("stats_id", "", time()-60*60);

    return  Redirect::action("AdminController@loginView");
  }

}
