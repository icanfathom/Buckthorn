<?php
	session_start();
	
	include 'connect.php';
	// connect to the database
	$con = mysqli_connect("localhost",$db_username,$db_password,"DB07") or die("Some error occurred during connection " . mysqli_error($con));


	function sql_to_array($sql)
	{
		$holder;
		$index = 0;
		while ($row = mysqli_fetch_array($sql))
		{
			$holder[$index] = $row;
			$index++;
		}
		return $holder;
	}



?>