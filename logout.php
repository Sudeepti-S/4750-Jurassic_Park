<!--From https://www.tutorialspoint.com/php/php_login_example.htm -->
<?php 
	session_start();
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['valid']);
	
	echo 'Logged out';
	header('Location: login.php');
?>