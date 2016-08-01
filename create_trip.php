    <?php



      $conn = mysqli_connect('localhost', 'root', 'root', 'TavantPool');
        
        if (!$conn) {
            echo 'Could not connect to mysql';
            exit;
    }
        
       date_default_timezone_set("Asia/Kolkata");
       $date = date('Y/m/d h:i:s', time());

       //echo "djdjndjndfjn".$_POST['source_lat'];



$handle = fopen('php://input','r');
$jsonInput = fgets($handle);
$decoded = json_decode($jsonInput,true);






// $jsonString = file_get_contents('php://input');
// print_r($decoded['source_name']);
 //echo "djdjndjndfjn".$decoded['records'];
//echo json_encode($jsonString);
// $jsonString = file_get_contents('php://input');
// $jsonArray = json_decode($json_string, true);
 //var_dump($decoded['records'])
 //echo "{";
//    //echo "<br/>";
//   echo '"status_code" : 200,';
//   //echo "<br/>";

//   //echo "<br/>";
//    echo '"status_message" : "successfully fetched data",';
//   //echo "<br/>";


// $data333 = json_decode($_POST["records"]);
//     $myarray = $data333->myarray;

//     foreach($myarray as $singular)
//     {
//         // do something

//       echo "value".json_encode($singular);
//     }


 //   echo '"trips" :'. var_dump($decoded['records']) ;

 // echo "}";




    $unixtime = strtotime("now");
/*
       $trip_path = isset($_POST['trip_path']) ? "'".$_POST['trip_path']."'" : "\"\"";
       $source_name =  isset($_POST['source_name']) ? "'".$_POST['source_name']."'" : "\"\"";
       $destination_name =  isset($_POST['destination_name']) ? "'".$_POST['destination_name']."'" : "\"\"";


        $source_lat                 =  isset($_POST['source_lat']) ? "".$_POST['source_lat']."" : 0.0;
        $source_lng                 =  isset($_POST['source_lng']) ? "".$_POST['source_lng']."" : 0.0;

        $destination_lat            =  isset($_POST['destination_lat']) ? "".$_POST['destination_lat']."" : 0.0;
        $destination_lng            =  isset($_POST['destination_lng']) ? "".$_POST['destination_lng']."" : 0.0;

        $time_leaving_source        =  isset($_POST['time_leaving_source']) ? "'".$_POST['time_leaving_source']."'" : "\"\"";
        $time_leaving_destination   =  isset($_POST['time_leaving_destination']) ? "'".$_POST['time_leaving_destination']."'" : "\"\"";
        $number_of_seats            =  isset($_POST['number_of_seats']) ? "".$_POST['number_of_seats']."" : 0;
        $traveller_type             =  isset($_POST['traveller_type']) ? "".$_POST['traveller_type']."" : 0;
        $trip_type                  =  isset($_POST['trip_type']) ? "".$_POST['trip_type']."" : 0;

        $total_trip_time            =  isset($_POST['total_trip_time']) ? "'".$_POST['total_trip_time']."'" : "\"\"";
        $total_trip_distance        =  isset($_POST['total_trip_distance']) ? "'".$_POST['total_trip_distance']."'" : "\"\"";
        $trip_via                   =  isset($_POST['trip_via']) ? "'".$_POST['trip_via']."'" : "\"\"";
       // $uniqueid_val        = $unixtime
        $uniqueid_val               = isset($_POST['uniqueid']) ? "".$_POST['uniqueid']."" : 0.0;
        $phonenumber_val            = isset($_POST['phone']) ? "'".$_POST['phone']."'" : "\"\"";
        $email_val                  = isset($_POST['email']) ? "'".$_POST['email']."'" : "\"\"";
        $is_trip_live               = isset($_POST['is_trip_live']) ? "".$_POST['is_trip_live']."" : 0;

    $records =  $_POST['records'];
*/
    //echo "sssss".$_POST['source_lat'];

 // echo "{";
 //       echo '"trips" :'. var_dump($records) ;

 //  echo "}";



    $trip_path = isset($decoded['trip_path']) ? "'".$decoded['trip_path']."'" : "\"\"";
       $source_name =  isset($decoded['source_name']) ? "'".$decoded['source_name']."'" : "\"\"";
       $destination_name =  isset($decoded['destination_name']) ? "'".$decoded['destination_name']."'" : "\"\"";


        $source_lat                 =  isset($decoded['source_lat']) ? "".$decoded['source_lat']."" : 0.0;
        $source_lng                 =  isset($decoded['source_lng']) ? "".$decoded['source_lng']."" : 0.0;

        $destination_lat            =  isset($decoded['destination_lat']) ? "".$decoded['destination_lat']."" : 0.0;
        $destination_lng            =  isset($decoded['destination_lng']) ? "".$decoded['destination_lng']."" : 0.0;

        $time_leaving_source        =  isset($decoded['time_leaving_source']) ? "'".$decoded['time_leaving_source']."'" : "\"\"";
        $time_leaving_destination   =  isset($decoded['time_leaving_destination']) ? "'".$decoded['time_leaving_destination']."'" : "\"\"";
        $number_of_seats            =  isset($decoded['number_of_seats']) ? "".$decoded['number_of_seats']."" : 0;
        $traveller_type             =  isset($decoded['traveller_type']) ? "".$decoded['traveller_type']."" : 0;
        $trip_type                  =  isset($decoded['trip_type']) ? "".$decoded['trip_type']."" : 0;

        $total_trip_time            =  isset($decoded['total_trip_time']) ? "'".$decoded['total_trip_time']."'" : "\"\"";
        $total_trip_distance        =  isset($decoded['total_trip_distance']) ? "'".$decoded['total_trip_distance']."'" : "\"\"";
        $trip_via                   =  isset($decoded['trip_via']) ? "'".$decoded['trip_via']."'" : "\"\"";
       // $uniqueid_val        = $unixtime
        $uniqueid_val               = isset($decoded['uniqueid']) ? "".$decoded['uniqueid']."" : 0.0;
        $phonenumber_val            = isset($decoded['phone']) ? "'".$decoded['phone']."'" : "\"\"";
        $email_val                  = isset($decoded['email']) ? "'".$decoded['email']."'" : "\"\"";
        $is_trip_live               = isset($decoded['is_trip_live']) ? "".$decoded['is_trip_live']."" : 0;

    $records =  $decoded['records'];


   
    $sql = "INSERT INTO PoolTrip (trip_path, 
        source_name, 
        destination_name,
        source_lat,
        source_lng,
        destination_lat,
        destination_lng, 
        time_leaving_source, 
        time_leaving_destination,
        number_of_seats,
        traveller_type, 
        trip_type, 
        total_trip_time,
        total_trip_distance,
        trip_via, 
        uniqueid_val,
        phonenumber_val, 
        email_val,
        is_trip_live)
