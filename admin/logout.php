<?php
	session_start();

	//Löscht alle Session-Daten
	session_destroy();
?>


<!doctype html>
<html>
	<head>
<!-- Meta Data -->
		<meta charset="UTF-8">
		<meta name="author" content="Marc Putz">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
		<meta name="robots" content="noindex,nofollow">
		<meta name="revised" content="Marc Putz, 11/15/2017">
		
		<!-- Bootstrap & jQuery -->
		<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/hgoe.php" type="text/css">
		<script src="./assets/jquery.min.js"></script>
		
		<!-- Custom Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">
		
		<title>HGÖ - Logout</title>
	</head>

	<body style="font-family: Open Sans, Arial, sans-serif;">
		<div class="container vertical-center" style="max-width: 500px;">
			<div class="panel panel-hgoe" style='width: 100%;'>
				<div class="panel-heading text-center" style="font-family: Armata, Times New Roman, serif;">
					HGÖ - Logout
				</div>
				<div class="panel-body text-center">
					<b>Sie wurden erfolgreich ausgeloggt!</b>
					
					<br><br>
					<a class="btn btn-hgoe" href="./login.php">Zurück zum Login</a>
				</div>
			</div>
		</div>
	</body>
</html>