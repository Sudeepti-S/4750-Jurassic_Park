<!--LOGIN HEADER-->
<link type="text/css" rel="stylesheet" href="styles/main.css" /> 
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
			echo ("<div align = 'center'>Num: $id</div>");
			echo("</br>");
			echo ("<div align = 'center'>Description: $description</div>");
			echo ("</br>");
		}
		
		//$stmt->close();
	}
	
	if($stmt->prepare("select chip_id from Lives_in where location_number = ?") or die(mysqli_error($db))) {
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->bind_result($chip_id);
		while($stmt->fetch()) {
			echo ("<div align = 'center'>Chip Id: $chip_id</div>");
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