<?php
	//header.php provides $con, a connection to the db
include 'header.php';
?>

<h1>Observations</h1>

<?php
	$obsQuery = "SELECT * FROM observation NATURAL JOIN team";
	$obsResult = mysqli_query($con, $obsQuery);
?>

<ul class="collapsible" data-collapsible="expandable">
	<?php while ($obsRow = mysqli_fetch_array($obsResult)): ?>
		<li>
			<div class="collapsible-header">
				<ul>
					<li class="date" ><?php echo $obsRow[date]; ?></li>
					<li class="teamName" ><?php echo $obsRow[team_name]; ?></li>
					<li class="numStems" ><?php echo "$obsRow[num_bt_stems] stems"; ?></li>
					<li class="notes" ><?php echo $obsRow[description]; ?></li>
				</ul>
			</div>
			<div class="collapsible-body">

				<!----------Observation---------->
				<table class="bordered responsive-table">
					<tr>
						<th>Team</th>
						<th>Quadrat GPS location</th>
						<th>Quadrat size</th>
						<th># BT stems</th>
						<th>Density</th>
						<th>% BT follar coverage</th>
						<th>Median BT circumference</th>
						<th>Habitat description</th>
						<th>Photos</th>
						<th>Other notes</th>
					</tr>
					<tr>
						<td>
							<?php echo "<a href=\"teams.php?team_id=$obsRow[team_id]\">$obsRow[team_name]</a>"; ?>
						</td>
						<td>
							<?php echo "$obsRow[coord_n] N, $obsRow[coord_w] W"; ?>
						</td>
						<td>
							<?php echo $obsRow[quadrat_size]; ?>
						</td>
						<td>
							<?php echo $obsRow[num_bt_stems]; ?>
						</td>
						<td>
							<?php echo $obsRow[num_bt_stems] / $obsRow[quadrat_size]; ?>
						</td>
						<td>
							<?php echo $obsRow[follar_coverage]; ?>
						</td>
						<td>
							<?php echo $obsRow[median_bt_circumference]; ?>
						</td>
						<td>
							<?php echo $obsRow[description]; ?>
						</td>
						<td>
							<a href="<?php echo $obsRow[photo_link]; ?>">Photos</a>
						</td>
						<td>
							<?php echo $obsRow[obs_notes]; ?>
						</td>
					</tr>
				</table>

				<!----------Biodiversity---------->
				<?php
					$bioQuery = "SELECT * FROM biodiversity WHERE obs_id = $obsRow[obs_id]";
					$bioResult = mysqli_query($con, $bioQuery);
					$bioRow = mysqli_fetch_array($bioResult);

					$speciesQuery = "SELECT * FROM bio_species WHERE obs_id = $obsRow[obs_id] ORDER BY species";
					$speciesResult = mysqli_query($con, $speciesQuery);

					//Throw together the string of surrounding species
					$bio_string = "A ($bioRow[num_bt])";
					while ($speciesRow = mysqli_fetch_array($speciesResult)) {
						$bio_string .= ", $speciesRow[species] ($speciesRow[num])";
					}
				?>
				<div class="card">
					<div class="card-content">
						<span class="card-title">Biodiversity</span>
						<ul>
							<li>Biodiversity: <?php echo $bio_string ?></li>
							<li>Shannon-Weiner index: TODO</li>
							<li>Notes: <?php echo $bioRow[bio_notes]; ?></li>
						</ul>
					</div>
				</div>

				<!----------Competition---------->
				<?php
					$compQuery = "SELECT * FROM competition WHERE obs_id = $obsRow[obs_id]";
					$compResult = mysqli_query($con, $compQuery);
				?>
				<div class="card">
					<div class="card-content">
						<span class="card-title">Competition</span>
						<ul class="collection">
							<?php while ($compRow =  mysqli_fetch_array($compResult)): ?>
								<li class="collection-item">
									<ul class="inline competition">
										<li>BT <?php echo $compRow[bt_index]; ?></li>
										<li>DBH: <?php echo $compRow[dbh]; ?></li>
										<li>Dist to nearest BT: <?php echo $compRow[dist_to_nearest_bt]; ?></li>
										<li>Nearest BT DBH: <?php echo $compRow[nearest_bt_dbh]; ?></li>
										<li>Dist to nearest Non-BT: <?php echo $compRow[dist_to_nearest_non_bt]; ?></li>
										<li>Nearest Non-BT DBH: <?php echo $compRow[nearest_non_bt_dbh]; ?></li>
										<li>Notes: <?php echo $compRow[cmp_notes]; ?></li>
									</ul>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
			</div>
		</li>
	<?php endwhile; ?>
</ul>

<?php include 'footer.php'; ?>