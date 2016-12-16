<?php

require 'db_connect_tavant.php';



header("Access-Control-Allow-Origin: *");

$conn = mysqli_connect($host_name, $db_user_name, $db_user_password, $db_name);
        
        
        if (!$conn) {
            echo 'Could not connect to mysql';
            exit;
   		}

        
       date_default_timezone_set("Asia/Kolkata");
       $date = date('Y/m/d h:i:s', time());


		$qwwuery=mysql_connect($host_name, $db_user_name, $db_user_password);
		mysql_select_db($db_name,$qwwuery);
		$unixtime = strtotime("now");



function getOwnerDeviceToken($owner_email) {


	$trip_query = mysql_query("SELECT deviceToken FROM Login WHERE email =".$owner_email."");
	//echo "string".$trip_query;
		if (!$trip_query) {
		    echo 'Could not run trip_query: ' . mysql_error();
		    exit;
		}
	$row = mysql_fetch_row($trip_query);
	$device_token_fetched =  $row[0];
	return $device_token_fetched;
}


function trip_booked($owner_eml,$booked_message,$booking_ids) {
   $token_val =  getOwnerDeviceToken($owner_eml);
   sendNotification($booked_message,$token_val,$booking_ids,1);
}


function trip_un_booked($owner_eml,$booked_message,$booking_ids) {
   $token_val =  getOwnerDeviceToken($owner_eml);
   sendNotification($booked_message,$token_val,$booking_ids,2);
}


function sendNotification($messageStr, $deviceTokenStr, $booking_id, $notif_Type)
{
// Put your device token here (without spaces):
	//$deviceToken = '2c43a4f2a46297cedf2fb82e510652e48986471a2162a45478ad67de505844a8';

	$deviceToken =  $deviceTokenStr;



	if (empty($deviceToken)) {
    echo 'deviceToken is either 0, empty, or not set at all';
}
else {

// Put your private key's passphrase here:
	$passphrase = '1234';

// Put your alert message here:
	//$title = 'Cachet Notification';

	$data = json_decode(file_get_contents('php://input'), true);
//print_r($data);
//echo

  $title =  $messageStr; 
$message = $messageStr; 
	//$message = $data["message"];
////////////////////////////////////////////////////////////////////////////////

	$ctx = stream_context_create();
	stream_context_set_option($ctx, 'ssl', 'local_cert', 'TavantPoolCer.pem');
	stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
	$fp = stream_socket_client(
		'ssl://gateway.sandbox.push.apple.com:2195', $err,
		$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

	if (!$fp)
		exit("Failed to connect: $err $errstr" . PHP_EOL);

	//echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
	$body['aps'] = array(
		'alert' => $title,
		'sound' => 'default',
		'message'=> $message
		);

	$body['trip_detail'] = array(
		'trip_id' => $booking_id,
		'notification_type' => $notif_Type
		);

// $payload = json_encode(
//     array(
//         $body,
//         $
//     )
// );

// Encode the payload as JSON
	$payload = json_encode($body);

// Build the binary notification
	$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
	$result = fwrite($fp, $msg, strlen($msg));

	// if (!$result)
	// 	echo 'Message not delivered' . PHP_EOL;
	// else
	// 	echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server
	fclose($fp);
}
}

?>
