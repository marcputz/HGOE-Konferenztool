<script>
	<?php
		if(isset($_GET['id'])) {
			if(isset($_GET['name']) && isset($_GET['datum']) && isset($_GET['beginnFrist']) && isset($_GET['endeFrist'])) {
				$id = $_GET['id'];
				$name = $_GET['name'];
				$datum = $_GET['datum'];
				$beginnAnmeldefrist = $_GET['beginnFrist'];
				$endeAnmeldefrist = $_GET['endeFrist'];
				$stornierungsfrist = (isset($_GET['stornierungsfrist'])) ? $_GET['stornierungsfrist'] : 'null';
				$maxAnmeldungen = (isset($_GET['maxAnmeldungen'])) ? $_GET['maxAnmeldungen'] : 'null';
				
				$testserver = false; //set this for testserver
				
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
				
				$sql = "UPDATE hgoe_konferenzen SET Name = '" . 
						$name . "', datum = '" . $datum . "', beginnanmeldefrist = '" . 
						$beginnAnmeldefrist . "', endeanmeldefrist = '" . $endeAnmeldefrist . "'";
						
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