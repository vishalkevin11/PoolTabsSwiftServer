<?php 

require 'db_connect_tavant.php';
include ("tavant_pool_push.php");
//require "tavant_pool_push.php"


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


 $unixtime = strtotime("now");
//echo "string".$unixtime;



$handle = fopen('php://input','r');
$jsonInput = fgets($handle);
$decoded = json_decode($jsonInput,true);

//echo "decoded".$decoded;
$ownerEmail_val = isset($decoded['ownerEmail']) ? "'".$decoded['ownerEmail']."'" : "\"\"";

//$isBooked_val = isset($decoded['isBooked']) ? "".$decoded['isBooked']."" : 0;
//$isPending_val = isset($decoded['isPending']) ? "".$decoded['isPending']."" : 0;
//$isExpired_val = isset($decoded['isExpired']) ? "".$decoded['isExpired']."" : 0;
$seatsBooked_val = isset($decoded['seatsBooked']) ? "".$decoded['seatsBooked']."" : 0;
$totalSeatsOffered_val = isset($decoded['totalSeatsOffered']) ? "".$decoded['totalSeatsOffered']."" : 0;
$bookieEmail_val = isset($decoded['bookieEmail']) ? "'".$decoded['bookieEmail']."'" : "\"\"";
$bookiePhoneNumber_val = isset($decoded['bookiePhoneNumber']) ? "'".$decoded['bookiePhoneNumber']."'" : "\"\"";
$bookie_name_val = isset($decoded['bookieName']) ? "'".$decoded['bookieName']."'" : "\"\"";
$bookedTripID_val = isset($decoded['bookedTripID']) ? "".$decoded['bookedTripID']."" : 0;
// $message_val = isset($decoded['message']) ? "'".$decoded['message']."'" : "\"\"";
// $messageTag_val = isset($decoded['messageTag']) ? "".$decoded['messageTag']."" : 0;
//$deviceToken_val = isset($decoded['deviceToken']) ? "'".$decoded['deviceToken']."'" : "\"\"";
$ownerPhoneNumber_val = isset($decoded['ownerPhoneNumber']) ? "'".$decoded['ownerPhoneNumber']."'" : "\"\"";
$deviceType_val = isset($decoded['deviceType']) ? "".$decoded['deviceType']."" : 0;

//$uniqueID_val                    =  isset($decoded['uniqueid']) ? "".$decoded['uniqueid']."" : 0;
// $isloggedin_val        = $_POST['isloggedin'];

$bookieEmailTrimmedName = substr($bookieEmail_val, strpos($bookieEmail_val,"<")+1, strrpos($bookieEmail_val, "@")-strpos($bookieEmail_val,"<")-1);


$selectsql = "SELECT  bookieEmail FROM BookingInfo WHERE bookieEmail = ".$bookieEmail_val." AND bookedTripID = ".$bookedTripID_val.";";

$product_type_result = mysqli_query($conn,$selectsql);


$num_rows = mysqli_num_rows($product_type_result);

//echo "string".$selectsql;
if ($num_rows<=0) {


 $sqls = "INSERT INTO BookingInfo (ownerEmail,isBooked,isPending,isExpired,seatsBooked,totalSeatsOffered,bookieEmail,bookiePhoneNumber,
  bookedTripID,message,messageTag,deviceToken,ownerPhoneNumber,deviceType,bookieName)
 VALUES ($ownerEmail_val,0,1,0,$seatsBooked_val,$totalSeatsOffered_val,$bookieEmail_val,$bookiePhoneNumber_val,
  $bookedTripID_val,'','','',$ownerPhoneNumber_val,$deviceType_val,$bookie_name_val);";

  
