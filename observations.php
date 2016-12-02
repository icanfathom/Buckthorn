<?php
	//header.php provides $con, a connection to the db
	include 'header.php';
?>

	<h1>Observations</h1>

	<?php
		$obsQuery = "SELECT * FROM observation NATURAL JOIN team";

		// if (isset($_GET['team_id']) && !empty($_GET['team_id']))
		// {
		// 	$obsQuery = "SELECT * FROM team WHERE team_id = {$_GET['team_id']}";
		// }
		
		$obsResult = mysqli_query($con, $obsQuery);
	?>

	<table border="1">
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
		<?php while($obsRow = mysqli_fetch_array($obsResult)): ?>
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
		<?php endwhile; ?>
	</table>

<?php include 'footer.php'; ?>