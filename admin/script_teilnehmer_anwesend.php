<?php
if(isset($_GET["nr"]) && isset($_GET["anwesend"])) {
	
	$testserver = true; //set this for testserver
	$servername = "websql06.sprit.org";
	$username = "hgoe";
	$password = "hgvfz54RFG";
	$dbname = "hgoe_17";
	if($testserver==true){
		$servername = "db.marcputz.at";
	}
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

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