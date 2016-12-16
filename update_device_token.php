<?php require 'db_connect_tavant.php';

header("Access-Control-Allow-Origin: *");

$conn = mysqli_connect($host_name, $db_user_name, $db_user_password, $db_name);
        
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

$email_val = isset($decoded['email']) ? "'".$decoded['email']."'" : "\"\"";
$deviceToken_val = isset($decoded['deviceToken']) ? "'".$decoded['deviceToken']."'" : "\"\"";




$updatesql = "UPDATE Login SET deviceToken =  ".$deviceToken_val." WHERE email = ".$email_val.";";


//echo "string".$updatesql;
if (mysqli_query($conn, $updatesql)) {

//$profileArr1 = array("email"=>$email_val, "phonenumber"=>$phone_number_val,"username"=>$username_val,"jobtitle"=>$jobtitle_val);


  echo "{";
  echo '"status_code" : 200,';

  echo '"status_message" : "Successfuly Added Device Token"';
//  echo '"profile" :'.json_encode($profileArr1);
  echo "}";


} else {
   // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   echo "{";
  echo '"status_code" : 400,';
  //  echo "<br/>";
  echo '"status_message" : "Failed to Add Device Token."';
  echo "}";

}


mysql_free_result($product_type_result);
?>