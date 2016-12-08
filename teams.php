<?php
	include 'header.php';
?>

	<h1>Teams</h1>

	<?php
		$teamQuery = "SELECT * FROM team";

		if (has_value($_GET['team_id']))
		{
			$teamQuery = "SELECT * FROM team WHERE team_id = {$_GET['team_id']}";
		}
		
		$teams = run_sql_string($teamQuery);

		foreach ($teams as $team)
		{
			echo "<h2><a href=\"?team_id=$team[team_id]\">$team[team_name]</a></h2>";

			$students = run_sql_string("SELECT * FROM student WHERE team_id = $team[team_id]");
			
			echo "<table>";
			foreach ($students as $student)
			{
				echo "<tr>";
				echo "<td>$student[stu_name]</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
	?>

<?php include 'footer.php'; ?>