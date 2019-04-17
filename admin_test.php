<!--LOGIN HEADER-->
<link type="text/css" rel="stylesheet" href="styles/main.css" /> 
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
	Login_Tools::RestrictAccess($_SESSION['username'],'Admin','Ranger');
?>
<!--END LOGIN HEADER-->
<html>
	<head>
		<title>Admin Only Test</title>
	</head>
	<body>
	<h1>Scientists should not be able to be here.</h1>
	<form action="admin_print.php" method="post">
		<input type="hidden" name="pinfo" value="1">
		<p><input type="Submit" value="Grab Info"></p>
	</form>
	</body>
</html>
