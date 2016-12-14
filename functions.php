<?php
	session_start();
	$_SESSION['access_lvl'] = 1; //Student-level access
	
	require 'connect.php';
	
	static $con = null;
	function get_con()
	{
		global $db_username;
		global $db_password;
		global $con;

		if (!$con)
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

	function species_to_textarea($obs_id)
	{
		$all_species = run_sql_string("SELECT * FROM bio_species WHERE obs_id = $obs_id ORDER BY species");
		$str = "";
		foreach ($all_species as $species)
		{
			$str .= "{$species['species']} {$species['num']}\n";
		}
		return $str;
	}

	function textarea_to_species($obs_id, $text)
	{
		$lines = explode("\n", trim($text));
		$species_listed = "(";
		for ($i = 0; $i < sizeof($lines); $i++)
		{
			preg_match("/([a-zA-Z]).*?(\d+)/", trim($lines[$i]), $matches); //Extract character and number
			$char = strtoupper($matches[1]);
			$num = $matches[2];
			$species_listed .= "'$char'";
			if ($i != sizeof($lines) - 1) //Last element
				$species_listed .= ", ";
			
			//If already exists, update.
			if (run_sql_string("SELECT * FROM bio_species WHERE obs_id = $obs_id AND species = '$char'"))
			{
				run_sql_string("UPDATE bio_species SET num = $num WHERE obs_id = $obs_id AND species = '$char'");
			}
			else //Insert.
			{
				run_sql_string("INSERT INTO bio_species VALUES ($obs_id, '$char', $num)");
			}
		}

		$species_listed .= ")";
		//Delete any that were removed
		run_sql_string("DELETE FROM bio_species WHERE obs_id = $obs_id AND species NOT IN $species_listed");
	}

?>