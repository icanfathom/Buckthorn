<?php
include 'header.php';

	$teams = run_sql_string("SELECT * FROM team");

	if (has_value($_GET['obs_id']))
	{
		$obs = run_sql_string("SELECT * FROM observation WHERE obs_id = {$_GET['obs_id']}");
		$obs = $obs[0]; //Grab the only observation returned
	}
?>

<h3>Observation</h3>
<form action="" method="post">
	<div class="row">
		<div class="col s12 l4">
			<label>Team</label>
			<select name="team" class="browser-default">
				<option value="-1" <?php if (!has_value($obs)) echo 'selected'; ?> disabled>Select team</option>
					<?php foreach ($teams as $team)
						{
							//If current team made this observation, set it as the selected element
							echo "<option value=\"{$team['team_id']}\"";
							if (has_value($obs) && $obs['team_id'] == $team['team_id'])
								echo ' selected';
							echo ">{$team['team_name']}";
							echo "</option>";
						}
					?>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col s12 l4 input-field">
			<input type="text" name="date" value="<?php echo $obs['date']; ?>">
			<label for="date">Date</label>
		</div>
	</div>
	<div class="row">
		<div class="col s12 l2 input-field">
			<input type="text" name="coord_n" value="<?php echo $obs['coord_n']; ?>">
			<label for="coord_n">Coordinate N</label>
		</div>
		<div class="col s12 l2 input-field">
			<input type="text" name="coord_w" value="<?php echo $obs['coord_w']; ?>">
			<label for="coord_w">Coordinate W</label>
		</div>
	</div>
	<div class="row">
		<div class="col s12 l4 input-field">
			<input type="text" name="quadrat_size" value="<?php echo $obs['quadrat_size']; ?>">
			<label for="quadrat_size">Quadrat size</label>
		</div>
	</div>
	<div class="row">
		<div class="col s12 l3 input-field">
			<input type="text" name="num_bt_stems" value="<?php echo $obs['num_bt_stems']; ?>">
			<label for="num_bt_stems">Number of BT stems</label>
		</div>
		<div class="col s12 l3 input-field">
			<input type="text" name="follar_coverage" value="<?php echo $obs['follar_coverage']; ?>">
			<label for="follar_coverage">% follar coverage</label>
		</div>
		<div class="col s12 l3 input-field">
			<input type="text" name="median_bt_circumference" value="<?php echo $obs['median_bt_circumference']; ?>">
			<label for="median_bt_circumference">Median BT circumference</label>
		</div>
	</div>
	<div class="row">
		<div class="col s12 l6 input-field">
			<textarea name="description" class="materialize-textarea"><?php echo $obs['description']; ?></textarea>
			<label for="description">Description</label>
		</div>
	</div>
	<div class="row">
		<div class="col s12 l12 input-field">
			<input type="text" name="photo_link" value="<?php echo $obs['photo_link']; ?>">
			<label for="photo_link">Link to photos</label>
		</div>
	</div>
	<div class="row">
		<div class="col s12 l6 input-field">
			<textarea name="obs_notes" class="materialize-textarea"><?php echo $obs['obs_notes']; ?></textarea>
			<label for="obs_notes">Notes</label>
		</div>
	</div>
	<div class="row">
		<div class="col s12 l10 offset-l1">
			<div class="col s12 l5">
				<a href="<?php echo $url . "observations.php"; ?>" class="btn red darken-3 waves-effect waves-light"><i class="material-icons right">cancel</i>Cancel</a>
			</div>
			<div class="col s12 l3 offset-l4">
				<?php if (has_value($obs)): ?>
					<button type="submit" name="action" value="edit" class="btn waves-effect waves-light"><i class="material-icons right">mode_edit</i>Modify</button>
					<input type="hidden" name="obs_id" value="<?php echo $obs['obs_id']; ?>">
				<?php else: ?>
					<button type="submit" name="action" value="add" class="btn waves-effect waves-light"><i class="material-icons right">add</i>Add</button>
				<?php endif; ?>
			</div>
		</div>
	</div>
</form>

<?php
include 'footer.php';
?>