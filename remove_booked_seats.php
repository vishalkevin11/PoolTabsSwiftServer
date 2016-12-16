<?php require 'db_connect_tavant.php';


header("Access-Control-Allow-Origin: *");



      $conn = mysqli_connect($host_name, $db_user_name, $db_user_password, $db_name);
        
    //     if (!$conn) {
    //         echo 'Could not connect to mysql';
    //         exit;
    // }

         // $conn = mysqli_connect('mysql.hostinger.in', 'u355642838_kevi', '123456', 'u355642838_tpool');
        
        if (!$conn) {
            echo 'Could not connect to mysql';
            exit;
    }

        
       date_default_timezone_set("Asia/Kolkata");
       $date = date('Y/m/d h:i:s', time());


$qwwuery=mysql_connect($host_name, $db_user_name, $db_user_password);
mysql_select_db($db_name,$qwwuery);


 $unixtime = strtotime("now");
//echo "string".$unixtime;



$handle = fopen('php://input','r');
$jsonInput = fgets($handle);
$decoded = json_decode($jsonInput,true);

//echo "decoded".$decoded;

$bookedTripID_val = isset($decoded['bookedTripID']) ? "".$decoded['bookedTripID']."" : 0;
$bookieEmail_val = isset($decoded['bookieEmail']) ? "'".$decoded['bookieEmail']."'" : "\"\"";
$seatsBooked_val = isset($decoded['seatsBooked']) ? "".$decoded['seatsBooked']."" : 0;

// mysql_connect("localhost", "root", "mypass");  
// mysql_select_db("tutorials");


//POOLTrip Table

$trip_query = mysql_query("SELECT seatsBooked FROM PoolTrip WHERE uniqueid_val =".$bookedTripID_val."");
//echo "string".$trip_query;
if (!$trip_query) {
    echo 'Could not run trip_query: ' . mysql_error();
    exit;
}
$row = mysql_fetch_row($trip_query);

$earlierBookedSeats =  $row[0]; // 42

$newseatscount = $earlierBookedSeats - $seatsBooked_val;

//echo "new seats ".$newseatscount."earlierBookedSeats".$earlierBookedSeats."seatsBooked_val".$seatsBooked_val;

 $updatesql = "UPDATE PoolTrip SET seatsBooked = ".$newseatscount."
 WHERE uniqueid_val = ".$bookedTripID_val.";";

  $updatesql .= "DELETE from BookingInfo 
                  WHERE bookieEmail = ".$bookieEmail_val." AND bookedTripID = ".$bookedTripID_val.";";



//echo "string".$updatesql;
  if (mysqli_multi_query($conn, $updatesql)) {


//$profileArr1 = array("email"=>$email_val, "phonenumber"=>$phone_number_val,"username"=>$username_val,"jobtitle"=>$jobtitle_val);


  echo "{";
  echo '"status_code" : 200,';

  echo '"status_message" : "Successfuly Removed '.$seatsBooked_val.'"';
//  echo '"profile" :'.json_encode($profileArr1);
  echo "}";


} else {
   // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   echo "{";
  echo '"status_code" : 400,';
  //  echo "<br/>";
  echo '"status_message" : "Failed to remove seats."';
  echo "}";

}









mysql_free_result($product_type_result);
?>