<!--LOGIN HEADER-->
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
	</body>
</html>
