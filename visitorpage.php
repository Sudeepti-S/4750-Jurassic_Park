<!--LOGIN HEADER-->
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
	Login_Tools::RestrictAccess($_SESSION['username'],'Admin');
?>
<!--END LOGIN HEADER-->

<?php
$db = Login_Tools::DBADMIN_Login();
$stmt = $db->stmt_init();

if(isset($_GET['id'])){
		
	if($stmt->prepare("select * from Visitor where visitor_number = ?") or die(mysqli_error($db))) {
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->bind_result($visitor_number, $age, $name, $allowed);
		while($stmt->fetch()) {
			echo ("Visitor Name: $name");
			echo ("</br>");
			echo ("Number: $visitor_number");
			echo ("</br>");
			echo ("Age: $age");
			echo ("</br>");
			echo ("Allowed: $allowed");
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