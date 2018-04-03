<!-- prüft ob der User eingeloggt ist -->
<?php
	session_start();
	$config = include('./config.php');

	/*if(!isset($_SESSION['user'])) {
		header("location: login.php");
		exit();
	}*/
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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
		
		<title>HGÖ - Konferenztool</title>
		
		<style>
			@media (min-width: 768px) {
				/* sm and bigger */
				#mainPanel {
					min-height: 96.5%;
					width: 100%;
				}
			}
			
			#navbar-btn {
				height:50px;
			}
			
			#navbar-absagen-btn {
				background-color: rgba(255, 0, 0, 0.25);
			}
			#navbar-absagen-btn:focus {
				background-color: red;
			}
			
			#navbar-loeschen-btn {
				background-color: rgba(255, 0, 0, 0.25);
			}
			#navbar-loeschen-btn:focus {
				background-color: red;
			}
						
			#navbar-list a:hover{
				background-color: rgba(0,0,0,0.5);
			}
			#navbar-list a:focus{
				background-color: rgba(0,0,0,0.5);
			}
			
			#panel-body-table {
				margin-left: 8px;
				margin-right: 8px;
			}
			#panel-body-table div {
				margin-top: 5px;
				margin-bottom: 5px;
			}
			#panel-body-table div div {
				height: 26px;
			}
			#panel-body-table div div p {
				margin-top: 3.55px;
				font-size: 13.5px;
			}
			#panel-body-table div div input {
				width: 100%;
			}
			
			#headerRow {
				height: 75px;
				margin-right: 0px;
				margin-left: 0px;
			}
		</style>		
	</head>

