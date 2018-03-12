<script>
<?php
	$config = include('../config.php');

	//Für Testzwecke ggf. auskommentieren
	session_start();
	
	if(!isset($_SESSION['user'])) {
		header("location: ../login.php");
		exit();
	} else {
		echo "console.log('" . $_SESSION['admin'] . " - " . $_SESSION['user'] . "');";
		//check privileges
		if($_SESSION['admin'] == 0 && $_SESSION['user'] != $_GET['user']) {
			//neither an admin, nor the concerned user. password change not allowed
			echo "console.log('Priviledge error: Not allowed');";
			header("location: settings.php");
			exit();
		}
	}

	if(isset($_GET['save']) && isset($_GET['user'])) {
		$oldPW = (isset($_POST['oldPassTF'])) ? $_POST['oldPassTF'] : 'empty';
		$newPW = (isset($_POST['newPassTF'])) ? $_POST['newPassTF'] : 'empty';
		$confirmPW = (isset($_POST['confirmPassTF'])) ? $_POST['confirmPassTF'] : 'empty';
		
		$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);
		if ($conn->connect_error) {
			echo "console.log('Verbindung fehlgeschlagen: " . $conn->connect_error . "');";
			die($conn->connect_error);
		}
		echo "console.log('Verbindung zur Datenbank " . $config['db_host'] . " erfolgreich hergestellt');";
		
		$sql = "SELECT * FROM hgoe_user WHERE username like '" . $_GET['user'] . "'";
		$result = $conn->query($sql);
		
		if($result->num_rows == 1) {
			while($row = $result->fetch_assoc()) {
				$oldPW_db = $row['password'];
				$oldPW_hash = hash('sha256', $oldPW);
				
				if($oldPW != 'empty' && $oldPW_hash == $oldPW_db) {
					//old password is correct
					echo "console.log('Passwort-Hash stimmt mit der Datenbank überein. Altes Passwort korrekt');";
					if($newPW != 'empty') {
						if($newPW == $confirmPW) {
							//use new password
							
							$newPW_hash = hash('sha256', $newPW);
							$sql = "UPDATE hgoe_user SET password = '" . $newPW_hash . "' WHERE username like '" . $_GET['user'] . "'";
							
							if ($conn->query($sql) === TRUE) {
								//password change success
								echo "console.log('SQL-UPDATE Befehl ausgeführt. Passwort geändert');";
								header("location: ../logout.php");
								exit();
							} else {
								//password change failed
								echo "console.error(\"Fehler beim Ausführen des SQL-UPDATE Befehls: " . $conn->error . "\");";
								$errorMessage = "Tut uns leid, da ist etwas schiefgelaufen. Bitte kontaktieren Sie einen Admin und checken Sie die JavaScript-Logs";
							}
						} else {
							//passwords don't match
							echo "console.error('ERROR: Neue Passwörter stimmen nicht miteinander überein!');";
							$errorMessage = "Die Passwörter stimmen nicht überein oder sind leer";
						}
					} else {
						echo "console.error('ERROR: Kein neues Passwort eingegeben');";
						$errorMessage = "Bitte geben Sie ein neues Passwort ein";
					}
				} else {
					//old password is incorrect
					echo "console.error('ERROR: Passwort-Hash stimmt NICHT mit der Datenbank überein. Altes Passwort falsch');";
					$errorMessage = "Das alte Passwort ist nicht korrekt";
				}
			}
		} else {
			//ERROR --> user not found
			echo "console.error('ERROR: User wurde nicht in der Datenbank gefunden');";
			$errorMessage = "Tut uns leid, da ist etwas schiefgelaufen. Bitte kontaktieren Sie einen Admin und checken Sie die JavaScript-Logs";
		}
		
		$conn->close();
	}
?>
</script>

<!doctype html>
<html>
	<head>
		<!-- Meta Data -->
		<meta charset="UTF-8">
		<meta name="author" content="Marc Putz">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
		<meta name="robots" content="noindex,nofollow">
		<meta name="revised" content="Marc Putz, 03/11/2018">
		
		<!-- Bootstrap & jQuery -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/hgoe.css" type="text/css">
		<script src="../assets/jquery.min.js"></script>
		
		<!-- Custom Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">
		
		<title>HGÖ - Passwort ändern</title>
		
		<style>
			.row {
				margin-bottom: 10px;
			}
		</style>
	</head>
	<body>
		<div class="container text-center" style="max-width: 500px">
			<div class="panel panel-hgoe" style="margin-top: 30px">
				<div class="panel-heading">
					<h4>Passwort ändern<?php if(isset($_GET['user'])) { echo " - User <b>" . $_GET['user'] . "</b>"; }?></h4>
				</div>
				<div class="panel-body text-left">
					<form action="?save=1<?php if(isset($_GET['user'])) { echo "&user=" . $_GET['user']; } ?>" method="post">
						<div class="row">
							<div class="col-xs-5 text-right">Altes Passwort:</div>
							<div class="col-xs-7"><input name="oldPassTF" type="password" style="width: 90%;"></div>
						</div>
						<br>
						<div class="row">
							<div class="col-xs-5 text-right">Neues Passwort:</div>
							<div class="col-xs-7"><input name="newPassTF" type="password" style="width: 90%;"></div>
						</div>
						<div class="row">
							<div class="col-xs-5 text-right">Erneut eingeben:</div>
							<div class="col-xs-7"><input name="confirmPassTF" type="password" style="width: 90%;"></div>
						</div>
						<?php 
							if(isset($errorMessage)) {
								echo "<br>";
								echo "<div class='row text-center' style='margin-bottom: 0px; color: red;'>";
								echo $errorMessage;
								echo "</div>";
							}
						?>
						<br>
						<div class="row text-center">
							<a class="btn btn-hgoe-red" style="margin-right: 20px;" href="./settings.php">Abbrechen</a>
							<input type="submit" class="btn btn-hgoe" value="Speichern">
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>