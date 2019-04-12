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
$stmt=$db->stmt_init();
if(!isset($_POST['id']) OR !isset($_POST['captivity']) OR !isset($_POST['age']) OR !isset($_POST['health'])) {
	echo("Bad data. No update");
}
else {
	if($stmt->prepare("UPDATE Dinosaur SET captivity_state=?, age=?, health=? WHERE chip_id=?") or die(mysqli_error($db))) {
		$stmt->bind_param("sisi",$_POST['captivity'],$_POST['age'],$_POST['health'],$_POST['id']);	
		$stmt->execute();
		echo("Record Updated");
	}
	$stmt->close();
	echo ("</br><a href=\"dinosaurs.php\">Dinosaur Search</a></br>");
	echo("<a href=\"landing.php\">Landing</a>");
}


$db->close();
?>