<?php 

   if (!$link = @mysql_connect('localhost', 'root', 'root')) {
    echo 'Could not connect to mysql';
    exit;
}


if (!mysql_select_db('TavantPool', $link)) {
    echo 'Could not select database';
    exit;
}

$handle = fopen('php://input','r');
$jsonInput = fgets($handle);
$decoded = json_decode($jsonInput,true);


$user_email = $decoded['email'];

if (isset($user_email)){
	//$username = $_POST['name'];
	
	$query="SELECT * FROM Login WHERE  email = '".$user_email."';";
	//echo "string".$query;
	$result   = mysql_query($query,$link);
	$count=mysql_num_rows($result);
	// If the count is equal to one, we will send message other wise display an error message.
	if($count==1)
	{
		$rows=mysql_fetch_array($result);
		$password  =  $rows['password'];//FETCHING PASS
		//echo "your pass is ::".($pass)."";
		$to = $rows['email'];
		$from = "kevinvishal347@gmail.com";
		//echo "your email is ::".$email;
		//Details for sending E-mail
		

		$subject = 'Password Reset for Tavant Pool';

// message
$message = '
<html>
<head>
  <title>Password Reset for Tavant Pool</title>
</head>
<body>
  <p>Your password is '.$password.'</p>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= "To: ".$to."\r\n";
$headers .= 'From:'.$from."\r\n";


// Mail it
$sent_status  = mail($to, $subject, $message, $headers);

if($sent_status==1)
	{
		 echo "{";
 		 echo '"status_code" : 200,';
	    	echo '"status_message" : " Your password has been mailed to your email Id"';
		 echo "}";
	}
   else  {
		 echo "{";
 		 echo '"status_code" : 400,';
     	echo '"status_message" : "Sending email failed."';
     	 echo "}";
		}
		
	//If the message is sent successfully, display sucess message otherwise display an error message.
	}
	else  {
		 echo "{";
 		 echo '"status_code" : 400,';
     	echo '"status_message" : "This email isnt subscribed to TavantPool."';
     	 echo "}";
		}
		
}
	
?>
