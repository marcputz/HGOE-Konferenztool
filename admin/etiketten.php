<!DOCTYPE html>
 <html>
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Etiketten</title>
    
	<!-- Bootstrap & jQuery -->
	<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="./assets/css/hgoe.css" type="text/css">
	<script src="./assets/jquery.min.js"></script>
		
	<!-- Custom Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">
  </head>
	<body style="font-family: 'Open Sans',serif;">
		<div class="container">
			<div class="row" style="display: -webkit-flex; flex-wrap: wrap;">
				<div class="hidden-xs col-md-3 col-sm-3" style="font-family: 'Armata', cursive;">
    				<center>
						<a class="menuBarItem btn text-center" href="teilnehmer.html">
							<img src="assets/img/teilnehmer_icon_black.svg" alt="Teilnehmer_Icon" width="90px">
							<p>Teilnehmer</p>
						</a>
						<a class="menuBarItem btn text-center" href="detail.php">
							<img src="assets/img/auswertungen_icon_black.svg" alt="Teilnehmer_Icon" width="90px">
							<p>Auswertung</p>
						</a>
					</center>
    			</div>
    		
  			<div class="col-md-9 col-sm-9 col-xs-12">
  				<div id="mainPanel" class="panel panel-hgoe text-center">
					<div class="panel-heading">
	   		 			<h3 class="panel-title" style="font-weight: bold">Etiketten</h3>
					</div>
			<br>
			<div class="row">
				<div class="col-sm-4 col-xs-5 text-center">
					<p>Veranstaltung</p>
				</div>
				<div class="col-sm-8 col-xs-7">
            		<select name="Veranstaltung" style="width:70%">
						<!--<?php
						$servername = "websql06.sprit.org";
						$username = "hgoe";
						$password = "hgvfz54RFG";
						$dbname = "hgoe_17";
						$conn = new mysqli($servername, $username, $password, $dbname);
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						} 

						$sql = "SELECT * FROM hgoe_17.hgoe_konferenzen;";
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
					
						$conn->close();
					?>-->
        			</select>
	  			</div>
	  			<br>
	  			<br>
	  			<div class="col-sm-4 col-xs-5">
	  				<p>
	  					Vorschau
	  				</p>
	  			</div>
	  			<div class="col-sm-8 col-xs-7">
	  				<div class="radio">
	  					<label class="radio">
							<input type="radio" name="rad" id="opt_ja" onClick="setVisible()">JA
						</label>
						<label class="radio">
							<input type="radio" name="rad" id="opt_nein" checked onClick="setVisible()" >NEIN
						</label>
	  				</div>
	  			</div>
	  			<div class="table-condensed" id="Vorschau" style="display: none">
	  				<div class="row">
						<div class='col-sm-4 col-xs-5'>Titel</div>
						<div class='col-sm-4 col-xs-5'>Vorname</div>
						<div class='col-sm-4 col-xs-5'>Nachname</div>
							<?php
							if(isset($_GET["id"])){
								$servername = "websql06.sprit.org";
								$username = "hgoe";
								$password = "hgvfz54RFG";
								$dbname = "hgoe_17";
								$conn = new mysqli($servername, $username, $password, $dbname);
								$id = $_GET["id"];
								if ($conn->connect_error) {
									die("Connection failed: " . $conn->connect_error);
								} 
								$sql = "select Titel, Vorname, Nachname from hgoe_teilnehmer where KonferenzID=" . $id. ";";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									$anr = "null";
									$vor = "null";
									$nach ="null";
									while($row = $result->fetch_assoc()) {
										$anr = $row["Titel"];
										$vor = $row["Vorname"];				
										$nach = $row["Nachname"];
										echo("<div class='row'><div class='col-sm-4 col-xs-5'>" . $anr . "</div>
										<div class='col-sm-4 col-xs-5'>" . $vor . "</div>
									<div class='col-sm-4 col-xs-5'>" . $nach."</div>
								</div>");
									}			
								} else {
									echo("<div class='row'><div class='col-sm-4 col-xs-5'>Keine Teilnehmer sind angemeldet</div></div>");
								}		
							$conn->close();
						}
					?>
				</div>
			<div class="row text-center" style="margin-top:25px;">
				<input class="btn btn-hgoe" style="width: 140px" type="submit" value="Drucken" onClick="printFunction()">
			</div>
			<br>
	  	</div>
	 </div>
	</div>
</div>  
</div>
  	<script>
		function setVisible(){
		if(document.getElementById("opt_ja").checked == true){
			document.getElementById("Vorschau").style.display = "inherit";
		}
		else{
			document.getElementById("Vorschau").style.display = "none";
		}
	
	  }
  	</script>	
  </body>
</html>
