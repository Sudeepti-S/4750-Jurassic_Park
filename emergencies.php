<!--LOGIN HEADER-->
<link type="text/css" rel="stylesheet" href="styles/main.css" /> 
<a href = 'landing.php'> <font color=white> Back to home</font> </a>
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
<center><h1 style="color:red">EMERGENCIES</h1></center>
<center><h3>Add New Attack</h3></center>
<?php
$db = Login_Tools::DBADMIN_Login();
$stmt = $db->stmt_init();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(!isset($_POST['chip']) || !isset($_POST['visitor'])) {
		echo("<p>Bad parameters</p>");
	}
	else {
		if($stmt->prepare("INSERT INTO Attacks(chip_id,visitor_number) VALUES(?,?);") or die(mysqli_error($db))) {
			$stmt->bind_param("ii",$_POST['chip'],$_POST['visitor']);
			$stmt->execute();
			echo("<p>Inserted new entry</p>");
		}
	}
}
echo("<form action=\"\" method=\"post\">");
echo("<p>Chip ID: <select name=\"chip\"></p>");
if($stmt->prepare("SELECT chip_id, species FROM Dinosaur") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($cid, $species);
	while($stmt->fetch()) {
		echo("<option value=" . $cid . ">$cid: $species</option>\n");
	}
}
echo("</select>");
echo("<p>Attacked Visitor: <select name=\"visitor\"></p>");
if($stmt->prepare("SELECT visitor_number, name FROM Visitor WHERE visitor_number NOT IN (SELECT visitor_number FROM Attacks);") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($vn, $vname);
	while($stmt->fetch()) {
		echo("<option value=" . $vn . ">$vname</option>\n");
	}
}
echo("</select>");
echo("<p><input type=\"submit\" value=\"Insert\"></p>");
echo("</form>");
echo("<center><h3>Escaped Dinosaurs:</h3></center>");
if($stmt->prepare("SELECT Dinosaur.chip_id,Lives_in.location_number, Dinosaur.hostility FROM Dinosaur NATURAL JOIN Lives_in WHERE Lives_in.location_number = 404") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($cid,$locnum,$hostility);
	while($stmt->fetch()) {
		if($hostility == "Hostile"){
			echo("<center>ID: $cid | HOSTILE</center>");			
		}
		else {
			echo("<center>ID: $cid</center>");
		}
	}	
}
echo("<center><h3>Attacks:</h3></center>");
if($stmt->prepare("SELECT Visitor.name, Attacks.chip_id FROM Visitor NATURAL JOIN Attacks") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($name,$cid);
	while($stmt->fetch()) {
		echo("<center><li>$name Attacked By Dinosaur ID: $cid</li></center>");
	}
}
$stmt->close();
$db->close();
?>
</body>
</html>