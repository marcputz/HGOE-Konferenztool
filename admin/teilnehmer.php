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
	<link rel="stylesheet" href="./assets/css/hgoe.css" type="text/css">
	<script src="./assets/jquery.min.js"></script>
	<script src="./assets/bootstrap.min.js"></script>

	<!-- Custom Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">
		
	<title>Teilnehmerliste - Veranstaltung<?php 
			if(isset($_GET["vid"])) {
				echo " #" . $_GET["vid"];
			}
		?>
	</title>
	
	<style>
		#mainPanel {
			margin-top:10px;	
		}
		@media (min-width: 768px) {
			/* sm and bigger */
			#mainPanel {
				position: absolute;
				min-height: 96%;
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

		#navbar-list a:hover{
			background-color: rgba(0,0,0,0.5);
		}
		#navbar-list a:focus{
			background-color: rgba(0,0,0,0.5);
		}
		
		.row-hgoe-detail {
			background-color: #EEEEEE;
			border-bottom-style: dashed;
			border-width: 1px;
			border-color: black;
			margin-left: 2px;
			margin-right: 2px;
		}

		.row-hgoe-detail [class^='col'] {
			padding-top: 10px;
			padding-bottom: 10px;
			word-wrap: break-word;
		}
		
		@media (max-width: 768px) { /* xs */
			.bordered-xs {
				 border-top-color: black; 
				 border-top-style: dotted; 
				 border-top-width: 1px;
			}
		}

	</style>
</head>

