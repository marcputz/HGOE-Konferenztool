<?php 
session_start();

$username = 'admin';
$password = 'admin';
 
if(isset($_GET['login'])) {
    $usernameEntered = (isset($_POST['username'])) ? $_POST['username'] : 'empty';
    $passwordEntered = (isset($_POST['password'])) ? $_POST['password'] : 'empty';
        
    //Überprüfung des Passworts
    if ($usernameEntered == $username && $passwordEntered == $password) {
        $_SESSION['user'] = $username;
        die('<script> window.location = "start.php"; </script>');
    } else {
        $errorMessage = "Nutzername oder Passwort war ungültig<br><br>";
    }
    
}
?>

<!DOCTYPE html> 
<html> 
	<head>
		<title>Login</title>
		
		<meta charset="UTF-8">
		<meta name="author" content="Marc Putz">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
		<meta name="robots" content="noindex,nofollow">
		<meta name="revised" content="Marc Putz, 03/08/2017">
		
		<!-- Bootstrap & jQuery -->
		<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="./assets/css/hgoe.css" type="text/css">
		<script src="./assets/jquery.min.js"></script>
		
		<!-- Custom Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">
	</head> 
	
	<body style="font-family: Open Sans, Arial, sans-serif;">
		
		<div class="container" style="max-width: 500px; margin-top: 30px;">
			<div class="panel panel-hgoe">
				<div class="panel-heading text-center" style="font-size: 18px; font-family: Armata, Times New Roman, serif;">
					HGÖ - Login
				</div>
				<div class="panel-body text-center">
					<form action="?login=1" method="post">
						<div class="row">
							<div class="col-xs-5 text-right"><b>Nutzername:</b></div>
							<div class="col-xs-7 text-left"><input type="username" size="40" maxlength="250" name="username" style="width: 100%; max-width: 300px;"></div>
						</div>
						<div class="row" style="margin-top: 10px;">
							<div class="col-xs-5 text-right"><b>Passwort:</b></div>
							<div class="col-xs-7 text-left"><input type="password" size="40"  maxlength="250" name="password" style="width: 100%; max-width: 300px; "></div>
						</div>
						
						<?php 
							if(isset($errorMessage)) {
								echo "<br><br>";
								echo "<div style='margin-bottom: 0px; color: red;'>";
								echo $errorMessage;
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