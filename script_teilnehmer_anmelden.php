<?php
$config = include('./admin/config.php');
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Anmelden...</title>
	
	<script src="./admin/assets/jquery.min.js"></script>
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
		$org = (isset($_GET['org'])) ? $_GET['org'] : 'null';
		$strasse = (isset($_GET['strasse'])) ? $_GET['strasse'] : 'null';
		$hausnr = (isset($_GET['hausnr'])) ? $_GET['hausnr'] : 'null';
		$gebdat = (isset($_GET['gebdat'])) ? $_GET['gebdat'] : 'null';
		$titel = (isset($_GET['titel'])) ? $_GET['titel'] : 'null';
		$mitglied = (isset($_GET['bundesland'])) ? $_GET['bundesland'] : 'null';		
		
		echo "console.log('Database Server: " . $config['db_host'] . "');\n";
		
		// Create connection
		$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		//eMail CHECK	
		$sql = "SELECT eMail FROM hgoe_teilnehmer WHERE eMail = " . $email . ";";
		
		$result = $conn->query($sql);
		if($result && $result->num_rows > 0) {
			echo "alert('eMail bereits vorhanden');";
			echo "window.location = 'anmelden.php';";
		} else {
			//Prüfe, ob die GEbühren 0 sind. Falls ja, setze den Bezahlt-Status gleich auf BEZAHLT
			$konfSql = "SELECT * FROM hgoe_konferenzen WHERE KonferenzID = " . $konferenzID . ";";
			
			$konfResult = $conn->query($konfSql);
			if($konfResult && $konfResult->num_rows > 0) {
				$gebMit = 'null';
				$gebNichtMit = 'null';
				$konferenzName = 'null';
				while($konfRow = $konfResult->fetch_assoc()) {
					$gebMit = $konfRow['gebuehr_mitglied'];
					$gebNichtMit = $konfRow['gebuehr_nichtmitglied'];
					$konferenzName = $konfRow['Name'];
				}
				
				//INSERT INTO hgoe_teilnehmer
				$sql = "INSERT INTO hgoe_teilnehmer (Titel, Vorname, Nachname, Organisation, Geburtsdatum, eMail, Strasse, Hausnr, PLZ, Ort, Mitglied, KonferenzID, Bezahlt, Gebuehr) VALUES (";

				if ($titel != "null") {
					$sql .= "'" . $titel . "', ";
				} else {
					$sql .= "null, ";
				}

				$sql .= "'" . $vname . "', ";
				$sql .= "'" . $nname . "', ";

				if($org != "null") {
					$sql .= "'" . $org . "', ";
				} else {
					$sql .= "null, ";
				}

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

				$sql .= $konferenzID . ", ";
				
				if($mitglied == 'null') {
					if($gebNichtMit == 0.00) {
						$sql .= "1, " . $gebNichtMit . ");";
					} else {
						$sql .= "0, " . $gebNichtMit . ");";
					}
				} else {
					if($gebMit == 0.00) {
						$sql .= "1, " . $gebMit . ");";
					} else {
						$sql .= "0, " . $gebMit . ");";
					}
				}

				if ($conn->query($sql)) {
					//send email
					echo '		$.post( "./script_sendMail.php", { ';
					echo '			to: "' . $email . '",';
					echo '			subject: "Anmeldebestätigung",';
					echo '			msg_title: "Sehr geehrte/r Herr/Frau ' . (($titel != 'null') ? ($titel . ' ') : '') . $nname . '!",';
					echo '			msg_body: "Sie haben sich erfolgreich für die Veranstaltung \"' . $konferenzName . '\" angemeldet." ';
					echo '		}).done(function( data ) {';
					echo '			console.log( data );';
					echo '		});';
					
					echo "window.location = 'anmelden_erfolgreich.php?id=" . $konferenzID . "';";
				} else {
					echo "alert(\"Error: Sql-Exception <br>" . $conn->error . "\");";
					echo "window.location = 'anmelden.php';";
				}
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
