<?php
session_start();
$config = include('./config.php');

if(!isset($_SESSION['user'])) {
	header("location: login.php");
	exit();
}
?>

<html>
<body>
<script>
	
<?php
	if(isset($_GET["id"]))  {
		$id = $_GET["id"];	

		// Create connection
		$conn = mysqli_connect($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		} 

		$sql = "SELECT * " . 
		"FROM hgoe_17.hgoe_konferenzen " . 
		"WHERE KonferenzID = " . $id . ";";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			// output data of each row

			$name = "null";
			$datum = "null";
			$beginnAnmeldefrist = "null";
			$endeAnmeldefrist = "null";
			$stornierungsfrist = "null";
			$maxAnmeldungen = "null";
			$gebuehr_mitglied = "null";
			$gebuehr_nichtmitglied = "null";

			while($row = $result->fetch_assoc()) {
				$name = $row["Name"];
				$datum = $row["datum"];
				$beginnAnmeldefrist = $row["beginnanmeldefrist"];
				$endeAnmeldefrist = $row["endeanmeldefrist"];
				$gebuehr_mitglied = $row["gebuehr_mitglied"];
				$gebuehr_nichtmitglied = $row["gebuehr_nichtmitglied"];
				if(!(is_null($row["stornierungsfrist"]))) {
					$stornierungsfrist = $row["stornierungsfrist"];
				}
				if(!(is_null($row["maxanmeldungen"]))) {
					$maxAnmeldungen = $row["maxanmeldungen"];
				}
			}

			$sql = "INSERT INTO hgoe_konferenzen_history (KonferenzID, Name, datum, beginnanmeldefrist, endeanmeldefrist, gebuehr_mitglied, gebuehr_nichtmitglied, stornierungsfrist, maxanmeldungen) VALUES (" . $id . ", '" . $name . "', '" . $datum . "', '" . $beginnAnmeldefrist . "', '" . $endeAnmeldefrist . "', '" . $gebuehr_mitglied . "', '" . $gebuehr_nichtmitglied . "', ";

			if($stornierungsfrist != "null") {
				$sql .= "'" . $stornierungsfrist . "', ";
			} else {
				$sql .= "null, ";
			}
			if($maxAnmeldungen != "null") {
				$sql .= "'" . $maxAnmeldungen . "')";
			} else {
				$sql .= "null);";
			}
				
			//EXECUTES INSERT QUERY
			if(!mysqli_query($conn, $sql)) {
				echo "console.log(\"Error beim Löschen: " . mysqli_error($conn) . "\");";
			} else {
				echo "console.log('In History Tabelle eingefügt.');";
			}
			
			$sql = "DELETE FROM hgoe_konferenzen WHERE KonferenzID = " . $id . ";";
			//EXECUTES DELETE QUERY
			if(!mysqli_query($conn, $sql)) {
				echo "console.log(\"Error beim Löschen: " . mysqli_error($conn) . "\");";
			} else {
				echo "console.log('Aus Veranstaltungs-Tabelle gelöscht');";
			}

			echo "alert('Veranstaltung abgesagt!');";
			echo "window.location = 'start.php';";
		} else {
			echo "alert('DB-Error: Veranstaltung wurde nicht gefunden!');";
			echo "window.location = 'detail.php?id=" . $id . "';";
		}

		mysqli_close($conn);
	} else {
		echo "alert('Kann leere Veranstaltung nicht absagen!');";
		echo "window.location = 'detail.php'";
	}
?>
				
</script>
</body>
</html>