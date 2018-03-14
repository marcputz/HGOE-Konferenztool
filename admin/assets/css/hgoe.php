<?php 
	header("Content-type: text/css"); 

	$config = include("../../config.php");
?>

body {
	background-color: <?php echo $config['color_background']; ?>;
}

.btn-hgoe {
	box-shadow: 0px 0px 4px rgba(0,0,0,0.6);
	color: white;
	background-color: <?php echo $config['color_button']; ?>;
	font-weight: bold;
	border-style: solid;
	border-width: 1px;
	border-color: <?php echo $config['color_primary']; ?>;
}
.btn-hgoe:hover {
	filter: brightness(80%);
	color: white;
}

.btn-hgoe-red {
	box-shadow: 0px 0px 4px rgba(0,0,0,0.6);
	color: white;
	background-color: #C90003; 
	border-color: #B40002;
	font-weight: bold;
	border-style: solid;
	border-width: 1px;
}
.btn-hgoe-red:hover {
	background-color: #B40002;
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
}
.btn-hgoe-grey:hover {
	background-color: #858585;
	color: black;
}

.panel-hgoe {
	background-color: <?php echo $config['color_secondary']; ?>;
}
.panel-hgoe>.panel-heading {
	color:#fff;
	background-color: <?php echo $config['color_primary']; ?>;
	border-color: #000000;
}
.panel-hgoe>.panel-heading+.panel-collapse .panel-body {
	border-top-color: #000000;
}

/* Main-Page Table Row */

.row-hgoe {
	background-color: #EEEEEE;
	border-bottom-style: dashed;
	border-width: 1px;
	border-color: black;
	margin-right: 2px;
	margin-left: 2px;
	display: flex;
	flex-wrap: wrap;
}

.row-hgoe:hover {
	background-color: white;
}

.row-hgoe:active {
	background-color: <?php echo $config['color_selected']; ?>;
	color: white;
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
	background-color: <?php echo $config['color_secondary']; ?>;
	border-bottom-style: solid;
	border-bottom-width: 1px;
	border-bottom-color: black;
	box-shadow: 0px 0px 5px rgba(0,0,0, 0.8);
}
.navbar-hgoe .navbar-header .navbar-toggle {
	background-color: <?php echo $config['color_primary']; ?>;
}
.navbar-hgoe .navbar-header .navbar-toggle .icon-bar {
	background-color: white;
}
.navbar-hgoe .navbar-collapse ul li a {
	color: black
}
.navbar-hgoe .navbar-collapse ul li:hover a {
	color: white;
}

/* SIZE DEPENDENT */

@media (max-width: 768px) { /* xs */ 
	.row-hgoe [class^='col'] {
		margin-left: -1px;
	}
}

@media (min-width: 768px) { /* sm & bigger */
  .menuBarItem {
	font-size:18px;
	height:150px;
	width:150px;
	margin-bottom: 15px;
	margin-top: 12px;
	padding-top: 15px;
  }
}

@media (min-width: 992px) { /* md & bigger */
  .menuBarItem {
	font-size: 20px;
	height:170px;
	width:170px;
	margin-bottom: 20px;
	margin-top: 15px;
	padding-top: 20px;
  }
}

@media (min-width: 1200px) { /* lg & bigger */ }