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

// $origLat = $_POST['latitude'];
// $origLon = $_POST['longitude'];

$dist = 10;
$origLat = 42.1365;
$origLon = -71.7559;
  //  $offset_value = $_POST['offset'];
    $limit_value = $_POST['limit'];

if (isset($_POST["page"])) { 
	$page  = $_POST["page"]; 
} 
else {
 $page=1; 
}; 
$start_from = ($page-1) * $limit_value; 













$db = new database(); // Initiate a new MySQL connection
$tableName = "db.table";

 // This is the maximum distance (in miles) away from $origLat, $origLon in which to search
$sql = "SELECT placename, latitude, longitude, 3956 * 2 * 
          ASIN(SQRT( POWER(SIN(($origLat - latitude)*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS(latitude*pi()/180)
          *POWER(SIN(($origLon-longitude)*pi()/180/2),2))) 
          as distance FROM $tableName WHERE 
          longitude between ($origLon-$dist/cos(radians($origLat))*69) 
          and ($origLon+$dist/cos(radians($origLat))*69) 
          and latitude between ($origLat-($dist/69)) 
          and ($origLat+($dist/69)) 
          having distance < $dist ORDER BY distance limit 100"; 
// $result = mysql_query($query) or die(mysql_error());
// while($row = mysql_fetch_assoc($result)) {
//     echo $row['name']." > ".$row['distance']."<BR>";
// }
// mysql_close($db);







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
//         FROM PoolTrip WHERE source_name 
//                        LIKE '%".$source_name."%' and destination_name  
//                        LIKE '%".$destination_name."%' and number_of_seats  = ".$number_of_seats." ORDER BY name ASC LIMIT $start_from,".$limit_value.";";

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
   'source_name' =>  $row['source_name'],
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



