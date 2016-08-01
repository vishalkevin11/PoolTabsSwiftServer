<?php 

// if (!$link = @mysql_connect('localhost', 'root', 'root')) {
//     echo 'Could not connect to mysql';
//     exit;
// }


// if (!mysql_select_db('sharecare', $link)) {
//     echo 'Could not select database';
//     exit;
// }


// if (!$link = @mysql_connect('mysql.hostinger.in', 'u136336608_kevin', '123456')) {
//     echo 'Could not connect to mysql';
//     exit;
// }


// if (!mysql_select_db('u136336608_shaca', $link)) {
//     echo 'Could not select database';
//     exit;
// }

 if (!$link = @mysql_connect('localhost', 'root', 'root')) {
     echo 'Could not connect to mysql';
     exit;
 }


 if (!mysql_select_db('TavantPool', $link)) {
     echo 'Could not select database';
     exit;
 }


date_default_timezone_set("Asia/Kolkata");

$user_email = $_POST['email'];

if (isset($user_email)){
	//$username = $_POST['name'];
	
	$query="SELECT email FROM Login WHERE ( email = '".$user_email."');";
	//echo "string".$query;
	$result   = mysql_query($query);
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
		

		$subject = 'Password Reset for Share N Care';

// message
$message = '
<html>
<head>
  <title>Password Reset for Share N Care</title>
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
		echo " Your Password Has Been Sent To Your Email Address";
	}
		else
		{
		if($_POST['email']!="")
		echo "Cannot send password to your e-mail address.Problem with sending mail...";
	}



	} else {
	if ($_POST ['email'] != "") {
     	echo "Not found your email in our database";
		}
		}
	//If the message is sent successfully, display sucess message otherwise display an error message.
	
}
?>
