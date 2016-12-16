
<?php require 'db_connect_tavant.php';


//header("Access-Control-Allow-Origin: *");


if (!$link = @mysql_connect($host_name, $db_user_name, $db_user_password)) {

//if (!$link = @mysql_connect('mysql.hostinger.in', 'u355642838_kevi', '123456')) {
//if (!$link = @mysql_connect('localhost', 'root', 'root')) {
    echo 'Could not connect to mysql';
    exit;
}


//if (!mysql_select_db('u355642838_tpool', $link)) {
//if (!mysql_select_db('TavantPoolWeekDay', $link)) {
if (!mysql_select_db($db_name, $link)) {
    echo 'Could not select database';
    exit;
}
        
       date_default_timezone_set("Asia/Kolkata");

// $handle = fopen('php://input','r');
// $jsonInput = fgets($handle);
// $decoded = json_decode($jsonInput,true);

$email_name_value = isset($_GET['email']) ? "'".$_GET['email']."'" : "";
// $password_value = $decoded['password'];
// echo "string".$email_name_value;
// echo "string".$password_value;

$sql = "SELECT  email,phonenumber FROM Login WHERE ( email = ".$email_name_value.");";

//$sql = "SELECT lat, lng, username, productname, uniqueid, uploaddate, reportedabuse, phonenumber, email, address, imageurl, deviceid, description, id FROM Product ";



$product_type_result = mysql_query($sql,$link);

//echo 'this is crap'.json_encode($busResult);
 //echo "string".$sql;


$response_array = array();

 while ($row = mysql_fetch_assoc($product_type_result)) {


$tmpBusArray = array(
 'email' => $row['email'],
 'phonenumber' => $row['phonenumber']
     );
$response_array = $tmpBusArray;
    
  }

  $results_count = count($response_array);



   if ($results_count>0) {
            echo "{";
            echo '"status_code" : 200,';
           
            echo '"status_message" : "Successfuly fetched Phone Number",';
            echo '"profile" :'.json_encode($response_array);
            echo "}";
            
        } else {
            
            echo "{";
            echo '"status_code" : 400,';
          //  echo "<br/>";
            echo '"status_message" : "FAiled to fetch Phone Number."';
            echo "}";
            
        }


 
mysql_free_result($product_type_result);

?>