<?php
	class Login_Tools{
		//Bunch of DB variables for DB login purposes.
		private static $login_admin = 'ss9ud_a';
		private static $login_ranger = 'ss9ud_b';
		private static $login_science = 'ss9ud_c';
		
		private static $login_pass = 'rice';
		private static $host = 'mysql.cs.virginia.edu';
		private static $schema = 'ss9ud';
		
		//Session login fields.
		private static $users = array('Admin','Ranger','Scientist');
		
		//Login data. 
		const admin_username = 'admin';
		const admin_password = 'pass';
		
		const ranger_username = 'ranger';
		const ranger_password = 'pass';
		
		const scientist_username = 'scientist';
		const scientist_password = 'pass';
		
		
		// Use this like a decorator for pages that require a login.
		public static function CheckLogin($session) {
			$logged_in = False;
			if($session['valid'] != 1) { //Force redirect to logout if invalid.
				header("Location: logout.php");
			}
			
			foreach(Login_Tools::$users as $u) { //Check all usernames against provided username
				if($session['username'] == $u) {
					$logged_in = True;
					break;
				}
			}
		
			if($logged_in) { //User is logged in? Do nothing.
				return;
			}
			else{ //Not logged in? Redirect to the login page.
				header("Location: login.php"); 
			}
		}
		public static function SessionData($session) {
			foreach($session as $val1 => $val2) {
				echo $val1 . " = " . $val2;
				echo "</br>";
			}
		}
		
		//DB Logins. ALWAYS USE THE LOWER ACCESS LEVEL WHEN MULTIPLE USER TYPES CAN REACH THE PAGE.
		//Login for Admin specific access.
		public static function DBADMIN_Login() {
			$db = new mysqli(Login_Tools::$host,Login_Tools::$login_admin,Login_Tools::$login_pass,Login_Tools::$schema);
			if($db->connect_errno){
				echo("Failed to connect to Database");
				$db->close();
				exit();
			}
			return $db;
		}
		
		//Login for Ranger specific access.
		public static function DBRANGER_Login() {
			$db = new mysqli(Login_Tools::$host,Login_Tools::$login_ranger,Login_Tools::$login_pass,Login_Tools::$schema);
			if($db->connect_errno){
				echo("Failed to connect to Database");
				$db->close();
				exit();
			}
			return $db;
		}
		
		//Login for Scientist specific access.
		public static function DBSCIENCE_Login() {
			$db = new mysqli(Login_Tools::$host,Login_Tools::$login_science,Login_Tools::$login_pass,Login_Tools::$schema);
			if($db->connect_errno){
				echo("Failed to connect to Database");
				$db->close();
				exit();
			}
			return $db;
		}
		
		//Allow only certain user types to access this page. Redirect to landing otherwise.
		//USAGE: RestrictAccess($_SESSION['username'],<USERTYPE>,<USERTYPE>...)
		public static function RestrictAccess() {
			$argc = func_num_args();
			if($argc <= 1){ //This should never happen in finished pages.
				echo("Whoever worked on this page, you didn't restrict correctly.");
				exit();
			}
			
			$allowed = False;
			$user = func_get_arg(0); //Username is first.
			for($i = 1; $i < $argc; $i++) {
				if($user == func_get_arg($i)) { //Username is in allowed usertypes.
						$allowed = True;
						break;
				}
			}
			if($allowed) { //User is allowed. Continue
				return true;
			}
			else { //User is not allowed. Redirect to landing.
				//header("Location: landing.php");
			}
		}		
	}
?>