<?php

class StatController extends Controller {

  public function showWelcome()
	{
		return View::make('hello');
	}

  public function mean($an_array){
      $sum = 0;
      for ($index = 0; $index < count($an_array); $index++){
          $sum = $sum + an_array[$index];
      }
      return $sum/count($an_array);
  }

  public function std_dev($an_array){
      $sum = 0;
      $mean = mean($an_array);
      for ($index = 0; $i < count($an_array); $index++) {
          $sum = $sum + (an_array[$index] - $mean)**2;
      }
      return (sqrt($sum /(count($an_array) - 1)));
  }
  
}
