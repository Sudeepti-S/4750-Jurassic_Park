<!--LOGIN HEADER-->
<link type="text/css" rel="stylesheet" href="styles/main.css" /> 
<center><a href = 'landing.php'> <font color=white> Back to home</font> </a></center>
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
	Login_Tools::RestrictAccess($_SESSION['username'],'Admin','Scientist');
?>
<!--END LOGIN HEADER-->

<?php
$db = Login_Tools::DBSCIENCE_Login();
$stmt = $db->stmt_init();
if($stmt->prepare("select * from Scientist") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($id,$phone,$first,$last,$age, $focus,$lab);
	while($stmt->fetch()) {
		echo ("<a href = 'scientistpage.php?id=$id'> <font color=white> $first $last </font> </a>");
		echo ("</br>");
	}
	
	$stmt->close();
}
$db->close();
?>
