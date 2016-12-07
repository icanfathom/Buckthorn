<?php
	include 'connect.php';
	global $db_username;
	global $db_password;

	function get_connection() {
		$con = mysqli_connect("localhost",$db_username,$db_password,"DB07") or die("Some error occurred during connection " . mysqli_error($con));
	}
?>