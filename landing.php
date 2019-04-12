<!--LOGIN HEADER-->
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
	<h1>WELCOME</h1>
	</br>
	<a href="dinosaurs.php">Dinosaurs</a>
	</br>
	<a href="rangers.php">Rangers</a>
	</br>
	<a href="scientist.php">Scientists</a>
	</br>
	<a href="location.php">Locations</a>
	</br>
	<a href="visitor.php">Visitors</a>
	</br>
	<a href="export.php">JSON Export</a>
	</br>
	<a href="logout.php">Logout</a>
	</body>
</html>
