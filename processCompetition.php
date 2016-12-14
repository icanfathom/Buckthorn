<?php
include 'functions.php';
	if (has_value($_POST['action']))
	{
		switch ($_POST['action'])
		{
			case 'add':
				for ($i = 1; $i <= $_POST['num_bt_stems']; $i++)
				{
					$insert_str = "INSERT INTO competition VALUES ({$_POST['obs_id']}, $i, {$_POST['dbh_'.$i]}, {$_POST['dist_to_nearest_bt_'.$i]}, {$_POST['nearest_bt_dbh_'.$i]}, {$_POST['dist_to_nearest_non_bt_'.$i]}, {$_POST['nearest_non_bt_dbh_'.$i]}, '{$_POST['cmp_notes_'.$i]}')";
					run_sql_string($insert_str);
				}
				
				header("Location: " . $root_url . "observations.php");
				die();
			break;
			case 'edit':
				for ($i = 1; $i <= $_POST['num_bt_stems']; $i++)
				{
					//If already exists, update.
					if (run_sql_string("SELECT * FROM competition WHERE obs_id = {$_POST['obs_id']} AND bt_index = " . ($i)))
					{
						$update_str = "UPDATE competition SET dbh={$_POST['dbh_'.$i]}, dist_to_nearest_bt={$_POST['dist_to_nearest_bt_'.$i]}, nearest_bt_dbh={$_POST['nearest_bt_dbh_'.$i]}, dist_to_nearest_non_bt={$_POST['dist_to_nearest_non_bt_'.$i]}, nearest_non_bt_dbh={$_POST['nearest_non_bt_dbh_'.$i]}, cmp_notes='{$_POST['cmp_notes_'.$i]}' WHERE obs_id={$_POST['obs_id']} AND bt_index=$i";
						run_sql_string($update_str);
					}
					else //Otherwise, insert.
					{
						$insert_str = "INSERT INTO competition VALUES ({$_POST['obs_id']}, $i, {$_POST['dbh_'.$i]}, {$_POST['dist_to_nearest_bt_'.$i]}, {$_POST['nearest_bt_dbh_'.$i]}, {$_POST['dist_to_nearest_non_bt_'.$i]}, {$_POST['nearest_non_bt_dbh_'.$i]}, '{$_POST['cmp_notes_'.$i]}')";
						run_sql_string($insert_str);
					}
				}

				header("Location: " . $root_url . "observations.php");
				die();
			break;
		}
	}
?>