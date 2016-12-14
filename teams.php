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

		$teamQuery .= " ORDER BY team_id";
		
		$teams = run_sql_string($teamQuery);
	?>

	<?php
		$i = -1;
		foreach ($teams as $team):
			$i++;
			if ($i % 2 == 0)
				echo "<div class=\"row\">";
	?>
			<div class="col s12 l5">
				<div class="card grey lighten-2">
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
						<a href="<?php echo "observations.php?team_id={$team['team_id']}"; ?>" class="btn waves-effect grey darken-1">View Observations</a>
					</div>
				</div>
			</div>
		
	<?php
		if ($i % 2 == 1)
			echo "</div>";
		endforeach;
	?>

	<div class="fixed-action-btn">
		<a href="#modal1" class="btn-floating btn-large waves-effect green">
			<i class="large material-icons">add</i>
		</a>
	</div>

	<div id="modal1" class="modal bottom-sheet">
		<div class="modal-content">
			<form action="processTeam.php" method="post">
				<div class="row">
					<div class="col s6 l3 offset-l3 input-field">
						<input class="team-name-textbox" name="team_name" type="text">
						<label for="team_name" class="active">Name</label>
						<input type="hidden" name="team_id" class="editing-team-id" value="-1">
					</div>
					<div class="col s6 l3">
						<button class="btn waves-effect waves-light green submit-action-add" type="submit" name="action" value="add"><i class="material-icons right">add</i>Add</button>
						<a class="yellow darken-4 btn waves-effect waves-light modal-close"><i class="material-icons right">cancel</i>Cancel</a>
					</div>
				</div>
			</form>
		</div>
	</div>

<?php include 'footer.php'; ?>