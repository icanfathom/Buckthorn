<?php
include 'functions.php';
	if (has_value($_POST['action']))
	{
		switch ($_POST['action'])
		{
			case 'add':
				$insert_str = "INSERT INTO observation VALUES (NULL, ";
				$insert_str .= "{$_POST['team_id']}, ";
				$insert_str .= "'{$_POST['date']}', ";
				$insert_str .= "{$_POST['coord_n']}, ";
				$insert_str .= "{$_POST['coord_w']}, ";
				$insert_str .= "{$_POST['quadrat_size']}, ";
				$insert_str .= "{$_POST['num_bt_stems']}, ";
				$insert_str .= "{$_POST['follar_coverage']}, ";
				$insert_str .= "{$_POST['median_bt_circumference']}, ";
				$insert_str .= "'{$_POST['description']}', ";
				$insert_str .= "'{$_POST['photo_link']}', ";
				$insert_str .= "'{$_POST['obs_notes']}'";
				$insert_str .= ")";
				run_sql_string($insert_str);
				header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/editBiodiversity.php?obs_id=" . mysqli_insert_id(get_con()));
				die();
			break;
			case 'edit':
				$update_str = "UPDATE observation SET ";
				$update_str .= "team_id={$_POST['team_id']}, ";
				$update_str .= "date='{$_POST['date']}', ";
				$update_str .= "coord_n={$_POST['coord_n']}, ";
				$update_str .= "coord_w={$_POST['coord_w']}, ";
				$update_str .= "quadrat_size={$_POST['quadrat_size']}, ";
				$update_str .= "num_bt_stems={$_POST['num_bt_stems']}, ";
				$update_str .= "follar_coverage={$_POST['follar_coverage']}, ";
				$update_str .= "median_bt_circumference={$_POST['median_bt_circumference']}, ";
				$update_str .= "description='{$_POST['description']}', ";
				$update_str .= "photo_link='{$_POST['photo_link']}', ";
				$update_str .= "obs_notes='{$_POST['obs_notes']}'";
				$update_str .= " WHERE obs_id={$_POST['obs_id']}";
				run_sql_string($update_str);
				header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/editBiodiversity.php?obs_id={$_POST['obs_id']}");
				die();
			break;
			case 'delete':
				run_sql_string("DELETE FROM observation WHERE obs_id = {$_POST['obs_id']}");
				header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/observations.php");
				die();
			break;
		}
	}
?>