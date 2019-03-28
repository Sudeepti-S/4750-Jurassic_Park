<!--LOGIN HEADER-->
<?php
	include("login_tools.php");
	session_start();
	CheckLogin($_SESSION['username']);
?>
<!--END LOGIN HEADER-->

<html>
	<head>
		<title>WELCOME</title>
	</head>
	<body>
	<h1>WELCOME</h1>
	</body>
</html>
