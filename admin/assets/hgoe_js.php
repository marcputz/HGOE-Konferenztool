function performCheck() {
	"use strict";
	<?php
	$config = include("../config.php");

	$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

	// Check connection
	if ($conn->connect_error) {
		echo "console.error(\"DB-Error: " . $conn->connect_error . "\");";
		die();
	} 

	$sql = "SELECT * FROM hgoe_17.hgoe_konferenzen;";
	$result = $conn->query($sql);

	$anz = 0;
	if ($result->num_rows > 0) {
		$currDate = date('Y-m-d');

		while($row = $result->fetch_assoc()) {
			//check date
			$datum = $row["datum"];

			if($currDate > $datum) {
				//in der vergangenheit --> veranstaltung absagen
				$id = $row['KonferenzID'];

				echo "console.warn('Veranstaltung #" . $id . " (" . $row['Name'] . ") liegt in der Vergangenheit.');";

				echo "$.ajax({";
				echo "	url: './script_veranstaltung_absagen.php?noAlert=1&id=" . $id . "', ";
				echo "  async: false, ";
				echo "	success: function(result) {";
				echo "		console.info('Veranstaltung #" . $id . " automatisch abgesagt');";
				echo "	}";
				echo "});";

				$anz = $anz + 1;
			}
		}
	}
	
	if($anz > 0) {
		echo "console.info('" . $anz . " Veranstaltungen gelöscht');";
	}

	?>
}