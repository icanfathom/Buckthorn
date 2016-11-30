<?php
	include 'Connect.php';
	global $username;
	global $password;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml" > 
<head>
  <title>Teams</title>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
  <meta name="keywords" content="php, mysql" />
</head> 
<body>
  <h1>PHP Query</h1>
  
<?php
	// connect to the database
	$con = mysqli_connect("localhost",$username,$password,"DB07") or die("Some error occurred during connection " . mysqli_error($con));
	
	// create the query and send it
	
	$studentQuery = "select * from team";
	$studentResult = mysqli_query($con, $studentQuery);   // mysql_query is a php function 
										 // you may need to uncomment ;extension=php_mysqli.dll <for windows, something similar for unix> in php.ini
										 // you also may need to set extension_dir in the php.ini file
?>
<ul>
<?php
 while($studentRow = mysqli_fetch_array($studentResult)) {	//mysqli_fetch_array grabs the next entry in the array
		echo json_encode($studentRow);

		
   }
?>
	</ul>

</body> 
</html>
