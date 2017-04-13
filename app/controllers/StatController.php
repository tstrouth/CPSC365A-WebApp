<?php

class StatController extends Controller {

    public function showWelcome()
	{
		return View::make('hello');
	}

    //needs an array and inputted test statisitc executes a python program and
    //returns the probability value
    function retrievepval($pArray, $teststat){
        $df = count($pArray) - 1;
        $stringtt = sprintf("%f", $teststat);
        $stringdf = sprintf("%f", $df);
        exec('python3 get_pval.py '.$stringtt.' '. $stringdf, $pval);
        echo sprintf(" and the p value is %f \n", $pval[0]);
    }

    //echo "passed first function \n";
    //inputs an array and a value from null hypothesis inputted by user
    //calculates the test statistic
    function getteststat($pArray, $nullmean){
        //echo 'in the function';
        $n = count($pArray);
        $tt = (mean($pArray) - $nullmean)/(std_dev($pArray)/sqrt($n));
        return $tt;
    }

    //echo "\n passed second function";

    //needs an inputted array of population data
    //calculates the confidence interval of the population data
    function getconfinterval($pArray){
        $standard_deviation_div_sqrtn = (std_dev($pArray)/sqrt(count($pArray)));
        $stringdf = sprintf("%f", (count($pArray) - 1));
        exec('python3 get_tval.py .025 '.$stringdf , $t);
        $mean = mean($pArray);
        $lowerbound = $mean - $t[0]*$standard_deviation_div_sqrtn;
        $upperbound = $mean + $t[0]*$standard_deviation_div_sqrtn;
        echo "the confidence interval is [";
        echo $lowerbound;
        echo " , ";
        echo $upperbound;
        echo "] \n";
    }

   //echo "\n passed third function";

    function main($pArray, $nullmean){
        $teststat = (float) getteststat($pArray, $nullmean);
        //echo 'made it to second line';
        echo sprintf("the test statistic is %f\n", $teststat); //prints test stat
        //echo "made it after the test stat";
        getconfinterval($pArray); //prints confidence interval
        retrievepval($pArray, $teststat); //prints p value
    }
}


