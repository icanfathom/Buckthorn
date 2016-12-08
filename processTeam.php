<?php
include 'functions.php';

	if (isset($_POST['action']) && !empty($_POST['action']))
	{
		switch ($_POST['action'])
		{
			case 'add':
				$stuQuery = "INSERT INTO student (team_id, stu_name) VALUES ('{$_SESSION['last_team_viewed']}', '{$_POST['stu_name']}')";
				$stuResult = mysqli_query($con, $stuQuery);
				header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/editTeam.php?team_id=".$_SESSION['last_team_viewed']);
				die();
			break;
			case 'edit':
				$stuQuery = "UPDATE student SET stu_name = '{$_POST['stu_name']}' WHERE stu_id = {$_POST['stu_id']}";
				$stuResult = mysqli_query($con, $stuQuery);
				header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/editTeam.php?team_id=".$_SESSION['last_team_viewed']);
				die();
			break;
			case 'delete':
				$stuQuery = "DELETE FROM student WHERE stu_id = ".$_POST['stu_id'];
				$stuResult = mysqli_query($con, $stuQuery);
				header("Location: http://www.mathcs.bethel.edu/~jom44754/Buckthorn/editTeam.php?team_id=".$_SESSION['last_team_viewed']);
				die();
			break;
		}
	}
?>