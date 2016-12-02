<?php
	include 'connect.php';
	global $db_username;
	global $db_password;
?>

<?php
	// connect to the database
	$con = mysqli_connect("localhost",$db_username,$db_password,"DB07") or die("Some error occurred during connection " . mysqli_error($con));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml" > 
<head>
	<title>Buckthorn</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<meta name="keywords" content="php, mysql" />
</head> 
<body>