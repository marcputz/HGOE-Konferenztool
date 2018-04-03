<?php
	session_start();
	$config = include('./config.php');

	/*if(!isset($_SESSION['user'])) {
		header("location: login.php");
		exit();
	}*/

	if(isset($_GET['vid'])) {
		if(isset($_GET['alle'])) {
			//get all
			echo getTeilnehmer('', false, false);
			exit;
		}
		if(isset($_GET['filterName'])) {
			//search by name
			echo getTeilnehmer($_GET['filterName'], false, false);
			exit;
		}
		if(isset($_GET['filterAnwesend'])) {
			//search all anwesend
			echo getTeilnehmer('', false, true);
			exit;
		}
		if(isset($_GET['filterBezahlt'])) {
			//search all bezahlt
			echo getTeilnehmer('', true, false);
			exit;
		}
	}

	function getTeilnehmer($filterName, $filterBezahlt, $filterAnwesend) {
		$config = include('./config.php');
		
		$ret = "";
		$vid = $_GET["vid"];

		// Create connection
		$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT * FROM hgoe_17.hgoe_teilnehmer WHERE KonferenzID = " . $vid;
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$lfdnr = 0;
			while($row = $result->fetch_assoc()) {
				$nr = "null";
				$titel = "null";
				$vname = "null";
				$nname = "null";
				$gebdat = "null";
				$org = "null";
				$email = "null";
				$strasse = "null";
				$hausnr = "null";
				$ort = "null";
				$plz = "null";
				$mitglied = "null";
				
				$lfdnr = $lfdnr + 1;

				$nr = $row["TeilnehmerNr"];
				$vname = $row["Vorname"];
				$nname = $row["Nachname"];
				$ort = $row["Ort"];
				$plz = $row["PLZ"];
				$email = $row["eMail"];
				if(!(is_null($row["Organisation"]))) {
					$org = $row["Organisation"];
				}
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
				
				$fullName = $vname . " " . $nname;
				if(($filterName == '' || strpos(strtoupper("x".$fullName), strtoupper($filterName)) !== false) && ($filterAnwesend == false || $row['Anwesend'] == 1) && ($filterBezahlt == false || $row['Bezahlt'] == 1)) { 	
					$ret .= "<div class='row'>";
					$ret .= "<div class='row row-hgoe equal' style='background-color: white;'>";
					$ret .= "	<div class='col-xs-2 col-sm-1 dropdown-btn' style='border-left-width: 0px;'><a data-toggle='collapse' data-target='#detail_" . $nr . "'>";
					$ret .= "		<img id='arrow_up_" . $nr . "' src='assets/img/arrow_drop_up.svg' style='width: 30px; margin: -10px; margin-left: -5px;'>";
					$ret .= "		<img id='arrow_down_" . $nr . "' src='assets/img/arrow_drop_down.svg' style='width: 30px; margin: -10px; margin-left: -5px;'>";
					$ret .= "			<script>";
					$ret .= "			$(document).ready( function() {\n";
					$ret .= "				$('#arrow_down_" . $nr . "').hide();\n";
					$ret .= "			});\n";
					$ret .= "			$('#arrow_up_" . $nr . "').click( function() {\n";
					$ret .= "				$('#arrow_down_" . $nr . "').show();\n;";
					$ret .= "				$('#arrow_up_" . $nr . "').hide();\n";
					$ret .= "			});\n";
					$ret .= "			$('#arrow_down_" . $nr . "').click( function() {\n";
					$ret .= "				$('#arrow_up_" . $nr . "').show();\n";
					$ret .= "				$('#arrow_down_" . $nr . "').hide();\n";
					$ret .= "			});\n";
					$ret .= "			</script>";
					$ret .= "		</a></div>";
					$ret .= "		<div class='hidden-xs hidden-sm col-md-1' style='border-right-style: solid; border-left-style: solid; border-color: grey; border-width: 1px; padding-top: 10px; padding-bottom: 10px; word-wrap: break-word;'><b>" . $lfdnr . "</b></div>";
					$ret .= "		<div class='col-xs-10 col-sm-7 col-md-7'>" . (($titel != "null") ? ($titel . " ") : "") . $vname . " " . $nname . "</div>";
					$ret .= "		<div class='col-xs-12 col-sm-4 col-md-3 text-right bordered-xs' style='font-size: 12.5px; border-right-width: 0px;'>";
					$ret .= "			Bezahlt <input id='bezahltCB_" . $nr . "' style='margin-left: 3px; margin-right: 1px;' type='checkbox' " . (($row["Bezahlt"] == 1) ? "checked" : "") . ">";
					$ret .= "			Anwesend <input id='anwesendCB_" . $nr . "' style='margin-left: 3px; margin-right: 1px;' type='checkbox' " . (($row["Anwesend"] == 1) ? "checked" : "") . ">";
					$ret .= "		</div>";
					$ret .= "	</div>";
					
					$ret .= "	<div class='row-hgoe-detail row collapse text-right' style='font-size: 13px; padding-right: 15px;' id='detail_" . $nr . "'>";
					$ret .= "		<br>";
					$ret .= "		<div class='col-xs-4 col-md-2'>Titel</div>";
					$ret .= "		<div class='col-xs-8 col-md-4 text-left'><input id='titel_" . $nr . "' type='text' style='width: 100%;' placeholder='(Optional)' " . (($titel != 'null') ? ("value='" . $titel . "'") : "") . "></div>";
					$ret .= "		<div class='col-xs-4 col-md-2'><b>Vorname</b></div>";
					$ret .= "		<div class='col-xs-8 col-md-4 text-left'><input id='vname_" . $nr . "' type='text' style='width: 100%;' value='" . $vname . "'></div>";
					$ret .= "		<div class='col-xs-4 col-md-2'><b>Name</b></div>";
					$ret .= "		<div class='col-xs-8 col-md-4 text-left'><input id='nname_" . $nr . "' type='text' style='width: 100%;' value='" . $nname . "'></div>";
					$ret .= "		<div class='col-xs-4 col-md-2 hidden-sm hidden-md hidden-lg'>Geb-Dat.</div>";
					$ret .= "		<div class='col-xs-4 col-md-2 hidden-xs'>Geburtsdat.</div>";
					$ret .= "		<div class='col-xs-8 col-md-4 text-left'><input id='gebdat_" . $nr . "' type='date' style='width: 100%;' placeholder='(Optional)' " . (($gebdat != 'null') ? ("value='" . $gebdat . "'") : "") . "></div>";
					$ret .= "		<div class='col-xs-4 col-md-2'><b>E-Mail</b></div>";
					$ret .= "		<div class='col-xs-8 col-md-4 text-left'><input id='email_" . $nr . "' type='email' style='width: 100%;' value='" . $email . "'></div>";
					$ret .= "		<div class='col-xs-4 col-md-2'>Straße</div>";
					$ret .= "		<div class='col-xs-8 col-md-4 text-left'><input placeholder='(Optional)' id='strasse_" . $nr . "' type='text' style='width: 100%;' " . (($strasse != 'null') ? ("value='" . $strasse . "'") : "") . "></div>";
					
					$ret .= "		<div class='col-xs-4 col-md-2'>Hausnr.</div>";
					$ret .= "		<div class='col-xs-8 col-md-2 text-left'><input placeholder='(Optional)' id='hausnr_" . $nr . "' type='number' style='width: 100%;' " . (($hausnr != 'null') ? ("value='" . $hausnr . "'") : "") . "></div>";
					$ret .= "		<div class='col-xs-4 col-md-2'><b>PLZ</b></div>";
					$ret .= "		<div class='col-xs-8 col-md-2 text-left'><input id='plz_" . $nr . "' type='number' style='width: 100%;' value='" . $plz . "'></div>";
					$ret .= "		<div class='col-xs-4 col-md-1'><b>Ort</b></div>";
					$ret .= "		<div class='col-xs-8 col-md-3 text-left'><input id='ort_" . $nr . "' type='text' style='width: 100%;' value='" . $ort . "'></div>";
					
					$ret .= "		<div class='col-xs-4 col-md-2'>Firma/Organisation</div>";
					$ret .= "		<div class='col-xs-8 col-md-10 text-left'><input id='org_" . $nr . "' type='text' style='width: 100%;' " . (($org != 'null') ? ("value='" . $org . "'") : "") . "'></div>";
					
					$ret .= "		<div class='col-xs-4 col-md-2'><b>Ist Mitglied</b></div>";
					$ret .= "		<div class='col-xs-2 col-md-2 text-left' style='height: 38px;'>";
					$ret .= "			<input id='mitglied_" . $nr . "' type='checkbox' style='width: 100%; min-height:20px; min-width:20px; margin-top: -2px;' value='true'>";
					$ret .= "		</div>";
					$ret .= "		<div class='col-xs-12 col-md-8' style='margin: 0px; padding: 0px;'>";
					$ret .= "			<div class='col-xs-4 col-md-3'>Bundesland</div>";
					$ret .= "			<div class='col-xs-8 col-md-9 text-left'>";
					$ret .= "				<select style='width: 100%;' id='bundesland_" . $nr . "'>";
					$ret .= "					<option value='1'>Burgenland</option>";
					$ret .= "					<option value='2'>Steiermark</option>";
					$ret .= "					<option value='3'>Niederösterreich</option>";
					$ret .= "					<option value='4'>Oberösterreich</option>";
					$ret .= "					<option value='5'>Salzburg</option>";
					$ret .= "					<option value='6'>Kärnten</option>";
					$ret .= "					<option value='7'>Tirol</option>";
					$ret .= "					<option value='8'>Vorarlberg</option>";
					$ret .= "					<option value='9'>Wien</option>";
					$ret .= "				</select>";
					$ret .= "			</div>";
					$ret .= "		</div>";
					$ret .= "		<script>";
					$ret .= "		$('#bezahltCB_" . $nr . "').click( function() {\n";
					$ret .= "			if(document.getElementById('bezahltCB_" . $nr . "').checked == true) {\n";
					$ret .= "				$.ajax({\n";
					$ret .= "					url: './script_teilnehmer_bezahlt.php?nr=" . $nr . "&bezahlt=ja',\n";
					$ret .= "					type: 'GET',\n";
					$ret .= "					success: function(results) { \n";
					$ret .= "						if(results != 'OK')\n";
					$ret .= "							alert(results);\n";
					$ret .= "					}\n";
					$ret .= "				});\n";
					$ret .= "			} else {\n";
					$ret .= "				$.ajax({\n";
					$ret .= "					url: './script_teilnehmer_bezahlt.php?nr=" . $nr . "&bezahlt=nein',\n";
					$ret .= "					type: 'GET',\n";
					$ret .= "					success: function(results) { \n";
					$ret .= "						if(results != 'OK')\n";
					$ret .= "							alert(results);\n";
					$ret .= "					}\n";
					$ret .= "				});\n";
					$ret .= "			}\n";
					$ret .= "		});\n";
					$ret .= "		$('#anwesendCB_" . $nr . "').click( function() {\n";
					$ret .= "			if(document.getElementById('anwesendCB_" . $nr . "').checked == true) {\n";
					$ret .= "				$.ajax({\n";
					$ret .= "					url: './script_teilnehmer_anwesend.php?nr=" . $nr . "&anwesend=ja',\n";
					$ret .= "					type: 'GET',\n";
					$ret .= "					success: function(results) { \n";
					$ret .= "						if(results != 'OK')\n";
					$ret .= "							alert(results);\n";
					$ret .= "					}\n";
					$ret .= "				});\n";
					$ret .= "			} else {\n";
					$ret .= "				$.ajax({\n";
					$ret .= "					url: './script_teilnehmer_anwesend.php?nr=" . $nr . "&anwesend=nein',\n";
					$ret .= "					type: 'GET',\n";
					$ret .= "					success: function(results) { \n";
					$ret .= "						if(results != 'OK')\n";
					$ret .= "							alert(results);\n";
					$ret .= "					}\n";
					$ret .= "				});\n";
					$ret .= "			}\n";
					$ret .= "		});\n";
					$ret .= "			$('#mitglied_" . $nr . "').click( function() {\n";
					$ret .= "				if(document.getElementById('mitglied_" . $nr . "').checked == true) {\n";
					$ret .= "					document.getElementById('bundesland_" . $nr . "').disabled = false;\n";
					$ret .= "					document.getElementById('bundesland_" . $nr . "').style.backgroundColor = '#FBFBFB';\n";
					$ret .= "					document.getElementById('bundesland_" . $nr . "').style.color = '#000000'\n";
					$ret .= "				} else {\n";
					$ret .= "					document.getElementById('bundesland_" . $nr . "').disabled = true;";
					$ret .= "					document.getElementById('bundesland_" . $nr . "').style.backgroundColor = '#CCCCCC';";
					$ret .= "					document.getElementById('bundesland_" . $nr . "').style.color = '#AAAAAA';";
					$ret .= "				}";
					$ret .= "			});";

					if($mitglied == 'null') {
						$ret .= "		$(document).ready( function() {";
						$ret .= "			document.getElementById('bundesland_" . $nr . "').disabled = true;";
						$ret .= "			document.getElementById('bundesland_" . $nr . "').style.backgroundColor = '#CCCCCC';";
						$ret .= "			document.getElementById('bundesland_" . $nr . "').style.color = '#AAAAAA';";	
						$ret .= "		});";
					} else {
						$ret .= "		$(document).ready( function() {";
						$ret .= "			document.getElementById('mitglied_" . $nr . "').checked = true;";
						switch($mitglied) {
							case 'Burgenland': $ret .= "$('#bundesland_" . $nr . "').val(1);"; break;
							case 'Steiermark': $ret .= "$('#bundesland_" . $nr . "').val(2);"; break;
							case 'Niederösterreich': $ret .= "$('#bundesland_" . $nr . "').val(3);"; break;
							case 'Oberösterreich': $ret .= "$('#bundesland_" . $nr . "').val(4);"; break;
							case 'Salzburg': $ret .= "$('#bundesland_" . $nr . "').val(5);"; break;
							case 'Kärnten': $ret .= "$('#bundesland_" . $nr . "').val(6);"; break;
							case 'Tirol': $ret .= "$('#bundesland_" . $nr . "').val(7);"; break;
							case 'Vorarlberg': $ret .= "$('#bundesland_" . $nr . "').val(8);"; break;
							case 'Wien': $ret .= "$('#bundesland_" . $nr . "').val(9);"; break;
						}
						$ret .= "		});";
					}

					$ret .= "		</script>";
					$ret .= "		<div class='col-xs-6 text-right'>";
					$ret .= "			<a id='savebtn_" . $nr . "' style='width: 125px;' class='btn btn-hgoe'>Speichern</a>";
					$ret .= "		</div>";
					$ret .= "		<div class='col-xs-6 text-left'>";
					$ret .= "			<a id='abmeldenbtn_" . $nr . "' style='width: 125px;' class='btn btn-hgoe-red'>Abmelden</a>";
					$ret .= "		</div>";
					$ret .= "		<br>";
					
					$ret .= "		<script>\n";
					$ret .= "		$('#abmeldenbtn_" . $nr . "').click( function() {\n";
					$ret .= "			if(confirm('Wollen Sie diesen Teilnehmer wirklich abmelden?')) {\n";
					$ret .= "				window.location = './script_teilnehmer_absagen.php?nr=" . $nr . "&vid=" . $vid . "';\n";
					$ret .= "			}\n";
					$ret .= "		});\n";
					$ret .= "		$('#savebtn_" . $nr . "').click( function() {\n";
					$ret .= "			var titel = 'null';\n";
					$ret .= "			var vname = 'null';\n";
					$ret .= "			var nname = 'null';\n";
					$ret .= "			var gebdat = 'null';\n";
					$ret .= "			var email = 'null';\n";
					$ret .= "			var strasse = 'null';\n";
					$ret .= "			var org = 'null';\n";
					$ret .= "			var hausnr = -1;\n";
					$ret .= "			var plz = -1;\n";
					$ret .= "			var ort = 'null';\n";
					$ret .= "			var bundesland = 'null';\n";
					$ret .= "			if($('#titel_" . $nr . "').val())\n";
					$ret .= "				titel = $('#titel_" . $nr . "').val();\n";
					$ret .= "			if($('#vname_" . $nr . "').val())\n";
					$ret .= "				vname = $('#vname_" . $nr . "').val();\n";
					$ret .= "			if($('#nname_" . $nr . "').val())\n";
					$ret .= "				nname = $('#nname_" . $nr . "').val();\n";
					$ret .= "			if($('#gebdat_" . $nr . "').val())\n";
					$ret .= "				gebdat = $('#gebdat_" . $nr . "').val();\n";
					$ret .= "			if($('#org_" . $nr . "').val())\n";
					$ret .= "				org = $('#org_" . $nr . "').val();\n";
					$ret .= "			if($('#email_" . $nr . "').val())\n";
					$ret .= "				email = $('#email_" . $nr . "').val();\n";
					$ret .= "			if($('#strasse_" . $nr . "').val())\n";
					$ret .= "				strasse = $('#strasse_" . $nr . "').val();\n";
					$ret .= "			if($('#hausnr_" . $nr . "').val())\n";
					$ret .= "				hausnr = $('#hausnr_" . $nr . "').val();\n";
					$ret .= "			if($('#plz_" . $nr . "').val())\n";
					$ret .= "				plz = $('#plz_" . $nr . "').val();\n";
					$ret .= "			if($('#ort_" . $nr . "').val())\n";
					$ret .= "				ort = $('#ort_" . $nr . "').val();\n";
					$ret .= "			if(document.getElementById('mitglied_" . $nr . "').checked == true) {\n";
					$ret .= "				bundesland = document.getElementById('bundesland_" . $nr . "').options[document.getElementById('bundesland_". $nr . "').selectedIndex].text;\n";
					$ret .= "			}\n";
					$ret .= "			if(vname != 'null' && nname != 'null' && email != 'null' && plz != -1 && ort != 'null') {\n";
					$ret .= "				var url = 'script_teilnehmer_bearbeiten.php?nr=" . $nr . "';\n";
					$ret .= "				url += '&vname=' + vname;\n";
					$ret .= "				url += '&nname=' + nname;\n";
					$ret .= "				url += '&email=' + email;\n";
					$ret .= "				url += '&plz=' + plz;\n";
					$ret .= "				url += '&ort=' + ort;\n";
					$ret .= "				if(titel != 'null')\n";
					$ret .= "					url += '&titel=' + titel;\n";
					$ret .= "				if(org != 'null')\n";
					$ret .= "					url += '&org=' + org;\n";
					$ret .= "				if(gebdat != 'null')\n";
					$ret .= "					url += '&gebdat=' + gebdat;\n";
					$ret .= "				if(strasse != 'null')\n";
					$ret .= "					url += '&strasse=' + strasse;\n";
					$ret .= "				if(hausnr != -1)\n";
					$ret .= "					url += '&hausnr=' + hausnr;\n";
					$ret .= "				if(bundesland != 'null')\n";
					$ret .= "					url += '&bundesland=' + bundesland;\n";
					$ret .= "				window.location = url;\n";
					$ret .= "			} else {\n";
					$ret .= "				alert('Bitte geben Sie alle Pflichtparameter ein!');\n";
					$ret .= "			}\n";
					$ret .= "		});";
					$ret .= "		</script>";
					$ret .= "	</div>";
					$ret .= "</div>";
				}
			}
			
			if($ret == "") {
				//no teilnehmer found
				$ret .= "<div class='row'>";
				$ret .= "	<div class='row-hgoe row' style='background-color: white;'>";
				$ret .= "		<div class='col-xs-12'>Es wurden keine Teilnehmer gefunden</div>";
				$ret .= "	</div>";
				$ret .= "</div>";
			}
		} else {
			$ret .= "<div class='row'>";
			$ret .= "	<div class='row-hgoe row' style='background-color: white;'>";
			$ret .= "		<div class='col-xs-12'>Es wurden keine Teilnehmer gefunden</div>";
			$ret .= "	</div>";
			$ret .= "</div>";
		}
		
		return $ret;
	}
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
		<script src="./assets/bootstrap.min.js"></script>

		<!-- Custom Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">

		<title>Teilnehmerliste - Veranstaltung
			<?php 
				if(isset($_GET["vid"])) {
					echo " #" . $_GET["vid"];
				}
			?>
		</title>

		<style>
			#mainPanel {
				background-color: #F4F4F4;
			}
			@media (min-width: 768px) {
				/* sm and bigger */
				#mainPanel {
					min-height: 96%;
					width: 100%;
				}
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

			#headerRow {
				height: 75px;
				margin-right: 0px;
				margin-left: 0px;
			}

			.row-hgoe-detail {
				background-color: #EEEEEE;
				border-bottom-style: dashed;
				border-width: 1px;
				border-color: black;
				margin-left: 2px;
				margin-right: 2px;

				box-shadow: inset 0px 4px 10px -4px rgba(0,0,0, 0.8);
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
		
		<script>
			$(document).ready( function() {
				resizeMenuItemHeight();
			});
			window.onresize = function(event) {
				resizeMenuItemHeight();
			};
			
			function resizeMenuItemHeight() {
				var item = $('.menu-bar-item').width();
				$('.menu-bar-item').css({'height': (item * 1.2) + 'px'});
			}
		</script>
	</head>

	<body style="font-family: Open Sans, Arial, sans-serif; min-height: 100%;">
		<!-- NAVBAR -->
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
			<div class="row" style="display: -webkit-flex; flex-wrap: wrap; margin-bottom: 50px;">

				<!-- MENU BAR bei größeren Bildschirmen -->
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
								<img src="assets/img/veranstaltung_icon.svg" style='width: 85%;'>
								<span style='margin-left: -6px;'>Veranstaltung</span>
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
							
							<script>
								$("#teilnehmerMenuItem").click( function() {
									window.location = './detail.php<?php if(isset($_GET["vid"])) { echo '?id=' . $_GET["vid"]; } ?>';
								});
								$("#statistikMenuItem").click( function() {
									
								});
								$("#etiketteMenuItem").click( function() {
									
								});
							</script>
						</div>
					</div>
				</div>

				<!-- MAIN PANEL -->
				<div class="col-sm-9 col-lg-10 col-xs-12">
					<div id="mainPanel" class="panel panel-hgoe text-center">
						<!-- kleine Bildschirme -->
						<div class="panel-heading hidden-md hidden-sm hidden-lg">
							<h2 id="panel-headline" class="panel-title" style="font-weight: bold; font-size: 18px;">
								Teilnehmer
							</h2>
						</div>
						<!-- Große Bildschirme -->
						<div class="panel-heading hidden-xs">
							<div class="row">
								<div class="col-sm-6 text-left">
									<h2 id="panel-headline" class="panel-title" style="padding-top: 3px; font-weight: bold; font-size: 18px;">
										Teilnehmer
									</h2>
								</div>
								<!-- suchleiste -->
								<div class="col-sm-6 text-right">
									<input type="search" id="searchTF" placeholder=" Suchen...">
									<script>
										//Enter-Taste zum Suchen
										$(document).ready(function(){
											$('#searchTF').keypress(function(e) {
												if(e.keyCode==13)
													startSearch();
											});
										});	
									</script>
									<button class="btn btn-hgoe-grey" onClick="startSearch()" style="margin-left: 10px; height: 25px; width: 25px; margin-top: -4px; box-shadow: 0px 0px 0px rgba(0,0,0,0);">
										<img style='height: 20px; margin-top: -10px; margin-left: -10px;' src="./assets/img/search_icon.svg">
									</button>
									<script>
										function startSearch() {
											var search = $('#searchTF').val();
											if(search.length > 0) {
												//teilnehmer filtern
												$("#panelBody").html("<div class='row'><div class='row-hgoe row' style='background-color: white;'><div class='col-xs-12'>Lade Teilnehmer...</div></div></div>");
												$.ajax({
													url: "./teilnehmer.php?vid=<?php echo $_GET['vid']; ?>&filterName=" + search, 
													success: function(result) {
														$("#panelBody").html(result);
													}
												});
											} else {
												//alle Teilnehmer anzeigen
												$("#panelBody").html("<div class='row'><div class='row-hgoe row' style='background-color: white;'><div class='col-xs-12'>Lade Teilnehmer...</div></div></div>");
												$.ajax({
													url: "./teilnehmer.php?vid=<?php echo $_GET['vid']; ?>&alle=1", 
													success: function(result) {
														$("#panelBody").html(result);
													}
												});
											}
										}
										
										function startSearchXS() {
											var search = $('#searchTF_XS').val();
											if(search.length > 0) {
												//teilnehmer filtern
												$("#panelBody").html("<div class='row'><div class='row-hgoe row' style='background-color: white;'><div class='col-xs-12'>Lade Teilnehmer...</div></div></div>");
												$.ajax({
													url: "./teilnehmer.php?vid=<?php echo $_GET['vid']; ?>&filterName=" + search, 
													success: function(result) {
														$("#panelBody").html(result);
													}
												});
											} else {
												//alle Teilnehmer anzeigen
												$("#panelBody").html("<div class='row'><div class='row-hgoe row' style='background-color: white;'><div class='col-xs-12'>Lade Teilnehmer...</div></div></div>");
												$.ajax({
													url: "./teilnehmer.php?vid=<?php echo $_GET['vid']; ?>&alle=1", 
													success: function(result) {
														$("#panelBody").html(result);
													}
												});
											}
										}
									</script>
								</div>
							</div>
							<div class="row text-left" style='border-top: 1pt solid rgba(0,0,0,0.2); margin-top: 10px; padding-top: 10px;'>
								<div class="col-xs-8">
									<b>Filtern: </b>
									<a onClick="filterAlle()" style='margin-left: 10px;'>Alle</a>
									<a onClick="filterBezahlt()" style='margin-left: 10px;'>Bezahlt</a>
									<a onClick="filterAnwesend()" style='margin-left: 10px;'>Anwesend</a>
									
									<script>
										function filterAlle() {
											$("#panelBody").html("<div class='row'><div class='row-hgoe row' style='background-color: white;'><div class='col-xs-12'>Lade Teilnehmer...</div></div></div>");
											$.ajax({
												url: "./teilnehmer.php?vid=<?php echo $_GET['vid']; ?>&alle=1", 
												success: function(result) {
													$("#panelBody").html(result);
												}
											});
										}
										
										function filterBezahlt() {
											$("#panelBody").html("<div class='row'><div class='row-hgoe row' style='background-color: white;'><div class='col-xs-12'>Lade Teilnehmer...</div></div></div>");
											$.ajax({
												url: "./teilnehmer.php?vid=<?php echo $_GET['vid']; ?>&filterBezahlt=1", 
												success: function(result) {
													$("#panelBody").html(result);
												}
											});
										}
										
										function filterAnwesend() {
											$("#panelBody").html("<div class='row'><div class='row-hgoe row' style='background-color: white;'><div class='col-xs-12'>Lade Teilnehmer...</div></div></div>");
											$.ajax({
												url: "./teilnehmer.php?vid=<?php echo $_GET['vid']; ?>&filterAnwesend=1", 
												success: function(result) {
													$("#panelBody").html(result);
												}
											});
										}
									</script>
								</div>
								<div class="col-sm-4 text-right">
									<a class="btn btn-hgoe" href="../anmelden.php" style='height: 22px; font-size: 11px; line-height: 8px; margin: -2px;'><img style='height: 16px; margin: -10px; margin-right: 3px;' src="./assets/img/add_icon.svg">Hinzufügen</a>
								</div>
							</div>
						</div>
						<div class="panel-body text-left" id="panelBody" style="font-size: 13px; margin-top: -15px; margin-bottom: -16px; margin-left: -3px; margin-right: -3px; font-family: Arial, sans-serif;">
							<!-- Teilnehmerliste -->
							<script>
								$(document).ready( function() {
									$("#panelBody").html("<div class='row'><div class='row-hgoe row' style='background-color: white;'><div class='col-xs-12'>Lade Teilnehmer...</div></div></div>");
									$.ajax({
										url: "./teilnehmer.php?vid=<?php echo $_GET['vid']; ?>&alle=1", 
										success: function(result) {
											$("#panelBody").html(result);
										}
									});
								});
							</script>
						</div>
					</div>
					&nbsp;
				</div>
			</div>
		</div>
		
		<!-- FOOTER -->
		<div class="box navbar-fixed-bottom hidden-sm hidden-md hidden-lg" style='box-shadow: 0px -2px 10px rgba(0,0,0,0.6);'>
			<div class="container-fluid text-center row" style='margin-top: 10px; margin-bottom: 10px;'>
				<div class="col-xs-2" id="filterIcon">
					<img src="./assets/img/filter_icon.svg" style="height: 30px;">
				</div>
				<div class="col-xs-10 text-right">
					<input type="search" id="searchTF_XS" placeholder=" Suchen..." style='height: 30px;'>
					<script>
						//Enter-Taste zum Suchen
						$(document).ready(function(){
							$('#searchTF_XS').keypress(function(e) {
								if(e.keyCode==13)
							  		startSearchXS();
							});
						});					
					</script>
					<button class="btn btn-hgoe-grey" onClick="startSearchXS()" style="margin-left: 10px; height: 30px; width: 30px; margin-top: -2px; box-shadow: 0px 0px 0px rgba(0,0,0,0);">
						<img style='height: 22px; margin-top: -7px; margin-left: -9px;' src="./assets/img/search_icon.svg">
					</button>
				</div>
			</div>
			
			<script>
				$("#filterIcon").click( function() {
					$("#footerFilterDiv").toggleClass('hide');
				})
			</script>
			
			<div class="container-fluid row hide" id="footerFilterDiv" style='font-size: 16px; margin-top: 10px; margin-bottom: 10px; border-top: 1pt solid #A6A6A6; padding-top: 10px; padding-bottom: 3px;'>
				<div class="col-xs-3">
					<b>Filtern</b>
				</div>
				<div class="col-xs-9 text-right">
					<a onClick="filterAlle()" style='margin-left: 10px;'>Alle</a>
					<a onClick="filterBezahlt()" style='margin-left: 10px;'>Bezahlt</a>
					<a onClick="filterAnwesend()" style='margin-left: 10px;'>Anwesend</a>
				</div>			
			</div>
		</div>
	</body>
</html>
