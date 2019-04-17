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
</head>
<body>
<?php
echo("<h1>Emergencies</h1>");

$db = Login_Tools::DBADMIN_Login();
$stmt = $db->stmt_init();
echo("<h3>Escaped Dinosaurs</h3>");
if($stmt->prepare("SELECT Dinosaur.chip_id,Lives_in.location_number, Dinosaur.hostility FROM Dinosaur NATURAL JOIN Lives_in WHERE Lives_in.location_number = 404") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($cid,$locnum,$hostility);
	while($stmt->fetch()) {
		if($hostility == "Hostile"){
			echo("ID: $cid | HOSTILE");			
		}
		else {
			echo("ID: $cid");
		}

	}	
}
echo("<h3>Attacks</h3>");
if($stmt->prepare("SELECT Visitor.name, Attacks.chip_id FROM Visitor NATURAL JOIN Attacks") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($name,$cid);
	while($stmt->fetch()) {
		echo("$name Attacked By Dinosaur ID: $cid");
	}
}

$stmt->close();
$db->close();

?>
</body>
</html>