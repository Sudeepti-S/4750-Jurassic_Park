<!--LOGIN HEADER-->
<link type="text/css" rel="stylesheet" href="styles/main.css" /> 
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

if($stmt->prepare("select staff_id, first_name, last_name from Ranger") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($id,$first,$last);
	while($stmt->fetch()) {
		echo ("<a href = 'rangerpage.php?id=$id'> <font color=white> $first $last</font> </a>");
		echo ("</br>");
	}
	
	$stmt->close();
}
$db->close();

?>