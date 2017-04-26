<html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=1024">
      <title>Histogram Test</title> <!-- title of the web tab-->
      <link rel="stylesheet" href="assets/css/csstest.css">
      <link rel="stylesheet" href="assets/css/csstest2.css">
   </head>

   <body>
      <div id="wrapper">
      <div class="chart">
        <h3>Time taken for  activity</h3>
     <table id="data-table" border="1" cellpadding="10" cellspacing="0">
     <thead>
                  <tr>
                     <td>&nbsp;</td>
     <?php

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
    echo "<th scope=col>" . $min_val,"-",$min_val+$mean . "</th>";
    $min_val=$min_val+$mean;
    }
    else{
    echo "<th scope=col>" . $min_val,"+" . "</th>";
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
     ?>
                  </tr>
               </thead>

     <tbody>
                  <tr>
     <th scope="row">Maze</th>
<?php
    //makes the rows for the histograms
    for($i=0;$i<count($hold_val);$i++){
            echo "<td>" . $hold_val[$i] . "</td>";
    }
	   ?>

                  </tr> 
               </tbody>
            </table>
          </div>
      </div>
      <script src="assets/js/google.js"></script>
      <script src="assets/js/test.js"></script>
    
   </body>
</html>
