<script>
<?php
	$config = include("../config.php");
	session_start();

	//Für Testzwecke ggf. auskommentieren
	/*if(!isset($_SESSION['user'])) {
		header("location: login.php");
		exit();
	}*/
	
	if(isset($_GET['user'])) {
		$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "DELETE FROM hgoe_17.hgoe_user WHERE username like '" . $_GET['user'] . "'";
		if($conn->query($sql) === TRUE) {
			//delete success
			echo "alert('User wurde erfolgreich gelöscht');";
		} else {
			//delete failed
			echo "console.error(\"SQL-DELTE Error: " . $conn->error . "\");";
			echo "alert('Fehler beim Löschen des Users. (Weitere Infos in den JavaScript-Logs des Browsers)');";
		}
	} else {
		echo "console.error('Kein User übergeben!');";
		echo "alert('Script Error: Fehlender User-Parameter');";
	}
	
	echo "window.location = './settings.php';";
?>
</script>