<!--LOGIN HEADER-->
<link type="text/css" rel="stylesheet" href="styles/main.css" /> 
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
?>
<!--END LOGIN HEADER-->

<html>
	<head>
		<title>WELCOME</title>
	</head>
	<body>
	<center><h1>WELCOME</h1></center>
	</br>
	<center><a href="dinosaurs.php"><font color=white>Dinosaurs</font></a></center>
	</br>
	<center><a href="rangers.php"><font color=white>Rangers</font></a><center>
	</br>
	<center><a href="scientist.php"><font color=white>Scientists</font></a></center>
	</br>
	<center><a href="location.php"><font color=white>Locations</font></a></center>
	</br>
	<center><a href="visitor.php"><font color=white>Visitors</font></a></center>
	</br>
	<center><a href="export.php"><font color=white>JSON Export</font></a></center>
	</br>
	<center><a href="logout.php"><font color=white>Logout</font></a></center>
	</body>
</html>
