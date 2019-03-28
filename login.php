<!--From https://www.tutorialspoint.com/php/php_login_example.htm -->
<?php
	include("login_tools.php");
	ob_start();
	session_start();
	error_reporting(E_ALL);
	ini_set("display_errors",1);
	?>
<html>
	<head>
		<title> LOGIN </title>
	</head>
	<body>
	<?php
		$msg = '';
		$user = 'admin';
		$pass = 'pass';
		//So long as the form items aren't empty
		if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
			//Items are correct
			if($_POST['username'] == $user && $_POST['password'] == $pass) {
				//Set session parameters
				$_SESSION['valid'] = true;
				$_SESSION['timeout'] = time();
				$_SESSION['username'] = 'Person';
				
				header("Location: landing.php");
			}
			//Incorrect
			else { 
				$msg = 'Incorrect parameters';
			}
		}
	?>
	
	<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
		<h4>MESSAGE <?php echo $msg;?></h4>
		<input type="text" name="username" placeholder = "USERNAME" required autofocus>
		<input type="password" name="password" required>
		<button type="submit" name="login">Login</button>
	</form>
	<?php
		SessionData($_SESSION);
	?>
	</body>
</html>