<!--LOGIN HEADER-->
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
?>
<!--END LOGIN HEADER-->

<?php
$db = Login_Tools::DBADMIN_Login();
$stmt = $db->stmt_init();

if(isset($_GET['id'])){
	if($stmt->prepare("select * from Location where location_number = ?") or die(mysqli_error($db))) {
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->bind_result($id, $description);
		while($stmt->fetch()) {
			echo ("Num: $id Description: $description");
			echo ("</br>");
		}
		
		//$stmt->close();
	}
	
	if($stmt->prepare("select chip_id from Lives_in where location_number = ?") or die(mysqli_error($db))) {
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->bind_result($chip_id);
		while($stmt->fetch()) {
			echo ("Chip Id: $chip_id");
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