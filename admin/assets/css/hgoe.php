/*
<style>
Used for proper display in Adobe Dreamweaver CC
*/

<?php 
	header("Content-type: text/css"); 

	$config = include("../../config.php");
?>

body {
	background-image: url("../img/background.jpg");
	background-size: cover;
	background-repeat:no-repeat;
}

a:hover, a:visited, a:link, a:active {
    text-decoration: none;
}

.seperator {
	background-color: #8D8D8D;
	width: 90%;
	height: 1pt;
	margin-left: 5%;
	margin-right: 5%;
}
	
.vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
  min-height: 100vh; /* These two lines are counted as one :-)       */

  display: flex;
  align-items: center;
}
	
.box {
	background-color: #E5E5E5;
	box-shadow: 2px 2px 10px rgba(0,0,0, 0.6);
	
	-webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
}	
	
input[type=text], input[type=password], input[type=date], input[type=email], input[type=number], input[type=datetime], textarea {
	-webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
}
	
input[type=search] {
	-webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
}
	
.btn-hgoe {
	box-shadow: 0px 0px 4px rgba(0,0,0,0.6);
	color: white;
	background-color: #1C8BFF;
	font-weight: bold;
	border-style: solid;
	border-width: 1px;
	border-color: <?php echo $config['color_primary']; ?>;
	
	-webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
}
.btn-hgoe:hover {
	background-color: #0E64BD;
	color: white;
}

.btn-hgoe-red {
	box-shadow: 0px 0px 4px rgba(0,0,0,0.6);
	color: white;
	background-color: #C90003; 
	border-color: #B40002;
	border-style: solid;
	border-width: 1px;
	font-weight: bold;
	
	-webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
}
.btn-hgoe-red:hover {
	background-color: #9D0001;
	color: white;
}

.btn-hgoe-grey {
	box-shadow: 0px 0px 4px rgba(0,0,0,0.6);
	color: black;
	background-color: #BDBDBD; 
	border-color: #858585;
	font-weight: bold;
	border-style: solid;
	border-width: 1px;
	
	-webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
}
.btn-hgoe-grey:hover {
	background-color: #9D9D9D;
	color: black;
}

.panel-hgoe {
	background-color: #FFFFFF;
	box-shadow: 2px 2px 10px rgba(0,0,0, 0.6);
	
	-webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
}
.panel-hgoe>.panel-heading {
	color: #000000;
	background-color: #E5E5E5;
	border-color: #E5E5E5;

	-webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
}
.panel-hgoe>.panel-heading+.panel-collapse .panel-body {
	border-top-color: #000000;
}

/* Main-Page Table Row */

.row-hgoe {
	background-color: #E1E1E1;
	color: black;
	
	border-bottom-color: black;
	border-bottom-style: solid;
	border-bottom-width: 1pt;
		
	margin-right: 2px;
	margin-left: 2px;
	display: flex;
	flex-wrap: wrap;
}

.row-hgoe:hover {
	background-color: #B8C0D8;
}

.row-hgoe:active {
	background-color: <?php echo $config['color_selected']; ?>;
}

.row-hgoe [class^='col'] {
	border-right-style: solid;
	border-left-style: solid;
	border-color: grey;
	border-width: 1px;
	padding-top: 10px;
	padding-bottom: 10px;
	word-wrap: break-word;
}

/* NAVBAR */

.navbar-hgoe {
	background-color: #E5E5E5;
	
	box-shadow: 0px 1px 10px rgba(0,0,0, 0.6);
	
	-webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
}
.navbar-hgoe .navbar-header .navbar-toggle {
	background-color: <?php echo $config['color_primary']; ?>;
}
.navbar-hgoe .navbar-header .navbar-toggle .icon-bar {
	background-color: white;
}
.navbar-hgoe .navbar-collapse {
	border-top-color: black;
	border-top-width: 1px;
	border-top-style: solid;
}
.navbar-hgoe .navbar-collapse ul li a {
	color: black;
}
.navbar-hgoe .navbar-collapse ul li:hover a {
	color: white;
}

.big-btn {
	background-color: white;
	box-shadow: 2px 2px 10px rgba(0,0,0, 0.6);
	color: black;
	
	display: inline-block;
	white-space:nowrap;
	vertical-align:middle;
	cursor:pointer;
	
	-webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
}
.big-btn:hover p {
	color: black;
    text-decoration: none;
}
	
/* SIZE DEPENDENT */

@media (max-width: 768px) { /* xs */ 
	.row-hgoe [class^='col'] {
		margin-left: -0.5px;
	}
}

@media (min-width: 768px) { /* sm & bigger */
  .big-btn {
	font-size:18px;
	height:150px;
	width:150px;
	margin-bottom: 15px;
	margin-top: 12px;
	padding-top: 15px;
  }
}

@media (min-width: 992px) { /* md & bigger */
  .big-btn {
	font-size: 20px;
	height:170px;
	width:170px;
	margin-bottom: 20px;
	margin-top: 15px;
	padding-top: 20px;
  }
}

@media (min-width: 1200px) { /* lg & bigger */ }