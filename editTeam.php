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
	<div class="col s12">
		<form action="" method="post">
			
			<h4>Team</h4>
			<div class="row">
				<div class="col s4 input-field">
					<input id="team_name" type="text" value="<?php echo $teamRow['team_name']; ?>">
					<label for="team_name" class="active">Name</label>
				</div>
				<!-- <div class="col s1">
					<a href="<?php echo "processTeam.php?delete=1&team_id=".$teamRow['team_id']; ?>"><i class="material-icons delete">delete</i></a>
				</div> -->
			</div>

			<h4>Students</h4>
			<?php for ($i = 0; $i < sizeof($students); $i++): ?>
				<div class="row student-list">
					<div class="col s4">
						<input name="<?php echo "student-".$students[$i]['stu_id']; ?>" type="text" value="<?php echo $students[$i]['stu_name']; ?>">
					</div>
					<div class="col s1">
						<a href="<?php echo "processTeam.php?delete=1&stu_id=".$students[$i]['stu_id']; ?>"><i class="material-icons">delete</i></a>
					</div>
				</div>
			<?php endfor; ?>

			<div class="row">
				<div class="col s4">
					<a href="#modal1" class="btn"><i class="material-icons right">add</i>New student</a>
				</div>
			</div>
			<div id="modal1" class="modal bottom-sheet">
				<div class="modal-content">
					<form action="processTeam.php" method="post">
						<div class="row">
							<div class="col s3 offset-s3 input-field">
								<input id="stu_name" name="stu_name" type="text">
								<label for="stu_name">Name</label>
							</div>
							<div class="col s3">
								<button class="white-text btn" type="submit"><i class="material-icons right">add</i>Add</button>
								<a class="red darken-3 btn modal-close"><i class="material-icons right">cancel</i>Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>

		</form>
	</div>
</div>

<?php include 'footer.php'; ?>