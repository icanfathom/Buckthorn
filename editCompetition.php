<?php include 'header.php'; ?>

<?php
	if (!has_value($_GET['obs_id'])) //We can't add biodiversity if there's no obs_id
	{
		header("Location: " . $root_url . "observations.php");
		die();
	}
	else
	{
		$obs = run_sql_string("SELECT * FROM observation WHERE obs_id = {$_GET['obs_id']}");
		$obs = $obs[0];
		$cmp = run_sql_string("SELECT * FROM competition WHERE obs_id = {$_GET['obs_id']}");
	}
?>

<form action="processCompetition.php" method="post">
	<div class="row">
		<?php for ($i = 1; $i <= $obs['num_bt_stems']; $i++): ?>
			<div class="col s12 l5 <?php if ($i % 2 == 0) echo "offset-l1"; ?>">
				<h4><?php echo "Buckthorn #" . $i; ?></h4>
				<div class="row">
					<div class="col s12 l8 input-field">
						<input type="text" name="<?php echo "dbh_$i"; ?>" value="<?php echo $cmp[$i - 1]['dbh']; ?>">
						<label for="<?php echo "dbh_$i"; ?>">DBH</label>
					</div>
				</div>
				<div class="row">
					<div class="col s12 l6 input-field">
						<input type="text" name="<?php echo "dist_to_nearest_bt_$i"; ?>" value="<?php echo $cmp[$i - 1]['dist_to_nearest_bt']; ?>">
						<label for="<?php echo "dist_to_nearest_bt_$i"; ?>">Distance to nearest BT</label>
					</div>
					<div class="col s12 l6 input-field">
						<input type="text" name="<?php echo "nearest_bt_dbh_$i"; ?>" value="<?php echo $cmp[$i - 1]['nearest_bt_dbh']; ?>">
						<label for="<?php echo "nearest_bt_dbh_$i"; ?>">Nearest BT DBH</label>
					</div>
				</div>
				<div class="row">
					<div class="col s12 l6 input-field">
						<input type="text" name="<?php echo "dist_to_nearest_non_bt_$i"; ?>" value="<?php echo $cmp[$i - 1]['dist_to_nearest_non_bt']; ?>">
						<label for="<?php echo "dist_to_nearest_non_bt_$i"; ?>">Distance to nearest non-BT</label>
					</div>
					<div class="col s12 l6 input-field">
						<input type="text" name="<?php echo "nearest_non_bt_dbh_$i"; ?>" value="<?php echo $cmp[$i - 1]['nearest_non_bt_dbh']; ?>">
						<label for="<?php echo "nearest_non_bt_dbh_$i"; ?>">Nearest non-BT DBH</label>
					</div>
				</div>
				<div class="row">
					<div class="col s12 l12 input-field">
						<textarea name="<?php echo "cmp_notes_$i"; ?>" class="materialize-textarea"><?php echo $cmp[$i - 1]['cmp_notes']; ?></textarea>
						<label for="<?php echo "cmp_notes_$i"; ?>">Notes</label>
					</div>
				</div>
			</div>
		<?php endfor; ?>
	</div>

	<div class="row">
		<div class="divider"></div>
		<div class="col s12 l10 offset-l1">
			<div class="col s12 l5">
				<a href="<?php echo $url . "observations.php"; ?>" class="btn red darken-3 waves-effect waves-light"><i class="material-icons right">cancel</i>Cancel</a>
			</div>
			<div class="col s12 l3 offset-l4">
				<?php if (has_value($cmp)): ?>
					<button type="submit" name="action" value="edit" class="btn waves-effect waves-light green"><i class="material-icons right">navigate_next</i>Finish</button>
				<?php else: ?>
					<button type="submit" name="action" value="add" class="btn waves-effect waves-light green"><i class="material-icons right">navigate_next</i>Finish</button>
				<?php endif; ?>
				<input type="hidden" name="obs_id" value="<?php echo $_GET['obs_id']; ?>">
				<input type="hidden" name="num_bt_stems" value="<?php echo $obs['num_bt_stems']; ?>">
			</div>
		</div>
	</div>

</form>

<?php include 'footer.php'; ?>