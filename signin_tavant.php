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


 $unixtime = strtotime("now");
//echo "string".$unixtime;



$handle = fopen('php://input','r');
$jsonInput = fgets($handle);
$decoded = json_decode($jsonInput,true);


$username_val             = $decoded['username'];
$email_val             = $decoded['email'];
$phone_number_val        = $decoded['phonenumber'];
$jobtitle_val        = $decoded['jobtitle'];

$device_token_val        = $decoded['deviceToken'];
$device_type_val        = $decoded['deviceType'];

$uniqueID_val        = $unixtime;
// $isloggedin_val        = $_POST['isloggedin'];



$selectsql = "SELECT  email FROM Login WHERE email = '".$email_val."';";

$product_type_result = mysqli_query($conn,$selectsql);


$num_rows = mysqli_num_rows($product_type_result);

//echo "string".$selectsql;
if ($num_rows<=0) {

  

 $sqls = "INSERT INTO Login (username, email, uniqueid,phonenumber,deviceToken,deviceType)
 VALUES ('$username_val','$email_val','$uniqueID_val','$phone_number_val','$device_token_val',$device_type_val);";


echo "string".$sqls;
 if (mysqli_query($conn, $sqls)) {

  $profileArr = array("email"=>$email_val, "phonenumber"=>$phone_number_val,"username"=>$username_val,"jobtitle"=>$jobtitle_val);


  echo "{";
  echo '"status_code" : 200,';

  echo '"status_message" : "Successfuly Signed-In",';
  echo '"profile" :'.json_encode($profileArr);
  echo "}";

} else {

  echo "{";
  echo '"status_code" : 400,';
  //  echo "<br/>";
  echo '"status_message" : "Failed to Sign-In. Please check your email and password."';
  echo "}";

}

} else {


//lets update  the existing email with phone number
  

$updatesql = "UPDATE Login SET phonenumber =  '".$phone_number_val."' WHERE email = '".$email_val."';";


//echo "string".$updatesql;
if (mysqli_query($conn, $updatesql)) {

$profileArr1 = array("email"=>$email_val, "phonenumber"=>$phone_number_val,"username"=>$username_val,"jobtitle"=>$jobtitle_val);


  echo "{";
  echo '"status_code" : 200,';

  echo '"status_message" : "Successfuly Signed-In",';
  echo '"profile" :'.json_encode($profileArr1);
  echo "}";


} else {
   // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   echo "{";
  echo '"status_code" : 400,';
  //  echo "<br/>";
  echo '"status_message" : "Failed to Sign-In. Please check your email and password."';
  echo "}";

}


}



mysql_free_result($product_type_result);
?>