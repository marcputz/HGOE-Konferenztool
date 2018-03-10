<?php
session_start();
$config = include('./config.php');

if(!isset($_SESSION['user'])) {
	header("location: login.php");
	exit();
}

if(isset($_GET["nr"]) && isset($_GET["anwesend"])) {
	
	// Create connection
	$conn = mysqli_connect($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	} 

	$sql = "UPDATE hgoe_teilnehmer SET Anwesend = ";
	if(($_GET["anwesend"]) == "ja") {
		$sql .= "1";
	} else {
		$sql .= "0";
	}
	$sql .= " WHERE TeilnehmerNr = " . $_GET["nr"];

	if(mysqli_query($conn, $sql) === TRUE) {
		echo "OK";
	} else {
		echo "Script DB Error: Fehler beim Speichern des Teilnehmers";
	}
	mysqli_close();
} else {
	echo "Script Error: Fehlende Parameter";
}
?>