VALUES ($trip_path, 
    $source_name, 
    $destination_name,
    $source_lat,
        $source_lng,
        $destination_lat,
        $destination_lng, 
    $time_leaving_source, 
    $time_leaving_destination,
    $number_of_seats,
    $traveller_type, 
    $trip_type, 
    $total_trip_time,
    $total_trip_distance,
    $trip_via, 
    $uniqueid_val,
    $phonenumber_val, 
    $email_val,
    $is_trip_live);";

    
 //echo "SQL ".$_POST['destination_lat'];
//var_dump($records);

// foreach ($records as $object) {
//   echo $object;
// }

$someJSON = '[
   {
      "distance":"0.3 km",
      "duration":"2 mins",
      "latitude":"12.9148937",
      "longitude":"77.5882616",
      "rawInstructions":"Head west on 20th Main Rd toward 3rd Cross Rd",
      "routeId":1488
   },
   {
      "distance":"44 m",
      "duration":"1 min",
      "latitude":"12.9119919",
      "longitude":"77.5881957",
      "rawInstructions":"Turn right onto 7th Cross Rd",
      "routeId":1488
   },
   {
      "distance":"0.2 km",
      "duration":"1 min",
      "latitude":"12.9119933",
      "longitude":"77.5877879",
      "rawInstructions":"Turn left after Trendy Pre - School (on the left)",
      "routeId":1488
   },
   {
      "distance":"1.3 km",
      "duration":"4 mins",
      "latitude":"12.9105318",
      "longitude":"77.58773189999999",
      "rawInstructions":"Turn left onto 9th Cross RdPass by Sree Tirumalagiri Lakshmi Venkateshwara Devasthanam (on the right)",
      "routeId":1488
   },
   {
      "distance":"0.4 km",
      "duration":"1 min",
      "latitude":"12.9106421",
      "longitude":"77.60000719999999",
      "rawInstructions":"Turn left at Jayadev Junction 2 onto 100 Feet Ring Rd/Bannerghatta Main Rd/Outer Ring RdPass by Shilpa Kala Mantap (on the left)",
      "routeId":1488
   },
   {
      "distance":"2.4 km",
      "duration":"6 mins",
      "latitude":"12.9142517",
      "longitude":"77.5998867",
      "rawInstructions":"Keep right to continue on Bannerghatta Main RdPass by the pharmacy (on the left in 1.0&nbsp,km)",
      "routeId":1488
   },
   {
      "distance":"0.1 km",
      "duration":"1 min",
      "latitude":"12.935668",
      "longitude":"77.6013427",
      "rawInstructions":"Keep left to continue on Bannerghatta-Marigowda Turn RdPass by Government Industrial Training Institute (on the left)",
      "routeId":1488
   },
   {
      "distance":"1.5 km",
      "duration":"5 mins",
      "latitude":"12.9367409",
      "longitude":"77.6014873",
      "rawInstructions":"Turn right at Dairy Cir onto Bannerghatta-Marigowda Turn Rd/Hosur Main Road/Marigowda RdContinue to follow Hosur Main RoadPass by Prestige Acropolis (on the left in 1.0&nbsp,km)",
      "routeId":1488
   },
   {
      "distance":"0.3 km",
      "duration":"1 min",
      "latitude":"12.9320053",
      "longitude":"77.61341059999999",
      "rawInstructions":"Sharp left onto Hosur RdPass by Shoppers Stop (on the left)",
      "routeId":1488
   },
   {
      "distance":"0.4 km",
      "duration":"2 mins",
      "latitude":"12.934336",
      "longitude":"77.6123212",
      "rawInstructions":"Turn right after UCO Bank - Koramangala Branch (on the left)Pass by Royal Arcade (on the right)",
      "routeId":1488
   },
   {
      "distance":"0.3 km",
      "duration":"1 min",
      "latitude":"12.935886",
      "longitude":"77.6153388",
      "rawInstructions":"Continue straight onto 20th Main Rd/Ganapathi Temple Rd/Koramangala 80 Feet RdContinue to follow 20th Main Rd/Ganapathi Temple RdPass by Masjid E Mamoor ( Koramangala ) (on the right)",
      "routeId":1488
   },
   {
      "distance":"0.2 km",
      "duration":"1 min",
      "latitude":"12.9367675",
      "longitude":"77.61809769999999",
      "rawInstructions":"Turn right onto 3rd Cross Rd",
      "routeId":1488
   },
   {
      "distance":"41 m",
      "duration":"1 min",
      "latitude":"12.9359372",
      "longitude":"77.6194515",
      "rawInstructions":"Turn right onto 17th E Main Rd",
      "routeId":1488
   },
   {
      "distance":"87 m",
      "duration":"1 min",
      "latitude":"12.9356128",
      "longitude":"77.61927109999999",
      "rawInstructions":"Turn left",
      "routeId":1488
   }
]';

 //$someJSON = '[{"latitude":12.77,"longitude":12.555,"routeId":1234.0},{"latitude":12.77,"longitude":12.555,"routeId":8978.0},{"latitude":14.77,"longitude":17.555,"routeId":5978.0}]';
