<?php
	//header.php provides $con, a connection to the db
	include 'header.php';
?>

	<h1>Teams</h1>

	<?php
		$teamQuery = "SELECT * FROM team";

		if (isset($_GET['team_id']) && !empty($_GET['team_id']))
		{
			$teamQuery = "SELECT * FROM team WHERE team_id = {$_GET['team_id']}";
		}
		
		$teamResult = mysqli_query($con, $teamQuery);

		while($teamRow = mysqli_fetch_array($teamResult))
		{
			echo "<h2><a href=\"?team_id=$teamRow[team_id]\">$teamRow[team_name]</a></h2>";

			$stuQuery = "SELECT * FROM student WHERE team_id = $teamRow[team_id]";
			$stuResult = mysqli_query($con, $stuQuery);
			
			echo "<table border=\"1\">";
			while ($stuRow = mysqli_fetch_array($stuResult))
			{
				echo "<tr>";
				echo "<td>$stuRow[stu_name]</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
	?>

<?php include 'footer.php'; ?>