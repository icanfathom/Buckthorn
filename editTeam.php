<?php
	include 'header.php';

	if (has_value($_GET['team_id']))
	{
		$_SESSION['last_team_viewed'] = $_GET['team_id'];
		$team = run_sql_string("SELECT * FROM team WHERE team_id = $_GET[team_id]");
		$students = run_sql_string("SELECT * FROM student WHERE team_id = {$team[0][team_id]}");
	}
?>
<div class="row">
	<div class="col s12 l5">
		<div class="row">
			<form action="processTeam.php" method="post">
				<div class="col s9">
					<h3 id="team_name"><?php echo $team[0]['team_name']; ?></h3>
				</div>
				<div class="col s3">
					<a href="#modal1" class="btn-floating waves-effect waves-light green edit-team team-action-btn"><i class="material-icons">mode_edit</i></a>
					<button type="submit" name="action" value="delete" class="btn-floating waves-effect waves-light yellow darken-4 team-action-btn"><i class="material-icons">delete</i></button>
					<input type="hidden" name="team_id" class="hidden-team-id" value="<?php echo $team[0]['team_id']; ?>">
					<input type="hidden" name="team_name" class="hidden-team-name" value="<?php echo $team[0]['team_name']; ?>">
				</div>
			</form>
		</div>

		<?php foreach ($students as $student): ?>
			<div class="row student-list">
				<form action="processTeam.php" method="post">
					<div class="col s9">
						<h5><?php echo $student['stu_name']; ?></h5>
					</div>
					<div class="col s3">
						<a href="#modal2" class="btn-floating waves-effect waves-light green edit-student"><i class="material-icons">mode_edit</i></a>
						<button type="submit" name="action" value="delete" class="btn-floating waves-effect waves-light yellow darken-4"><i class="material-icons">delete</i></button>
						<input type="hidden" name="stu_id" class="hidden-stu-id" value="<?php echo $student['stu_id']; ?>">
						<input type="hidden" name="stu_name" class="hidden-stu-name" value="<?php echo $student['stu_name']; ?>">
					</div>
				</form>
			</div>
		<?php endforeach; ?>
	
		<div class="row">
			<div class="col s9">
				<a href="#modal2" class="btn waves-effect waves-light green add-student"><i class="material-icons right">add</i>New student</a>
			</div>
		</div>
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
						<button class="btn waves-effect waves-light green submit-action-edit" type="submit" name="action" value="edit"><i class="material-icons right">mode_edit</i>Modify</button>
						<a class="yellow darken-4 btn waves-effect waves-light modal-close"><i class="material-icons right">cancel</i>Cancel</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div id="modal2" class="modal bottom-sheet">
		<div class="modal-content">
			<form action="processTeam.php" method="post">
				<div class="row">
					<div class="col s6 l3 offset-l3 input-field">
						<input class="stu-name-textbox" name="stu_name" type="text">
						<label for="stu_name" class="active">Name</label>
						<input type="hidden" name="stu_id" class="editing-stu-id" value="-1">
					</div>
					<div class="col s6 l3">
						<button class="btn waves-effect waves-light green submit-action-add" type="submit" name="action" value="add"><i class="material-icons right">add</i>Add</button>
						<button class="btn waves-effect waves-light green submit-action-edit" type="submit" name="action" value="edit"><i class="material-icons right">mode_edit</i>Modify</button>
						<a class="yellow darken-4 btn waves-effect waves-light modal-close"><i class="material-icons right">cancel</i>Cancel</a>
					</div>
				</div>
			</form>
		</div>
	</div>

</div>

<?php include 'footer.php'; ?>