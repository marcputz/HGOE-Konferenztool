<!DOCTYPE html>
<html lang="en">
  <head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114935320-1"></script>
		<script>
  	    	window.dataLayer = window.dataLayer || [];
  			function gtag(){dataLayer.push(arguments);}
  		    gtag('js', new Date());

  			gtag('config', 'UA-114935320-1');
		</script>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anmeldung Veranstaltung</title>
    <!-- Bootstrap -->
	<link href="admin/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="admin/assets/css/hgoe.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
	<!-- Custom Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">
  </head>
  <body>
  <div class="container-fluid" style="font-family: Open Sans, Arial, sans-serif;">
  <div class="container">
  <div class="panel panel-hgoe" style="margin-top: 15px;">
	<div class="panel-heading text-center">
	    <h3 class="panel-title" style="color: white; font-size: 25px; font-family: Armata, Arial, sans-serif;">Anmeldung</h3>
    </div>
	<div class="panel-body text-right">
		<div class="row">
			<div class="col-xs-5 col-md-3">Veranstaltung</div>
			<div class="col-xs-7">
           		<select id="veranstaltungCB" style="width: 100%">
           			<?php
						$testserver = false;
					
						$servername = "websql06.sprit.org";
						$username = "hgoe";
						$password = "hgvfz54RFG";
						$dbname = "hgoe_17";
					
						if($testserver==true){
							$servername="db.marcputz.at";
						}
						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);

						// Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						} 

						$sql = "SELECT * FROM hgoe_17.hgoe_konferenzen";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							$id = "null";
							$name = "null";

							while($row = $result->fetch_assoc()) {
								$id = $row["KonferenzID"];
								$name = $row["Name"];
								
								echo "<option value='" . $id . "'>" . $name . "</option>";
							}
						} else {
							echo "<option value='0'>Keine aktuellen Veranstaltungen</option>";
						}
					
						mysqli_close($conn);
					?>
        		</select>
	  		</div>
		</div>
		<div class="row text-center" style="margin: 8px;">
			<p>Felder mit <b>"*"</b> sind Pflichtfelder und müssen ausgefüllt werden!</p>
		</div>
		<div class="row">
			<div class="col-xs-5 col-md-3">Titel</div>
			<div class="col-xs-7"><input type="text" id="titel" style="width: 100%"></div>
		</div> 
		<br>
		<div class="row">
			<div class="col-xs-5 col-md-3">Vorname*</div>
			<div class="col-xs-7"><input type="text" id="vname" style="width: 100%"></div>
		</div> 
		<br>
		<div class="row">
			<div class="col-xs-5 col-md-3">Nachname*</div>
			<div class="col-xs-7"><input type="text" id="nname" style="width: 100%"></div>
		</div>
		<br> 
		<br>
		<div class="row">
			<div class="col-xs-5 col-md-3">Geburtsdatum</div>
			<div class="col-xs-7"><input type="date" id="gebdat" style="width: 100%"></div>
		</div> 
		<br>
		<div class="row">
			<div class="col-xs-5 col-md-3">E-Mail*</div>
			<div class="col-xs-7"><input type="email" id="email" style="width: 100%"></div>
		</div> 
		<br>
		<br>
		<div class="row">
			<div class="col-xs-5 col-md-3">Straße</div>
			<div class="col-xs-7"><input type="text" id="strasse" style="width: 100%"></div>
		</div>
		<br>
		<div class="row">
			<div class="col-xs-5 col-md-3">Hausnummer</div>
			<div class="col-xs-7"><input type="number" id="hausnr" style="width: 100%"></div>
		</div> 
		<br>
		<div class="row">
			<div class="col-xs-5 col-md-3">PLZ*</div>
			<div class="col-xs-7"><input type="number" id="plz" style="width: 100%"></div>
		</div> 
		<br>
		<div class="row">
			<div class="col-xs-5 col-md-3">Ort*</div>
			<div class="col-xs-7"><input type="text" id="ort" style="width: 100%"></div>
		</div> 
		<br>
		<br>
		<div class="row">
			<div class="col-xs-4 col-md-3">Mitglied</div>
			<div class="col-xs-8 text-center">
				<label class="radio">
					<input type="radio" name="mitglied" id="opt_mit" value="0">Ich bin HGÖ-Burgenland Mitglied
				</label>
				<label class="radio">
					<input type="radio" name="mitglied" id="opt_and" value="1">Ich bin Mitglied in einem anderen Bundesland
				</label>
				<label class="radio">
					<input type="radio" name="mitglied" id="opt_kein" value="2" checked>Ich bin kein Mitglied
				</label>
				
				<script>
					document.getElementById('opt_mit').onclick = function () {
						$("#divBundesland").fadeOut();
					};
					document.getElementById('opt_and').onclick = function () {
						$("#divBundesland").fadeIn();
					};
					document.getElementById('opt_kein').onclick = function () {
						$("#divBundesland").fadeOut();
					};
					
					$(document).ready( function() {
						$("#divBundesland").hide();
					});
				</script>
			</div>
		</div>
		<br> 
		<div class="row" id="divBundesland">
			<div class="col-xs-5 col-md-3">Bundesland</div>
			<div class="col-xs-7">
				<select id="bundesland" style="width: 100%;">
            		<option value="1">Steiermark</option>
            		<option value="2">Niederösterreich</option>
					<option value="3">Oberösterreich</option>
            		<option value="4">Salzburg</option>
					<option value="5">Kärnten</option>
            		<option value="6">Tirol</option>
					<option value="7">Vorarlberg</option>
					<option value="8">Wien</option>
        		</select>
			</div>
		</div>
	  	
	  	<br>

  		<div class="container text-center">
	  		<button id="anmeldenBtn" class="btn btn-hgoe" type="submit" style="padding-left: 40px; padding-right: 40px;">Anmelden</button>
		</div>
	  </div>
	  </div>
  </div>    
  </div>
  <script>
  	$("#anmeldenBtn").click( function() {
		var url = "./script_teilnehmer_anmelden.php";
		
	  	var veranstaltung = document.getElementById('veranstaltungCB').options[document.getElementById('veranstaltungCB').selectedIndex].value;
		  
	  	if(veranstaltung != 0) {
			url += "?KonferenzID=" + veranstaltung;
			
			var titel = document.getElementById("titel").value.trim();
			var vname = document.getElementById("vname").value.trim();
			var nname = document.getElementById("nname").value.trim();
			var gebdat = document.getElementById("gebdat").value;
			var email = document.getElementById("email").value;
			var strasse = document.getElementById("strasse").value.trim();
			var hausnr = document.getElementById("hausnr").value;
			var plz = document.getElementById("plz").value;
			var ort = document.getElementById("ort").value.trim();
			
			var bundesland = document.getElementById("bundesland").options[document.getElementById('bundesland').selectedIndex].text;
			
			var mitglied = document.querySelector('input[name="mitglied"]:checked').value;
			
			if(!vname || !nname || !email || !plz || !ort) {
				alert('Bitte geben Sie alle Pflichtfelder an!');
			} else {
				if(mitglied == 0) {
					bundesland = "Burgenland";
				}
				if(mitglied == 2) {
					bundesland = "null";
				}
				
				if(titel) {
					url += "&titel=" + titel;
				}
				url += "&vname=" + vname;
				url += "&nname=" + nname;
				if(gebdat) {
					url += "&gebdat=" + gebdat;
				}
				url += "&email=" + email;
				if(strasse) {
					url += "&strasse=" + strasse;
				}
				if(hausnr) {
					url += "&hausnr=" + hausnr;
				}
				url += "&plz=" + plz;
				url += "&ort=" + ort;
				if(bundesland != "null") {
					url += "&bundesland=" + bundesland;
				}
				
				window.location = url;
			}
	  	} else {
			alert('Im Moment finden keine Veranstaltungen statt. Anmeldung nicht möglich.');
	  	}
	});
  </script>
  </body>
</html>