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
<title>Löschen...</title>
</head>

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