//`ownerEmail`,`isBooked`,`isPending`,`isExpired`,`seatsBooked`,`totalSeatsOffered`,`bookieEmail`,`bookiePhoneNumber`,
  //`bookedTripID`,`message`,`messageTag`,`deviceToken`,`ownerPhoneNumber`,`deviceType`
 // $sqls = "INSERT INTO BookingInfo (ownerEmail,isBooked,isPending,isExpired,seatsBooked,totalSeatsOffered,bookieEmail,bookiePhoneNumber,
 //  bookedTripID,message,messageTag,deviceToken,ownerPhoneNumber,deviceType)
 // VALUES ($ownerEmail_val,$isBooked_val,$isPending_val,$isExpired_val,$seatsBooked_val,$totalSeatsOffered_val,$bookieEmail_val,$bookiePhoneNumber_val,
 //  $bookedTripID_val,$message_val,$messageTag_val,$deviceToken_val,$ownerPhoneNumber_val,$deviceType_val);";
//echo "string".$sqls;


 if (mysqli_query($conn, $sqls)) {

//trip_booked("kevin.saldanha@tavant.com","saav panapuna");

  $trip_detail_Strs = "".$bookieEmailTrimmedName." is requesting ".$seatsBooked_val." seats.";
  trip_booked($ownerEmail_val,$trip_detail_Strs,$bookedTripID_val);

  //$profileArr = array("email"=>$email_val, "phonenumber"=>$phone_number_val,"username"=>$username_val,"jobtitle"=>$jobtitle_val);
//trip_booked($ownerEmail_val,"Booked just now");

  echo "{";
  echo '"status_code" : 200,';

  echo '"status_message" : "Successfuly Booked the trip"';
 // echo '"profile" :'.json_encode($profileArr);
  echo "}";

} else {

  echo "{";
  echo '"status_code" : 400,';
  //  echo "<br/>";
  echo '"status_message" : "Failed to Book."';
  echo "}";

}

} else {


//lets update  the existing email with phone number
  

// $updatesql = "UPDATE BookingInfo SET ownerEmail=  ".$ownerEmail_val.",isBooked=  ".$isBooked_val.",isPending=  ".$isPending_val.",
// isExpired=  ".$isExpired_val.",seatsBooked=  ".$seatsBooked_val.",totalSeatsOffered=  ".$totalSeatsOffered_val.",
// bookieEmail=  ".$bookieEmail_val.",bookiePhoneNumber=  ".$bookiePhoneNumber_val.",bookedTripID=  ".$bookedTripID_val.",
// message=  ".$phone_number_val.",messageTag=  ".$phone_number_val.",deviceToken=  ".$phone_number_val.",
// ownerPhoneNumber=  ".$ownerPhoneNumber_val.",deviceType=  ".$deviceType_val."
//  WHERE bookieEmail = ".$bookieEmail_val." AND bookedTripID = ".$bookedTripID_val.";";

  $updatesql = "UPDATE BookingInfo SET ownerEmail=  ".$ownerEmail_val.",bookieName=  ".$bookie_name_val.",isPending=  1,
seatsBooked=  ".$seatsBooked_val.",totalSeatsOffered=  ".$totalSeatsOffered_val.",
bookieEmail=  ".$bookieEmail_val.",bookiePhoneNumber=  ".$bookiePhoneNumber_val.",bookedTripID=  ".$bookedTripID_val.",
ownerPhoneNumber=  ".$ownerPhoneNumber_val.",deviceType=  ".$deviceType_val."
 WHERE bookieEmail = ".$bookieEmail_val." AND bookedTripID = ".$bookedTripID_val.";";


//echo "string".$updatesql;
if (mysqli_query($conn, $updatesql)) {

//$profileArr1 = array("email"=>$email_val, "phonenumber"=>$phone_number_val,"username"=>$username_val,"jobtitle"=>$jobtitle_val);

// Send message to owner that someone booked

//trip_booked($ownerEmail_val,"Booked just now");

  $trip_detail_Str = "".$bookieEmailTrimmedName." is requesting ".$seatsBooked_val." seats.";
  trip_booked($ownerEmail_val,$trip_detail_Str,$bookedTripID_val);

  echo "{";
  echo '"status_code" : 200,';

  echo '"status_message" : "Successfuly Booked the trip"';
//  echo '"profile" :'.json_encode($profileArr1);
  echo "}";


} else {
   // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   echo "{";
  echo '"status_code" : 400,';
  //  echo "<br/>";
  echo '"status_message" : "Failed to Book."';
  echo "}";

}


}



mysql_free_result($product_type_result);
?>