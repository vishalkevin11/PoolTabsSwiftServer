
<?php 

   if (!$link = @mysql_connect('localhost', 'root', 'root')) {
    echo 'Could not connect to mysql';
    exit;
}


if (!mysql_select_db('TavantPool', $link)) {
    echo 'Could not select database';
    exit;
}

        
       date_default_timezone_set("Asia/Kolkata");

$handle = fopen('php://input','r');
$jsonInput = fgets($handle);
$decoded = json_decode($jsonInput,true);

$email_name_value = $decoded['email'];
$password_value = $decoded['password'];
// echo "string".$email_name_value;
// echo "string".$password_value;

$sql = "SELECT  email,phonenumber FROM Login WHERE ( email = '".$email_name_value."') and password = '".$password_value."';";

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
           
            echo '"status_message" : "Successfuly Signed-In",';
            echo '"profile" :'.json_encode($response_array);
            echo "}";
            
        } else {
            
            echo "{";
            echo '"status_code" : 400,';
          //  echo "<br/>";
            echo '"status_message" : "Sign-In error, Please check username or password or Sign-Up."';
            echo "}";
            
        }


 
mysql_free_result($product_type_result);

?>