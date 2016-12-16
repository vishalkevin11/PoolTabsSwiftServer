<?php require 'db_connect_tavant.php';


//header("Access-Control-Allow-Origin: *");



      $conn = mysqli_connect($host_name, $db_user_name, $db_user_password, $db_name);


      // $conn = mysqli_connect('localhost', 'root', 'root', 'TavantPoolWeekDay');
        
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
    

$records = $_POST['lat_longs'];


if(is_array($records)){
    foreach ($records as $row) {
        $fieldVal1 = mysql_real_escape_string($records[$row][0]);
        $fieldVal2 = mysql_real_escape_string($records[$row][1]);
        $fieldVal3 = mysql_real_escape_string($records[$row][2]);
        $fieldVal4 = mysql_real_escape_string($records[$row][3]);
        $fieldVal5 = mysql_real_escape_string($records[$row][4]);
        $fieldVal6 = mysql_real_escape_string($records[$row][5]);
        $query ="INSERT INTO LatLongs (latitude, longitude, routeId, distance , duration,htmlImstruction) 
        VALUES ( '". $fieldVal1."','".$fieldVal2."','".$fieldVal3."','".$fieldVal4."',,'".$fieldVal5."',,'".$fieldVal6."')";
        mysqli_query($conn, $query);
    }

       echo "{";
  echo '"status_code" : 200,';

  echo '"status_message" : "Successfully inserted"';
  echo "}";
}
else {
      echo "{";
  echo '"status_code" : 400,';

  echo '"status_message" : "Failed To Insert"';
  echo "}";


}

?>