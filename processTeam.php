<?php
include 'functions.php';

	if (isset($_GET['delete']) && !empty($_GET['delete']))
	{
		if (isset($_GET['team_id']) && !empty($_GET['team_id']))
		{

		}
		else if (isset($_GET['stu_id']) && !empty($_GET['stu_id']))
		{
			$stuQuery = "DELETE FROM student WHERE stu_id = ".$_GET['stu_id'];
			$stuResult = mysqli_query($con, $stuQuery);
			header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/editTeam.php?team_id=".$_SESSION['last_team_viewed']);
			die();
		}		
	}
	else if (isset($_GET['update']) && !empty($_GET['update']))
	{
		if (isset($_GET['team_id']) && !empty($_GET['team_id']))
		{

		}
		else if (isset($_GET['stu_id']) && !empty($_GET['stu_id']))
		{

		}
	}
	else if (isset($_POST['stu_name']) && !empty($_POST['stu_name']))
	{
		$stuQuery = "INSERT INTO student (team_id, stu_name) VALUES ('{$_SESSION['last_team_viewed']}', '{$_POST['stu_name']}')";
		echo $stuQuery;
		$stuResult = mysqli_query($con, $stuQuery);
		header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/editTeam.php?team_id=".$_SESSION['last_team_viewed']);
		//die();
	}

?>