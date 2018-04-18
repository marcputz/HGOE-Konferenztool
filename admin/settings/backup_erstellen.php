<script>
<?php
$config = include('../config.php');
session_start();

$progress = 0;
$error = false;
	
echo "function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}";

//Für Testzwecke ggf. auskommentieren
if(!isset($_SESSION['user'])) {
	header("location: ../login.php");
	exit();
}

if(isset($_GET['progress'])) {
	if($_GET['progress'] == 1) { //save veranstaltungen
		$progress = 40;
		
		$files = scandir('./backups/', SCANDIR_SORT_DESCENDING);
		$file_path = $files[0];
		
		$file = fopen("./backups/" . $file_path, "a+");
		if($file) {
			echo "console.log('Datei geöffnet');";
			//write to file
			
			// Create connection
			$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			echo "console.log('Datenbank-Verbindung erfolgreich hergestellt');";

			$sql = "SELECT * FROM hgoe_konferenzen";
			$result = $conn->query($sql);
			
			if($result && $result->num_rows > 0) {
				$total_array = array();
				
				while($row = $result->fetch_assoc()) {
					$array['KonferenzID'] = $row['KonferenzID'];
					$array['Name'] = $row['Name'];
					$array['datum'] = $row['datum'];
					$array['beginnanmeldefrist'] = $row['beginnanmeldefrist'];
					$array['endeanmeldefrist'] = $row['endeanmeldefrist'];
					$array['stornierungsfrist'] = $row['stornierungsfrist'];
					$array['maxanmeldungen'] = $row['maxanmeldungen'];
					$array['gebuehr_mitglied'] = $row['gebuehr_mitglied'];
					$array['gebuehr_nichtmitglied'] = $row['gebuehr_nichtmitglied'];
					
					array_push($total_array, $array);
				}
				
				$string = "\"hgoe_konferenzen\"" . json_encode($total_array);
				fwrite($file, $string);
				fclose($file);
				
				echo "console.log('Backup-File String: " . $string . "');";
				echo "async function progress() { await sleep(800); window.location = '?progress=2';} progress();";
			} else {
				echo "console.warn('Keine Konferenzen in der Datenbank gefunden. Werden nicht im Backup gesichert.');";
				echo "async function progress() { await sleep(800); window.location = '?progress=2';} progress();";
			}
		} else {
			echo "console.error('Fehler beim öffnen der Datei: " . $file . "'); window.location = '?error=1'; </script>";
			exit;
		}
	}
	if($_GET['progress'] == 2) { //save alte veranstaltugnen
		$progress = 60;
		
		$files = scandir('./backups', SCANDIR_SORT_DESCENDING);
		$file_path = $files[0];
		
		$file = fopen("./backups/" . $file_path, "a+");
		if($file) {
			echo "console.log('Datei geöffnet');";
			//write to file
			
			// Create connection
			$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			echo "console.log('Datenbank-Verbindung erfolgreich hergestellt');";

			$sql = "SELECT * FROM hgoe_konferenzen_history";
			$result = $conn->query($sql);
			
			if($result && $result->num_rows > 0) {
				$total_array = array();
				
				while($row = $result->fetch_assoc()) {
					$array['KonferenzID'] = $row['KonferenzID'];
					$array['Name'] = $row['Name'];
					$array['datum'] = $row['datum'];
					$array['beginnanmeldefrist'] = $row['beginnanmeldefrist'];
					$array['endeanmeldefrist'] = $row['endeanmeldefrist'];
					$array['stornierungsfrist'] = $row['stornierungsfrist'];
					$array['maxanmeldungen'] = $row['maxanmeldungen'];
					$array['gebuehr_mitglied'] = $row['gebuehr_mitglied'];
					$array['gebuehr_nichtmitglied'] = $row['gebuehr_nichtmitglied'];
					
					array_push($total_array, $array);
				}
				
				$string = "\"hgoe_konferenzen_history\"" . json_encode($total_array);
				fwrite($file, $string);
				fclose($file);
				
				echo "console.log('Backup-File String: " . $string . "');";
				echo "async function progress() { await sleep(800); window.location = '?progress=3';} progress();";
			} else {
				echo "console.warn('Keine alten Konferenzen in der Datenbank gefunden. Werden nicht im Backup gesichert.');";
				echo "async function progress() { await sleep(800); window.location = '?progress=3';} progress();";
			}
		} else {
			echo "console.error('Fehler beim öffnen der Datei: " . $file . "'); window.location = '?error=1'; </script>";
			exit;
		}
	}
	if($_GET['progress'] == 3) { //save teilnehmer
		$progress = 80;
		
		$files = scandir('./backups/', SCANDIR_SORT_DESCENDING);
		$file_path = $files[0];
		
		$file = fopen("./backups/" . $file_path, "a+");
		if($file) {
			echo "console.log('Datei geöffnet');";
			//write to file
			
			// Create connection
			$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			echo "console.log('Datenbank-Verbindung erfolgreich hergestellt');";

			$sql = "SELECT * FROM hgoe_teilnehmer";
			$result = $conn->query($sql);
			
			if($result && $result->num_rows > 0) {
				$total_array = array();
				
				while($row = $result->fetch_assoc()) {
					$array['TeilnehmerNr'] = $row['TeilnehmerNr'];
					$array['Titel'] = $row['Titel'];
					$array['Vorname'] = $row['Vorname'];
					$array['Nachname'] = $row['Nachname'];
					$array['Organisation'] = $row['Organisation'];
					$array['Geburtsdatum'] = $row['Geburtsdatum'];
					$array['eMail'] = $row['eMail'];
					$array['Strasse'] = $row['Strasse'];
					$array['Hausnr'] = $row['Hausnr'];
					$array['PLZ'] = $row['PLZ'];
					$array['Ort'] = $row['Ort'];
					$array['Mitglied'] = $row['Mitglied'];
					$array['KonferenzID'] = $row['KonferenzID'];
					$array['Bezahlt'] = $row['Bezahlt'];
					$array['Anwesend'] = $row['Anwesend'];
					$array['Berufsgruppe'] = $row['Berufsgruppe'];
					$array['Gebuehr'] = $row['Gebuehr'];
					$array['Geschlecht'] = $row['Geschlecht'];
					
					array_push($total_array, $array);
				}
				
				$string = "\"hgoe_teilnehmer\"" . json_encode($total_array);
				fwrite($file, $string);
				fclose($file);
				
				echo "console.log('Backup-File String: " . $string . "');";
				echo "async function progress() { await sleep(800); window.location = '?progress=4';} progress();";
			} else {
				echo "console.warn('Keine Teilnehmer in der Datenbank gefunden. Werden nicht im Backup gesichert.');";
				echo "async function progress() { await sleep(800); window.location = '?progress=4';} progress();";
			}
		} else {
			echo "console.error('Fehler beim öffnen der Datei: " . $file . "'); window.location = '?error=1'; </script>";
			exit;
		}
	}
	if($_GET['progress'] == 4) { //save config
		$progress = 100;
		
		$files = scandir('./backups', SCANDIR_SORT_DESCENDING);
		$file_path = $files[0];
		
		$file = fopen("./backups/" . $file_path, "a+");
		if($file) {
			echo "console.log('Datei geöffnet');";
			//write to file
			
			$str = "\"config\"" . json_encode($config);
			fwrite($file, $str);
			fclose($file);
			
			echo "console.log('Backup-File String: " . $str . "');";
			echo "async function progress() { await sleep(800); window.location = '?finished=1'; } progress();";
		} else {
			echo "console.error('Fehler beim öffnen der Datei: " . $file . "'); window.location = '?error=1'; </script>";
			exit;
		}
	}
}
	
