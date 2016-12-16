<?php require 'db_connect_tavant.php';


//header("Access-Control-Allow-Origin: *");


if (!$link = @mysql_connect($host_name, $db_user_name, $db_user_password)) {

//if (!$link = @mysql_connect('mysql.hostinger.in', 'u355642838_kevi', '123456')) {
//if (!$link = @mysql_connect('localhost', 'root', 'root')) {
    echo 'Could not connect to mysql';
    exit;
}


//if (!mysql_select_db('u355642838_tpool', $link)) {
//if (!mysql_select_db('TavantPoolWeekDay', $link)) {
if (!mysql_select_db($db_name, $link)) {
    echo 'Could not select database';
    exit;
}


date_default_timezone_set("Asia/Kolkata");


$email_val                  = isset($_GET['email_val']) ? "'".$_GET['email_val']."'" : "";



$sql = "SELECT uniqueid_val,
    trip_path,
  source_name, 
  destination_name,
  source_lat,
        source_lng,
        destination_lat,
        destination_lng, 
  time_leaving_source, time_leaving_destination,
   number_of_seats, traveller_type, trip_type, total_trip_time,total_trip_distance,trip_via,
 phonenumber_val, email_val, is_trip_live,schedule_type,
        day1,
        day2,
        day3,
        day4,
        day5,
        day6,
        day7,
        tripDate,
        isBooked,
        isPending,
        totalSeatsOffered,
        seatsBooked
         FROM PoolTrip where is_trip_live = 1 and uniqueid_val IN (SELECT  bookedTripID FROM BookingInfo WHERE bookieEmail = ".$email_val.")";

                      /* $sql = "SELECT uniqueid_val,
    trip_path,
  source_name, 
  destination_name,
  source_lat,
        source_lng,
        destination_lat,
        destination_lng, 
  time_leaving_source, time_leaving_destination,
   number_of_seats, traveller_type, trip_type, total_trip_time,total_trip_distance,trip_via,
 phonenumber_val, email_val, is_trip_live, routeId
         FROM PoolTrip , LatLongs WHERE PoolTrip.uniqueid_val = LatLongs.routeId;";

*/
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
    'source_lat' =>  $row['source_lat'],
    'source_lng' =>  $row['source_lng'],
    'destination_lat' =>  $row['destination_lat'],
    'destination_lng' =>  $row['destination_lng'],
    'time_leaving_source' =>  $row['time_leaving_source'],
    'time_leaving_destination' =>  $row['time_leaving_destination'],
    'number_of_seats' =>  $row['number_of_seats'],
    'traveller_type' =>  $row['traveller_type'],
    'trip_type' =>  $row['trip_type'],
    'total_trip_time' =>  $row['total_trip_time'],
    'total_trip_distance' =>  $row['total_trip_distance'],
    'trip_via' =>  $row['trip_via'],
    'uniqueid_val' => $row['uniqueid_val'],
    'phonenumber_val' => $row['phonenumber_val'],
   'email_val' => $row['email_val'],
   'schedule_type' => $row['schedule_type'],
   'day1' => $row['day1'],
   'day2' => $row['day2'],
   'day3' => $row['day3'],
   'day4' => $row['day4'],
   'day5' => $row['day5'],
   'day6' => $row['day6'],
   'day7' => $row['day7'],
   'tripDate' => $row['tripDate'],
   'isBooked' => $row['isBooked'],
   'isPending' => $row['isPending'],
   'totalSeatsOffered' => $row['totalSeatsOffered'],
   'seatsBooked' => $row['seatsBooked']

   //'routeId' => $row['routeId']
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