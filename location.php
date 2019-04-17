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

if($stmt->prepare("select * from Location") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($location_number,$desc);
	while($stmt->fetch()) {
		echo ("<a href = 'locationpage.php?id=$location_number'> <font color=white>$location_number $desc</font> </a>");
		echo ("</br>");
	}
	
	$stmt->close();
}
$db->close();

?>