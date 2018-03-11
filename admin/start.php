<?php
	$config = include('./config.php');

	//Für Testzwecke ggf. auskommentieren
	session_start();
	
	if(!isset($_SESSION['user'])) {
		header("location: login.php");
		exit();
	}
?>

<!doctype html>
<html>
	<head>
			<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114935320-1"></script>
		
		<script>
  	    	window.dataLayer = window.dataLayer || [];
  			function gtag(){dataLayer.push(arguments);}
  		    gtag('js', new Date());

  			gtag('config', 'UA-114935320-1');
		</script>
		
		<!-- Meta Data -->
		<meta charset="UTF-8">
		<meta name="author" content="Marc Putz">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
		<meta name="robots" content="noindex,nofollow">
		<meta name="revised" content="Marc Putz, 11/15/2017">
		
		<!-- Bootstrap & jQuery -->
		<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="./assets/css/hgoe.css" type="text/css">
		<script src="./assets/jquery.min.js"></script>
		
		<!-- Custom Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">
		
		<title>HGÖ - Konferenztool - Startseite</title>
	</head>

	<body style="font-family: Open Sans, Arial, sans-serif;">
		<div class="container-fluid">
			<!-- Headline -->
			<div class="container-fluid row" style="padding-bottom: 5px;">
			
				<!-- normale Bildschirmgrößen -->
				<div class="col-sm-6 text-left hidden-xs" style="height: 70px;">
					<h1><img src="assets/img/hgoe_logo.png" style="height: 65px; margin-top: -16px;">&nbsp;
					Willkommen!</h1>
				</div>
				<div class="col-sm-6 text-right hidden-xs" style="height: 70px;">
					<a class="btn-hgoe btn" style="color: white; margin-top:15px; width: 225px;" href="erstellen.php">Neue Veranstaltung erstellen</a>
					<a class="btn btn-hgoe-red" style="margin-top: 15px; margin-left: 20px;" href="./logout.php">Ausloggen</a>
					<a class="btn btn-hgoe-grey" style="margin-top: 15px; margin-left: 20px;" onClick="settingsPlaceholder()"><img src="assets/img/settings_icon.svg" style="height: 20px;"></a>
					<script>
						function settingsPlaceholder() {
							alert('Dieser Button ist leider noch in Entwicklung.');
						}
					</script>
				</div>
				
				<!-- kleine Bildschirmgrößen -->
				<div class="col-xs-12 text-center hidden-sm hidden-md hidden-lg hidden-xl">
					<h1><img src="assets/img/hgoe_logo.png" style="height: 80px; margin-top: -10px;"> &nbsp;
					Willkommen!</h1>
				</div>
				<div class="col-xs-12 text-center hidden-sm hidden-md hidden-lg hidden-xl" style="height: 50px;">
					<a class="btn-hgoe btn" style="color: white; width: 300px;" href="erstellen.php">Neue Veranstaltung erstellen</a>
				</div>
			</div>
			
		  	<!-- Aktuelle Veranstaltungen -->
		  	<div class="panel-hgoe panel">
				
				<div class="panel-heading">
					<h4 style="margin: 0px;">
						<a data-toggle="collapse" href="#panelAktuell" style="text-decoration: none; font-weight: normal; color: white;">Aktuelle Veranstaltungen</a>
					</h4>
				</div>
				<div id="panelAktuell" class="panel-body panel-collapse collapse in" style="font-size: 14px;">
					<!-- Tabllen Überschrift -->
					<div class="row-hgoe row" style="font-size: 17px; font-weight: bold; background-color: #3D83BC; border-bottom-style: solid; border-bottom-width: 3px; color: white;">
						<div class="col-xs-8 col-sm-3" style="border-color: #CBD4FF">Veranstaltung</div>
						<div class="col-xs-4 col-sm-3" style="border-color: #CBD4FF">Datum</div>
						<div class="col-sm-3 hidden-xs" style="border-color: #CBD4FF">Anmeldefrist</div>
						<div class="col-sm-3 hidden-xs" style="border-color: #CBD4FF">Anmeldungen</div>
					</div>
					
					<!-- Veranstaltungen -->
					<?php
						echo "<script>";
						echo "	console.log('Connected to Database: " . $config['db_host'] . " as user " . $config['db_user'] . "');\n";
						echo "</script>";

						// Create connection
						$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

						// Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						} 

						$sql = "SELECT * FROM hgoe_17.hgoe_konferenzen ORDER BY datum ASC";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$id = "null";
								$name = "null";
								$datum = "null";
								$endeAnmeldefrist = "null";
								$maxAnmeldungen = "---";
								
								$id = $row["KonferenzID"];
								$name = $row["Name"];
								$datum = $row["datum"];
								$endeAnmeldefrist = $row["endeanmeldefrist"];
								if(!(is_null($row["maxanmeldungen"]))) {
									$maxAnmeldungen = $row["maxanmeldungen"];
								}
								
								echo "<div class='row-hgoe row clickable-row' data-href='detail.php?id=" . $id . "'>";
								echo "	<div class='col-xs-8 col-sm-3'>";
								echo "		" . $name;
								echo "	</div>";
								
								echo "	<div class='col-xs-4 col-sm-3'>";
								$datumFormatiert = date_create($datum);
								echo date_format($datumFormatiert, 'd.m.Y');
								echo "	</div>";
								
								echo "	<div class='col-sm-3 hidden-xs'>";
								$anmeldefristFormatiert = date_create($endeAnmeldefrist);
								echo date_format($anmeldefristFormatiert, 'd.m.Y  -  H:i');
								echo "	</div>";
								
								echo "	<div class='col-sm-3 hidden-xs'>";
								echo "		";
								$countResult = $conn->query("SELECT count(*) AS total FROM hgoe_teilnehmer WHERE KonferenzID = " . $id);
								if($countResult->num_rows > 0) {
									$tmp = $countResult->fetch_assoc();
									echo $tmp['total'];
								} else {
									echo "0";
								}
								echo " / " . $maxAnmeldungen;
								echo "	</div>";
								echo "</div>";	
							}
						} else {
							echo "<div class='row-hgoe row'>";
							echo "	<div class='col-xs-12'>Keine aktuellen Veranstaltungen</div>";
							echo "</div>";
						}
					?>
					
					<script>
						jQuery(document).ready(function($) {
							$(".clickable-row").click(function() {
								window.location = $(this).data("href");
							});
						});
					</script>
				</div>
			</div>
			
			<!-- Ältere Veranstaltungen -->
			<div class="panel-hgoe panel">
								
				<div class="panel-heading">
					<h4 style="margin: 0px;">
						<a data-toggle="collapse" href="#panelAelter" style="text-decoration: none; font-weight: normal; color: white;">Ältere Veranstaltungen</a>
					</h4>
				</div>
				<div id="panelAelter" class="panel-body panel-collapse collapse in" style="font-size: 14px;">
					<!-- Tabllen Überschrift -->
					<div class="row-hgoe row" style="font-size: 17px; font-weight: bold; background-color: #3D83BC; border-bottom-style: solid; border-bottom-width: 3px; color: white;">
						<div class="col-xs-8 col-sm-3" style="border-color: #CBD4FF">Veranstaltung</div>
						<div class="col-xs-4 col-sm-3" style="border-color: #CBD4FF">Datum</div>
						<div class="col-sm-3 hidden-xs" style="border-color: #CBD4FF">Anmeldefrist</div>
						<div class="col-sm-3 hidden-xs" style="border-color: #CBD4FF">Anmeldungen</div>
					</div>
					
					<!-- Veranstaltungen -->
					<?php
						// Create connection
						$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

						// Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						} 

						$sql = "SELECT * FROM hgoe_17.hgoe_konferenzen_history ORDER BY datum DESC";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$id = "null";
								$name = "null";
								$datum = "null";
								$endeAnmeldefrist = "null";
								$maxAnmeldungen = "---";
								
								$id = $row["KonferenzID"];
								$name = $row["Name"];
								$datum = $row["datum"];
								$endeAnmeldefrist = $row["endeanmeldefrist"];
								if(!(is_null($row["maxanmeldungen"]))) {
									$maxAnmeldungen = $row["maxanmeldungen"];
								}
								
								echo "<div class='row-hgoe row clickable-row' data-href='detail.php?id=" . $id . "'>";
								echo "	<div class='col-xs-8 col-sm-3'>";
								echo "		" . $name;
								echo "	</div>";
								
								echo "	<div class='col-xs-4 col-sm-3'>";
								$datumFormatiert = date_create($datum);
								echo date_format($datumFormatiert, 'd.m.Y');
								echo "	</div>";
								
								echo "	<div class='col-sm-3 hidden-xs'>";
								$anmeldefristFormatiert = date_create($endeAnmeldefrist);
								echo date_format($anmeldefristFormatiert, 'd.m.Y  -  H:i');
								echo "	</div>";
								
								echo "	<div class='col-sm-3 hidden-xs'>";
								echo "		";
								$countResult = $conn->query("SELECT count(*) AS total FROM hgoe_teilnehmer WHERE KonferenzID = " . $id);
								if($countResult->num_rows > 0) {
									$tmp = $countResult->fetch_assoc();
									echo $tmp['total'];
								} else {
									echo "0";
								}
								echo " / " . $maxAnmeldungen;
								echo "	</div>";
								echo "</div>";	
							}
						} else {
							echo "<div class='row-hgoe row'>";
							echo "	<div class='col-xs-12'>Keine älteren Veranstaltungen</div>";
							echo "</div>";
						}
					?>
					
					<script>
						jQuery(document).ready(function($) {
							$(".clickable-row").click(function() {
								window.location = $(this).data("href");
							});
						});
					</script>
				</div>
			</div>
			
			<div>
				HGÖ Konferenztool - <b>Version 0.2</b> (Pre-Release)
			</div>
		</div>
	</body>
</html>
