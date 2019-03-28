<?php
	// Use this like a decorator for pages that require a login.
	function CheckLogin($uname) {
		$users = array('Person','Admin'); //Check by username
		$logged_in = False;
		
		foreach($users as $u) { //Check all usernames against provided username
			if($uname == $u) {
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
	function SessionData($session) {
		foreach($session as $val1 => $val2) {
			echo $val1 . " = " . $val2;
			echo "</br>";
		}
	}
?>