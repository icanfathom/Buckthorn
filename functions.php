<?php
	session_start();
	$_SESSION['access_lvl'] = 1; //Student-level access
	
	require 'connect.php';
	
	static $con = null;
	function get_con()
	{
		global $db_username;
		global $db_password;

		if ($con === null)
		{
			$con = mysqli_connect("localhost",$db_username,$db_password,"DB07") or die("Some error occurred during connection " . mysqli_error($con));
		}
		return $con;
	}

	function has_value($object)
	{
		return isset($object) && !empty($object);
	}

	function run_sql_string($query_string)
	{
		return sql_to_array(mysqli_query(get_con(), $query_string));
	}

	function run_sql($query)
	{
		$query_string = "SELECT $query[select] FROM $query[from]";
		if (has_value($query['where']))
			$query_string .= " WHERE $query[where]";
		if (has_value($query['order_by']))
			$query_string .= " ORDER BY $query[order_by]";
		return run_sql_string($query_string);
	}

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