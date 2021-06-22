<?php 

// Filters inputs form users messages 
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// WOrks out average on track score

function countRecords($arr){
  $total = [];
  $rowCount = [];
  // loops through nested arrays and pushes results into empty arrays
  foreach($arr as $sum){
   array_push($total, array_sum($sum));
   array_push($rowCount, count($sum));
  }
  
  return round(array_sum($total) / array_sum($rowCount));
};

