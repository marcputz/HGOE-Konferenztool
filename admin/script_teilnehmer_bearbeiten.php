<?php
	session_start();
	$config = include('./config.php');

	if(!isset($_SESSION['user'])) {
		header("location: login.php");
		exit();
	}
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">

<title>Teilnehmer speichern...</title>
</head>

<body>
	<script>
	<?php
		if(isset($_GET["nr"]) && isset($_GET["vname"]) && isset($_GET["nname"]) && isset($_GET["email"]) && isset($_GET["plz"]) && isset($_GET["ort"]) && isset($_GET['geschlecht'])) {
			$nr = $_GET["nr"];
			$vname = $_GET["vname"];
			$nname = $_GET["nname"];
			$email = $_GET["email"];
			$plz = $_GET["plz"];
			$ort = $_GET["ort"];
			$titel = "null";
			$geschlecht = $_GET['geschlecht'];
			$strasse = "null";
			$hausnr = "null";
			$org = "null";
			$gebdat = "null";
			$bundesland = "null";

			if(isset($_GET["titel"]))
				$titel = $_GET["titel"];
			if(isset($_GET["org"]))
				$org = $_GET["org"];
			if(isset($_GET["gebdat"]))
				$gebdat = $_GET["gebdat"];
			if(isset($_GET["strasse"]))
				$strasse = $_GET["strasse"];
			if(isset($_GET["hausnr"]))
				$hausnr = $_GET["hausnr"];	
			if(isset($_GET["bundesland"]))
				$bundesland = $_GET["bundesland"];	

			// Create connection
			$conn = mysqli_connect($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			} 

			$sql = "UPDATE hgoe_teilnehmer SET Vorname = '" . 
					$vname . "', Nachname = '" . $nname . "', eMail = '" . 
					$email . "', plz = " . $plz . ", ort = '" . $ort . "', Geschlecht = '" . $geschlecht . "'";

			if($gebdat != 'null') {
				$sql .= ", Geburtsdatum = '" . $gebdat . "'";
			} else {
				$sql .= ", Geburtsdatum = null";
			}
			if($titel != 'null') {
				$sql .= ", Titel = '" . $titel . "'";
			} else {
				$sql .= ", Titel = null";
			}
			if($org != 'null') {
				$sql .= ", Organisation = '" . $org . "'";
			} else {
				$sql .= ", Organisation = null";
			}
			if($strasse != 'null') {
				$sql .= ", Strasse = '" . $strasse . "'";
			} else {
				$sql .= ", Strasse = null";
			}
			if($hausnr != 'null') {
				$sql .= ", Hausnr = " . $hausnr;
			} else {
				$sql .= ", Hausnr = null";
			}
			if($bundesland != 'null') {
				$sql .= ", Mitglied = '" . $bundesland . "'";
			} else {
				$sql .= ", Mitglied = null";
			}

			$sql .= " WHERE TeilnehmerNr = " . $nr;

			if (mysqli_query($conn, $sql) === TRUE) {
				echo "alert('Teilnehmer gespeichert!');\n";

				mysqli_close($conn);
				$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

				$sql = "SELECT KonferenzID FROM hgoe_teilnehmer WHERE TeilnehmerNr = " . $nr . ";";

				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo "window.location = './teilnehmer.php?vid=" . $row["KonferenzID"] . "';";
					}
				} else {
					echo "alert('Error: Sql-Exception <br>" . $conn->error . "');\n";
					echo "window.location = './teilnehmer.php';";
				}
			} else {
				echo "alert('Error: Sql-Exception <br>" . $conn->error . "');\n";
				echo "window.location = './teilnehmer.php';";

				mysqli_close();
			}
		} else {
			echo "alert('Script Error: Fehlende Pflichtparameter!');";
			echo "window.location = './start.php';";
		}
	?>
	</script>
</body>
</html>
