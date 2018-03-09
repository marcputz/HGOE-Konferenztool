<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Anmelden...</title>
</head>
<body>
<script>
<?php
	if(isset($_GET["KonferenzID"]) && isset($_GET["vname"]) && isset($_GET["nname"]) && isset($_GET["email"]) && isset($_GET["plz"]) && isset($_GET["ort"])) {
		$konferenzID = $_GET["KonferenzID"];
		$vname = $_GET["vname"];
		$nname = $_GET["nname"];
		$email = $_GET["email"];
		$plz = $_GET["plz"];
		$ort = $_GET["ort"];
		$strasse = (isset($_GET['strasse'])) ? $_GET['strasse'] : 'null';
		$hausnr = (isset($_GET['hausnr'])) ? $_GET['hausnr'] : 'null';
		$gebdat = (isset($_GET['gebdat'])) ? $_GET['gebdat'] : 'null';
		$titel = (isset($_GET['titel'])) ? $_GET['titel'] : 'null';
		$mitglied = (isset($_GET['bundesland'])) ? $_GET['bundesland'] : 'null';
		$arbeit = $_GET['arbeit'];
		
		$testserver = false; // set this for testserver
		$servername = "websql06.sprit.org";
		$username = "hgoe";
		$password = "hgvfz54RFG";
		$dbname = "hgoe_17";
		
		if($testserver == true){
			$servername = "db.marcputz.at";
		}
		
		echo "console.log('Database Server: " . $servername . "');\n";
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		//eMail CHECK
		
		$sql = "SELECT eMail FROM hgoe_teilnehmer WHERE eMail = " . $email . ";";
		
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			echo "alert('eMail bereits vorhanden');";
			echo "window.location = 'anmelden.php';";
		} else {
			//INSERT
			$sql = "INSERT INTO hgoe_teilnehmer (Titel, Vorname, Nachname, Geburtsdatum, eMail, Strasse, Hausnr, PLZ, Ort, Mitglied, Berufsgruppe, KonferenzID) VALUES (";

			if ($titel != "null") {
				$sql .= "'" . $titel . "', ";
			} else {
				$sql .= "null, ";
			}

			$sql .= "'" . $vname . "', ";
			$sql .= "'" . $nname . "', ";

			if ($gebdat != "null") {
				$sql .= "'" . $gebdat . "', ";
			} else {
				$sql .= "null, ";
			}

			$sql .= "'" . $email . "', ";

			if ($strasse != "null") {
				$sql .= "'" . $strasse . "', ";
			} else {
				$sql .= "null, ";
			}
			if ($hausnr != "null") {
				$sql .= "'" . $hausnr . "', ";
			} else {
				$sql .= "null, ";
			}

			$sql .= $plz . ", ";
			$sql .= "'" . $ort . "', ";

			if ($mitglied != "null") {
				$sql .= "'" . $mitglied . "', ";
			} else {
				$sql .= "null, ";
			}
			
			$sql .= "'" . $arbeit . "',";

			$sql .= $konferenzID . ");";

			if ($conn->query($sql)) {
				echo "alert('Erfolgreich angemeldet!');";
				echo "window.location = 'anmelden_erfolgreich.php?id=" . $konferenzID . "';";
			} else {
				echo "alert(\"Error: Sql-Exception <br>" . $conn->error . "\");";
				echo "window.location = 'anmelden.php';";
			}
		}
		
		$conn->close();
	} else {
		echo "alert('Script Error: Fehlende Pflicht-Parameter!');";
	}
?>
</script>
</body>
</html>
