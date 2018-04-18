<script>
<?php
	$config = include('../config.php');
	session_start();

	//Für Testzwecke ggf. auskommentieren
	if(!isset($_SESSION['user'])) {
		header("location: ../login.php");
		exit();
	}

	if(isset($_GET['save'])) {
		//save to $config
		
		if(isset($_GET['database'])) {
			$config['db_host'] = $_POST['dbHostTF'];
			$config['db_user'] = $_POST['dbUserTF'];
			$config['db_password'] = $_POST['dbPassTF'];
			$config['db_schema'] = $_POST['dbSchemaTF'];
		}
		if(isset($_GET['kontodaten'])) {
			$config['iban'] = $_POST['ibanTF'];
			$config['bic'] = $_POST['bicTF'];
		}
		
		file_put_contents('../config.php', "<?php return " . substr(var_export($config, true), 0, strlen(var_export($config, true)) - 3) . "); ?>");
		
		if(isset($_GET['database'])) {
			//user database changed, so logout
			header('location: ../logout.php');
			exit;
		}
	}
	
	if(isset($_GET['backup_del'])) {
		$filename = $_GET['backup_del'];
		echo "console.log('Datei " . $filename . " wird gesucht...');";
		if(file_exists("./backups/" . $filename)) {
			echo "console.log('Datei " . $filename . " wurde gefunden');";
			unlink("./backups/" . $filename);
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
				<div class="panel-body text-center">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xs-6 text-left"><h4>Benutzerkonten</h4></div>
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
								echo "<div class='row row-hgoe text-left' style='margin-bottom: 0px;'>";
								echo "	<div class='col-xs-12'>Fehler beim Herstellen der Datenbank-Verbindung</div>";
								echo "</div>";
							} 

							$sql = "SELECT * FROM hgoe_17.hgoe_user";
							$result = $conn->query($sql);

							if($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									$username = $row['username'];
									$administrator = $row['administrator'];

									echo "<div class='row row-hgoe text-left' style='margin-bottom: 0px;'>";

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
						
						<br>
						<div class="container-fluid" style="margin: 5px;">
							<div class="row">
								<div class="col-xs-12">
									<h4>Kontodaten</h4>
									<p>Diese Daten werden dem User bei der Anmeldung angezeigt</p>
								</div>
							</div>
							<form action="?save=1&kontodaten=1" method="post">
								<div class="row">
									<div class="col-xs-4 text-right">IBAN: </div>
									<div class="col-xs-8 text-left"><input type="text" name="ibanTF" style="width: 90%" value='<?php echo $config['iban']; ?>'></div>
								</div>
								<div class="row">
									<div class="col-xs-4 text-right">BIC: </div>
									<div class="col-xs-8 text-left"><input type="text" name="bicTF" style="width: 90%" value='<?php echo $config['bic']; ?>'></div>
								</div>
								<div class="row">
									<div class="col-xs-12"><button class="btn btn-hgoe" type="submit" style="margin-top: 5px; width: 150px;">Speichern</button></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<div class="panel panel-hgoe <?php
				//add the class 'hide' if user is not an admin
				if($_SESSION['admin'] != 1) {
					echo "hide";
				}
			?>" style='margin-top: 10px;'>
				<div class="panel-heading" id="advancedSettingsPanelHeading">
					<h3 class="panel-title" style="font-weight: bold;">Erweiterte Einstellungen</h3>
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
						<div class="row">
							<div class="col-xs-12">
								<h4>Datenbank</h4>
								<p>Hier kann die Datenbank für den Fall einer Datenbank-Migration geändert werden. Diese Einstellung sollte NUR von einem Administrator vorgenommen werden</p>
							</div>
						</div>
						<form action="?save=1&database=1" method="post">
							<div class="row">
								<div class="col-xs-4 text-right">Server: </div>
								<div class="col-xs-8 text-left"><input type="text" name="dbHostTF" style="width: 90%" value='<?php echo $config['db_host']; ?>'></div>
							</div>
							<div class="row">
								<div class="col-xs-4 text-right">DB-User: </div>
								<div class="col-xs-8 text-left"><input type="text" name="dbUserTF" style="width: 90%" value='<?php echo $config['db_user']; ?>'></div>
							</div>
							<div class="row">
								<div class="col-xs-4 text-right">DB-Passwort: </div>
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
					
					<div class="container-fluid" style="margin: 5px;">
						<div class="row">
							<div class="col-xs-12">
								<h4>Backups</h4>
								<p>Hier können Sie alle Daten des Konferenztools sichern</p>
							</div>
						</div>
						<span>
							<!-- BACKUP LISTE -->
							<div style='border: 2px solid black; margin: 0px; padding: 0px; margin-left: 10%; width: 80%;' class="text-left">
							<?php
								$files = array_diff(scandir("./backups"), array('..', '.', '.DS_Store'));

								foreach($files as $key => $file) {
									echo "<div class='row row-hgoe' style='border-bottom: 2px solid #AAA; margin: 0px; background-color: #DDD;'>";
									echo "	<div class='col-xs-7 col-sm-9' style='border-width: 0px;'>" . substr($file, 7) . "</div>";
									echo "	<div class='col-xs-5 col-sm-3 text-right' style='border-width: 0px;'><a class='btn btn-hgoe' style='height: 20px; line-height: 8px; font-size: 12px; margin-right: 5px;' title='Wiederherstellen' disabled='disabled'><img src='../assets/img/restore_icon.svg' style='height: 16px; margin-top: -5px;'></a>";
									echo "		<a href='?backup_del=" . $file . "' class='btn btn-hgoe-red' title='Löschen' style='height: 20px; line-height: 8px; font-size: 12px;'><img src='../assets/img/delete_icon.svg' style='height: 16px; margin-top: -5px;'></a></div>";
									echo "</div>";
								}
								
								if (!$files || empty($files)) {
								 	echo "<div class='row row-hgoe' style='border-bottom: 2px solid #AAA; margin: 0px; background-color: #DDD;' data-toggle='collapse'>";
									echo "	<div class='col-xs-12' style='border-width: 0px;'>" . "Keine Backups gefunden" . "</div>";
									echo "</div>";
								}
							?>
							</div>
							<a type='submit' class='btn btn-hgoe' style='margin-top: 15px;' href="./backup_erstellen.php">Backup erstellen</a>
						</span>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>