<?php


header("Access-Control-Allow-Origin: *");


// $conn = mysqli_connect('localhost', 'root', 'root', 'sharecare');
    
//     if (!$conn) {
//         echo 'Could not connect to mysql';
//         exit;
// }


// $conn = mysqli_connect('mysql.hostinger.in', 'u136336608_kevin', '123456', 'u136336608_shaca');
    
//     if (!$conn) {
//         echo 'Could not connect to mysql';
//         exit;
// }


// if (!$link = @mysql_connect('mysql.hostinger.in', 'u136336608_kevin', '123456')) {
//   echo 'Could not connect to mysql';
//   exit;
// }


// if (!mysql_select_db('u136336608_shaca', $link)) {
//   echo 'Could not select database';
//   exit;
// }

$conn = mysqli_connect('localhost', 'root', 'root', 'TavantPool');
    
    if (!$conn) {
        echo 'Could not connect to mysql';
        exit;
}



 

date_default_timezone_set("Asia/Kolkata");


$date = date('Y/m/d h:i:s', time());



 $unixtime = strtotime("now");
//echo "string".$unixtime;


$username_val             = $_POST['username'];
$email_val             = $_POST['email'];
$password_val        = $_POST['password'];
$uniqueID_val        = $unixtime;
// $isloggedin_val        = $_POST['isloggedin'];



$selectsql = "SELECT  email FROM Login WHERE email = '".$email_val."';";

$product_type_result = mysqli_query($conn,$selectsql);


$num_rows = mysqli_num_rows($product_type_result);


if ($num_rows<=0) {

  //echo "string".$num_rows;

 $sqls = "INSERT INTO Login (username, email, password, uniqueid)
 VALUES ('$username_val','$email_val','$password_val','$uniqueID_val');";


//echo "string".$sqls;
 if (mysqli_query($conn, $sqls)) {
  echo "{";
  echo '"status_code" : 200,';

  echo '"status_message" : "Successfuly Signed Up"';
  echo "}";

} else {

  echo "{";
  echo '"status_code" : 400,';
  //  echo "<br/>";
  echo '"status_message" : "Failed to Sign Up. Email Exists Please Login."';
  echo "}";

}

} else {

  echo "{";
  echo '"status_code" : 400,';
  //  echo "<br/>"; 
  echo '"status_message" : "This email is already registered. Please either Signin or try some other email."';
  echo "}";

}



mysql_free_result($product_type_result);
?>