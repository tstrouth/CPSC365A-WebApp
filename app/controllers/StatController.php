<?php

class StatController extends Controller {

  public function getData($id){
    $room_data = ResponseDB::where("room_fkey", $id)->with("data")->get();
    $all_responses = [];
    foreach($room_data as $entry){
      foreach($entry->data as $response){
        $all_responses[] = $response->response_data;
      }
    }
    if(count($all_responses) > 0){
      $mean = $this->mean($all_responses);
      $standard_dev = $this->std_dev($all_responses);
      $median = $this->findMedian($all_responses);
      $five_number = $this->fiveNumber($all_responses);
      $histo = $this->BuildHistogram($all_responses);
    }else{
      $mean = 0;
      $standard_dev = 0;
      $median = 0;
      $five_number = 0;
      $histo = "";
    }

    $return_array = [];
    $return_array["mean"] = $mean;
    $return_array["std_dev"] = $standard_dev;
    $return_array["median"] = $median;
    $return_array["five_number"] = $five_number;
    $return_array["histo"] = $histo;


    return Response::json($return_array);
  }

  public function getStatTest($id){
    $null = Input::get("null");
    $alpha = Input::get("alpha");
    $test = Input::get("test");

    $room_data = ResponseDB::where("room_fkey", $id)->with("data")->get();
    $all_responses = [];
    foreach($room_data as $entry){
      foreach($entry->data as $response){
        $all_responses[] = $response->response_data;
      }
    }
    $all_responses[2000] = $null;
    $all_responses[2001] = $alpha;
    $all_responses[2002] = $test;


    return Response::json($all_responses);
  }






    public function hypoTestView(){
        return View::make("hypothesis");
    }

    public function hypoTest(){
        //var_dump(Input::all());
        $null_value = Input::get("null");
        $alpha_value = Input::get("alpha");
        $choice = Input::get("Type");
        $data = ResponseData::get()->lists("response_data");
        //var_dump($data);
        if($choice == 0){

        }else if($choice == 1){
            $data_array_2 = $data;
            shuffle($data_array_2);
            echo "<h2>Data set 1</h2>";
            foreach($data as $d){
                echo $d;
                echo "<br>\n";
            }
            echo "<h2>Data set 2</h2>";
            foreach($data_array_2 as $d){
                echo $d . "<br>\n";
            }
            echo "<h2> Result </h2>";
            $paired_data = $this-> find_difference($data, $data_array_2);
            echo $this->two_sided_pval($paired_data, $alpha_value, $null_value);
        }else if($choice == 2){
            echo "<h2>Data set</h2>";
            foreach($data as $d){
                echo $d;
                echo "<br>\n";
            }
            echo "<h2> Results </h2>";
            $this->two_sided_pval($data, $alpha_value, $null_value);

        }


    }

    //needs an array and inputted test statisitc executes a python program and
    //returns the probability value
    public function retrievepval($pArray, $teststat){
        $df = count($pArray) - 1;
        $command = sprintf("python3 get_pval.py %f %f 2>&1", $teststat, $df);
        exec($command, $pval);
        return $pval[0];
    }

    //inputs an array and a value from null hypothesis inputted by user
    //calculates the test statistic
    public function getteststat($pArray, $nullmean){
        $n = count($pArray);
        $tt = ($this->mean($pArray) - $nullmean)/($this->std_dev($pArray)/sqrt($n));
        return $tt;
    }


    //needs an inputted array of population data
    //calculates the confidence interval of the population data
    public function getconfinterval($pArray, $alpha){
        $standard_deviation_div_sqrtn = ($this->std_dev($pArray)/sqrt(count($pArray)));
        $alpha_div_2 = (float) $alpha/2;
        $df = count($pArray) - 1;
        $command = sprintf("python3 get_tval.py %f %d 2>&1", $alpha_div_2, $df);
        exec($command, $t);
        $mean = $this->mean($pArray);
        $lowerbound = $mean - $t[0]*$standard_deviation_div_sqrtn;
        $upperbound = $mean + $t[0]*$standard_deviation_div_sqrtn;
        printf("<br> the confidence interval is [ %f, %f] <br>", $lowerbound,
        $upperbound);
    }

    //computes the sum of ((x_x -x\bar) -((yi-y\bar)) ^ 2
    //part of the matched pairs t-test formula
    public function two_sample_std_dev($pArray1, $pArray2){
        $sum = 0;
        $mean1 = $this->mean($pArray1);
        $mean2 = $this->mean($pArray2);
        for ($index = 0; $index < count($pArray2); $index++) {
            $x_i = ($pArray1[$index] - $mean1);
            $y_i = ($pArray2[$index] - $mean2);
            $sum = $sum + ($x_i - $y_i)**2;
        }
        return $sum;

    }

