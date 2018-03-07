<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anmeldung Erfolgreich</title>
    <!-- Bootstrap -->
	<link href="admin/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="admin/assets/css/hgoe.css" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
	<!-- Custom Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">
  </head>

<body>
	<div class="container text-center">
		<div class="panel panel-hgoe" style="margin-top: 30px; padding-bottom: 15px;">
			<div class="panel-body">
				<h1 style="color: white;">Anmelden erfolgreich!</h1>
				<p><b>Sie haben sich erfolgreich zur Veranstaltung <?php
					
					if(isset($_GET["id"])) {
						$id = $_GET["id"];
						
						$servername = "websql06.sprit.org";
						$username = "hgoe";
						$password = "hgvfz54RFG";
						$dbname = "hgoe_17";

						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);

						// Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}
						
						$sql = "SELECT Name FROM hgoe_konferenzen WHERE KonferenzID = " . $id . ";";
						
						$result = $conn->query($sql);
						if($result->num_rows > 0) {
							$name = "Unbekannte Veranstaltung";
							while($row = $result->fetch_assoc()) {
								$name = $row["Name"];
							}
							echo "</b>" . $name . " <b>";
						}
					}
				?> angemeldet</b></p>
				
				<a href="http://www.hgoe-burgenland.at/" class="btn btn-hgoe" style="width: 225px; margin-top: 20px;">Zurück zur Startseite</a>
			</div>
		</div>
	</div>
</body>
</html>
