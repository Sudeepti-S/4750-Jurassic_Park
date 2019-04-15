<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
	Login_Tools::RestrictAccess($_SESSION['username'],'Admin');
?>

<?php
//Some info from https://www.w3schools.com/js/js_json_php.asp
header("Content-Type: application/json; charset=UTF-8");

$db = Login_Tools::DBADMIN_Login();
$stmt = $db->stmt_init();

echo("{\"DB\":");
//Dino export
if($stmt->prepare("SELECT * FROM Dinosaur") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($cid,$captivity,$species,$social,$health,$hostility,$diet,$age);
	$result = $stmt->get_result();
	echo("{\"Dinosaur\":");
	echo(json_encode($result->fetch_all(MYSQLI_ASSOC)));
	
}
//Ranger export
if($stmt->prepare("SELECT * FROM Ranger") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($staff,$phone,$first,$last,$age);
	$result = $stmt->get_result();
	echo(",\"Ranger\":");
	echo(json_encode($result->fetch_all(MYSQLI_ASSOC)));
}
//Scientist export
if($stmt->prepare("SELECT * FROM Scientist") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($staff,$phone,$first,$last,$age,$focus,$lab);
	$result = $stmt->get_result();
	echo(",\"Scientist\":");
	echo(json_encode($result->fetch_all(MYSQLI_ASSOC)));
}
//Visitor export
if($stmt->prepare("SELECT * FROM Visitor") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($vis,$age,$name,$allowed);
	$result = $stmt->get_result();
	echo(",\"Visitor\":");
	echo(json_encode($result->fetch_all(MYSQLI_ASSOC)));
}
//Location export
if($stmt->prepare("SELECT * FROM Location") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($locnum,$desc);
	$result = $stmt->get_result();
	echo(",\"Location\":");
	echo(json_encode($result->fetch_all(MYSQLI_ASSOC)));
}
// RELATIONS NOW
//Attacks export
if($stmt->prepare("SELECT * FROM Attacks") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($f1,$f2);
	$result = $stmt->get_result();
	echo(",\"Attacks\":");
	echo(json_encode($result->fetch_all(MYSQLI_ASSOC)));
}
//Bred_by export
if($stmt->prepare("SELECT * FROM Bred_by") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($f1,$f2);
	$result = $stmt->get_result();
	echo(",\"Bred_by\":");
	echo(json_encode($result->fetch_all(MYSQLI_ASSOC)));
}
//Cares_for export
if($stmt->prepare("SELECT * FROM Cares_for") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($f1,$f2);
	$result = $stmt->get_result();
	echo(",\"Cares_for\":");
	echo(json_encode($result->fetch_all(MYSQLI_ASSOC)));
}
//Lives_in export
if($stmt->prepare("SELECT * FROM Lives_in") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($f1,$f2);
	$result = $stmt->get_result();
	echo(",\"Lives_in\":");
	echo(json_encode($result->fetch_all(MYSQLI_ASSOC)));
}
//Patrols export
if($stmt->prepare("SELECT * FROM Patrols") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($f1,$f2);
	$result = $stmt->get_result();
	echo(",\"Patrols\":");
	echo(json_encode($result->fetch_all(MYSQLI_ASSOC)));
}
echo("}}");
$stmt->close();
$db->close();


?>