// $records1 = json_decode($someJSON, true);
 // print_r($records);   
// echo "value".json_encode($records);

//  echo "{";

if(is_array($records)){
   // echo "okkkkk".sizeof($records);


  for ($arrayIndex=0; $arrayIndex < count($records); $arrayIndex++) { 

    $value = $records[$arrayIndex];

$latValue =  isset($value["latitude"]) ? $value["latitude"] : 0.0;
$longValue =  isset($value["longitude"]) ? $value["longitude"] : 0.0;
$routeIdValue =  isset($value["routeId"]) ? $value["routeId"] : 0.0;
$distanceValue = isset($_POST['distance']) ? "'".$_POST['distance']."'" : "\"\"";
$durationValue =  isset($_POST['duration']) ? "'".$_POST['duration']."'" : "\"\"";
$htmlImstructionValue =  isset($_POST['rawInstructions']) ? "'".$_POST['rawInstructions']."'" : "\"\"";

 $sql  .= "INSERT INTO LatLongs (latitude, longitude, routeId, distance , duration,htmlImstruction) 
                VALUES ($latValue,$longValue,$routeIdValue,$distanceValue,$durationValue,$htmlImstructionValue);";
 //echo "value".json_encode($records);
  }

//     foreach ($records as $key => $value) {


// $latValue =  isset($value["latitude"]) ? $value["latitude"] : 0.0;
// $longValue =  isset($value["longitude"]) ? $value["longitude"] : 0.0;
// $routeIdValue =  isset($value["routeId"]) ? $value["routeId"] : 0.0;
// $distanceValue = isset($_POST['distance']) ? "'".$_POST['distance']."'" : "\"\"";
// $durationValue =  isset($_POST['duration']) ? "'".$_POST['duration']."'" : "\"\"";
// $htmlImstructionValue =  isset($_POST['rawInstructions']) ? "'".$_POST['rawInstructions']."'" : "\"\"";



//     echo $latValue . ", " . $longValue . ", " . $routeIdValue . "<br>";
     //  $sql  .= "INSERT INTO LatLongs (latitude, longitude, routeId, distance , duration,htmlImstruction) VALUES ($latValue,$longValue,$routeIdValue,$distanceValue,$durationValue,$htmlImstructionValue);";
        //mysqli_query($conn, $query);
  }

// echo "}";

  // echo "string".$sql;
 
 //}
 //echo "}";



        
        if (mysqli_multi_query($conn, $sql)) {
            echo "{";
            echo '"status_code" : 200,';
            echo '"status_message" : "Successfully created Trip"';
            echo "}";
            
        } else {
            echo "{";
            echo '"status_code" : 200,';
           // echo '"status_code_s" :'.$sql.',';
            echo '"status_message" : "Failed  to create trip"';
            echo "}";
            
        }

      

    mysqli_close($conn);
    ?>