<?php

class AdminController extends Controller {

  public function login(){
    $username = Input::get("username");
    $password = Input::get("password");
    echo $username . "<br />";
    echo $password;

  }


  public function createAdmin(){
    $username = Input::get("username");
    $password = Input::get("password");
    echo $username . "<br />";
    echo $password;
    $this->another();
  }

  public function another(){

  }

}
