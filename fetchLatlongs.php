
<?php require 'db_connect_tavant.php';


//header("Access-Control-Allow-Origin: *");





if (!$link = @mysql_connect($host_name, $db_user_name, $db_user_password)) {


 //if (!$link = @mysql_connect('localhost', 'root', 'root')) {
// if (!$link = @mysql_connect('mysql.hostinger.in', 'u355642838_kevi', '123456')) {
    echo 'Could not connect to mysql';
    exit;
}


//if (!mysql_select_db('TavantPoolWeekDay', $link)) {
if (!mysql_select_db($db_name, $link)) {
//if (!mysql_select_db('u355642838_tpool', $link)) {
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
     $routeId        = $_GET['unique_value'];
   //  $routeId = 1470225228;
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


$sql = "SELECT latitude, longitude, routeId, distance , duration,htmlImstruction,polyline,orderID
         FROM LatLongs where routeId =".$routeId.";";

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
  echo '"status_code" : 200,';
  echo '"status_message" : "No ProductType results found in our server."';
  echo "}";
    exit;
}


 
$response_array = array();

 while ($row = mysql_fetch_assoc($product_type_result)) {


$tmpBusArray = array(
 'latitude' => $row['latitude'],
   'longitude' =>  $row['longitude'],
    'routeId' =>  $row['routeId'],
    'distance' =>  $row['distance'],
    'duration' =>  $row['duration'],
    'htmlImstruction' =>  $row['htmlImstruction'],
    'polyline' =>  $row['polyline'],
    'orderID' => $row["orderID"]
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

echo '"latlongs" :'.json_encode($response_array);

echo "}";

  }

 
mysql_free_result($product_type_result);

?>