<!doctype html>
<html>
	<head>
		<!-- Meta Data -->
		<meta charset="UTF-8">
		<meta name="author" content="Marc Putz">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="noindex,nofollow">
		<meta name="revised" content="Marc Putz, 11/15/2017">
		
		<!-- Bootstrap & jQuery -->
		<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="./assets/css/hgoe.css" type="text/css">
		<script src="./assets/jquery.min.js"></script>
		
		<!-- Custom Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">
		
		<title>HGÖ - Konferenztool</title>
		
		<style>
			#mainPanel {
				margin-top:10px;
				
			}
			@media (min-width: 768px) {
				/* sm and bigger */
				#mainPanel {
					position: absolute;
					height:96%;
					width:95%;
				}
			}
			
			.menuBarItem {
				background-color: #7EAED5;
				box-shadow: 2px 2px 4px rgba(47,102,146,0.80);
				color: black;
				margin-bottom: 10px;
				margin-top: 10px;
			}
			.menuBarItem:hover {
				background-color: #4F90C5;
			}
			
			#navbar-btn {
				height:50px;
			}
			
			#absagen-btn {
				height:29px;
				padding:3px;
				background-color: tomato;
				font-weight: normal;
				font-size: 15px;
			}
			#absagen-btn:hover {
				background-color: darkred;
				color: white;
			}
			
			#loeschen-btn {
				height:29px;
				padding:3px;
				background-color: tomato;
				font-weight: normal;
				font-size: 15px;
			}
			#loeschen-btn:hover {
				background-color: darkred;
				color: white;
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
		</style>		
	</head>

