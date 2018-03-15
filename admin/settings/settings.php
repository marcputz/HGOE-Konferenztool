<script>
<?php
	$config = include('../config.php');
	session_start();

	//Für Testzwecke ggf. auskommentieren
	/*if(!isset($_SESSION['user'])) {
		header("location: login.php");
		exit();
	}*/

	if(isset($_GET['save'])) {
		//save to $config
		
		if(isset($_GET['color'])) {
			if($_GET['color'] == 'blue') {
				$config['color_secondary'] = '#7EAED5';
				$config['color_primary'] = '#0F6DBB';
				$config['color_background'] = '#B8DBFF';
				$config['color_selected'] = '#191F6D';
				$config['color_button'] = '#1C8BFF';
			}
			if($_GET['color'] == 'green') {
				$config['color_secondary'] = '#7CCE7B';
				$config['color_primary'] = '#18830E';
				$config['color_background'] = '#D7F8DA';
				$config['color_selected'] = '#196D38';
				$config['color_button'] = '#14B312';
			}
			if($_GET['color'] == 'yellow') {
				$config['color_secondary'] = '#D5D676';
				$config['color_primary'] = '#B0AF1B';
				$config['color_background'] = '#FDFBC8';
				$config['color_selected'] = '#5E610F';
				$config['color_button'] = '#C5C20B';
			}
			if($_GET['color'] == 'orange') {
				$config['color_secondary'] = '#D3B471';
				$config['color_primary'] = '#BE7C02';
				$config['color_background'] = '#FDE4C8';
				$config['color_selected'] = '#61480E';
				$config['color_button'] = '#C2840D';
			}
		}
		
		if(isset($_GET['database'])) {
			$config['db_host'] = $_POST['dbHostTF'];
			$config['db_user'] = $_POST['dbUserTF'];
			$config['db_password'] = $_POST['dbPassTF'];
			$config['db_schema'] = $_POST['dbSchemaTF'];
		}
		
		file_put_contents('../config.php', "<?php return " . substr(var_export($config, true), 0, strlen(var_export($config, true)) - 3) . "); ?>");
		
		if(isset($_GET['database'])) {
			//user database changed, so logout
			header('location: ../logout.php');
			exit;
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
		
		<title>HGÖ - Einstellungen</title>
		
		<style>
			.row {
				margin-bottom: 8px;
			}
			
			.square {
				width: 60px;
				height: 60px;
				
				border-style: solid;
				border-color: black;
				border-width: 2px;
				display: inline-block;
				line-height: 55px;
				margin: 5px;
			}
		</style>
	</head>

	<body>
		<!-- content -->
		<div class="container text-center" style="max-width: 768px">
			<a class="btn btn-hgoe" href="../start.php" style="margin-top: 20px; margin-bottom: -5px; width: 230px;"><img src="../assets/img/arrow_back.svg" style="height: 32px; margin: -10px; margin-right: 8px; margin-top: -12px;">Zurück zur Startseite</a>
			<div class="panel panel-hgoe" style="margin-top: 25px;">
				<div class="panel-heading">
					<h3 class="panel-title" style="font-weight: bold">Einstellungen</h3>
				</div>
				<div class="panel-body text-left">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xs-6"><h4>Benutzerkonten</h4></div>
							<div class="col-xs-6 text-right"><?php
								if($_SESSION['admin'] == 1) {
									echo "<a class='btn btn-hgoe' style='width: 100%; max-width: 150px;' href='./user_anlegen.php'>Neuer Nutzer</a>";
								}
							?></div>
						</div>
						<?php
							$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);

							// Check connection
							if ($conn->connect_error) {
								echo "<div class='row row-hgoe' style='margin-bottom: 0px;'>";
								echo "	<div class='col-xs-12'>Fehler beim Herstellen der Datenbank-Verbindung</div>";
								echo "</div>";
							} 

							$sql = "SELECT * FROM hgoe_17.hgoe_user";
							$result = $conn->query($sql);

							if($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									$username = $row['username'];
									$administrator = $row['administrator'];

									echo "<div class='row row-hgoe' style='margin-bottom: 0px;'>";

									$str = "	<div class='col-xs-5'>" . $username;
									if($administrator == 1) {
										$str .= " <font color='green'>[Administrator]</font>";
									}
									if($_SESSION['user'] == $username) {
										$str .= " <font color='orange'>[Dieser User]</font>";
									}

									echo $str . "</div>";
									echo "	<div class='col-xs-7 text-right'>";

									//When is admin or when is this user, enable the password change
									if($_SESSION['admin'] == 1 || $username == $_SESSION['user']) { 
										echo "		<a href='./passwort_aendern.php?user=" . $username . "'>Passwort ändern</a>";
									}

									//when is not last user AND admin, but not this user, enable delete option
									if($result->num_rows > 1 && $_SESSION['admin'] == 1 && $_SESSION['user'] != $username) {
										echo "		<a href='./script_user_loeschen.php?user=" . $username . "' style='margin-left: 15px; color:red;'>Löschen</a>";
									}

									echo "	</div>";
									echo "</div>";
								}
							} else {
								//keine Benutzer --> FATAL ERROR --> Anmeldung nicht mehr möglich
							}
						?>
						
						<br><br>
						<div class="row">
							<div class="col-xs-12"><h4>Farbwahl</h4></div>
						</div>
						<div class="row">
							<form>
								<div class="col-xs-12 text-center" style='inline'>
									<div class="square" id="colorBlue" style='background-color: #1324DE; color: white;'>Blau</div>
									<div class="square" id="colorGreen" style='background-color: #069100; color: white;'>Grün</div>
									<div class="square" id="colorYellow" style='background-color: #D5EA09;'>Gelb</div>
									<div class="square" id="colorOrange" style='background-color: #EA9E08;'>Orange</div>
								</div>
								<script>
									$("#colorBlue").click( function() {
										window.location = './settings.php?save=1&color=blue';
									});
									$("#colorGreen").click( function() {
										window.location = './settings.php?save=1&color=green';
									});
									$("#colorYellow").click( function() {
										window.location = './settings.php?save=1&color=yellow';
									});
									$("#colorOrange").click( function() {
										window.location = './settings.php?save=1&color=orange';
									});
								</script>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel panel-hgoe" style='margin-top: 10px;'>
				<div class="panel-heading" id="advancedSettingsPanelHeading">
					<h3 class="panel-title" style="font-weight: bold;">Erweiterte Entwickler-Einstellungen</h3>
				</div>
				<script>
					$("#advancedSettingsPanelHeading").click( function() {
						$("#advancedSettingsPanel").toggleClass('hide');
					});
					$(document).ready( function() {
						$("#advancedSettingsPanel").addClass('hide');
					});
				</script>
				<div class="panel-body" id="advancedSettingsPanel">
					<div class="container-fluid" style="margin: 5px;">
						<div class="row"><div class="col-xs-12"><h4>Datenbank</h4></div></div>
						<form action="?save=1&database=1" method="post">
							<div class="row">
								<div class="col-xs-4 text-right">Server: </div>
								<div class="col-xs-8 text-left"><input type="text" name="dbHostTF" style="width: 90%" value='<?php echo $config['db_host']; ?>'></div>
							</div>
							<div class="row">
								<div class="col-xs-4 text-right">User: </div>
								<div class="col-xs-8 text-left"><input type="text" name="dbUserTF" style="width: 90%" value='<?php echo $config['db_user']; ?>'></div>
							</div>
							<div class="row">
								<div class="col-xs-4 text-right">Passwort: </div>
								<div class="col-xs-8 text-left"><input type="password" name="dbPassTF" style="width: 90%" value='<?php echo $config['db_password']; ?>'></div>
							</div>
							<div class="row">
								<div class="col-xs-4 text-right">Schema: </div>
								<div class="col-xs-8 text-left"><input type="text" name="dbSchemaTF" style="width: 90%" value='<?php echo $config['db_schema']; ?>'></div>
							</div>
							<div class="row">
								<div class="col-xs-12"><button class="btn btn-hgoe" type="submit" style="margin-top: 5px; width: 150px;">Speichern</button></div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>