    //computes the test statistic for the paired t-test
    public function two_sample_test_stat($pArray1, $pArray2){
        $m1 = $this->mean($pArray1);
        $m2 = $this->mean($pArray2);
        $n = count($pArray2);
        $tt = (($m1 - $m2)*
        sqrt(($n*($n-1))/$this->two_sample_std_dev($pArray1,$pArray2)));
        return $tt;
    }

    //retrieves the p-value for the paired t-test
    public function two_sample_p_val($pArray1, $pArray2){
        $tt = $this->two_sample_test_stat($pArray1, $pArray2);
        $p_val = $this->retrievepval($pArray2, $tt);
        return $p_val;
    }

    public function std_dev($an_array){
        $sum = 0;
        $mean = $this->mean($an_array);
        for ($index = 0; $index < count($an_array); $index++) {
            $sum = $sum + ($an_array[$index] - $mean)**2;
        }
        return (sqrt($sum /(count($an_array) - 1)));
    }

    //NOTE: this is TWO SIDED not TWO SAMPLES
    public function two_sided_pval($pArray, $palpha, $null){
        printf("Null hypothesis: mean is %f <br>", $null);
        $teststat = $this->getteststat($pArray, $null);
        printf("Test Stat: %f", $teststat);
        $this->getconfinterval($pArray, $palpha);
        $prob = $this->retrievepval($pArray, $teststat);
        printf("p-value: %f <br>", $prob);
        printf("with alpha value of %f <br>", $palpha);
        if ($prob < $palpha){echo "We reject the null hypothesis";}
        else{echo "we fail to reject the null hypothesis";}
    }

    //takes two arrays same length and forms a new array from the difference between each values
    //and returns array of differences
    public function find_difference($pArray1, $pArray2){
        $diff = array();
        for ($index = 0; $index < count($pArray1); $index++){
            array_push($diff, $pArray1[$index] - $pArray2[$index]);
        }
        return $diff;
    }

  public function mean($an_array){
      $sum = 0;
      for ($index = 0; $index < count($an_array); $index++){
          $sum = $sum + $an_array[$index];
      }
      return $sum/count($an_array);
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
      return $median;
  }

  public function fiveNumber($anArray){
      $sorted = $anArray;
      sort($sorted);
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
      $median = $this->findMedian($sorted);
      $q1 = $this->findMedian($left);
      $q3 = $this->findMedian($right);
      $fiveNumber = [$lower, $q1, $median, $q3, $upper];
      return $fiveNumber;
  }

  public function BuildHistogram($draw_data)
  {
      $return_string = "";
      $return_string .= "<thead><tr><td>&nbsp;</td>";
      $max_val=0; // maximum value to use for spacing
      $min_val=$draw_data[0]; //minimum value to use for spacing
      $intervals=array(); //array that will be used to establish intervals
      //finds the maximum and minimum values in the database array
      for ($i=0;$i<count($draw_data);$i++){
               if ($max_val<$draw_data[$i])
                   $max_val=$draw_data[$i];
               if ($min_val>$draw_data[$i])
                   $min_val=$draw_data[$i];

           }
      $mean=($max_val+$min_val)/5;
      //sets up the 5 intervals to use in the histogram
      array_push($intervals, $min_val);
      for ($i=0;$i<5;$i++){
          if ($i<4){
          $return_string = $return_string .  "<th scope=col>" . $min_val."-".($min_val+$mean) . "</th>";
          $min_val=$min_val+$mean;
          }
          else{
          $return_string .= "<th scope=col>" . $min_val."+" . "</th>";
          }
          array_push($intervals, $min_val);
      }


      $hold_val=array(); //sets the 5 spaces in hold_val to 0
      for ($i=0;$i<count($intervals);$i++){
          $hold_val[$i]=0;
      }

      //figures out how many people fell within each interval
      for ($i=0;$i<count($draw_data);$i++){
          $interval_index=0;
          while ($draw_data[$i]>$intervals[$interval_index+1] and
          $interval_index<count($intervals)-2){
              $interval_index++;
          }

          $hold_val[$interval_index]++;

      }

      $return_string .= "</tr></thead><tbody><tr><th scope='row'>Maze</th>";
      for($i=0;$i<count($hold_val);$i++){
              $return_string .= "<td>" . $hold_val[$i] . "</td>";
      }
      $return_string .= "</tr></tbody>";
      return $return_string;
  }

}
