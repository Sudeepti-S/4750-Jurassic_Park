<!--LOGIN HEADER-->
<link type="text/css" rel="stylesheet" href="styles/main.css" /> 
<center><a href = 'landing.php'> <font color=white> Back to home</font> </a></center>
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
	Login_Tools::RestrictAccess($_SESSION['username'],'Admin');
?>
<!--END LOGIN HEADER-->

<?php
$db = Login_Tools::DBADMIN_Login();
$stmt = $db->stmt_init();

if($stmt->prepare("select * from Visitor") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($num, $age, $name, $allowed);
	while($stmt->fetch()) {
		echo ("<a href = 'visitorpage.php?id=$num'> <font color=white> $name</font> </a>");
		echo ("</br>");
	}
	
	$stmt->close();
}
$db->close();

?>
