
<?php 

if (!$link = @mysql_connect('localhost', 'root', 'root')) {
    echo 'Could not connect to mysql';
    exit;
}


if (!mysql_select_db('sharecare', $link)) {
    echo 'Could not select database';
    exit;
}

date_default_timezone_set("Asia/Kolkata");

    $source_name =  $_POST['source_name'];
    $destination_name =  $_POST['destination_name'];
    $number_of_seats =  $_POST['number_of_seats'];

$sql = "SELECT trip_path, 
        source_name, 
        destination_name, 
        time_leaving_source, 
        time_leaving_destination,
        number_of_seats,
        traveller_type, 
        trip_type, 
        total_trip_time, 
        uniqueid_val,
        phonenumber_val, 
        email_val,
        is_trip_live
        FROM PoolTrip WHERE source_name 
                       LIKE '%".$source_name."%' and destination_name  
                       LIKE '%".$destination_name."%' and number_of_seats  = ".$number_of_seats.";";



$product_type_result = mysql_query($sql,$link);

if (!$product_type_result) {

   echo "{";
  echo '"status_code" : 3477,';
  echo '"status_message" : "No ProductType results found in our server."';
  echo "}";
    exit;
}


 
$response_array = array();

 while ($row = mysql_fetch_assoc($product_type_result)) {


$tmpBusArray = array(
  'trip_path' => $row['trip_path'],
   ' source_name' =>  $row['source_name'],
    'destination_name' =>  $row['destination_name'],
    'time_leaving_source' =>  $row['time_leaving_source'],
    'time_leaving_destination' =>  $row['time_leaving_destination'],
    'number_of_seats' =>  $row['number_of_seats'],
    'traveller_type' =>  $row['traveller_type'],
    'trip_type' =>  $row['trip_type'],
    'total_trip_time' =>  $row['total_trip_time'],
    'uniqueid_val' => $row['uniqueid_val'],
    'phonenumber_val' => $row['phone'],
   'email_val' => $row['email']
    );
$response_array[] = $tmpBusArray;
    
  }

  $results_count = count($response_array);

   echo "{";
  echo '"status_code" : 7347,';
  echo '"count" : '.$results_count.',';
   echo '"status_message" : "successfully fetched data",';

if (count($response_array)>=0) {

echo '"trips" :'.json_encode($response_array);

echo "}";

  }

 
mysql_free_result($product_type_result);

?>