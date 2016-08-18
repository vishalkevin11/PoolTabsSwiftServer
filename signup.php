<?php


header("Access-Control-Allow-Origin: *");



  $conn = mysqli_connect('localhost', 'root', 'root', 'TavantPool');
        
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
$password_val        = $decoded['password'];
$phone_number_val        = $decoded['phonenumber'];
$uniqueID_val        = $unixtime;
// $isloggedin_val        = $_POST['isloggedin'];



$selectsql = "SELECT  email FROM Login WHERE email = '".$email_val."';";

$product_type_result = mysqli_query($conn,$selectsql);


$num_rows = mysqli_num_rows($product_type_result);

//echo "string".$selectsql;
if ($num_rows<=0) {

  

 $sqls = "INSERT INTO Login (username, email, password, uniqueid,phonenumber)
 VALUES ('$username_val','$email_val','$password_val','$uniqueID_val','$phone_number_val');";


//echo "string".$sqls;
 if (mysqli_query($conn, $sqls)) {

  $profileArr = array("email"=>$email_val, "phonenumber"=>$phone_number_val);


  echo "{";
  echo '"status_code" : 200,';

  echo '"status_message" : "Successfuly Signed-Up",';
  echo '"profile" :'.json_encode($profileArr);
  echo "}";

} else {

  echo "{";
  echo '"status_code" : 400,';
  //  echo "<br/>";
  echo '"status_message" : "Failed to Sign-Up. Email Exists Please Login."';
  echo "}";

}

} else {

  echo "{";
  echo '"status_code" : 400,';
  //  echo "<br/>"; 
  echo '"status_message" : "This email is already registered. Please either Sign-In or try some other email."';
  echo "}";

}



mysql_free_result($product_type_result);
?>