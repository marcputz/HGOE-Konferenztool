<?php
	$config = include('../config.php');
	session_start();

	//Für Testzwecke ggf. auskommentieren
	/*if(!isset($_SESSION['user'])) {
		header("location: login.php");
		exit();
	}*/
?>

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
		
		<title>HGÖ - Einstellungen</title>
	</head>

	<body>
		<!-- content -->
		<div class="container text-center" style="max-width: 768px">
			<a class="btn btn-hgoe" href="../start.php" style="margin-top: 20px; margin-bottom: -5px; width: 230px;"><img src="../assets/img/arrow_back.svg" style="height: 32px; margin: -10px; margin-right: 8px; margin-top: -12px;">Zurück zur Startseite</a>
			<div class="panel panel-hgoe" style="margin-top: 25px;">
				<div class="panel-heading">
					<h2>Einstellungen</h2>
				</div>
				<div class="panel-body text-left">
					<div>
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
									die("Connection failed: " . $conn->connect_error);
								} 

								$sql = "SELECT * FROM hgoe_17.hgoe_user";
								$result = $conn->query($sql);
							
								if($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										$username = $row['username'];
										$administrator = $row['administrator'];
										
										echo "<div class='row row-hgoe'>";
										
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>