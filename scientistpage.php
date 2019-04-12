<!--LOGIN HEADER-->
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
	Login_Tools::RestrictAccess($_SESSION['username'],'Admin','Scientist');
?>
<!--END LOGIN HEADER-->

<?php
$db = Login_Tools::DBADMIN_Login();
$stmt = $db->stmt_init();
if(isset($_GET['id'])){
	if($stmt->prepare("select * from Scientist where staff_id = ?") or die(mysqli_error($db))) {
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->bind_result($id, $phone_number, $first, $last, $age, $focus, $lab);
		while($stmt->fetch()) {
			echo ("Name: $first $last Age: $age Phone: $phone_number Focus: $focus Lab: $lab" );
			echo ("</br>");
		}
		
		//$stmt->close();
	}
	
	if($stmt->prepare("select * from Bred_by where staff_id = ?") or die(mysqli_error($db))) {
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->bind_result($chip_id, $staff_id);
		while($stmt->fetch()) {
			echo ("Chip Id: $chip_id Staff Id: $staff_id");
			echo ("</br>");
		}
		
		$stmt->close();
	}
}
else{
	header("Location: landing.php");
}
$db->close();
?>