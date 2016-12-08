<?php include 'header.php'; ?>
<?php
	//Update team
if (isset($_GET['team_id']) && !empty($_GET['team_id']))
{
	$_SESSION['last_team_viewed'] = $_GET['team_id'];
	$teamQuery = "SELECT * FROM team WHERE team_id = {$_GET['team_id']}";
	$teamResult = mysqli_query($con, $teamQuery);
	$teamRow = mysqli_fetch_array($teamResult);

	$stuQuery = "SELECT * FROM student WHERE team_id = $teamRow[team_id]";
	$stuResult = mysqli_query($con, $stuQuery);
	$students = sql_to_array($stuResult);
}
?>
<div class="row">
	<div class="col s4">
		
		<h4><?php echo $teamRow['team_name']; ?></h4>

		<?php for ($i = 0; $i < sizeof($students); $i++): ?>
			<div class="row student-list">
				<form action="processTeam.php" method="post">
					<div class="col s8">
						<h5 id="stu_name_<?php echo $students[$i]['stu_id']; ?>"><?php echo $students[$i]['stu_name']; ?></h5>
					</div>
					<div class="col s4">
						<a href="#modal1" class="btn-floating edit-student"><i class="material-icons">mode_edit</i></a>
						<button type="submit" name="action" value="delete" class="btn-floating red darken-3"><i class="material-icons">delete</i></button>
						<input type="hidden" name="stu_id" class="hidden-stu-id" value="<?php echo $students[$i]['stu_id']; ?>">
					</div>
				</form>
			</div>
		<?php endfor; ?>

		<div class="row">
			<div class="col s8">
				<a href="#modal1" class="btn add-student"><i class="material-icons right">add</i>New student</a>
			</div>
		</div>
		<div id="modal1" class="modal bottom-sheet">
			<div class="modal-content">
				<form action="processTeam.php" method="post">
					<div class="row">
						<div class="col s3 offset-s3 input-field">
							<input class="stu-name-textbox" name="stu_name" type="text">
							<label for="stu_name" class="active">Name</label>
							<input type="hidden" name="stu_id" class="editing-stu" value="-1">
						</div>
						<div class="col s3">
							<button class="btn submit-action-add" type="submit" name="action" value="add"><i class="material-icons right">add</i>Add</button>
							<button class="btn submit-action-edit" type="submit" name="action" value="edit"><i class="material-icons right">mode_edit</i>Modify</button>
							<a class="red darken-3 btn modal-close"><i class="material-icons right">cancel</i>Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>

<?php include 'footer.php'; ?>