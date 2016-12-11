<?php
	include 'header.php';
?>

	<h3>Teams</h3>

	<?php
		$teamQuery = "SELECT * FROM team";

		if (has_value($_GET['team_id']))
		{
			$teamQuery = "SELECT * FROM team WHERE team_id = {$_GET['team_id']}";
		}
		
		$teams = run_sql_string($teamQuery);
	?>
	<?php foreach ($teams as $team): ?>
		<div class="row">
			<div class="col s12 l5">
				<div class="card green darken-3 white-text">
					<div class="card-content">
						<span class="card-title"><?php echo $team['team_name']; ?></span>
						<ul>
							<?php
								$students = run_sql_string("SELECT * FROM student WHERE team_id = {$team['team_id']}");
								foreach ($students as $student)
								{
									echo "<li>{$student['stu_name']}</li>";
								}
							?>
						</ul>
					</div>
					<div class="card-action">
						<a href="<?php echo "editTeam.php?team_id={$team['team_id']}"; ?>" class="btn waves-effect green">Modify</a>
						<a href="<?php echo "observations.php?team_id={$team['team_id']}"; ?>" class="btn waves-effect green">View Observations</a>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>

<?php include 'footer.php'; ?>