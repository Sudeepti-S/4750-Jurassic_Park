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
</head>
<body>
<?php
echo('<center><h1 style="color: red;">EMERGENCIES</h1></center></br>');

$db = Login_Tools::DBADMIN_Login();
$stmt = $db->stmt_init();
echo("<center><h3>Escaped Dinosaurs:</h3></center></br>");
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
echo("<center><h3>Attacks:</h3></center>");
if($stmt->prepare("SELECT Visitor.name, Attacks.chip_id FROM Visitor NATURAL JOIN Attacks") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($name,$cid);
	while($stmt->fetch()) {
		echo("<div align='center'>$name Attacked By Dinosaur ID: $cid</div>");
		echo("</br>");
	}
}

$stmt->close();
$db->close();

?>
</body>
</html>