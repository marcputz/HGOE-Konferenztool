<!-- prüft ob der User eingeloggt ist -->
<?php
	session_start();
	$config = include('./config.php');

	if(!isset($_SESSION['user'])) {
		header("location: login.php");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HGÖ - Veranstaltung erstellen</title>
    
	<!-- Bootstrap & jQuery -->
	<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/hgoe.php" type="text/css">
	<script src="./assets/jquery.min.js"></script>
	
	<!-- Custom Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">

	<style>
		.row {
			padding-bottom: 15px;
		}
	</style>
		
  </head>
<body>
	<div class="container">
		<div class="panel panel-hgoe text-center" style="margin-top: 15px;">
			<div class="panel-heading">
				<h3 class="panel-title">Veranstaltung Erstellen</h3>
			</div>
			<div class="panel-body">
				<div class = "table-condensed text-left">
					<div class="row">
						<div class="col-xs-4">
							<p>Name</p>
						</div>
						<div class="col-xs-8">
							<input type="text" id="nameTF" style="width:100%">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<p>Datum</p>
						</div>
						<div class="col-xs-8">
							<input type="date" id ="datumTF">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<p>Beginn Anmeldefrist</p>
						</div>
						<div class="col-xs-8">
							<input type="datetime-local" id ="beginnAnmeldefristTF">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<p>Ende Anmeldefrist</p>
						</div>
						<div class="col-xs-8">
							<input type="datetime-local" id ="endeAnmeldefristTF">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<p>Stornierbar</p>
						</div>
						<div class="col-xs-8">
							<label class="radio-inline">
								<input type="radio" name="optradio" id = "ve_opt_ja" onClick="setVisible()">Ja
							</label>
							<label class="radio-inline">
								<input type="radio" name = "optradio" id = "ve_opt_nein" checked onClick="setVisible()">Nein
							</label>
						</div>
					</div>
					<div class="row" style="display: none" id = "ve_stor">
						<div class="col-xs-4">
							<p>Ende Stornierungsfrist</p>
						</div>
						<div class="col-xs-8">
							<input type="date" id ="stornierungsfristTF">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<p>max. Anmeldungen</p>
						</div>
						<div class="col-xs-8">
							<input type = "number" id="maxAnmeldungenTF">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-4">
							<p>Gebühren (Mitglieder)</p>
						</div>
						<div class="col-xs-8">
							<input type = "number" id="gebuehren_mitgliederTF"> <b style="color: white;">€</b>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<p>Gebühren (Nicht-Mitglieder)</p>
						</div>
						<div class="col-xs-8">
							<input type = "number" id="gebuehren_nichtmitgliederTF"> <b style="color: white;">€</b>
						</div>
					</div>
				</div>
				<br><br>
				<button id="ve_btn" class="btn btn-hgoe" onclick="executeCreateScript()" style="width: 180px;">Erstellen</button>
			</div>
		</div>
	</div>

  <script type="text/javascript">	  
	function executeCreateScript() {
		var name = document.getElementById("nameTF").value;
		var datum = document.getElementById("datumTF").value;
		var beginnAnmeldefrist = document.getElementById("beginnAnmeldefristTF").value;
		var endeAnmeldefrist = document.getElementById("endeAnmeldefristTF").value;
		var stornierungsfrist = document.getElementById("stornierungsfristTF").value;
		var maxAnmeldungen = document.getElementById("maxAnmeldungenTF").value;
		var gebuehren_mitglieder = document.getElementById("gebuehren_mitgliederTF").value;
		var gebuehren_nichtmitglieder = document.getElementById("gebuehren_nichtmitgliederTF").value;
		
		if(name.length > 0 && datum.length > 0 && beginnAnmeldefrist.length > 0 && endeAnmeldefrist.length > 0 && gebuehren_mitglieder.length > 0 && gebuehren_nichtmitglieder.length > 0) {
			var url = 'script_veranstaltung_erstellen.php?name=' + name + '&datum=' + datum + "&beginnFrist=" + beginnAnmeldefrist + "&endeFrist=" + endeAnmeldefrist + "&geb-mitglieder=" + gebuehren_mitglieder + "&geb-nichtmitglieder=" + gebuehren_nichtmitglieder;
			
			if(stornierungsfrist.length > 0) {
				url = url + "&stornierungsfrist=" + stornierungsfrist;
			}
			if(maxAnmeldungen.length > 0) {
				url = url + "&maxAnmeldungen=" + maxAnmeldungen;
			}
			
			window.location = url;
		} else {
			alert('Bitte geben Sie alle Pflichtfelder an!');	
		}
	}
	  
	function doButton() {
		//var v = Document.getElementById("ve_footer");
		Document.getElementById("ve_btn").class="btn btn-success";
	}
	  
	function setVisible(){
		if(document.getElementById("ve_opt_ja").checked == true){
			//document.getElementById("ve_stor_frist").style.visibility = "visible";
			//document.getElementById("ve_stor_label").style.visibility = "visible";
			
			//document.getElementById("br1").style.display = "inherit";
			
			document.getElementById("ve_stor").style.display = "inherit";
			
		}
		else{
			//document.getElementById("ve_stor_frist").style.visibility = "hidden";
			//document.getElementById("ve_stor_label").style.visibility = "hidden";
			
			//document.getElementById("br1").style.display = "none";
			
			document.getElementById("ve_stor").style.display = "none";
		}
	}
	  
  </script>
  
  
  
  </body>
</html>