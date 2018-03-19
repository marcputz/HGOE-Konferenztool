<?php
session_start();
$config = include('./config.php');

if(!isset($_SESSION['user'])) {
	header("location: login.php");
	exit();
}
?>

<script>
	<?php
		if(isset($_GET['id'])) {
			if(isset($_GET['name']) && isset($_GET['datum']) && isset($_GET['beginnFrist']) && isset($_GET['endeFrist']) && isset($_GET['gebNichtmitglieder']) && isset($_GET['gebMitglieder'])) {
				$id = $_GET['id'];
				$name = $_GET['name'];
				$datum = $_GET['datum'];
				$beginnAnmeldefrist = $_GET['beginnFrist'];
				$endeAnmeldefrist = $_GET['endeFrist'];
				$stornierungsfrist = (isset($_GET['stornierungsfrist'])) ? $_GET['stornierungsfrist'] : 'null';
				$maxAnmeldungen = (isset($_GET['maxAnmeldungen'])) ? $_GET['maxAnmeldungen'] : 'null';
				$gebMitglieder = $_GET['gebMitglieder'];
				$gebNichtmitglieder = $_GET['gebNichtmitglieder'];
				
				// Create connection
				$conn = mysqli_connect($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

				// Check connection
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				} 
				
				$sql = "UPDATE hgoe_konferenzen SET Name = '" . 
						$name . "', datum = '" . $datum . "', beginnanmeldefrist = '" . 
						$beginnAnmeldefrist . "', endeanmeldefrist = '" . $endeAnmeldefrist . "', gebuehr_mitglied = '" . $gebMitglieder . "', gebuehr_nichtmitglied = '" . $gebNichtmitglieder . "'";
						
				if($stornierungsfrist != 'null') {
					$sql .= ", stornierungsfrist = '" . $stornierungsfrist . "'";
				} else {
					$sql .= ", stornierungsfrist = null";
				}
				if($maxAnmeldungen != 'null') {
					$sql .= ", maxanmeldungen = " . $maxAnmeldungen;
				} else {
					$sql .= ", maxanmeldungen = null";
				}
				
				$sql .= " WHERE KonferenzID = " . $id;
				
				if (mysqli_query($conn, $sql) === TRUE) {
					echo "alert('Veranstaltung gespeichert!');\n";
				} else {
					echo "alert(\"Error: Sql-Exception: " . $conn->error . "\");\n";
				}

				mysqli_close($conn);
				
				echo "window.location = 'detail.php?id=" . $id . "';";
			} else {
				echo "alert('Script Error: Fehlende Pflichtfelder!');\n";
			}
		} else {
			echo "alert('Script Error: Fehlende Veranstaltungs-ID!');\n";
		}
	?>
</script>