<?php require 'db_connect_tavant.php';


// header("Access-Control-Allow-Origin: *");



      $conn = mysqli_connect($host_name, $db_user_name, $db_user_password, $db_name);



    //   $conn = mysqli_connect('localhost', 'root', 'root', 'TavantPoolWeekDay');
        
    //     if (!$conn) {
    //         echo 'Could not connect to mysql';
    //         exit;
    // }

//          $conn = mysqli_connect('mysql.hostinger.in', 'u355642838_kevi', '123456', 'u355642838_tpool');
//$conn = mysqli_connect('localhost', 'root', 'root', 'TavantPoolWeekDay');
        
        if (!$conn) {
            echo 'Could not connect to mysql';
            exit;
    }

date_default_timezone_set("Asia/Kolkata");


 $handle = fopen('php://input','r');
$jsonInput = fgets($handle);
$decoded = json_decode($jsonInput,true);

$uniqueid_val               = isset($decoded['uniqueid']) ? "".$decoded['uniqueid']."" : 0.0;


$sql = "UPDATE PoolTrip SET is_trip_live =  0 WHERE uniqueid_val = ".$uniqueid_val.";";


//echo "string".$sql;
if (mysqli_query($conn, $sql)) {
echo "{";
echo '"status_code" : 200,';
echo '"status_message" : "Trip deleted successfully."';
echo "}";

} else {
   // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  echo "{";
echo '"status_code" : 400,';
echo '"status_message" : "Failed to delete trip."';
echo "}";

}
mysqli_close($conn);
?>