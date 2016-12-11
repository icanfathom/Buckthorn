<?php
	//header.php provides $con, a connection to the db
include 'header.php';
	
	$sql_string = "SELECT * FROM observation NATURAL JOIN team";
	if (has_value($_GET['team_id']))
		$sql_string .= " WHERE team_id = " . $_GET['team_id'];

	$observations = run_sql_string($sql_string);
?>

<h3>Observations</h3>

<ul class="collapsible obs" data-collapsible="expandable">
	<?php foreach ($observations as $obs): ?>
		<li>
			<div class="collapsible-header">
				<ul>
					<li class="date" ><?php echo $obs['date']; ?></li>
					<li class="teamName" ><?php echo $obs['team_name']; ?></li>
					<li class="numStems" ><?php echo "{$obs['num_bt_stems']} stems"; ?></li>
					<li class="notes" ><?php echo $obs['description']; ?></li>
					<div class="secondary-content">
						<a href="<?php echo "editObservation.php?obs_id={$obs['obs_id']}"; ?>"><i class="material-icons green-text">mode_edit</i></a>
						<a href="" class="yellow-text text-darken-4"><i class="material-icons">delete</i></a>
					</div>
				</ul>
			</div>
			<div class="collapsible-body">
				
				<!----------Observation---------->
				<div class="card">
					<div class="card-content">
						<table class="bordered responsive-table">
							<tr>
								<th>Team</th>
								<th>Location</th>
								<th>Quadrat size</th>
								<th># BT stems</th>
								<th>Density</th>
								<th>% BT follar coverage</th>
								<th>Median BT circumference</th>
								<th>Habitat</th>
								<th>Photos</th>
								<th>Notes</th>
							</tr>
							<tr>
								<td>
									<?php echo "<a href=\"teams.php?team_id={$obs['team_id']}\">{$obs['team_name']}</a>"; ?>
								</td>
								<td>
									<?php echo "{$obs['coord_n']} N, {$obs['coord_w']} W"; ?>
								</td>
								<td>
									<?php echo $obs['quadrat_size']; ?>
								</td>
								<td>
									<?php echo $obs['num_bt_stems']; ?>
								</td>
								<td>
									<?php echo $obs['num_bt_stems'] / $obs['quadrat_size']; ?>
								</td>
								<td>
									<?php echo $obs['follar_coverage']; ?>
								</td>
								<td>
									<?php echo $obs['median_bt_circumference']; ?>
								</td>
								<td>
									<?php echo $obs['description']; ?>
								</td>
								<td>
									<a href="<?php echo $obs['photo_link']; ?>" class="btn-floating waves-effect green"><i class="material-icons">photo</i></a>
								</td>
								<td>
									<a href="#!" id="<?php echo "notes_btn_{$obs['obs_id']}"; ?>" class="btn-floating waves-effect green show-obs-notes"><i class="material-icons">description</i></a>
								</td>
							</tr>
						</table>
					</div>
				</div>

				<div id="<?php echo "notes_card_{$obs['obs_id']}"; ?>" class="card obs-notes">
					<div class="card-content">
						<?php echo $obs['obs_notes']; ?>
					</div>
				</div>

				<!----------Biodiversity---------->
				<?php
				$bio = run_sql_string("SELECT * FROM biodiversity WHERE obs_id = {$obs['obs_id']}");
				$bio = $bio[0];

				$speciesResults = run_sql_string("SELECT * FROM bio_species WHERE obs_id = {$obs['obs_id']} ORDER BY species");

					//Throw together the string of surrounding species
				$bio_string = "A ({$bio['num_bt']})";
				foreach ($speciesResults as $species)
				{
					$bio_string .= ", {$species['species']} ({$species['num']})";
				}
				?>
				<div class="card">
					<div class="card-content">
						<span class="card-title">Biodiversity</span>
						<ul>
							<li>Biodiversity: <?php echo $bio_string ?></li>
							<li>Shannon-Weiner index: TODO</li>
							<li>Notes: <?php echo $bio['bio_notes']; ?></li>
						</ul>
					</div>
				</div>

				<!----------Competition---------->
				<?php
				$compResults = run_sql_string("SELECT * FROM competition WHERE obs_id = {$obs['obs_id']}");
				?>
				<div class="card">
					<div class="card-content">
						<span class="card-title">Competition</span>
						<ul class="collection">
							<?php foreach ($compResults as $comp): ?>
								<li class="collection-item">
									<ul class="inline competition">
										<li>BT <?php echo $comp['bt_index']; ?></li>
										<li>DBH: <?php echo $comp['dbh']; ?></li>
										<li>Dist to nearest BT: <?php echo $comp['dist_to_nearest_bt']; ?></li>
										<li>Nearest BT DBH: <?php echo $comp['nearest_bt_dbh']; ?></li>
										<li>Dist to nearest Non-BT: <?php echo $comp['dist_to_nearest_non_bt']; ?></li>
										<li>Nearest Non-BT DBH: <?php echo $comp['nearest_non_bt_dbh']; ?></li>
										<li>Notes: <?php echo $comp['cmp_notes']; ?></li>
									</ul>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</li>
	<?php endforeach; ?>
</ul>

<?php include 'footer.php'; ?>