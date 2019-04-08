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
//################################GET CLEAN################################
//Do some $_GET cleaning.
//ID
if($_GET['searchChip'] != "") {
	$dino_data['chip'] = $_GET['searchChip'];		
} 
else { //Empty send.
	echo "empty chip</br>";
	$dino_data['chip'] = Null;
}

//SPECIES
if($_GET['searchSpecies'] != "") {
	$dino_data['species'] = '%' . $_GET['searchSpecies'] . '%';		
} 
else { //Empty send.
	echo "empty species</br>";
	$dino_data['species'] = '%';
}

//HEALTH
if($_GET['searchHealth'] != "") {
	$dino_data['health'] = $_GET['searchHealth'];		
} 
else { //Empty send.
	echo "empty health</br>";
	$dino_data['health'] = '%';
}

//SOCIAL DYNAMIC
if($_GET['searchDynamic'] != "") {
	$dino_data['dynamic'] = $_GET['searchDynamic'];		
} 
else { //Empty send.
	echo "empty dynamic</br>";
	$dino_data['dynamic'] = '%';
}

//CAPTIVITY STATE
if($_GET['searchCaptive'] != "") {
	$dino_data['captive'] = $_GET['searchCaptive'];		
} 
else { //Empty send.
	echo "empty captive</br>";
	$dino_data['captive'] = '%';
}

//AGE
if($_GET['searchAge'] != "") {
	$dino_data['age'] = $_GET['searchAge'];		
} 
else { //Empty send.
	echo "empty age</br>";
	$dino_data['age'] = Null;
}

//HOSTILITY
if($_GET['searchHostility'] != "") {
	$dino_data['hostility'] = $_GET['searchHostility'];		
} 
else { //Empty send.
	echo "empty hostility</br>";
	$dino_data['hostility'] = '%';
}
//##############################END GET CLEAN##############################
if($stmt->prepare("SELECT * FROM Dinosaur WHERE species LIKE ? AND health LIKE ? AND social_dynamic LIKE ? AND captivity_state LIKE ? AND hostility LIKE ?") or die(mysqli_error($db))) {	
	$stmt->bind_param('sssss',$dino_data['species'],$dino_data['health'],$dino_data['dynamic'],$dino_data['captive'],$dino_data['hostility']);
	$stmt->execute();
	$stmt->bind_result($cid,$captivity,$species,$social,$health,$hostility,$diet,$age);
	echo "<table border=1><th>Chip ID</th><th>Captivity State</th><th>Species</th><th>Social Dynamic</th><th>Health</th><th>Hostile?</th><th>Diet</th><th>Age</th>";
	while($stmt->fetch()) {
		echo "<tr><td>$cid</td><td>$captivity</td><td>$species</td><td>$social</td><td>$health</td><td>$hostility</td><td>$diet</td><td>$age</td></tr>";
	}
	echo "</table>";
	
	$stmt->close();
}

$db->close();
?>