<body style="font-family: Open Sans, Arial, sans-serif;">
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
			<li><a href="./detail.php<?php 
					if(isset($_GET["vid"])) { echo '?id=' . $_GET["vid"]; } 
			?>">Veranstaltung</a></li>
			<li><a href="#">Auswertung</a></li>
			<li><a href="#">Ettiketten</a></li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	
	<!-- CONTENT -->
	
	<div class="container">
		<div class="row" style="display: -webkit-flex; flex-wrap: wrap;">
   		
   			<!-- MENU BAR bei größeren Bildschirmen-->
   		
    		<div class="hidden-xs col-md-3 col-sm-3" style="font-family: 'Armata', cursive; padding-bottom: 5px;">
    			<center>
					<a class="menuBarItem btn text-center" href="./detail.php<?php 
						if(isset($_GET["vid"])) { echo '?id=' . $_GET["vid"]; } 
					?>">
						<img src="assets/img/veranstaltung_icon.svg" alt="Teilnehmer_Icon" width="90px">
						<p style="margin-left: -2px;">Veranstaltung</p>
					</a>
					<a class="menuBarItem btn text-center">
						<img src="assets/img/auswertungen_icon_black.svg" alt="Teilnehmer_Icon" width="90px">
						<p>Auswertung</p>
					</a>
					<a class="menuBarItem btn text-center">
						<img src="assets/img/print_icon_black.svg" alt="Teilnehmer_Icon" width="90px">
						<p>Etiketten</p>
					</a>

				</center>
    		</div>
    		
    		<!-- MAIN PANEL -->
    		
    		<div class="col-md-9 col-sm-9 col-xs-12">
    			<div id="mainPanel" class="panel panel-hgoe text-center">
					<div class="panel-heading">
						<h3 id="panel-headline" class="panel-title" style="font-weight: bold;">
							Teilnehmer - Veranstaltung<?php
								if(isset($_GET["vid"])) {
									echo " #" . $_GET["vid"];
								}
							?>
						</h3>
					</div>
					<div class="panel-body text-left" style="font-size: 13px; margin-left: 15px; margin-right: 15px; font-family: Arial, sans-serif;">

						<!-- EXAMPLE (Max Mustermann, ID 0)
						<div class='row'>
							<div class='row row-hgoe equal'>
								<div class='col-xs-2 col-sm-1 dropdown-btn'><a data-toggle='collapse' data-target='#detail_0'>
									<img id='arrow_up_0' src='assets/img/arrow_drop_up.svg' style='width: 30px; margin: -10px; margin-left: -5px;'>
									<img id='arrow_down_0' src='assets/img/arrow_drop_down.svg' style='width: 30px; margin: -10px; margin-left: -5px;'>
										<script>
										$(document).ready( function() {
											$('#arrow_down_0').hide();
										});
										$('#arrow_up_0').click( function() {
											$('#arrow_down_0').show();
											$('#arrow_up_0').hide();
										});
										$('#arrow_down_0').click( function() {
											$('#arrow_down_0').hide();
											$('#arrow_up_0').show();
										});
										</script>
									</a></div>
									<div class='hidden-xs hidden-sm col-md-1' style='border-right-style: solid; border-left-style: solid; border-color: grey; border-width: 1px; padding-top: 10px; padding-bottom: 10px; word-wrap: break-word;'><b>0</b></div>
									<div class='col-xs-10 col-sm-7 col-md-7'>Dr. Max Mustermann</div>
									<div class='col-xs-12 col-sm-4 col-md-3 text-right bordered-xs'>
										Bezahlt <input id='bezahltCB_0' style='margin-left: 3px; margin-right: 1px;' type='checkbox' checked>
										Anwesend <input id='anwesendCB_0' style='margin-left: 3px; margin-right: 1px;' type='checkbox'>
									</div>
								</div>
								<div class='row-hgoe-detail row collapse text-right' style='font-size: 13px;' id='detail_0'>
									<div class='col-xs-4 col-md-2'>Titel</div>
									<div class='col-xs-8 col-md-4'><input id='titel_0' type='text' style='width: 100%;' value='Dr.'></div>
									<div class='col-xs-4 col-md-2'>Vorname*</div>
									<div class='col-xs-8 col-md-4'><input id='vname_0' type='text' style='width: 100%;' value='Max'></div>
									<div class='col-xs-4 col-md-2'>Nachname*</div>
									<div class='col-xs-8 col-md-4'><input id='nname_0' type='text' style='width: 100%;' value='Mustermann'></div>
									<div class='col-xs-4 col-md-2'>Geburtsdat.</div>
									<div class='col-xs-8 col-md-4'><input id='gebdat_0' type='date' style='width: 100%;' value='2000-01-01'></div>
									<div class='col-xs-4 col-md-2'>E-Mail*</div>
									<div class='col-xs-8 col-md-4'><input id='email_0' type='email' style='width: 100%;' value='max.mustermann@test.at'></div>
									<div class='col-xs-4 col-md-2'>Straße</div>
									<div class='col-xs-8 col-md-4'><input id='strasse_0' type='text' style='width: 100%;' value='Testgasse'></div>
									<div class='col-xs-4 col-md-2'>Hausnr.</div>
									<div class='col-xs-8 col-md-2'><input id='hausnr_0' type='number' style='width: 100%;' value='10' ></div>
									<div class='col-xs-4 col-md-2'>PLZ*</div>
									<div class='col-xs-8 col-md-2'><input id='plz_0' type='number' style='width: 100%;' value='8200'></div>
									<div class='col-xs-4 col-md-1'>Ort*</div>
									<div class='col-xs-8 col-md-3'><input id='ort_0' type='text' style='width: 100%;' value='Graz'></div>
									<div class='col-xs-4 col-md-2'>Ist Mitglied*</div>
									<div class='col-xs-2 col-md-2' style='height: 38px;'>
										<input id='mitglied_0' type='checkbox' style='width: 100%; min-height:20px; min-width:20px; margin-top: -2px;' value='true'>
									</div>
									<div class='col-xs-12 col-md-8' style='margin: 0px; padding: 0px;'>
										<div class='col-xs-4 col-md-3'>Bundesland</div>
										<div class='col-xs-8 col-md-9'>
											<select style='width: 100%;' id='bundesland_0'>
												<option value='1'>Burgenland</option>
												<option value='2'>Steiermark</option>
												<option value='3'>Niederösterreich</option>
												<option value='4'>Oberösterreich</option>
												<option value='5'>Salzburg</option>
												<option value='6'>Kärnten</option>
												<option value='7'>Tirol</option>
												<option value='8'>Vorarlberg</option>
												<option value='9'>Wien</option>
											</select>
										</div>
									</div>
											<div class='col-xs-6 text-right'>
												<a id='savebtn_" . $nr . "' style='width: 125px;' class='btn btn-hgoe'>Speichern</a>
											</div>
											<div class='col-xs-6 text-left'>
												<a id='abmeldenbtn_" . $nr . "' style='width: 125px;' class='btn btn-hgoe-red'>Abmelden</a>
											</div>
								</div>
							</div> -->
					
						<!-- Teilnehmer -->
						<?php
							if(isset($_GET["vid"])) {
								$vid = $_GET["vid"];
								
								$testserver = true; //set this for testsever;
								$servername = "websql06.sprit.org";
								$username = "hgoe";
								$password = "hgvfz54RFG";
								$dbname = "hgoe_17";
								if($testserver==false){
									$servername = "db.marcputz.at";
								}
								// Create connection
								$conn = new mysqli($servername, $username, $password, $dbname);

								// Check connection
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								} 

								$sql = "SELECT * FROM hgoe_17.hgoe_teilnehmer WHERE KonferenzID = " . $vid;
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										$nr = "null";
										$titel = "null";
										$vname = "null";
										$nname = "null";
										$gebdat = "null";
										$email = "null";
										$strasse = "null";
										$hausnr = -1;
										$ort = "null";
										$plz = "null";
										$mitglied = "null";

										$nr = $row["TeilnehmerNr"];
										$vname = $row["Vorname"];
										$nname = $row["Nachname"];
										$ort = $row["Ort"];
										$plz = $row["PLZ"];
										$email = $row["eMail"];
										if(!(is_null($row["Mitglied"]))) {
											$mitglied = $row["Mitglied"];
										}
										if(!(is_null($row["Titel"]))) {
											$titel = $row["Titel"];
										}
										if(!(is_null($row["Geburtsdatum"]))) {
											$gebdat = $row["Geburtsdatum"];
										}
										if(!(is_null($row["Strasse"]))) {
											$strasse = $row["Strasse"];
										}
										if(!(is_null($row["Hausnr"]))) {
											$hausnr = $row["Hausnr"];
										}

										echo "<div class='row'>";
										echo "<div class='row row-hgoe equal'>";
										echo "	<div class='col-xs-2 col-sm-1 dropdown-btn'><a data-toggle='collapse' data-target='#detail_" . $nr . "'>";
										echo "		<img id='arrow_up_" . $nr . "' src='assets/img/arrow_drop_up.svg' style='width: 30px; margin: -10px; margin-left: -5px;'>";
										echo "		<img id='arrow_down_" . $nr . "' src='assets/img/arrow_drop_down.svg' style='width: 30px; margin: -10px; margin-left: -5px;'>";
										echo "			<script>";
										echo "			$(document).ready( function() {\n";
										echo "				$('#arrow_down_" . $nr . "').hide();\n";
										echo "			});\n";
										echo "			$('#arrow_up_" . $nr . "').click( function() {\n";
										echo "				$('#arrow_down_" . $nr . "').show();\n";
										echo "				$('#arrow_up_" . $nr . "').hide();\n";
										echo "			});\n";
										echo "			$('#arrow_down_" . $nr . "').click( function() {\n";
										echo "				$('#arrow_down_" . $nr . "').hide();\n";
										echo "				$('#arrow_up_" . $nr . "').show();\n";
										echo "			});\n";
										echo "			</script>";
										echo "		</a></div>";
										echo "		<div class='hidden-xs hidden-sm col-md-1' style='border-right-style: solid; border-left-style: solid; border-color: grey; border-width: 1px; padding-top: 10px; padding-bottom: 10px; word-wrap: break-word;'><b>" . $nr . "</b></div>";
										echo "		<div class='col-xs-10 col-sm-7 col-md-7'>" . (($titel != "null") ? ($titel . " ") : "") . $vname . " " . $nname . "</div>";
										echo "		<div class='col-xs-12 col-sm-4 col-md-3 text-right bordered-xs'>";
										echo "			Bezahlt <input id='bezahltCB_" . $nr . "' style='margin-left: 3px; margin-right: 1px;' type='checkbox' " . (($row["Bezahlt"] == 1) ? "checked" : "") . ">";
										echo "			Anwesend <input id='anwesendCB_" . $nr . "' style='margin-left: 3px; margin-right: 1px;' type='checkbox' " . (($row["Anwesend"] == 1) ? "checked" : "") . ">";
										echo "		</div>";
										echo "	</div>";
										echo "	<div class='row-hgoe-detail row collapse text-right' style='font-size: 13px;' id='detail_" . $nr . "'>";
										echo "		<div class='col-xs-4 col-md-2'>Titel</div>";
										echo "		<div class='col-xs-8 col-md-4'><input id='titel_" . $nr . "' type='text' style='width: 100%;' " . (($titel != 'null') ? ("value='" . $titel . "'") : "") . "></div>";
										echo "		<div class='col-xs-4 col-md-2'>Vorname*</div>";
										echo "		<div class='col-xs-8 col-md-4'><input id='vname_" . $nr . "' type='text' style='width: 100%;' value='" . $vname . "'></div>";
										echo "		<div class='col-xs-4 col-md-2'>Nachname*</div>";
										echo "		<div class='col-xs-8 col-md-4'><input id='nname_" . $nr . "' type='text' style='width: 100%;' value='" . $nname . "'></div>";
										echo "		<div class='col-xs-4 col-md-2'>Geburtsdat.</div>";
										echo "		<div class='col-xs-8 col-md-4'><input id='gebdat_" . $nr . "' type='date' style='width: 100%;' " . (($gebdat != 'null') ? ("value='" . $gebdat . "'") : "") . "></div>";
										echo "		<div class='col-xs-4 col-md-2'>E-Mail*</div>";
										echo "		<div class='col-xs-8 col-md-4'><input id='email_" . $nr . "' type='email' style='width: 100%;' value='" . $email . "'></div>";
										echo "		<div class='col-xs-4 col-md-2'>Straße</div>";
										echo "		<div class='col-xs-8 col-md-4'><input id='strasse_" . $nr . "' type='text' style='width: 100%;' " . (($strasse != 'null') ? ("value='" . $strasse . "'") : "") . "></div>";
										echo "		<div class='col-xs-4 col-md-2'>Hausnr.</div>";
										echo "		<div class='col-xs-8 col-md-2'><input id='hausnr_" . $nr . "' type='number' style='width: 100%;' " . (($hausnr != -1) ? ("value='" . $hausnr . "'") : "") . "></div>";
										echo "		<div class='col-xs-4 col-md-2'>PLZ*</div>";
										echo "		<div class='col-xs-8 col-md-2'><input id='plz_" . $nr . "' type='number' style='width: 100%;' value='" . $plz . "'></div>";
										echo "		<div class='col-xs-4 col-md-1'>Ort*</div>";
										echo "		<div class='col-xs-8 col-md-3'><input id='ort_" . $nr . "' type='text' style='width: 100%;' value='" . $ort . "'></div>";
										echo "		<div class='col-xs-4 col-md-2'>Ist Mitglied*</div>";
										echo "		<div class='col-xs-2 col-md-2' style='height: 38px;'>";
										echo "			<input id='mitglied_" . $nr . "' type='checkbox' style='width: 100%; min-height:20px; min-width:20px; margin-top: -2px;' value='true'>";
										echo "		</div>";
										echo "		<div class='col-xs-12 col-md-8' style='margin: 0px; padding: 0px;'>";
										echo "			<div class='col-xs-4 col-md-3'>Bundesland</div>";
										echo "			<div class='col-xs-8 col-md-9'>";
										echo "				<select style='width: 100%;' id='bundesland_" . $nr . "'>";
										echo "					<option value='1'>Burgenland</option>";
										echo "					<option value='2'>Steiermark</option>";
										echo "					<option value='3'>Niederösterreich</option>";
										echo "					<option value='4'>Oberösterreich</option>";
										echo "					<option value='5'>Salzburg</option>";
										echo "					<option value='6'>Kärnten</option>";
										echo "					<option value='7'>Tirol</option>";
										echo "					<option value='8'>Vorarlberg</option>";
										echo "					<option value='9'>Wien</option>";
										echo "				</select>";
										echo "			</div>";
										echo "		</div>";
										echo "		<script>";
										echo "		$('#bezahltCB_" . $nr . "').click( function() {\n";
										echo "			if(document.getElementById('bezahltCB_" . $nr . "').checked == true) {\n";
										echo "				$.ajax({\n";
										echo "					url: './script_teilnehmer_bezahlt.php?nr=" . $nr . "&bezahlt=ja',\n";
										echo "					type: 'GET',\n";
										echo "					success: function(results) { \n";
										echo "						if(results != 'OK')\n";
										echo "							alert(results);\n";
										echo "					}\n";
										echo "				});\n";
										echo "			} else {\n";
										echo "				$.ajax({\n";
										echo "					url: './script_teilnehmer_bezahlt.php?nr=" . $nr . "&bezahlt=nein',\n";
										echo "					type: 'GET',\n";
										echo "					success: function(results) { \n";
										echo "						if(results != 'OK')\n";
										echo "							alert(results);\n";
										echo "					}\n";
										echo "				});\n";
										echo "			}\n";
										echo "		});\n";
										echo "		$('#anwesendCB_" . $nr . "').click( function() {\n";
										echo "			if(document.getElementById('anwesendCB_" . $nr . "').checked == true) {\n";
										echo "				$.ajax({\n";
										echo "					url: './script_teilnehmer_anwesend.php?nr=" . $nr . "&anwesend=ja',\n";
										echo "					type: 'GET',\n";
										echo "					success: function(results) { \n";
										echo "						if(results != 'OK')\n";
										echo "							alert(results);\n";
										echo "					}\n";
										echo "				});\n";
										echo "			} else {\n";
										echo "				$.ajax({\n";
										echo "					url: './script_teilnehmer_anwesend.php?nr=" . $nr . "&anwesend=nein',\n";
										echo "					type: 'GET',\n";
										echo "					success: function(results) { \n";
										echo "						if(results != 'OK')\n";
										echo "							alert(results);\n";
										echo "					}\n";
										echo "				});\n";
										echo "			}\n";
										echo "		});\n";
										echo "			$('#mitglied_" . $nr . "').click( function() {\n";
										echo "				if(document.getElementById('mitglied_" . $nr . "').checked == true) {\n";
										echo "					document.getElementById('bundesland_" . $nr . "').disabled = false;\n";
										echo "					document.getElementById('bundesland_" . $nr . "').style.backgroundColor = '#FBFBFB';\n";
										echo "					document.getElementById('bundesland_" . $nr . "').style.color = '#000000'\n";
										echo "				} else {\n";
										echo "					document.getElementById('bundesland_" . $nr . "').disabled = true;";
										echo "					document.getElementById('bundesland_" . $nr . "').style.backgroundColor = '#CCCCCC';";
										echo "					document.getElementById('bundesland_" . $nr . "').style.color = '#AAAAAA';";
										echo "				}";
										echo "			});";
										
										if($mitglied == 'null') {
											echo "		$(document).ready( function() {";
											echo "			document.getElementById('bundesland_" . $nr . "').disabled = true;";
											echo "			document.getElementById('bundesland_" . $nr . "').style.backgroundColor = '#CCCCCC';";
											echo "			document.getElementById('bundesland_" . $nr . "').style.color = '#AAAAAA';";	
											echo "		});";
										} else {
											echo "		$(document).ready( function() {";
											echo "			document.getElementById('mitglied_" . $nr . "').checked = true;";
											switch($mitglied) {
												case 'Burgenland': echo "$('#bundesland_" . $nr . "').val(1);"; break;
												case 'Steiermark': echo "$('#bundesland_" . $nr . "').val(2);"; break;
												case 'Niederösterreich': echo "$('#bundesland_" . $nr . "').val(3);"; break;
												case 'Oberösterreich': echo "$('#bundesland_" . $nr . "').val(4);"; break;
												case 'Salzburg': echo "$('#bundesland_" . $nr . "').val(5);"; break;
												case 'Kärnten': echo "$('#bundesland_" . $nr . "').val(6);"; break;
												case 'Tirol': echo "$('#bundesland_" . $nr . "').val(7);"; break;
												case 'Vorarlberg': echo "$('#bundesland_" . $nr . "').val(8);"; break;
												case 'Wien': echo "$('#bundesland_" . $nr . "').val(9);"; break;
											}
											echo "		});";
										}
										
										echo "		</script>";
										echo "		<div class='col-xs-6 text-right'>";
										echo "			<a id='savebtn_" . $nr . "' style='width: 125px;' class='btn btn-hgoe'>Speichern</a>";
										echo "		</div>";
										echo "		<div class='col-xs-6 text-left'>";
										echo "			<a id='abmeldenbtn_" . $nr . "' style='width: 125px;' class='btn btn-hgoe-red'>Abmelden</a>";
										echo "		</div>";
										echo "		<script>\n";
										echo "		$('#abmeldenbtn_" . $nr . "').click( function() {\n";
										echo "			if(confirm('Wollen Sie diesen Teilnehmer wirklich abmelden?')) {\n";
										echo "				window.location = './script_teilnehmer_absagen.php?nr=" . $nr . "&vid=" . $vid . "';\n";
										echo "			}\n";
										echo "		});\n";
										echo "		$('#savebtn_" . $nr . "').click( function() {\n";
										echo "			var titel = 'null';\n";
										echo "			var vname = 'null';\n";
										echo "			var nname = 'null';\n";
										echo "			var gebdat = 'null';\n";
										echo "			var email = 'null';\n";
										echo "			var strasse = 'null';\n";
										echo "			var hausnr = -1;\n";
										echo "			var plz = -1;\n";
										echo "			var ort = 'null';\n";
										echo "			var bundesland = 'null';\n";
										echo "			if($('#titel_" . $nr . "').val())\n";
										echo "				titel = $('#titel_" . $nr . "').val();\n";
										echo "			if($('#vname_" . $nr . "').val())\n";
										echo "				vname = $('#vname_" . $nr . "').val();\n";
										echo "			if($('#nname_" . $nr . "').val())\n";
										echo "				nname = $('#nname_" . $nr . "').val();\n";
										echo "			if($('#gebdat_" . $nr . "').val())\n";
										echo "				gebdat = $('#gebdat_" . $nr . "').val();\n";
										echo "			if($('#email_" . $nr . "').val())\n";
										echo "				email = $('#email_" . $nr . "').val();\n";
										echo "			if($('#strasse_" . $nr . "').val())\n";
										echo "				strasse = $('#strasse_" . $nr . "').val();\n";
										echo "			if($('#hausnr_" . $nr . "').val())\n";
										echo "				hausnr = $('#hausnr_" . $nr . "').val();\n";
										echo "			if($('#plz_" . $nr . "').val())\n";
										echo "				plz = $('#plz_" . $nr . "').val();\n";
										echo "			if($('#ort_" . $nr . "').val())\n";
										echo "				ort = $('#ort_" . $nr . "').val();\n";
										echo "			if(document.getElementById('mitglied_" . $nr . "').checked == true) {\n";
										echo "				bundesland = document.getElementById('bundesland_" . $nr . "').options[document.getElementById('bundesland_". $nr . "').selectedIndex].text;\n";
										echo "			}\n";
										echo "			if(vname != 'null' && nname != 'null' && email != 'null' && plz != -1 && ort != 'null') {\n";
										echo "				var url = 'script_teilnehmer_bearbeiten.php?nr=" . $nr . "';\n";
										echo "				url += '&vname=' + vname;\n";
										echo "				url += '&nname=' + nname;\n";
										echo "				url += '&email=' + email;\n";
										echo "				url += '&plz=' + plz;\n";
										echo "				url += '&ort=' + ort;\n";
										echo "				if(titel != 'null')\n";
										echo "					url += '&titel=' + titel;\n";
										echo "				if(gebdat != 'null')\n";
										echo "					url += '&gebdat=' + gebdat;\n";
										echo "				if(strasse != 'null')\n";
										echo "					url += '&strasse=' + strasse;\n";
										echo "				if(hausnr != -1)\n";
										echo "					url += '&hausnr=' + hausnr;\n";
										echo "				if(bundesland != 'null')\n";
										echo "					url += '&bundesland=' + bundesland;\n";
										echo "				window.location = url;\n";
										echo "			} else {\n";
										echo "				alert('Bitte geben Sie alle Pflichtparameter ein!');\n";
										echo "			}\n";
										echo "		});";
										echo "		</script>";
										echo "	</div>";
										echo "</div>";
									}
								} else {
									echo "<div class='row'>";
									echo "	<div class='row-hgoe row'>";
									echo "		<div class='col-xs-12'>Es sind noch keine Teilnehmer angemeldet</div>";
									echo "	</div>";
									echo "</div>";
								}
							} else {
								echo "<div class='row'>";
								echo "	<div class='row-hgoe row'>";
								echo "		<div class='col-xs-12'>Es sind noch keine Teilnehmer angemeldet</div>";
								echo "	</div>";
								echo "</div>";
							}
						?>
					</div>
				</div>
    			&nbsp;
			</div>
    	</div>
	</div>
</body>
</html>
