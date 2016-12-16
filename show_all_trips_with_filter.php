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


    // $origin_latval =  $_POST['latitude'];
    // $origin_longval =  $_POST['longitude'];
    //$max_distance =  $_POST['max_distance'];


/*

A value of 6371 for the $earthMeanRadius argument (which is the default) is the earth mean radius in kilometres,
 which means that the returned result will be in kilometres.... if you want miles instead,
 then call it with an $earthMeanRadius argument value of 3,958; if you want nautical miles, change it to 3440, etc.
*/
//$dist = 10;
$max_distance =  2;
// $origLat = 12.9119919;
// $origLon = 77.5882616;

// $destLat = 12.9222464;
// $destLon = 77.5881957;


// $origLat = 12.9119919;
// $origLon = 77.5882616;
// $destLat = 12.9222464;
// $destLon = 77.5881957;


        $origLat            =  isset($_GET['source_lat']) ? "".$_GET['source_lat']."" : 0.0;
        $origLon            =  isset($_GET['source_lng']) ? "".$_GET['source_lng']."" : 0.0;

        $destLat            =  isset($_GET['destination_lat']) ? "".$_GET['destination_lat']."" : 0.0;
        $destLon            =  isset($_GET['destination_lng']) ? "".$_GET['destination_lng']."" : 0.0;

   
$number_of_seats            =  isset($_GET['number_of_seats']) ? "".$_GET['number_of_seats']."" : 0;
$traveller_type             =  isset($_GET['traveller_type']) ? "".$_GET['traveller_type']."" : 0;
        $trip_type          =  isset($_GET['trip_type']) ? "".$_GET['trip_type']."" : 0;
$email_val                  = isset($_GET['email_val']) ? "'".$_GET['email_val']."'" : "";

$schedule_type             =  isset($_GET['schedule_type']) ? "".$_GET['schedule_type']."" : 0;

//date('m/d/y', strtotime($date));
$trip_date =  isset($_GET['trip_date']) ? "".$_GET['trip_date']."" : "";

$sstime = strtotime($trip_date);

//$trip_timestamp = date('Y-m-d H:i:s', $sstime);
$trip_timestamp = date('Y-M-d', $sstime);

//1= Mon, 7 = sun
$weekdayIndex = date('w', strtotime($trip_timestamp));
//echo "ssss".$weekdayIndex;
//echo "tttttt".$trip_timestamp;

//echo "wdwdwwd".date_format($date,"Y/m/d H:i:s");

//echo "trip_date".$trip_timestamp;


 //echo "orglat".$traveller_type;
// echo "deslat".$destLat;
// echo "orglng".$origLon;
// echo "deslng".$deslng;

// echo "num".$number_of_seats;
// echo "trip_type".$trip_type;
// echo "email_val".$email_val;
  //  $email_val   = "aaa@bbb.com";
  // //$number_of_seats = 1;
  //  $trip_type  = 1;




$sql = "";

//$whereArr = [];



if($schedule_type!="" && $schedule_type != 0){
    $whereArr[] = "schedule_type =".$schedule_type."";
// if ($schedule_type == 1) {
//   //see only days
// }

}
else if($trip_date!=""){
    $whereArr[] = "tripDate like'".$trip_timestamp."%'";
    //echo "ssss".$whereArr[0];
}


if($traveller_type!="" && $traveller_type != 0){
    $whereArr[] = "traveller_type =".$traveller_type."";
}

if($trip_type!="" && $trip_type != 0){
    $whereArr[] = "trip_type =".$trip_type."";
}





if($email_val!=""){
    $whereArr[] = "email_val !=".$email_val."";
}

if($number_of_seats!="" && $number_of_seats != 0){
    $whereArr[] = "number_of_seats >=".$number_of_seats."";
}


if(($origLat!=""  && $origLat != 0.0) && ($origLon!=""  && $origLon != 0.0) && ($destLat==""  ||  $destLon==""   || $destLat == 0.0   || $destLon == 0.0) ){
    $destLat  = $origLat;
    $destLon  = $origLon;
}