if(isset($_GET['finished'])) {
	$progress = 100;
}
	
if(isset($_GET['start'])) { //wird gestartet
	$progress = 20;
	
	//datei erstellen
	$date = date('Y-m-d_H:i:s');
	$file = fopen("./backups/backup_" . $date . ".bkp", "a+");
	echo "console.log('Datei erstellt'); progress();";
	
	echo "async function progress() {
	await sleep(800); window.location = '?progress=1';
	};";
}
?>
</script>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Backup erstellen...</title>
	
	<!-- Bootstrap & jQuery -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/hgoe.php" type="text/css">
	<script src="../assets/jquery.min.js"></script>

	<!-- Custom Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">
</head>
<body>

<div class="vertical-center">
	<div class='container-fluid text-center' style='max-width: 700px; width: 100%;'>
		<div class='panel panel-hgoe'>
			<div class="panel-heading text-center" style="font-size: 18px; font-family: Armata, Times New Roman, serif;">
				Backup wird erstellt
			</div>
			<div class='panel-body'>
				<?php
					if($error == false) {
						if(isset($_GET['start']) || isset($_GET['progress']) || isset($_GET['finished'])) {
				?>
					<!-- Progress view -->
					<div class='text-center' id='text'>
						<?php
							if(isset($_GET['start'])) {
								echo "Konferenzen werden gesichert...";
							}
							if(isset($_GET['progress'])) {
								if($_GET['progress'] == 1) {
									echo "Alte Konferenzen werden gesichert...";
								}
								if($_GET['progress'] == 2) {
									echo "Teilnehmer werden gesichert...";
								}
								if($_GET['progress'] == 3) {
									echo "Einstellungen werden gesichert...";
								}
								if($_GET['progress'] == 4) {
									echo "Backup wird abgeschlossen";
								}
							}
							if($_GET['finished']) {
								echo "Backup erfolgreich erstellt!";
							}
						?>
					</div>
					<div class='progress' style='margin: 10px;'>
						<div class='progress-bar <?php if(!isset($_GET['finished'])) { echo "progress-bar-striped active"; } ?>' role='progressbar' id='bar' aria-valuenow='<?php echo $progress; ?>' aria-valuemin='0' aria-valuemax='<?php echo $progress; ?>' style='width: <?php echo $progress; ?>%'>
							<span class='sr-only'>Progress...</span>
						</div>
					</div>
					<?php if(!$_GET['finished']) { ?>
						<a id='stopBtn' style='margin-top: 10px; margin-bottom: 5px;' class='btn btn-hgoe'>Abbrechen</a>
					<?php } else { ?>
						<a href="./settings.php" style='margin-top: 10px; margin-bottom: 5px;' class='btn btn-hgoe'>Zurück</a>
					<?php } ?>
					
					<script>
						$('#stopBtn').click( function() {
							if(confirm('Wollen Sie wirklich abbrechen?')) {
								$("#text").innerHTML = 'Backup abbrechen...';
								window.location = '?stop=1';
							}
						});
					</script>
				<?php
						} else {
				?>
					<!-- Start view -->
					<div class='text-center' id='text'>
						Klicken Sie auf 'Start', um ein Backup zu erstellen
					</div>
					<a href='?start=1' class='btn btn-hgoe' style='margin-top: 15px; margin-bottom: 5px;'>Start</a>
				<?php
						}
					} else {
				?>		
					<!-- Error view -->
					<div class='text-center' id='text'>
						Leider ist ein Fehler unterlaufen. Versuchen Sie es später nochmal oder fragen Sie einen Administrator
					</div>
					<a href='./settings.php' class='btn btn-hgoe' style='margin-top: 15px; margin-bottom: 5px;'>Zurück zu den Einstellungen</a>
				<?php
					}
				?>
			</div>
		</div>
	</div>
</div>
</body>
</html>