<?php
	$servername = "websql06.sprit.org";
	$username = "hgoe";
	$password = "hgvfz54RFG";
	$dbname = "hgoe_17";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO hgoe_konferenzen (Name, datum, beginnanmeldefrist, endeanmeldefrist)
		VALUES ('Test', '2000-01-01', '2000-01-01 00:00:00', '2000-01-01 11:59:00')";

	if ($conn->query($sql) === TRUE) {
		echo "<script> alert('Veranstaltung erfolgreich erstellt') </script>";
	} else {
		echo "<script> alert('Error: " . $sql . "<br>" . $conn->error . "') </script>";
	}

	$conn->close();
?>