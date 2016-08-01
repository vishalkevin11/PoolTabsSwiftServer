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
$origLat = 12.87;
$origLon = 77.99;

$destLat = 12.87;
$destLon = 77.93;

  //  $offset_value = $_POST['offset'];
 //$limit_value = $_POST['limit'];
$limit_value = 10;
if (isset($_POST["page"])) { 
	$page  = $_POST["page"]; 
} 
else {
 $page=1; 
}; 
$start_from = ($page-1) * $limit_value; 



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


echo "".$sql;

/*$sql = "SELECT  distinct uniqueid_val,
    trip_path,
  source_name, 
  destination_name, 
  time_leaving_source, time_leaving_destination,
   number_of_seats, traveller_type, trip_type, total_trip_time,
    phonenumber_val, email_val, is_trip_live
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

        ) LatLongs ON LatLongs.routeId = PoolTrip.uniqueid_val";
*/

 // This is the maximum distance (in miles) away from $origLat, $origLon in which to search
/*

$sql = "SELECT  PoolTrip.source_name, PoolTrip.uniqueid_val
FROM    PoolTrip
        INNER JOIN (
          
          (SELECT routeId, 3956 * 2 * 
          ASIN(SQRT( POWER(SIN(($origLat - latitude)*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS(latitude*pi()/180)
          *POWER(SIN(($origLon-longitude)*pi()/180/2),2))) as distance 
          FROM LatLongs WHERE 
          longitude between ($origLon-$max_distance/cos(radians($origLat))*69) 
          and ($origLon+$max_distance/cos(radians($origLat))*69) 
          and latitude between ($origLat-($max_distance/69)) 
          and ($origLat+($max_distance/69)) 
          having distance < $max_distance ORDER BY distance limit 10)

        ) LatLongs ON LatLongs.routeId = PoolTrip.uniqueid_val";


*/

/*
$sql = "SELECT  distinct uniqueid_val,
    trip_path,
  source_name, 
  destination_name, 
  time_leaving_source, time_leaving_destination,
   number_of_seats, traveller_type, trip_type, total_trip_time,
    phonenumber_val, email_val, is_trip_live
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

        ) LatLongs ON LatLongs.routeId = PoolTrip.uniqueid_val";

      */

//echo "".$sql;

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
    'total_trip_time' =>  $row['total_trip_time'],
    'total_trip_time' =>  $row['total_trip_time'],
    'uniqueid_val' => $row['uniqueid_val'],
    'phonenumber_val' => $row['phonenumber_val'],
   'email_val' => $row['email_val'],
   'is_trip_live' => $row['is_trip_live']
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



