<?php

	$testserver = true; //set this for testserver
	$servername = "websql06.sprit.org";
	$username = "hgoe";
	$password = "hgvfz54RFG";
	$dbname = "hgoe_17";
	if($testserver==true){
			$servername = "db.marcputz.at";
		}
	$conn = new mysqli($servername, $username, $password, $dbname);
	$id = $_GET["id"];
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	/*$sql = "select Titel, Vorname, Nachname from hgoe_teilnehmer where Nachname like 'Schweiger;";//where KonferenzID=" . $id. ";";
	$result = $conn->query($sql);
	$dir = dirname(__FILE__);
	require_once $dir . '/../lib/PHPRtfLite.php';
	PHPRtfLite::registerAutoloader();
	$rtf = new PHPRtfLite();
	$sect = $rtf->addSection();
	$table = $sect->addTable();
	$table->addRows(5, 1);
	$table->addColumnsList(array(5,5,5));
	$cell = $table->getCell(1, 1);
	$cell->writeText("GGGGGG");
	if ($result->num_rows > 0) {
		$anr = "null";
		$vor = "null";
		$nach ="null";
		$anz = "null";
		while($row = $result->fetch_assoc()) {
			$anr = $row["Titel"];
			$vor = $row["Vorname"];				
			$nach = $row["Nachname"];
			if($anz==null){
				$anz = $row["count(*)"];
			}
			while($count<$anz){
				$cell = $table->getCell(1, 1);
				$cell->writeText("<b>GGGGGGHZGHZGBUH</b>");
			}
		}
	} else {
		$cell->$table->getCell(1,1);
		$cell->writeText("<b>ERROR</b>");
	}
	$conn->close();*/
	$rtf->save($dir . '/generated/' . basename(__FILE__, '.php') . '.rtf');