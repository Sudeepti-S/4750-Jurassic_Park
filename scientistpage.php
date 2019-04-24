<!--LOGIN HEADER-->
<link type="text/css" rel="stylesheet" href="styles/main.css" /> 
<link href='http://fonts.googleapis.com/css?family=Signika' rel='stylesheet' type='text/css'>
<center><a href = 'landing.php'> <font color=white> Back to home</font> </a></center>
<center><a href = 'scientist.php'> <font color=white> View all scientists</font> </a></center>
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
			echo "<font size='5' face='Signika'>";
			echo ("</br>");
			echo ("Name: $first $last");
			echo ("</br>");
			echo ("</br>");
			echo ("Age: $age" );
			echo ("</br>");
			echo ("</br>");
			echo ("Phone: $phone_number" );
			echo ("</br>");
			echo ("</br>");
			echo ("Focus: $focus" );
			echo ("</br>");
			echo ("</br>");
			echo ("Lab: $lab" );
			echo ("</br>");
			echo ("</br>");
			echo "</font>";
		}
		
		//$stmt->close();
	}
	
	if($stmt->prepare("select * from Bred_by where staff_id = ?") or die(mysqli_error($db))) {
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->bind_result($chip_id, $staff_id);
		while($stmt->fetch()) {
			echo "<font size='5' face='Signika'>";
			echo ("Chip Id: $chip_id Staff Id: $staff_id");
			echo ("</br>");
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
