<?php

class StatController extends Controller {

    public function showWelcome()
	{
		return View::make('hello');
	}

    //needs an array and inputted test statisitc executes a python program and
    //returns the probability value  
    public function retrievepval($pArray, $teststat){
        $df = count($pArray) - 1;
        $stringtt = sprintf("%5f", $teststat);
        $stringdf = sprintf("%1f", $df);
        $pval = exec('python3 getpval.py '.$stringtt.' '. $stringdf);
        return $pval;
    }

   //inputs an array and a value from null hypothesis inputted by user
   //calculates the test statistic
    public function getteststat($pArray, $nullmean){
        $tt = ((mean($pArray) - $nullmean)/
        (std_dev($pArray)/sqrt(count($pArray))));
        return $tt;
    }

   //needs an inputted array of population data
   //calculates the confidence interval of the population data
    public function getconfinterval($pArray){
        $standard_deviation_div_sqrtn = ((std_devd($pArray)/
        sqrt(count($pArray))));
        $mean = mean($pArray);
        $tt = ($mean - $nullmean)/$standard_deviation_div_sqrtn;
        $lowerbound = $mean - $tt*$standard_deviation_div_sqrtn;
        $upperbound = $mean + $tt*$standard_deviation_div_sqrtn;
        echo ("the confidence interval is [",$lowerbound,
        " , "$upperbound, "] \n");
    }

    public function main($pArray, $nullmean){
        $teststat = getteststat($pArray, $nullmean=0);
        echo ("the test statistic is ",$teststat,"\n"); //prints test stat
        getconfinterval($pArray); //prints confidence interval
        echo ("p value ",retrievepval($pArray, $teststat),"\n");
        //prints p value
    }
}


