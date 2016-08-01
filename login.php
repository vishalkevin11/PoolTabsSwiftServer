
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

$email_name_value = $_POST['email'];
$password_value = $_POST['password'];


$sql = "SELECT username, email FROM Login WHERE ( email = '".$email_name_value."') and password = '".$password_value."';";

//$sql = "SELECT lat, lng, username, productname, uniqueid, uploaddate, reportedabuse, phonenumber, email, address, imageurl, deviceid, description, id FROM Product ";



$product_type_result = mysql_query($sql,$link);

//echo 'this is crap'.json_encode($busResult);
 //print_r ($sql);


$response_array = array();

 while ($row = mysql_fetch_assoc($product_type_result)) {


$tmpBusArray = array(
  'username' => $row['username'],
 'email' => $row['email']
     );
$response_array[] = $tmpBusArray;
    
  }

  $results_count = count($response_array);



   if ($results_count>0) {
            echo "{";
            echo '"status_code" : 200,';
           
            echo '"status_message" : "Successfuly logged In"';
            echo "}";
            
        } else {
            
            echo "{";
            echo '"status_code" : 200,';
          //  echo "<br/>";
            echo '"status_message" : "Login error, Please check username or password"';
            echo "}";
            
        }


 
mysql_free_result($product_type_result);

?>