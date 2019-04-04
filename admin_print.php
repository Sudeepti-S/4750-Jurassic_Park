<!--LOGIN HEADER-->
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
	Login_Tools::RestrictAccess($_SESSION['username'],'Admin','Ranger');
?>
<!--END LOGIN HEADER-->

<?php
$db = Login_Tools::DBADMIN_Login();
$stmt = $db->stmt_init();

if($stmt->prepare("select * from Dinosaur") or die(mysqli_error($db))) {
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