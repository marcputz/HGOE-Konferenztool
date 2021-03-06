<?php 
session_start();
$config = include('./config.php');
 
//Executed when 'LOGIN'-Button pressed
if(isset($_GET['login'])) {
	$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_schema']);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
    $usernameEntered = (isset($_POST['username'])) ? $_POST['username'] : 'empty';
    $passwordEntered = (isset($_POST['password'])) ? $_POST['password'] : 'empty';
	echo "<script> console.log('MD5-Hash of entered password: " . hash('sha256', $passwordEntered) . "'); </script>";
	
	$sql = "SELECT * FROM hgoe_17.hgoe_user WHERE username like '" . $usernameEntered . "'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		//user found
		while($row = $result->fetch_assoc()) {
			$username = $row['username'];
			$administrator = $row['administrator'];
			
			//check password
			$passwordHash = $row['password'];
			if($passwordHash == hash('sha256', $passwordEntered)) {
				//password correct
				$_SESSION['user'] = $username;
				$_SESSION['admin'] = $administrator;
        		die('<script> window.location = "start.php"; </script>');
			} else {
				$errorMessage = "Das Passwort ist nicht korrekt!";
			}
		}
	} else {
		$errorMessage = "Dieser Benutzer existiert nicht!";
	}
}
?>

<!DOCTYPE html> 
<html> 
	<head>
		<script>
			if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) {
				//Internet Explorer detected
				
				if(!confirm("ACHTUNG: Sie verwenden den Internet Explorer.\n\nDieser Browser unterstützt nicht alle modernen Technologien die auf diesem Web-Tool verwendet werden. Deshalb wird empfohlen, auf einen anderen Browser (Google Chrome, Mozilla Firefox, ...) umzusteigen, um optimale Performance zu gewährleisten.\n\nKlicken Sie 'OK' falls Sie trotzdem zur Website fortfahren wollen.")) {
					window.location = 'http://www.hgoe-burgenland.at';
				}
			}  
		</script>
		
		<title>HGÖ - Login</title>
		
		<meta charset="UTF-8">
		<meta name="author" content="Marc Putz">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
		<meta name="robots" content="noindex,nofollow">
		<meta name="revised" content="Marc Putz, 03/12/2017">
		
		<!-- Bootstrap & jQuery -->
		<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/hgoe.php" type="text/css">
		<script src="./assets/jquery.min.js"></script>
		
		<!-- Custom Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">
	</head> 
	
	<body style="font-family: Open Sans, Arial, sans-serif;">
		<div class="container vertical-center" style="max-width: 500px;">
			<div class="panel panel-hgoe">
				<div class="panel-heading text-center" style="font-size: 18px; font-family: Armata, Times New Roman, serif;">
					HGÖ - Login
				</div>
				<div class="panel-body text-center">
					<form action="?login=1" method="post">
						<div class="row">
							<div class="col-xs-5 text-right" style='line-height: 24px;'><b>Nutzername:</b></div>
							<div class="col-xs-7 text-left"><input type="text" size="40" maxlength="250" name="username" style="width: 100%; max-width: 300px;"></div>
						</div>
						<div class="row" style="margin-top: 10px;">
							<div class="col-xs-5 text-right" style='line-height: 24px;'><b>Passwort:</b></div>
							<div class="col-xs-7 text-left"><input type="password" size="40"  maxlength="250" name="password" style="width: 100%; max-width: 300px; "></div>
						</div>
						
						<?php 
							if(isset($errorMessage)) {
								echo "<br><br>";
								echo "<div style='margin-bottom: 0px; color: red;'>";
								echo $errorMessage . "<br><br>";
								echo "</div>";
							}
						?>
						
						<br>
						<input type="submit" class="btn btn-hgoe" value="Einloggen">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>