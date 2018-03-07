<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Löschen...</title>
</head>

<body>
<script>
<?php
	if(isset($_GET["nr"]))  {
		$nr = $_GET["nr"];	
		
		$servername = "websql06.sprit.org";
		$username = "hgoe";
		$password = "hgvfz54RFG";
		$dbname = "hgoe_17";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		} 
				
		$sql = "DELETE FROM hgoe_teilnehmer WHERE TeilnehmerNr = " . $nr . ";";
		//EXECUTES DELETE QUERY
		
		$result = mysqli_query($conn, $sql);
		
		if($result === false) {
			echo "alert('Fehler beim Abmelden des Teilnehmers!');";
			if(isset($_GET["vid"])) {
				echo "window.location = 'teilnehmer.php?vid=" . $_GET["vid"] . "';";
			} else {
				echo "window.location = 'start.php';";
			}
		} else {
			echo "alert('Teilnehmer abgemeldet!');";
			if(isset($_GET["vid"])) {
				echo "window.location = 'teilnehmer.php?vid=" . $_GET["vid"] . "';";
			} else {
				echo "window.location = 'start.php';";
			}
		}
	} else {
		echo "alert('Script Error: Fehlende Teilnehmernummer');";
	}
?>
</script>
</body>
</html>