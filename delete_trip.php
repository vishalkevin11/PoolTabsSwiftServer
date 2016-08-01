<?php 



$conn = mysqli_connect('localhost', 'root', 'root', 'tavantpool');
    
    if (!$conn) {
        echo 'Could not connect to mysql';
        exit;
    }
    

date_default_timezone_set("Asia/Kolkata");


 $uniqueid_val          = $_POST['uniqueid']; 


$sql = "UPDATE PoolTrip SET is_trip_live =  1 WHERE uniqueid = ".$uniqueid_val.";";

if (mysqli_query($conn, $sql)) {
echo "{";
echo '"status_code" : 7347';
echo "}";

} else {
   // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  echo "{";
echo '"status_code" : 3477';
echo "}";

}
mysqli_close($conn);
?>