<body style="font-family: 'Open Sans', sans-serif;">
	
	<!-- NAVBAR -->
	
	<!-- große Bildschirme -->
	
	<nav class="navbar navbar-default navbar-hgoe hidden-xs">
		<div class="container-fluid text-right">
			<a type="button" class="btn btn-hgoe" href="./start.php" style="text-decoration: none; color: white; margin-top: 5px;">Zurück zur <br> Startseite</a>
			
			<div class="navbar-header">
				<a class="navbar-brand" href="./start.php" style="height: 70px; padding-top: 5px; padding-bottom: 5px;"><img src="assets/img/hgoe_logo_breitbild.png" style="height: 100%;"></a>
			</div>
		</div>
	</nav>
	
	<!-- kleine bildschirme -->
	<nav class="navbar navbar-default navbar-hgoe navbar-static-top hidden-sm hidden-md hidden-lg">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" id="navbar-btn" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
			  <a class="navbar-brand" href="./start.php"><img style="height:40px;" src="assets/img/hgoe_logo_breitbild.png"></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul id="navbar-list" class="nav navbar-nav">
			<li><a id="navbar-teilnehmer-btn">Teilnehmer</a></li>
			<li><a href="#">Auswertung</a></li>
			<li><a href="#">Ettiketten</a></li>
			<li><a id="navbar-absagen-btn">Veranstaltung absagen</a></li>
			<li><a id="navbar-loeschen-btn">Veranstaltung löschen</a></li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	
	<!-- CONTENT -->
	
	<div class="container">
		<div class="row" style="display: -webkit-flex; flex-wrap: wrap;">
   		
   			<!-- MENU BAR bei größeren Bildschirmen-->
   		
    		<div class="hidden-xs col-md-3 col-sm-3" style="font-family: 'Armata', cursive;">
    			<center>
					<a class="menuBarItem btn text-center" id="teilnehmer-btn">
						<img src="assets/img/teilnehmer_icon_black.svg" alt="Teilnehmer_Icon" width="90px">
						<p>Teilnehmer</p>
					</a>
					<a class="menuBarItem btn text-center">
						<img src="assets/img/auswertungen_icon_black.svg" alt="Teilnehmer_Icon" width="90px">
						<p>Auswertung</p>
					</a>
					<a class="menuBarItem btn text-center">
						<img src="assets/img/print_icon_black.svg" alt="Teilnehmer_Icon" width="90px">
						<p>Etiketten</p>
					</a>
					<a class="menuBarItem btn text-center" id="absagen-btn">Absagen</a>
					<a class="menuBarItem btn text-center" id="loeschen-btn">Löschen</a>
					
						<script>
							$("#teilnehmer-btn").click( function() {
								var url = "./teilnehmer.php";
								
								<?php
									if(isset($_GET["id"]))
										echo "url += '?vid=" . $_GET["id"] . "';";
								?>
								window.location = url;
							});
							
							$("#navbar-teilnehmer-btn").click( function() {
								var url = "./teilnehmer.php";
								
								<?php
									if(isset($_GET["id"]))
										echo "url += '?vid=" . $_GET["id"] . "';";
								?>
								window.location = url;
							});
							
							$("#absagen-btn").click( function() {
								if(confirm("Wollen Sie diese Veranstaltung wirklich absagen?")) {
									var url = "./script_veranstaltung_absagen.php?id=";

									<?php
										if(isset($_GET["id"])) {
											echo "url += " . $_GET["id"] . ";";
											echo "window.location = url;";
										} else {
											echo "alert('Kann Veranstaltung ohne ID nicht absagen');";
										}
									?>
								}
							});
							
							$("#navbar-absagen-btn").click( function() {
								if(confirm("Wollen Sie diese Veranstaltung wirklich absagen?")) {
									var url = "./script_veranstaltung_absagen.php?id=";

									<?php
										if(isset($_GET["id"])) {
											echo "url += " . $_GET["id"] . ";";
											echo "window.location = url;";
										} else {
											echo "alert('Kann Veranstaltung ohne ID nicht absagen');";
										}
									?>
								}
							});
							
							$("#loeschen-btn").click( function() {
								if(confirm("Wollen Sie diese Veranstaltung wirklich löschen?")) {
									var url = "./script_veranstaltung_loeschen.php?id=";

									<?php
										if(isset($_GET["id"])) {
											echo "url += " . $_GET["id"] . ";";
											echo "window.location = url;";
										} else {
											echo "alert('Kann Veranstaltung ohne ID nicht löschen');";
										}
									?>
								}
							});
							
							$("#navbar-loeschen-btn").click( function() {
								if(confirm("Wollen Sie diese Veranstaltung wirklich löschen?")) {
									var url = "./script_veranstaltung_loeschen.php?id=";

									<?php
										if(isset($_GET["id"])) {
											echo "url += " . $_GET["id"] . ";";
											echo "window.location = url;";
										} else {
											echo "alert('Kann Veranstaltung ohne ID nicht löschen');";
										}
									?>
								}
							});
							
							$(document).ready( function() {
								$("#navbar-loeschen-btn").hide();
								$("#loeschen-btn").hide();
							});
						</script>
				</center>
    		</div>
    		
    		<!-- MAIN PANEL -->
    		
    		<div class="col-md-9 col-sm-9 col-xs-12">
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
						<div class="panel-body text-left" id="panel-body-table">
							<div class="row">
								<div class="col-sm-4 col-xs-5 text-right">
									<p>Name</p>
								</div>
								<div class="col-sm-8 col-xs-7">
									<input id="name" type="text" placeholder="Veranstaltung benennen...">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4 col-xs-5 text-right">
									<p>Datum</p>
								</div>
								<div class="col-sm-8 col-xs-7">
									<input id="datum" type="date" value="2000-01-01">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4 col-xs-5 text-right">
									<p>Beginn Anmeldefrist</p>
								</div>
								<div class="col-sm-8 col-xs-7">
									<input id="beginnAnmeldefrist" type="datetime-local" value="2000-01-01T00:00">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4 col-xs-5 text-right">
									<p>Ende Anmeldefrist</p>
								</div>
								<div class="col-sm-8 col-xs-7">
									<input id="endeAnmeldefrist" type="datetime-local" value="2000-01-01T23:59">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4 col-xs-5 text-right">
									<p>Stornierung möglich</p>
								</div>
								<div class="col-xs-1">
									<input id="stornierungCB" type="checkbox" style="min-height:20px; min-width:20px;">
									
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
								<div class="col-sm-4 col-xs-5 text-right">
									<p>Ende Stornierungsfrist</p>
								</div>
								<div class="col-sm-8 col-xs-7">
									<input id="endeStornierungsfrist" type="datetime-local" value="2000-01-01T23:59">
									
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
								<div class="col-sm-4 col-xs-5 text-right">
									<p>Max. Anmeldungen</p>
								</div>
								<div class="col-sm-8 col-xs-7">
									<input id="maxAnmeldungen" type="number" placeholder="(Optional)">
								</div>
							</div>
							
							<br><br>
							<div class="row">
								<div class="col-sm-4 col-xs-5 text-right">
									<p>Gebühren (Mitglieder)</p>
								</div>
								<div class="col-sm-8 col-xs-7">
									<input id="gebuehren_mitglieder" type="number" placeholder="Eingeben...">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4 col-xs-5 text-right">
									<p>Gebühren (Nicht Mitglieder)</p>
								</div>
								<div class="col-sm-8 col-xs-7">
									<input id="gebuehren_nichtmitglieder" type="number" placeholder="Eingeben...">
								</div>
							</div>
							
							<div class="row text-center" style="margin-top:25px;" id="saveBtnDIV">
								<input class="btn btn-hgoe" style="width: 140px" id="saveBtn" value="Speichern">
								
								<script>
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
											var gebuehrenMitglieder = document.getElementById('gebuehren_mitglieder').value;
											var gebuehrenNichtmitglieder = document.getElementById('gebuehren_nichtmitglieder').value;
											
											if((stornierungCB && stornierungsfrist.length > 0) || !stornierungCB) {
												if(name.length > 0 && datum.length > 0 && beginnAnmeldefrist.length > 0 && endeAnmeldefrist.length > 0 && gebuehrenMitglieder.length > 0 && gebuehrenNichtmitglieder.length > 0) {
													var url = 'script_veranstaltung_bearbeiten.php?id=' + id + '&name=' + name + '&datum=' + datum + "&beginnFrist=" + beginnAnmeldefrist + "&endeFrist=" + endeAnmeldefrist + "&geb-mitglieder=" + gebuehrenMitglieder + "&geb-nichtmitglieder=" + gebuehrenNichtmitglieder;

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

					$servername = "websql06.sprit.org";
					$username = "hgoe";
					$password = "hgvfz54RFG";
					$dbname = "hgoe_17";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					
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
							
							//Speichern Knopf ausblenden
							echo "$(\"#saveBtnDIV\").hide();";
							//Absagen Knöpfe ausblenden
							echo "$(\"#absagen-btn\").hide();";
							echo "$(\"#navbar-absagen-btn\").hide();";
							//Löschen Knöpfe einblenden
							echo "$(\"#loeschen-btn\").show();";
							echo "$(\"#navbar-loeschen-btn\").show();";
							
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
			$('#gebuehren_mitglieder').val(gebuehr_mitglieder);
			$('#gebuehren_nichtmitglieder').val(gebuehr_nichtmitglieder);
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
