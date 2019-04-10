<!--LOGIN HEADER-->
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
?>
<!--END LOGIN HEADER-->
<?php 
$db = Login_tools::DBADMIN_Login();
$stmt = $db->stmt_init();

$query = "SELECT * FROM Dinosaur WHERE ";
$hasparams = false;
$default = "1=0";
$params = array();
$paramstypes = "";

//################################GET CLEAN################################
//Do some $_GET cleaning.
//ID
if($_GET['searchChip'] != "") {
	$dino_data['chip'] = $_GET['searchChip'];
	$params[] = & $dino_data['chip'];
	$paramstypes .= "i";
	if($hasparams) {
		$query .= " AND ";
	}
	else {
		$hasparams = true;
	}
	$query .= "chip_id = ?";
} 
else { //Empty send.
	$dino_data['chip'] = 0;
}

//SPECIES
if($_GET['searchSpecies'] != "") {
	$dino_data['species'] = '%' . $_GET['searchSpecies'] . '%';		
	$params[] = & $dino_data['species'];
	$paramstypes .= "s";
	if($hasparams) {
		$query .= " AND ";
	}
	else {
		$hasparams = true;
	}
	$query .= "species LIKE ?";
} 
else { //Empty send.
	$dino_data['species'] = '%';
}

//HEALTH
if($_GET['searchHealth'] != "%") {
	$dino_data['health'] = $_GET['searchHealth'];
	$params[] = & $dino_data['health'];
	$paramstypes .= "s";
	if($hasparams) {
		$query .= " AND ";
	}
	else {
		$hasparams = true;
	}
	$query .= "health LIKE ?";	
} 
else { //Empty send.
	$dino_data['health'] = '%';
}

//SOCIAL DYNAMIC
if($_GET['searchDynamic'] != "%") {
	$dino_data['dynamic'] = $_GET['searchDynamic'];	
	$params[] = & $dino_data['dynamic'];
	$paramstypes .= "s";
	if($hasparams) {
		$query .= " AND ";
	}
	else {
		$hasparams = true;
	}
	$query .= "social_dynamic LIKE ?";		
} 
else { //Empty send.
	$dino_data['dynamic'] = '%';
}

//CAPTIVITY STATE
if($_GET['searchCaptive'] != "%") {
	$dino_data['captive'] = $_GET['searchCaptive'];
	$params[] = & $dino_data['captive'];
	$paramstypes .= "s";
	if($hasparams) {
		$query .= " AND ";
	}
	else {
		$hasparams = true;
	}
	$query .= "captivity_state LIKE ?";		
} 
else { //Empty send.
	$dino_data['captive'] = '%';
}

//AGE
if($_GET['searchAge'] != "") {
	$dino_data['age'] = $_GET['searchAge'];	
	$params[] = & $dino_data['age'];
	$paramstypes .= "i";
	if($hasparams) {
		$query .= " AND ";
	}
	else {
		$hasparams = true;
	}
	$query .= "age = ?";		
} 
else { //Empty send.
	$dino_data['age'] = 0;
}

//HOSTILITY
if($_GET['searchHostility'] != "%") {
	$dino_data['hostility'] = $_GET['searchHostility'];	
	$params[] = & $dino_data['hostility'];
	$paramstypes .= "s";
	if($hasparams) {
		$query .= " AND ";
	}
	else {
		$hasparams = true;
	}
	$query .= "hostility LIKE ?";		
} 
else { //Empty send.
	$dino_data['hostility'] = '%';
}

//DIET
if($_GET['searchDiet'] != "%") {
	$dino_data['diet'] = $_GET['searchDiet'];
	$params[] = & $dino_data['diet'];
	$paramstypes .= "s";
	if($hasparams) {
		$query .= " AND ";
	}
	else {
		$hasparams = true;
	}
	$query .= "diet LIKE ?";		
} 
else { //Empty send.
	$dino_data['diet'] = '%';
}
//##############################END GET CLEAN##############################
if($hasparams == false) {
	$query .= $default;
}
$query .= ";";
$args = array();
$args[] = & $paramstypes;
for( $i = 0; $i < strlen($paramstypes);$i++) {
	$args[] = & $params[$i];
}

if($stmt->prepare($query) or die(mysqli_error($db))) {
	if($hasparams == true) {
		call_user_func_array(array($stmt,'bind_param'), $args);
		$stmt->execute();
		$stmt->bind_result($cid,$captivity,$species,$social,$health,$hostility,$diet,$age);
		echo "<table border=1><th>Chip ID</th><th>Captivity State</th><th>Species</th><th>Social Dynamic</th><th>Health</th><th>Hostile?</th><th>Diet</th><th>Age</th>";
		while($stmt->fetch()) {
			echo "<tr><td>$cid</td><td>$captivity</td><td>$species</td><td>$social</td><td>$health</td><td>$hostility</td><td>$diet</td><td>$age</td></tr>";
		}
		echo "</table>";
	}	
	$stmt->close();
}

$db->close();
?>
