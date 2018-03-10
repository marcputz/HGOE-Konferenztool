<?php
	session_start();
	$config = include('./config.php');

	if(!isset($_SESSION['user'])) {
		header("location: login.php");
		exit();
	}

	if(isset($_GET['name']) && isset($_GET['datum']) && isset($_GET['beginnFrist']) && isset($_GET['endeFrist']) && isset($_GET["geb-mitglieder"]) && isset($_GET["geb-nichtmitglieder"])) {
		$name = $_GET['name'];
		$datum = $_GET['datum'];
		$beginnAnmeldefrist = $_GET['beginnFrist'];
	    $endeAnmeldefrist = $_GET['endeFrist'];
		$stornierungsfrist = (isset($_GET['stornierungsfrist'])) ? $_GET['stornierungsfrist'] : 'null';
		$maxAnmeldungen = (isset($_GET['maxAnmeldungen'])) ? $_GET['maxAnmeldungen'] : 'null';
		$gebuehren_mitglieder = $_GET['geb-mitglieder'];
		$gebuehren_nichtmitglieder = $_GET['geb-nichtmitglieder'];
		
		// Create connection
		$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "INSERT INTO hgoe_konferenzen (Name, datum, beginnanmeldefrist, endeanmeldefrist, gebuehr_mitglied, gebuehr_nichtmitglied, stornierungsfrist, maxanmeldungen)
			VALUES ('" . $name . "', '" . $datum . "', '" . $beginnAnmeldefrist . "', '" . $endeAnmeldefrist . "', '" . $gebuehren_mitglieder . "', '" . $gebuehren_nichtmitglieder . "', ";

		if ($stornierungsfrist != "null") {
			$sql .= "'" . $stornierungsfrist . "', ";
		} else {
			$sql .= "null, ";
		}
		if($maxAnmeldungen != "null") {
			$sql .= "'" . $maxAnmeldungen . "');";
		} else {
			$sql .= "null);";
		}
		
		if ($conn->query($sql) === TRUE) {
			echo "<script> alert('Veranstaltung erfolgreich erstellt');";
		} else {
			echo "<script> alert('Error: Sql-Exception <br>" . $conn->error . "');";
		}

		$id = $conn->insert_id;
		$conn->close();

		echo "window.location = 'detail.php?id=" . $id . "'";
		echo "</script>";
	} else {
		echo "<script> alert('Script ERROR: Fehlende Parameter');";
		echo "window.location = 'erstellen.html' </script>";
	}
?>