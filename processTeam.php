<?php
include 'functions.php';

	if (has_value($_POST['action']))
	{
		if (isset($_POST['team_id']))
		{
			switch ($_POST['action'])
			{
				case 'add':
					run_sql_string("INSERT INTO team (team_name) VALUES ('{$_POST['team_name']}')");
					/*
					TO DO:
					can we get the resulting team_id from the query? And then redirect there?

					header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/editTeam.php?team_id=".$_SESSION['last_team_viewed']);
					die();
					*/
				break;
				case 'edit':
					run_sql_string("UPDATE team SET team_name = '{$_POST['team_name']}' WHERE team_id = {$_POST['team_id']}");
					header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/editTeam.php?team_id=".$_POST['team_id']);
					die();
				break;
				case 'delete':
					run_sql_string("DELETE FROM team WHERE team_id = {$_POST['team_id']}");
					header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/teams.php");
					die();
				break;
			}
		}
		else if (isset($_POST['stu_id']))
		{
			switch ($_POST['action'])
			{
				case 'add':
					run_sql_string("INSERT INTO student (team_id, stu_name) VALUES ('{$_SESSION['last_team_viewed']}', '{$_POST['stu_name']}')");
					header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/editTeam.php?team_id=".$_SESSION['last_team_viewed']);
					die();
				break;
				case 'edit':
					run_sql_string("UPDATE student SET stu_name = '{$_POST['stu_name']}' WHERE stu_id = {$_POST['stu_id']}");
					header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/editTeam.php?team_id=".$_SESSION['last_team_viewed']);
					die();
				break;
				case 'delete':
					run_sql_string("DELETE FROM student WHERE stu_id = {$_POST['stu_id']}");
					header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/editTeam.php?team_id=".$_SESSION['last_team_viewed']);
					die();
				break;
			}
		}
	}
?>