//if(($destLat!=""  ||  $destLon!="") && ($origLat==""  ||  $origLon=="")){
if(($destLat!=""  && $destLat != 0.0) && ($destLon!=""  && $destLon != 0.0) && ($origLat==""  ||  $origLon==""   || $origLat == 0.0   || $origLon == 0.0) ){
    $origLat  = $destLat;
    $origLon  = $destLon;
}


$where_clause = implode(' AND ', $whereArr);




if($origLat!=""  &&  $origLon!="" && $destLat!=""  &&  $destLon!="" && $origLat!=0.0  &&  $origLon!=0.0 && $destLat!=0.0  &&  $destLon!=0.0){

$sql  .=  "SELECT  distinct uniqueid_val,
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
FROM    PoolTrip  where uniqueid_val IN (

SELECT  distinct uniqueid_val
FROM    PoolTrip 
        INNER JOIN (
          



SELECT distinct a.routeId , 3956 * 2 * 
          ASIN(SQRT( POWER(SIN(($origLat - a.latitude)*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS(a.latitude*pi()/180)
          *POWER(SIN(($origLon-a.longitude)*pi()/180/2),2))) as distanceA,

          3956 * 2 * 
          ASIN(SQRT( POWER(SIN(($destLat - b.latitude)*pi()/180/2),2)
          +COS($destLat*pi()/180 )*COS(b.latitude*pi()/180)
          *POWER(SIN(($destLon-b.longitude)*pi()/180/2),2))) as distanceB

from LatLongs a, LatLongs b 
where a.longitude between ($origLon-$max_distance/cos(radians($origLat))*69) 
          and ($origLon+$max_distance/cos(radians($origLat))*69) 
          and a.latitude between ($origLat-($max_distance/69)) 
          and ($origLat+($max_distance/69)) 

          and  b.longitude between ($destLon-$max_distance/cos(radians($destLat))*69) 
          and ($destLon+$max_distance/cos(radians($destLat))*69) 
          and b.latitude between ($destLat-($max_distance/69)) 
          and ($destLat+($max_distance/69)) 
          having (distanceB < $max_distance) and (distanceA < $max_distance 
          )

        ) LatLongs ON LatLongs.routeId = PoolTrip.uniqueid_val

) and is_trip_live = 1 and ".$where_clause.";";

}
else if(($origLat==""  &&  $origLon=="" && $destLat==""  &&  $destLon=="") || ($origLat==0.0  &&  $origLon==0.0 && $destLat==0.0  &&  $destLon==0.0)){


  $sql  .=  "SELECT  distinct uniqueid_val,
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
FROM    PoolTrip  where  is_trip_live = 1 and ".$where_clause.";";
}
else {
  $sql .= "SELECT  distinct uniqueid_val,
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
FROM    PoolTrip  where uniqueid_val IN (

SELECT  distinct uniqueid_val
FROM    PoolTrip 
        INNER JOIN (
          



SELECT distinct routeId , 3956 * 2 * 
          ASIN(SQRT( POWER(SIN(($origLat - latitude)*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS(latitude*pi()/180)
          *POWER(SIN(($origLon-longitude)*pi()/180/2),2))) as distanceA
from LatLongs
where longitude between ($origLon-$max_distance/cos(radians($origLat))*69) 
          and ($origLon+$max_distance/cos(radians($origLat))*69) 
          and latitude between ($origLat-($max_distance/69)) 
          and ($origLat+($max_distance/69)) 

  
          having  (distanceA < $max_distance)

        ) LatLongs ON LatLongs.routeId = PoolTrip.uniqueid_val

) and is_trip_live = 1 and ".$where_clause.";";
}






$limit_value = 10;
if (isset($_GET["page"])) { 
	$page  = $_GET["page"]; 
} 
else {
 $page=1; 
}; 
$start_from = ($page-1) * $limit_value; 

//echo "string ".$sql;

/*

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
 phonenumber_val, email_val, is_trip_live, routeId
         FROM PoolTrip , LatLongs WHERE PoolTrip.uniqueid_val = LatLongs.routeId and PoolTrip.uniqueid_val IN (


SELECT   uniqueid_val
FROM    PoolTrip  where uniqueid_val IN (

SELECT  distinct uniqueid_val
FROM    PoolTrip 
        INNER JOIN (
          



SELECT distinct a.routeId , 3956 * 2 * 
          ASIN(SQRT( POWER(SIN(($origLat - a.latitude)*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS(a.latitude*pi()/180)
          *POWER(SIN(($origLon-a.longitude)*pi()/180/2),2))) as distanceA,

          3956 * 2 * 
          ASIN(SQRT( POWER(SIN(($destLat - b.latitude)*pi()/180/2),2)
          +COS($destLat*pi()/180 )*COS(b.latitude*pi()/180)
          *POWER(SIN(($destLon-b.longitude)*pi()/180/2),2))) as distanceB

from LatLongs a, LatLongs b 
where a.longitude between ($origLon-$max_distance/cos(radians($origLat))*69) 
          and ($origLon+$max_distance/cos(radians($origLat))*69) 
          and a.latitude between ($origLat-($max_distance/69)) 
          and ($origLat+($max_distance/69)) 

          and  b.longitude between ($destLon-$max_distance/cos(radians($destLat))*69) 
          and ($destLon+$max_distance/cos(radians($destLat))*69) 
          and b.latitude between ($destLat-($max_distance/69)) 
          and ($destLat+($max_distance/69)) 
          having (distanceB < $max_distance) and (distanceA < $max_distance 
          )

        ) LatLongs ON LatLongs.routeId = PoolTrip.uniqueid_val

) and is_trip_live = 1

          );";

*/
/**********************************
$sql = "SELECT  distinct uniqueid_val,
    trip_path,
  source_name, 
  destination_name,
  source_lat,
        source_lng,
        destination_lat,
        destination_lng, 
  time_leaving_source, time_leaving_destination,
   number_of_seats, traveller_type, trip_type, total_trip_time,total_trip_distance,trip_via,
    phonenumber_val, email_val, is_trip_live
FROM    PoolTrip  where uniqueid_val IN (

SELECT  distinct uniqueid_val
FROM    PoolTrip 
        INNER JOIN (
          



SELECT distinct a.routeId , 3956 * 2 * 
          ASIN(SQRT( POWER(SIN(($origLat - a.latitude)*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS(a.latitude*pi()/180)
          *POWER(SIN(($origLon-a.longitude)*pi()/180/2),2))) as distanceA,

          3956 * 2 * 
          ASIN(SQRT( POWER(SIN(($destLat - b.latitude)*pi()/180/2),2)
          +COS($destLat*pi()/180 )*COS(b.latitude*pi()/180)
          *POWER(SIN(($destLon-b.longitude)*pi()/180/2),2))) as distanceB

from LatLongs a, LatLongs b 
where a.longitude between ($origLon-$max_distance/cos(radians($origLat))*69) 
          and ($origLon+$max_distance/cos(radians($origLat))*69) 
          and a.latitude between ($origLat-($max_distance/69)) 
          and ($origLat+($max_distance/69)) 

          and  b.longitude between ($destLon-$max_distance/cos(radians($destLat))*69) 
          and ($destLon+$max_distance/cos(radians($destLat))*69) 
          and b.latitude between ($destLat-($max_distance/69)) 
          and ($destLat+($max_distance/69)) 
          having (distanceB < $max_distance) and (distanceA < $max_distance 
          )

        ) LatLongs ON LatLongs.routeId = PoolTrip.uniqueid_val

) and is_trip_live = 1;";
******************/



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
   'is_trip_live' => $row['is_trip_live'],
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

  // 'routeId' => $row['routeId']
    );
$response_array[] = $tmpBusArray;
    
  }

  $results_count = count($response_array);

   echo "{";
  echo '"status_code" : 200,';
  echo '"count" : '.$results_count.',';
   echo '"status_message" : "successfully fetched data",';

if (count($response_array)>=0) {

echo '"trips" :'.json_encode($response_array);

echo "}";

  }

 
mysql_free_result($product_type_result);


?> 



