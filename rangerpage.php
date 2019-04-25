<!--LOGIN HEADER-->
<link type="text/css" rel="stylesheet" href="styles/main.css" /> 
<link href='http://fonts.googleapis.com/css?family=Signika' rel='stylesheet' type='text/css'>
<center><a href = 'landing.php'> <font color=white> Back to home</font> </a></center>
<center><a href = 'rangers.php'> <font color=white> View all rangers</font> </a></center>
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
	Login_Tools::RestrictAccess($_SESSION['username'],'Admin','Ranger');
?>
<!--END LOGIN HEADER-->

<?php
$db = Login_Tools::DBRANGER_Login();
$stmt = $db->stmt_init();

if(isset($_GET['id'])){
	if($stmt->prepare("select * from Ranger where staff_id = ?") or die(mysqli_error($db))) {
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->bind_result($id, $phone_number, $first, $last, $age);
		while($stmt->fetch()) {
			echo "<font size='5' face='Signika'>";
			echo ("</br>");
			echo ("Name: $first $last");
			echo ("</br>");
			echo ("</br>");
			echo ("Age: $age");
			echo ("</br>");
			echo ("</br>");
			echo ("Phone: $phone_number");
			echo ("</br>");
			echo ("</br>");
			echo "</font>";
		}
		
		//$stmt->close();
	}
	
	echo ("<h1>Patrol Locations</h1>");
	
	if($stmt->prepare("select * from Patrols where staff_id = ?") or die(mysqli_error($db))) {
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->bind_result($location_number, $staff_id);
		while($stmt->fetch()) {
			echo "<font size='5' face='Signika'>";
			echo ("Location: $location_number");
			echo ("</br>");
			echo ("</br>");
			echo "</font>";
		}
		
		//$stmt->close();
	}
	
	echo ("<h1>Dinosaurs Cared For</h1>");
	
	if($stmt->prepare("select * from Cares_for where staff_id = ?") or die(mysqli_error($db))) {
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->bind_result($chip_id, $staff_id);
		while($stmt->fetch()) {
			echo "<font size='5' face='Signika'>";
			echo ("Chip Id: $chip_id");
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