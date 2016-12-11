<?php include 'functions.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml" > 
<head>
	<title>Buckthorn</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<meta name="keywords" content="php, mysql" />
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
	<link rel="stylesheet" href="main.css">
</head> 
<body>

	<nav class="main-nav green">
		<div class="nav-wrapper">
			<a href="<?php echo $root_url; ?>" class="brand-logo">Buckthorn Database</a>
			<ul id="nav-mobile" class="right hide-on-small-only">
				<li><a href="teams.php">Teams</a></li>
				<li><a href="observations.php">Observations</a></li>
			</ul>
		</div>
	</nav>

	<div class="container">