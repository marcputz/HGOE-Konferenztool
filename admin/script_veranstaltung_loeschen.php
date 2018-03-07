<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Löschen...</title>
</head>

<body>
<script>
<?php
	if(isset($_GET["id"]))  {
		$id = $_GET["id"];	
		
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
				
		$sql = "DELETE FROM hgoe_konferenzen_history WHERE KonferenzID = " . $id . ";";
		//EXECUTES DELETE QUERY
		
		$result = mysqli_query($conn, $sql);
		
		if($result === false) {
			echo "alert('Fehler beim löschen der Veranstaltung');";
			echo "window.location = 'start.php';";
		} else {
			echo "alert('Veranstaltung gelöscht!');";
			echo "window.location = 'start.php';";
		}
	} else {
		echo "alert('Script Error: Fehlende ID');";
	}
?>
</script>
</body>
</html>