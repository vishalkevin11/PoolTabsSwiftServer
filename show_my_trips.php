
<?php 

 if (!$link = @mysql_connect('localhost', 'root', 'root')) {
    echo 'Could not connect to mysql';
    exit;
}


if (!mysql_select_db('TavantPool', $link)) {
    echo 'Could not select database';
    exit;
}


date_default_timezone_set("Asia/Kolkata");

    //$trip_path = $_POST['trip_path'];

    // $source_name =  $_POST['source_name'];
    // $destination_name =  $_POST['destination_name'];
    // $number_of_seats =  $_POST['number_of_seats'];
    
    // $time_leaving_source =  $_POST['time_leaving_source'];
    // $time_leaving_destination =  $_POST['time_leaving_destination'];
    // $traveller_type =  $_POST['traveller_type'];
    // $trip_type =  $_POST['trip_type'];
    // $total_trip_time =  $_POST['total_trip_time'];
    // $uniqueid_val        = strtotime($date);
    // $phonenumber_val     = $_POST['phone'];
   //  $email_val           = $_POST['email'];


// $sql = "SELECT trip_path, 
//         source_name, 
//         destination_name, 
//         time_leaving_source, 
//         time_leaving_destination,
//         number_of_seats,
//         traveller_type, 
//         trip_type, 
//         total_trip_time, 
//         uniqueid_val,
//         phonenumber_val, 
//         email_val,
//         is_trip_live
//         FROM PoolTrip WHERE email_val 
//                        LIKE '%".$email_val."%';";


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
        FROM PoolTrip ;";



//echo "string".$sql;

$product_type_result = mysql_query($sql,$link);

//echo 'this is crap'.json_encode($busResult);
 //print_r ($sql);
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
   'source_name' =>  $row['source_name'],
    'destination_name' =>  $row['destination_name'],
    'time_leaving_source' =>  $row['time_leaving_source'],
    'time_leaving_destination' =>  $row['time_leaving_destination'],
    'number_of_seats' =>  $row['number_of_seats'],
    'traveller_type' =>  $row['traveller_type'],
    'trip_type' =>  $row['trip_type'],
    'total_trip_time' =>  $row['total_trip_time'],
    'uniqueid_val' => $row['uniqueid_val'],
    'phonenumber_val' => $row['phonenumber_val'],
   'email_val' => $row['email_val']
   // 'is_trip_live'=> $row['is_trip_live']
    );
$response_array[] = $tmpBusArray;
    
  }

  $results_count = count($response_array);

   echo "{";
   //echo "<br/>";
  echo '"status_code" : 200,';
  //echo "<br/>";
  echo '"count" : '.$results_count.',';
  //echo "<br/>";
   echo '"status_message" : "successfully fetched data",';
  //echo "<br/>";

if (count($response_array)>=0) {

echo '"trips" :'.json_encode($response_array);

echo "}";

  }

 
mysql_free_result($product_type_result);

?>