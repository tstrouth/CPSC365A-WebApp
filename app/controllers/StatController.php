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
        $command = sprintf("python3 get_pval.py %f %f", $teststat, $df);
        exec($command, $pval);
        return $pval[0];
    }

    //inputs an array and a value from null hypothesis inputted by user
    //calculates the test statistic
    function getteststat($pArray, $nullmean){
        $n = count($pArray);
        $tt = (mean($pArray) - $nullmean)/(std_dev($pArray)/sqrt($n));
        return $tt;
    }


    //needs an inputted array of population data
    //calculates the confidence interval of the population data
    function getconfinterval($pArray, $alpha){
        $standard_deviation_div_sqrtn = (std_dev($pArray)/sqrt(count($pArray)));
        $alpha_div_2 = (float) $alpha/2;
        $df = count($pArray) - 1;
        $command = sprintf("python3 get_tval.py %f %d", $alpha_div_2, $df);
        exec($command, $t);
        $mean = mean($pArray);
        $lowerbound = $mean - $t[0]*$standard_deviation_div_sqrtn;
        $upperbound = $mean + $t[0]*$standard_deviation_div_sqrtn;
        printf("the confidence interval is [ %f, %f] <br>", $lowerbound,
        $upperbound);
    }

    //computes the sum of ((x_x -x\bar) -((yi-y\bar)) ^ 2
    //part of the matched pairs t-test formula 
    function matched_pairs_std_dev($pArray1, $pArray2){
        $sum = 0;
        $mean1 = mean($pArray1);
        $mean2 = mean($pArray2);
        for ($index = 0; $index < count($pArray2); $index++) {
            $x_i = ($pArray1[$index] - $mean1);
            $y_i = ($pArray2[$index] - $mean2);
            $sum = $sum + ($x_i - $y_i)**2;
        }
        return $sum;
    
    }

    //computes the test statistic for the paired t-test
    function matched_pairs_test_stat($pArray1, $pArray2){
        $m1 = mean($pArray1);
        $m2 = mean($pArray2);
        $n = count($pArray2);
        $tt = (($m1 - $m2)*
        sqrt(($n*($n-1))/matched_pairs_std_dev($pArray1,$pArray2)));
        return $tt;
    }

    //retrieves the p-value for the paired t-test
    function matched_pairs_p_val($pArray1, $pArray2){
        $tt = matched_pairs_test_stat($pArray1, $pArray2);
        $p_val = retrievepval($pArray2, $tt);
        return $p_val;
    }
    
}


