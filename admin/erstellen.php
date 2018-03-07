<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HGÖ - Veranstaltung erstellen</title>
    
    <!-- Bootstrap -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="./assets/css/hgoe.css" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<!-- Custom Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Armata" rel="stylesheet">

	<style>
		.hgoe-row {
			padding-bottom: 10px;
		}
	</style>
		
  </head>
  <body>
  <div class="container">
  <br><br><br><br>
  <div class="row">
  <div class="col-xs-offset-2 col-xs-12">
  	<div class="panel panel-hgoe text-center">
  	  <div class="panel-heading">
  	    <h3 class="panel-title">Veranstaltung Erstellen</h3>
      </div>
  	  <div class="panel-body">
  	  <div class = "table-condensed text-left">
		<div class="row hgoe-row">
			<div class="col-xs-4">
				<p>Name</p>
			</div>
			<div class="col-xs-8">
				<input type="text" id="ve_name" style="width:100%">
			</div>
		</div>
		<br>
 		<div class="row hgoe-row">
			<div class="col-xs-4">
				<p>Datum</p>
			</div>
			<div class="col-xs-8">
				<input type="date" id ="ve_date">
			</div>
		</div>
		<br>
		<div class="row hgoe-row">
			<div class="col-xs-4">
				<p>Beginn Anmeldefrist</p>
			</div>
			<div class="col-xs-8">
				<input type="date" id ="ve_frist_start">
			</div>
		</div>
		<div class="row hgoe-row">
			<div class="col-xs-4">
				<p>Ende Anmeldefrist</p>
			</div>
			<div class="col-xs-8">
				<input type="date" id ="ve_frist_end">
			</div>
		</div>
		<br>
		<div class="row hgoe-row">
			<div class="col-xs-4">
				<p>Stornierbar</p>
			</div>
			<div class="col-xs-8">
				<label class="radio-inline">
    				<input type="radio" name="optradio" id = "ve_opt_ja" onClick="setVisible()">Ja
    			</label>
   				<label class="radio-inline">
    				<input type="radio" name = "optradio" id = "ve_opt_nein" checked onClick="setVisible()">Nein
   				</label>
			</div>
		</div>
		<div class="row hgoe-row" style="display: none" id = "ve_stor">
			<div class="col-xs-4">
				<p>Ende Stornierungsfrist</p>
			</div>
			<div class="col-xs-8">
				<input type="date" id ="ve_stor_date">
			</div>
		</div>
		<!--<br id="br1" style="visibility: hidden">-->
		<!--<div id = "br1" style="display: none">
			<br>
		</div>-->
		<br>
		<div class="row hgoe-row">
			<div class="col-xs-4">
				<p>max. Anmeldungen</p>
			</div>
			<div class="col-xs-8">
				<input type = "number" id="ve_maxanm">
			</div>
		</div>
		</div>
 			
		<?php
		  	$testserver = true;
			$servername = "websql06.sprit.org";
			$username = "hgoe";
			$password = "hgvfz54RFG";
		  	$dbname = "hgoe_17";
		  	if($testserver == true){
				$servername = "db.marcputz.at";
			}
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			
		  	$sql = "INSERT INTO hgoe_konferenzen (Name, datum, beginnanmeldefrist, endeanmeldefrist)
				VALUES ('Test', '2000-01-01', '2000-01-01 00:00:00', '2000-01-01 11:59:00')";
		  	
		  	if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();
		  ?>
	  
  			<!--<tbody>

    			<tr>
   				  <td>Datum<br><br></td>
      			  <td><input type="date" id ="ve_date"><br><br></td>
    			</tr>
    			<tr>
   				  <td>Beginn Anmeldefrist</td>
      			  <td><input type="date" id ="ve_frist_start"></td>
    			</tr>
    			<tr>
   				  <td>Ende Anmeldefrist<br><br></td>
      			  <td><input type="date" id ="ve_frist_end"><br><br></td>
    			</tr>
    			<tr>
    				<td>Stornierbar</td>
   				  <td>
    					<label class="radio-inline">
    						<input type="radio" name="optradio" id = "ve_opt_ja" onClick="setVisible()">Ja
    					</label>
   					<label class="radio-inline">
    						<input type="radio" name = "optradio" id = "ve_opt_nein" checked onClick="setVisible()">Nein
   					  </label>
   					  <!-- <input type="checkbox" onClick="setVisible()" id="test" name="test"> -->
    				<!--</td>
    			</tr>
    			<tr style="display: none" id = "ve_stor">
    				<td>Ende Stornierungsfrist</td>
      			  	<td><input type="date" id ="ve_stor_date"></td>
    			</tr>
    			<tr>
    				<td><br><br>max. Anmeldungen</td>
    				<td><br><br><input type = "number" id="ve_maxanm"></td>
    			</tr>
    			
  			</tbody>
</table> -->
  	<br><br><br>
	  <button id="ve_btn" class="btn btn-hgoe" style="width: 180px;" onClick="test()">Erstellen</button>
 	  </div>
  	  <!-- <div class="panel-footer" >
		  <a class="text-success" id="ve_footer"></a> </div>
  	  </div> -->
  	  </div>
	  </div>
	  </div>
	  </div>

  <script>
	  
	function doButton(){
		//var v = Document.getElementById("ve_footer");
		Document.getElementById("ve_btn").class="btn btn-success";
	}
	  
	function setVisible(){
		if(document.getElementById("ve_opt_ja").checked == true){
			//document.getElementById("ve_stor_frist").style.visibility = "visible";
			//document.getElementById("ve_stor_label").style.visibility = "visible";
			
			//document.getElementById("br1").style.display = "inherit";
			
			document.getElementById("ve_stor").style.display = "inherit";
			
		}
		else{
			//document.getElementById("ve_stor_frist").style.visibility = "hidden";
			//document.getElementById("ve_stor_label").style.visibility = "hidden";
			
			//document.getElementById("br1").style.display = "none";
			
			document.getElementById("ve_stor").style.display = "none";
		}
	}
	  
  </script>
  
  <script>
		function test(){
			alert("Veranstaltung erfolgreich erstellt!");
		}
  </script>
  
  </body>
</html>