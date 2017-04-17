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
        $alpha_div_2 = $alpha/2;
        $command = sprintf("python3 get_tval.py %f %f", $alpha_div_2,
        count($pArray) - 1);
        exec($command, $t);
        $mean = mean($pArray);
        $lowerbound = $mean - $t[0]*$standard_deviation_div_sqrtn;
        $upperbound = $mean + $t[0]*$standard_deviation_div_sqrtn;
        printf("the confidence interval is [ %f, %f]",
        $lowerbound, $upperbound);
    }

    function main($pArray, $nullmean, $alpha){
        $teststat = (float) getteststat($pArray, $nullmean);
        printf("the test statistic is %f", $teststat);
        //prints test stat
        getconfinterval($pArray. $alpha); //prints confidence interval
        $p_value = retrievepval($pArray, $teststat); //prints p value
        printf("the p value is %f", $p_value);
        if ($p_value < $alpha){echo "We reject the null hypothesis";}
        else{echo "We fail to reject the null hypothesis";}
        
    }
}


