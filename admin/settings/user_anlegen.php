<script>
<?php
	$config = include('../config.php');
	session_start();

	//Für Testzwecke ggf. auskommentieren
	/*if(!isset($_SESSION['user'])) {
		//is not logged in
		header("location: ../login.php");
		exit();
	} else {
		//check privileges
		if($_SESSION['admin'] == 0) {
			//not an admin. cannot create new users
			echo "console.log('Privilege error: Not allowed');";
			header("location: settings.php");
			exit();
		}
	}*/

	if(isset($_GET['create'])) {
		//code for 'Anlegen' button
		$user = (isset($_POST['usernameTF'])) ? $_POST['usernameTF'] : '';
		$pass = (isset($_POST['passTF'])) ? $_POST['passTF'] : '';
		$confirmPass = (isset($_POST['confirmPassTF'])) ? $_POST['confirmPassTF'] : '';
		$isAdmin = (isset($_POST['isAdminCB'])) ? $_POST['isAdminCB'] : 'off';
		
		$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);
		if ($conn->connect_error) {
			echo "console.log('Verbindung fehlgeschlagen: " . $conn->connect_error . "');";
			die($conn->connect_error);
		}
		echo "console.log('Verbindung zur Datenbank " . $config['db_host'] . " erfolgreich hergestellt');";
		
		echo "console.log('" . $user . " - " . $pass . " - " . $isAdmin . "');";
		if($user != '') {
			if($pass != '') {
				if($pass == $confirmPass) {
					$sql = "INSERT INTO hgoe_user VALUES ('" . $user . "', '" . hash('sha256', $pass) . "', ";
					if($isAdmin == 'on') {
						$sql .= "'1'";
					} else {
						$sql .= "'0'";
					}
					$sql .= ");";
		
					if($conn->query($sql) === TRUE) {
						//insert success
						echo "console.log('User erfolgreich in Datenbank eingefügt!');";
						echo "window.location = './settings.php'";
					} else {
						//insert failed
						echo "console.error(\"Database INSERT-SQL Error: " . $conn->error . "\");\n";
						$errorMessage = "Fehler beim Erstellen des Users!";
					}
				} else {
					echo "console.error('Passwörter stimmen nicht überein');";
					$errorMessage = "Passwörter stimmen nicht überein!";
				}
			} else {
				echo "console.error('Kein Passwort eingegeben!');";
				$errorMessage = "Bitte geben Sie ein Passwort ein!";
			}
		} else {
			echo "console.error('Kein Nutzername eingegeben!');";
			$errorMessage = "Bitte geben Sie einen Nutzernamen ein!";
		}
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
		<link rel="stylesheet" href="../assets/css/hgoe.php" type="text/css">
		<script src="../assets/jquery.min.js"></script>
		
		<!-- Custom Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">
		
		<title>HGÖ - User anlegen</title>
		
		<style>
			.row {
				margin-bottom: 10px;
			}
		</style>
	</head>

	<body>
		<div class="container" style="max-width: 700px">
			<div class="panel panel-hgoe text-center" style="margin-top: 20px;">
				<div class="panel-heading">
					<h4>User anlegen</h4>
				</div>
				<div class="panel-body">
					<form action="?create=1" method="post">
						<div class="row">
							<div class="col-xs-4 text-right">Nutzername: </div>
							<div class="col-xs-8 text-left"><input name="usernameTF" type="text" size="40" style="width: 90%;"></div>
						</div>
						<br>
						<div class="row">
							<div class="col-xs-4 text-right">Passwort: </div>
							<div class="col-xs-8 text-left"><input name="passTF" type="password" size="190" style="width: 90%;"></div>
						</div>
						<div class="row">
							<div class="col-xs-4 text-right">Wiederholen: </div>
							<div class="col-xs-8 text-left"><input name="confirmPassTF" type="password" size="190" style="width: 90%;"></div>
						</div>
						
						<br>
						<div class="row">
							<div class="col-xs-4 text-right">Als Admin anlegen: </div>
							<div class="col-xs-8 text-left"><input name="isAdminCB" type="checkbox"></div>
						</div>
						
						<?php
							if(isset($errorMessage)) {
								echo "<br>";
								echo "<div class='row' style='color: red;'>";
								echo $errorMessage;
								echo "</div>";
							}
						?>
						
						<br>
						<div class="row">
							<a class="btn btn-hgoe-red" href="./settings.php" style='width: 110px;'>Abbrechen</a>
							<button type="submit" class="btn btn-hgoe" style="margin-left: 15px; width: 110px;">Anlegen</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>