<body style="font-family: 'Open Sans', sans-serif;">
	
	<!-- NAVBAR -->
	<nav class="navbar navbar-default navbar-hgoe navbar-static-top hidden-sm hidden-md hidden-lg">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" id="navbar-btn" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
			<span class="sr-only">Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
			  <a class="navbar-brand" href="./start.php"><img style="height:40px;" src="assets/img/hgoe_logo_breitbild.png"></a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
		  <ul id="navbar-list" class="nav navbar-nav">
			<li><a href="./teilnehmer.php<?php if(isset($_GET['id'])) { echo "?vid=" . $_GET['id']; } ?>">Teilnehmer</a></li>
			<li><a href="#">Auswertung</a></li>
			<li><a href="#">Ettiketten</a></li>
			<li><a id="navbar-absagen-btn">Veranstaltung absagen</a></li>
			<li><a id="navbar-loeschen-btn">Veranstaltung löschen</a></li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	
	<!-- HEADER -->
	<div class="container hidden-xs" style='margin-top: 20px; margin-bottom: 20px;'>
		<div class="box row" id="headerRow">
			<div class="col-xs-4">
				<a class="navbar-brand" href="./start.php"><img style="height: 54px; margin-top: -5px;" src="assets/img/hgoe_logo_breitbild.png"></a>
			</div>
			<div class="col-xs-8 text-right">
				<a class="btn btn-hgoe" style='margin-top: 20px; margin-right: 15px;' href="./start.php"><img src="assets/img/arrow_back.svg" style='height: 20px; margin-right: 5px;'> Startseite</a>
				<a class="btn btn-hgoe-red" style='margin-top: 20px; margin-right: 5px;' href="./logout.php"><img src="./assets/img/logout_icon.svg" style='height: 20px; margin-right: 5px;'> Ausloggen</a>
			</div>
		</div>
	</div>
	
	<!-- CONTENT -->
	<div class="container">
		<div class="row" style="display: -webkit-flex; flex-wrap: wrap;">
   		
   			<!-- MENU BAR bei größeren Bildschirmen-->
			<div class="hidden-xs col-sm-3 col-lg-2" style="">
				<div class="panel panel-hgoe text-center">
					<div class="panel-heading">
						<h2 id="panel-headline" class="panel-title" style="padding-top: 3px; font-weight: bold; font-size: 18px;">
							Menü
						</h2>
					</div>
					<div class="panel-body" style='font-size: 18px;'>
						<div class="seperator"></div>
						<div class="container-fluid menu-bar-item" id="teilnehmerMenuItem">
							<img src="assets/img/teilnehmer_icon.svg" style='width: 85%;'>
							Teilnehmer
						</div>
						<div class="seperator"></div>
						<div class="container-fluid menu-bar-item" id="statistikMenuItem">
							<img src="assets/img/auswertungen_icon.svg" style='width: 85%;'>
							Statistik
						</div>
						<div class="seperator"></div>
						<div class="container-fluid menu-bar-item" id="etikettenMenuItem">
							<img src="assets/img/print_icon.svg" style='width: 85%;'>
							Etiketten
						</div>
						<div class="seperator"></div>
					</div>
				</div>
			
				<div class="btn btn-hgoe-red" style='width: 100%;' id="absagen-btn">
					<img src="./assets/img/absagen_icon.svg" style='width: 20%; margin-right: 10px;'>
					Absagen
				</div>
				
				<div class="btn btn-hgoe-red" style='width: 100%;' id="loeschen-btn">
					<img src="./assets/img/delete_icon.svg" style='width: 20%; margin-right: 10px;'>
					Löschen
				</div>
				
				<script>
					$("#teilnehmerMenuItem").click( function() {
						window.location = './teilnehmer.php<?php if(isset($_GET["id"])) { echo '?vid=' . $_GET["id"]; } ?>';
					});
					$("#statistikMenuItem").click( function() {

					});
					$("#etiketteMenuItem").click( function() {

					});
					
					$("#absagen-btn").click( function() {
						window.location = './script_veranstaltung_absagen.php<?php if(isset($_GET["id"])) { echo '?id=' . $_GET["id"]; } ?>';
					});
					$("#loeschen-btn").click( function() {
						window.location = './script_veranstaltung_loeschen.php<?php if(isset($_GET["id"])) { echo '?id=' . $_GET["id"]; } ?>';
					});

					$("#navbar-absagen-btn").hide();
					$("#navbar-loeschen-btn").hide();
					$("#absagen-btn").hide();
					$("#loeschen-btn").hide();
				</script>
			</div>

			<!-- MAIN PANEL -->
			<div class="col-sm-9 col-lg-10 col-xs-12">
    			<div id="mainPanel" class="panel panel-hgoe text-center">
					<div class="panel-heading">
						<h3 id="panel-headline" class="panel-title" style="font-weight: bold">
							<?php
								if(isset($_GET["id"])) {
									echo "Detailansicht - Veranstaltung #" . $_GET["id"];
								} else {
									echo "Detailansicht";
								}
							?>
						</h3>
					</div>
					<form>
						<div class="panel-body text-left text-xs-center" id="panel-body-table">
							<div class="row">
								<div class="col-sm-4 col-xs-12 text-right text-xs-center" style='line-height: 40px;'>
									Name
								</div>
								<div class="col-sm-8 col-xs-12" style='height: 35px;'>
									<textarea id="name" style='width: 90%;' rows="2"></textarea>
								</div>
							</div>
							<br>
							<div class="seperator"></div>
							<br>
							<div class="row">
								<div class="col-sm-4 col-xs-12 text-right text-xs-center">
									Datum
								</div>
								<div class="col-xs-1 hidden-sm hidden-md hidden-lg"></div>
								<div class="col-sm-8 col-xs-10">
									<input id="datum" type="date" value="2000-01-01" style='width: 90%;'>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4 col-xs-12 text-right text-xs-center">
									Beginn Anmeldefrist
								</div>
								<div class="col-xs-1 hidden-sm hidden-md hidden-lg"></div>
								<div class="col-sm-8 col-xs-10">
									<input id="beginnAnmeldefrist" type="datetime-local" value="2000-01-01T00:00" style='width: 90%;'>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4 col-xs-12 text-right text-xs-center">
									Ende Anmeldefrist
								</div>
								<div class="col-xs-1 hidden-sm hidden-md hidden-lg"></div>
								<div class="col-sm-8 col-xs-10">
									<input id="endeAnmeldefrist" type="datetime-local" value="2000-01-01T23:59" style='width: 90%;'>
								</div>
							</div>
							<br>
							<div class="seperator"></div>
							<br>
							<div class="row">
								<div class="col-xs-9 col-sm-4 text-right">
									<p>Stornierung möglich</p>
								</div>
								<div class="col-xs-3 text-left">
									<input id="stornierungCB" type="checkbox" style='min-height: 20px; min-width: 20px;'>
									
									<script>
										$("#stornierungCB").click( function() {
											if(document.getElementById("stornierungCB").checked == false) {
												$("#stornierungsfristDiv").hide();
											} else {
												$("#stornierungsfristDiv").show();
											}
										});
										$(document).ready( function() {
											$("#stornierungsfristDiv").hide();
										});
									</script>
								</div>
								
							</div>
							<div class="row" id="stornierungsfristDiv">
								<div class="col-sm-4 col-xs-12 text-right text-xs-center">
									<p>Ende Stornierungsfrist</p>
								</div>
								<div class="col-xs-1 hidden-sm hidden-md hidden-lg"></div>
								<div class="col-sm-6 col-xs-10">
									<input id="endeStornierungsfrist" type="datetime-local" value="2000-01-01T23:59" style='width: 90%;'>
									
									<script>
										$(document).ready( function() {
											var now = new Date();
											var month = (now.getMonth() + 1);               
											var day = now.getDate();
											if(month < 10) 
												month = "0" + month;
											if(day < 10) 
												day = "0" + day;
											var today = now.getFullYear() + '-' + month + '-' + day + "T23:59";
											$('#endeStornierungsfrist').val(today);
										});
									</script>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4 col-xs-12 text-right text-xs-center">
									<p>Max. Anmeldungen</p>
								</div>
								<div class="col-xs-3 hidden-sm hidden-md hidden-lg"></div>
								<div class="col-xs-6">
									<input id="maxAnmeldungen" type="number" placeholder="(Optional)" style='width: 90%;'>
								</div>
							</div>
							<br>
							<div class="seperator"></div>
							<br>
							<div class="row">
								<div class="col-xs-12 col-sm-4 text-right text-xs-center">
									<p>Gebühren Mitglieder</p>
								</div>
								<div class="col-xs-3 hidden-sm hidden-md hidden-lg"></div>
								<div class="col-xs-6 col-sm-5">
									<input id="gebuehrenMitglieder" type="number">
								</div>
								<div class="col-xs-1">
									<b style='margin-left: -20px;'>€</b>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-4 text-right text-xs-center">
									<p>Gebühren Nicht-Mitglieder</p>
								</div>
								<div class="col-xs-3 hidden-sm hidden-md hidden-lg"></div>
								<div class="col-xs-6 col-sm-5">
									<input id="gebuehrenNichtmitglieder" type="number">
								</div>
								<div class="col-xs-1">
									<b style='margin-left: -20px;'>€</b>
								</div>
							</div>
							<br>
							<div class="row text-center" style="margin-top:25px;" id="saveBtnDIV">
								<input class="btn btn-hgoe" style="width: 140px" id="saveBtn" value="Speichern">
								
								<script>
									$(document).ready( function() {
										$("#saveBtn").hide();
									})
									
									$("#saveBtn").click( function() {
										<?php
											if(isset($_GET['id'])) {
												echo "var id = " . $_GET['id'] . ";";
											} else {
												echo "var id = 'null';";
											}
										?>

										if(id != 'null') {
											var name = $('#name').val();
											var datum = $('#datum').val();
											var beginnAnmeldefrist = $('#beginnAnmeldefrist').val();
											var endeAnmeldefrist = $('#endeAnmeldefrist').val();
											var stornierungCB = document.getElementById('stornierungCB').checked;
											var stornierungsfrist = $('#endeStornierungsfrist').val();
											var maxAnmeldungen = $('#maxAnmeldungen').val();
											var gebuehrenMitglieder = $('#gebuehrenMitglieder').val();
											var gebuehrenNichtmitglieder = $('#gebuehrenNichtmitglieder').val();
											
											if((stornierungCB && stornierungsfrist.length > 0) || !stornierungCB) {
												if(name.length > 0 && datum.length > 0 && beginnAnmeldefrist.length > 0 && endeAnmeldefrist.length > 0 && gebuehrenMitglieder.length > 0 && gebuehrenNichtmitglieder.length > 0) {
													var url = 'script_veranstaltung_bearbeiten.php?id=' + id + '&name=' + name + '&datum=' + datum + "&beginnFrist=" + beginnAnmeldefrist + "&endeFrist=" + endeAnmeldefrist + "&gebMitglieder=" + gebuehrenMitglieder + "&gebNichtmitglieder=" + gebuehrenNichtmitglieder;

													if(stornierungCB) {
														url = url + "&stornierungsfrist=" + stornierungsfrist;
													}
													if(maxAnmeldungen.length > 0) {
														url = url + "&maxAnmeldungen=" + maxAnmeldungen;
													}
													
													window.location = url;
												} else {
													alert("Bitte geben Sie alle Pflichtfelder an!");
												}
											} else {
												alert("Bitte geben Sie eine gültige Stornierungsfrist an!");
											}
										} else {
											alert("Leere Veranstaltung kann nicht gespeichert werden!");
										}
									});
								</script>
							</div>
						</div>
					</form>
				</div>
    			&nbsp;
			</div>
    	</div>
	</div>
	
	<script>
		$(document).ready( function() {
			var now = new Date();
			var month = (now.getMonth() + 1);               
			var day = now.getDate();
			if(month < 10) 
				month = "0" + month;
			if(day < 10) 
				day = "0" + day;
			
			var datum = now.getFullYear() + '-' + month + '-' + day;
			var name = 'null';
			
			var beginnAnmeldefrist = now.getFullYear() + '-' + month + '-' + day + 'T00:00';
			var endeAnmeldefrist = now.getFullYear() + '-' + month + '-' + day + 'T23:58';
			var stornierungsfrist = 'null';
			var maxAnmeldungen = 0;
			
			var gebuehr_mitglieder = 0;
			var gebuehr_nichtmitglieder = 0;
			
			<?php
				if(isset($_GET['id'])) {
					$id = $_GET['id'];

					// Create connection
					$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);
					
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} 

					$sql = "SELECT * " . 
						"FROM hgoe_17.hgoe_konferenzen " . 
						"WHERE KonferenzID = " . $id . ";";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						
						//Speichern Button einblenden
						echo "$(\"#saveBtn\").show();";
						//Absagen Knöpfe einblenden
						echo "$(\"#absagen-btn\").show();";
						echo "$(\"#navbar-absagen-btn\").show();";

						$name = "null";
						$datum = "null";
						$beginnAnmeldefrist = "null";
						$endeAnmeldefrist = "null";
						$stornierungsfrist = "null";
						$maxAnmeldungen = "null";
						$gebuehr_mitglieder = -1;
						$gebuehr_nichtmitglieder = -1;

						while($row = $result->fetch_assoc()) {
							$name = $row["Name"];
							$datum = $row["datum"];
							$beginnAnmeldefrist = $row["beginnanmeldefrist"];
							$endeAnmeldefrist = $row["endeanmeldefrist"];
							$gebuehr_mitglieder = $row["gebuehr_mitglied"];
							$gebuehr_nichtmitglieder = $row["gebuehr_nichtmitglied"];
							if(!(is_null($row["stornierungsfrist"]))) {
								$stornierungsfrist = $row["stornierungsfrist"];
							}
							if(!(is_null($row["maxanmeldungen"]))) {
								$maxAnmeldungen = $row["maxanmeldungen"];
							}
							
							echo "name = '" . $name . "';";
							echo "datum = '" . $datum . "';";
							echo "gebuehr_mitglieder = " . $gebuehr_mitglieder . ";";
							echo "gebuehr_nichtmitglieder = " . $gebuehr_nichtmitglieder . ";";
							echo "var temp1 = '" . $beginnAnmeldefrist . "'.split(/[- :]/);";
							echo "beginnAnmeldefrist = temp1[0] + '-' + temp1[1] + '-' + temp1[2] + 'T' + temp1[3] + ':' + temp1[4];";
							echo "var temp2 = '" . $endeAnmeldefrist . "'.split(/[- :]/);";
							echo "endeAnmeldefrist = temp2[0] + '-' + temp2[1] + '-' + temp2[2] + 'T' + temp2[3] + ':' + temp2[4];";
							
							if($stornierungsfrist != "null") {
								echo "var temp3 = '" . $stornierungsfrist . "'.split(/[- :]/);";
								echo "stornierungsfrist = temp3[0] + '-' + temp3[1] + '-' + temp3[2] + 'T' + temp3[3] + ':' + temp3[4];";
								
								echo "document.getElementById('stornierungCB').checked = true;";
								echo "$('#stornierungsfristDiv').show();";
							}
							
							if($maxAnmeldungen != "null") {
								echo "maxAnmeldungen = " . $maxAnmeldungen . ";";
							}
						}

					} else {
						//KEINE AKTIVE KONFERENZEN - SUCHE NACH ABGESAGTEN/ABGELAUFENEN KONFERENZEN
						$sql = "SELECT * " . 
						"FROM hgoe_17.hgoe_konferenzen_history " . 
						"WHERE KonferenzID = " . $id . ";";
						
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							//ABGESAGTE KONFERENZ GEFUNDEN
							
							//Löschen Knöpfe einblenden
							echo "$(\"#loeschen-btn\").show();";
							echo "$(\"#navbar-loeschen-btn\").show();";
							
							$name = "null";
							$datum = "null";
							$beginnAnmeldefrist = "null";
							$endeAnmeldefrist = "null";
							$stornierungsfrist = "null";
							$maxAnmeldungen = "null";
							$gebuehr_mitglieder = "null";
							$gebuehr_nichtmitglieder = "null";
							
							while($row = $result->fetch_assoc()) {
								$name = $row["Name"];
								$datum = $row["datum"];
								$beginnAnmeldefrist = $row["beginnanmeldefrist"];
								$endeAnmeldefrist = $row["endeanmeldefrist"];
								$gebuehr_mitglieder = $row["gebuehr_mitglied"];
								$gebuehr_nichtmitglieder = $row["gebuehr_nichtmitglied"];
								if(!(is_null($row["stornierungsfrist"]))) {
									$stornierungsfrist = $row["stornierungsfrist"];
								}
								if(!(is_null($row["maxanmeldungen"]))) {
									$maxAnmeldungen = $row["maxanmeldungen"];
								}

								echo "name = '" . $name . "';";
								echo "datum = '" . $datum . "';";
								echo "gebuehr_mitglieder = " . $gebuehr_mitglieder . ";";
								echo "gebuehr_nichtmitglieder = " . $gebuehr_nichtmitglieder . ";";
								echo "var temp1 = '" . $beginnAnmeldefrist . "'.split(/[- :]/);";
								echo "beginnAnmeldefrist = temp1[0] + '-' + temp1[1] + '-' + temp1[2] + 'T' + temp1[3] + ':' + temp1[4];";
								echo "var temp2 = '" . $endeAnmeldefrist . "'.split(/[- :]/);";
								echo "endeAnmeldefrist = temp2[0] + '-' + temp2[1] + '-' + temp2[2] + 'T' + temp2[3] + ':' + temp2[4];";

								if($stornierungsfrist != "null") {
									echo "var temp3 = '" . $stornierungsfrist . "'.split(/[- :]/);";
									echo "stornierungsfrist = temp3[0] + '-' + temp3[1] + '-' + temp3[2] + 'T' + temp3[3] + ':' + temp3[4];";

									echo "document.getElementById('stornierungCB').checked = true;";
									echo "$('#stornierungsfristDiv').show();";
								}

								if($maxAnmeldungen != "null") {
									echo "maxAnmeldungen = " . $maxAnmeldungen . ";";
								}
							}
						} else {
							echo "alert('DB-Error: Zugehöriger Eintrag wurde nicht gefunden! ID:" . $id . " ');";
						}
					}
					
					$conn->close();

				} else {
					/* ERROR MESSAGE */
				}
			?>
				
			$('#datum').val(datum);
			if(name != 'null') {
				$('#name').val(name);
			}
			$('#beginnAnmeldefrist').val(beginnAnmeldefrist);
			$('#endeAnmeldefrist').val(endeAnmeldefrist);
			$('#gebuehrenMitglieder').val(gebuehr_mitglieder);
			$('#gebuehrenNichtmitglieder').val(gebuehr_nichtmitglieder);
			if(stornierungsfrist != 'null') {
				$('#endeStornierungsfrist').val(stornierungsfrist);
			}
			if(maxAnmeldungen != 0) {
				$('#maxAnmeldungen').val(maxAnmeldungen);
			}
		});
	</script>
	
</body>
</html>
