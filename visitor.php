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

if($stmt->prepare("select * from Visitor") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($num, $age, $name, $allowed);
	while($stmt->fetch()) {
		echo ("<a href = 'visitorpage.php?id=$num'> $name </a>");
		echo ("</br>");
	}
	
	$stmt->close();
}
$db->close();

?>