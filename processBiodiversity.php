<?php
include 'functions.php';
	if (has_value($_POST['action']))
	{
		switch ($_POST['action'])
		{
			case 'add':
				$insert_str = "INSERT INTO biodiversity VALUES ({$_POST['obs_id']}, '{$_POST['bio_notes']}')";
				run_sql_string($insert_str);
				textarea_to_species($_POST['obs_id'], $_POST['bio_species']);
				header("Location: " . $root_url . "editCompetition.php?obs_id={$_POST['obs_id']}");
				die();
			break;
			case 'edit':
				$update_str = "UPDATE biodiversity SET bio_notes='{$_POST['bio_notes']}' WHERE obs_id={$_POST['obs_id']}";
				run_sql_string($update_str);
				textarea_to_species($_POST['obs_id'], $_POST['bio_species']);
				header("Location: " . $root_url . "editCompetition.php?obs_id={$_POST['obs_id']}");
				die();
			break;
		}
	}
?>