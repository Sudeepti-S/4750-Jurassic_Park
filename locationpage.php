<!--LOGIN HEADER-->
<link type="text/css" rel="stylesheet" href="styles/main.css" /> 
<link href='http://fonts.googleapis.com/css?family=Signika' rel='stylesheet' type='text/css'>
<center><a href = 'landing.php'> <font color=white> Back to home</font> </a></center>
<center><a href = 'location.php'> <font color=white> View all locations</font> </a></center>
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
			echo "<font size='5' face='Signika'>";
			echo ("Num: $id");
			echo("</br>");
			echo ("Description: $description");
			echo ("</br>");
			echo "</font>";
		}
		
		//$stmt->close();
	}
	
	if($stmt->prepare("select chip_id from Lives_in where location_number = ?") or die(mysqli_error($db))) {
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->bind_result($chip_id);
		while($stmt->fetch()) {
			echo "<font size='5' face='Signika'>";
			echo ("Chip Id: $chip_id");
			echo ("</br>");
			echo "</font>";
		}
		
		$stmt->close();
	}
}
else{
	header("Location: landing.php");
}
$db->close();

?>