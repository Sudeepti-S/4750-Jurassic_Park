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
		//So long as the form items aren't empty
		if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
			//Items are correct
			if($_POST['username'] == Login_Tools::admin_username && $_POST['password'] == Login_Tools::admin_password) {
				//Set session parameters
				$_SESSION['valid'] = true;
				$_SESSION['timeout'] = time();
				$_SESSION['username'] = 'Admin';
	
				header("Location: landing.php");
			}
			
			elseif($_POST['username'] == Login_Tools::ranger_username && $_POST['password'] == Login_Tools::ranger_password) {
				//Set session parameters
				$_SESSION['valid'] = true;
				$_SESSION['timeout'] = time();
				$_SESSION['username'] = 'Ranger';
	
				header("Location: landing.php");
			}
			
			elseif($_POST['username'] == Login_Tools::scientist_username && $_POST['password'] == Login_Tools::scientist_password) {
				//Set session parameters
				$_SESSION['valid'] = true;
				$_SESSION['timeout'] = time();
				$_SESSION['username'] = 'Scientist';
	
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
		Login_Tools::SessionData($_SESSION);
	?>
	</body>
</html>