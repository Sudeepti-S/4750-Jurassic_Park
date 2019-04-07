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

if($stmt->prepare("select staff_id, first_name, last_name from Ranger") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($id,$first,$last);
	while($stmt->fetch()) {
		echo ("<a href = 'rangerpage.php?id=$id'> $first $last </a>");
		echo ("</br>");
	}
	
	$stmt->close();
}
$db->close();

?>