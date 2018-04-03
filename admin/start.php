<?php
	$config = include('./config.php');
	session_start();

	//Für Testzwecke ggf. auskommentieren
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
		<link rel="stylesheet" href="assets/css/hgoe.php" type="text/css">
		<script src="./assets/jquery.min.js"></script>
		<script src="./assets/bootstrap.min.js"></script>
		
		<!-- Custom Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">
		
		<title>HGÖ - Startseite</title>
	</head>

	<body style="font-family: Open Sans, Arial, sans-serif;">
		<div class="container">
			<!-- Headline -->
			<div class="container-fluid row box" style="margin-left: 0px; margin-right: 0px; margin-top: 20px; margin-bottom: 20px; padding-bottom: 8px; padding-top: 3px;">
			
				<!-- normale Bildschirmgrößen -->
				<div class="col-sm-5 text-left hidden-xs" style="height: 70px;">
					<h2 style="margin-top: -4px;"><img src="assets/img/hgoe_logo.png" style="height: 65px; margin-top: 8px;">&nbsp;
					Willkommen!</h2>
					<p style="margin-left: 65px; margin-top: -35px;"><?php if(isset($_SESSION['user'])) { echo "Angemeldet als: <b>" . $_SESSION['user'] . "</b>"; } else { echo "Nicht angemeldet"; } ?></p>
				</div>
				<div class="col-sm-7 text-right hidden-xs" style="height: 70px;">
					<a class="btn btn-hgoe-red" style="margin-top: 18px;" href="./logout.php"><img src="assets/img/logout_icon.svg" style="height: 20px;"> Ausloggen</a>
					<a class="btn btn-hgoe-grey" style="margin-top: 18px; margin-left: 15px;" href="./settings/settings.php"><img src="assets/img/settings_icon.svg" style="height: 20px;"> Einstellungen</a>
				</div>
				
				<!-- kleine Bildschirmgrößen -->
				<div class="col-xs-12 text-center hidden-sm hidden-md hidden-lg hidden-xl" style="margin-bottom: 10px; margin-top: 5px;">
					<h3 style="margin-top: -10px; font-size: 24px;"><img src="assets/img/hgoe_logo.png" style="height: 80px; margin-top: 18px;"> &nbsp;
					Willkommen!</h3>
					<p style="margin-left: 80px; margin-top: -45px;"><?php if(isset($_SESSION['user'])) { echo "Angemeldet als: <b>" . $_SESSION['user'] . "</b>"; } else { echo "Nicht angemeldet"; } ?></p>
				</div>
			</div>
			
		  	<!-- Aktuelle Veranstaltungen -->
		  	<div class="panel-hgoe panel" style='margin-top: 30px;'>
				<div class="panel-heading">
					<h4 data-toggle="collapse" href="#panelAktuell" style="text-decoration: none; font-weight: normal; margin: 0px;">
						Aktuelle Veranstaltungen
					</h4>
				</div>
				<div id="panelAktuell" class="panel-body panel-collapse collapse in" style="font-size: 13px; padding: 20px;">
					
					<!-- Tabellen Überschrift -->
					<div class="row-hgoe row" style="font-size: 15px; font-weight: bold; background-color: <?php echo $config['color_primary']; ?>; color: white;">
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
					
					<div class="container-fluid text-center" style="margin-top: 20px;">
						<a class="btn-hgoe btn" style="" href="erstellen.php">Neue Veranstaltung erstellen</a>
					</div>
				</div>
			</div>
			
			<!-- Ältere Veranstaltungen -->
			<div class="panel-hgoe panel" style='margin-top: 30px;'>					
				<div class="panel-heading">
					<h4 data-toggle="collapse" href="#panelAelter" style="text-decoration: none; font-weight: normal; margin: 0px;">
						Ältere Veranstaltungen
					</h4>
				</div>
				<div id="panelAelter" class="panel-body panel-collapse collapse in" style="font-size: 13px;">
					<!-- Tabllen Überschrift -->
					<div class="row-hgoe row" style="font-size: 15px; font-weight: bold; background-color: <?php echo $config['color_primary']; ?>; border-bottom-style: solid; border-bottom-width: 3px; color: white;">
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
			
			<div class="container-fluid text-center" style="margin-top: 20px; margin-bottom: 5px;">
				<p>© HGÖ Konferenztool - <b>Version 0.3</b><br> (Pre-Release)</p>
			</div>
			
			<div class="container-fluid text-center" style="margin-bottom: 80px; margin-top: 10px;">
				<a href="../hilfe.php" style="font-size: 18px; color: black;"><img src="./assets/img/help_icon.svg" style="height: 22px; margin-top: -3px; margin-right: 3px;">Hilfe</a>
			</div>
		</div>
		
		<!-- FOOTER -->
		<div class="box navbar-fixed-bottom hidden-sm hidden-md hidden-lg" style='box-shadow: 0px -2px 10px rgba(0,0,0,0.6);'>
			<div class="container-fluid row" style='margin-top: 10px; margin-bottom: 10px;'>
				<div class="col-xs-12 text-center" id="burgerIcon">
					<img src="./assets/img/burger_icon.svg" style="height: 30px;">
				</div>
			</div>
			
			<script>
				$("#burgerIcon").click( function() {
					$("#footerButtonDiv").toggleClass('hide');
				})
			</script>
			
			<div class="container-fluid row hide" id="footerButtonDiv" style='font-size: 16px; margin-top: 10px; margin-bottom: 10px; border-top: 1pt solid #A6A6A6; padding-top: 10px; padding-bottom: 3px;'>
				<div class="col-xs-6 text-center">
					<a class="btn btn-hgoe-red" href="./logout.php" style="width: 100%;"><img src="assets/img/logout_icon.svg" style="height: 20px;"> Ausloggen</a>
				</div>
				<div class="col-xs-6 text-center">
					<a class="btn btn-hgoe-grey" style="width: 100%;" onClick="settingsPlaceholder()"><img src="assets/img/settings_icon.svg" style="height: 20px;"> Einstellungen</a>
				</div>			
			</div>
		</div>
	</body>
</html>
