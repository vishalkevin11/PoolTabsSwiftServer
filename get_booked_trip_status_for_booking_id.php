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


$bookedTripID_val                  = isset($_GET['bookedTripID']) ? "'".$_GET['bookedTripID']."'" : "";

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

$sql = "SELECT ownerEmail,isBooked,isPending,isExpired,seatsBooked,totalSeatsOffered,bookieEmail,bookiePhoneNumber,
  bookedTripID,message,messageTag,deviceToken,ownerPhoneNumber,deviceType
         FROM BookingInfo where bookedTripID = ".$bookedTripID_val."";

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
  echo '"status_code" : 400,';
  echo '"status_message" : "No ProductType results found in our server."';
  echo "}";
    exit;
}


 
$response_array = array();

 while ($row = mysql_fetch_assoc($product_type_result)) {


$tmpBusArray = array(
 'ownerEmail' => $row['ownerEmail'],
 'isBooked' => $row['isBooked'],
 'isPending' => $row['isPending'],
 'isExpired' => $row['isExpired'],
 'seatsBooked' => $row['seatsBooked'],
 'totalSeatsOffered' => $row['totalSeatsOffered'],
 'bookieEmail' => $row['bookieEmail'],
 'bookiePhoneNumber' => $row['bookiePhoneNumber'],
 'bookedTripID' => $row['bookedTripID'],
 'message' => $row['message'],
 'messageTag' => $row['messageTag'],
 'deviceToken' => $row['deviceToken'],
 'ownerPhoneNumber' => $row['ownerPhoneNumber'],
 'deviceType' => $row['deviceType']
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

echo '"bookies" :'.json_encode($response_array);

echo "}";

  }

 
mysql_free_result($product_type_result);

?>