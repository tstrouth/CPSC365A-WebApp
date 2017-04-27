<?php
class AuthComposer{

  public function compose($view){
    $auth = 0;
    if(isset($_COOKIE["stats_username"])){
      $users = User::all();
      $found = false;
      foreach($users as $user){
        $found = Hask::check($user->username, $_COOKIE["stats_username"]);
        if($found){
          $auth = 1;
          break;
        }
      }
    }

    $view->with("auth", $auth);
  }


}



?>
