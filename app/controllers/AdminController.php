<?php

class AdminController extends Controller {

  public function login(){
    $username = Input::get("username");
    $password = Input::get("password");
    $adminFound = $this->authAdmin($username, $password);
  }


  public function createAdmin(){
    $username = Input::get("username");
    $password = Input::get("password");
    $hashpassword = Hash::make($password);

    //enter user into database
    $admin = new User;
    $admin->username = $username;
    $admin->user_type = ;//What is the integer that should be added
    $admin->hashpassword = $hashpassword;
    $admin->save();
  }

  public function addProfessor(){

  }
  
  public function deleteProfessor(){

  }

  
  public function authAdmin($username, $password){
      $hashedPassword = User::where('username', $username)->get();
      if (Hash::check($password, $hashedPassword) {
          //Redirect
      }
      else {
          //Display error
      }
  }
 
}
