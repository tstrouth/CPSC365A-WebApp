<?php

class StatController extends Controller {

  public function showWelcome()
	{
		return View::make('hello');
	}

  public function mean($an_array){
      $sum = 0;
      for ($index = 0; $index < count($an_array); $index++){
          $sum = $sum + $an_array[$index];
      }
      return $sum/count($an_array);
  }

  public function std_dev($an_array){
      $sum = 0;
      $mean = mean($an_array);
      for ($index = 0; $index < count($an_array); $index++) {
          $sum = $sum + ($an_array[$index] - $mean)**2;
      }
      return (sqrt($sum /(count($an_array) - 1)));
  }

  public function findMedian($anArray){
      $median = (double) 0;
      $half = count($anArray) / 2;
      if (count($anArray)%2 == 0){
          $median = (double) ($anArray[$half] + $anArray[$half - 1]) / 2; 
      }
      else{
          $median = (double) $anArray[$half];
      }
      return $median
  }
  public function fiveNumber($anArray){
      $sorted = sort($anArray);
      $lower = $sorted[0];
      $upper = $sorted[count($sorted) - 1];
      $half = count($sorted) / 2;
      $left = [];
      $right = [];
      for ($index = 0; $index < $half; $index++){
          $left[$index] = $sorted[$index];
          if (count($sorted) % 2 == 0){
              $right[$index] = $sorted[$index + $half];
          }
          else{
              $right[$index] = $sorted[$index + $half+ 1];
          }
      }
      $median = findMedian($sorted);
      $q1 = findMedian($left);
      $q3 = findMedian($right);
      $fiveNumber = [$lower, $q1, $median, $q3, $upper];
      return $fiveNumber;
  }
  
}
