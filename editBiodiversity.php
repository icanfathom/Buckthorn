<?php include 'header.php'; ?>

<?php
	if (!has_value($_GET['obs_id'])) //We can't add biodiversity if there's no obs_id
	{
		header("Location: " . $root_url . "observations.php");
		die();
	}

	if (has_value($_GET['obs_id']))
	{
		$bio = run_sql_string("SELECT * FROM biodiversity WHERE obs_id = {$_GET['obs_id']}");
		if (has_value($bio))
		{
			$bio = $bio[0]; //Grab the only observation returned
		}
	}
?>

<h3>Biodiversity</h3>
<form action="processBiodiversity.php" method="post">
	<div class="row">
		<div class="col s12 l4 input-field">
			<textarea name="bio_species" class="materialize-textarea"><?php echo species_to_textarea($_GET['obs_id']); ?></textarea>
			<label for="bio_species">Species</label>
		</div>
	</div>
	<div class="row">
		<div class="col s12 l6 input-field">
			<textarea name="bio_notes" class="materialize-textarea"><?php echo $bio['bio_notes']; ?></textarea>
			<label for="bio_notes">Notes</label>
		</div>
	</div>
	
	<div class="row">
		<div class="col s12 l10 offset-l1">
			<div class="col s12 l5">
				<a href="<?php echo $url . "observations.php"; ?>" class="btn red darken-3 waves-effect waves-light"><i class="material-icons right">cancel</i>Cancel</a>
			</div>
			<div class="col s12 l3 offset-l4">
				<?php if (has_value($bio)): ?>
					<button type="submit" name="action" value="edit" class="btn waves-effect waves-light green"><i class="material-icons right">navigate_next</i>Next</button>
				<?php else: ?>
					<button type="submit" name="action" value="add" class="btn waves-effect waves-light green"><i class="material-icons right">navigate_next</i>Next</button>
				<?php endif; ?>
				<input type="hidden" name="obs_id" value="<?php echo $_GET['obs_id']; ?>">
			</div>
		</div>
	</div>
	
</form>

<?php include 'footer.php'; ?>