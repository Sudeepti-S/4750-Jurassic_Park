<!--LOGIN HEADER-->
<link type="text/css" rel="stylesheet" href="styles/main.css" /> 
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
	Login_Tools::RestrictAccess($_SESSION['username'],'Admin','Ranger');
?>
<!--END LOGIN HEADER-->

<html> 
<body>
<center><h1> EDIT DINOSAUR INFORMATION</h1></center></br>
<form action="edit.php" method="post">
<?php 
$db = Login_Tools::DBRANGER_Login();
$stmt = $db->stmt_init();
if(isset($_GET['id'])){
	if($stmt->prepare("SELECT * FROM Dinosaur WHERE chip_id = ?") or die(mysqli_error($db))) {
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->bind_result($cid,$captivity,$species,$social,$health,$hostility,$diet,$age);
		if($stmt->fetch()) {
			echo("<h2>ID: $cid</h2>");
			echo("<h3>Species: $species</h3>");
			echo("<input type=\"hidden\" name=\"id\" value=$cid>\n");
			echo("<p>Captivity State: <input type=\"text\" name=\"captivity\" value=\"$captivity\"></p>\n");
			echo("<p>Age: <input type=\"number\" name=\"age\" value=$age></p>\n");
			echo("<p>Health: <input type=\"text\" name=\"health\" value=\"$health\"></p>\n");
			echo("<p>Location: <select name=\"location\">");
			echo("<option value=0>No change</option>");
			if($stmt->prepare("SELECT location_number FROM Location") or die(mysqli_error($db))) {
				$stmt->execute();
				$stmt->bind_result($locnum);
				while($stmt->fetch()) {
					echo("<option value=" . $locnum . ">$locnum</option>\n");
				}
			}

			echo("</select></p>");
			echo("<p><input type=\"submit\" value=\"Update\"></p>");
		}
	}
	echo ("<a href=\"dinosaurs.php\"><font color=white>Go Back</font></a>");
	$stmt->close();
}
$db->close();
?>
</form>
</body>
</html>
