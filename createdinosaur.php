<!--LOGIN HEADER-->
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
	Login_Tools::RestrictAccess($_SESSION['username'],'Admin','Scientist');
?>
<!--END LOGIN HEADER-->

<html>
<head>
	<title>DINOSAUR INSERTION TOOL</title>
</head>
<body>
<h1>ADD A NEW DINOSAUR</h1>
<p>You MUST include the scientist who bred the dinosaur.</p>
<form action="insert.php" method="post">
<p>Species: <input type="text" name="species"></p>

<p>Social Dynamic: <select name="social">
	<option value="Group">Group-based</option>
	<option value="Solitary">Solitary</option>
	</select>
</p>

<p>Health: <select name="health">
	<option value="healthy">Healthy</option>
	<option value="sick">Sick</option>
	<option value="dead">Dead</option>
	</select>
</p>

<p>Hostility: <select name="hostility">
	<option value="Hostile">Hostile</option>
	<option value="Non-hostil">Non-Hostile</option>
	</select>
</p>

<p>Diet: <select name="diet">
	<option value="carnivore">Carnivore</option>
	<option value="herbivore">Herbivore</option>
	<option value="omnivore">Omnivore</option>
	</select>
</p>
<p>Age: <input type="number" name="age"></p>
<p>Scientist: <select name="scientist">
	<?php
	//Generate all the possible scientists to create info for.
	$db = Login_Tools::DBADMIN_Login();
	$stmt = $db->stmt_init();

	if($stmt->prepare("SELECT staff_id, first_name, last_name FROM Scientist") or die(mysqli_error($db))) {
		$stmt->execute();
		$stmt->bind_result($id,$first,$last);
		while($stmt->fetch()) {
			echo ("<option value=" . $id . ">$first $last</option>\n");
		}
	
		$stmt->close();
	}
	$db->close();

	?>
	</select>
</p>	
<p><input type="submit" value="Insert"></p>
</form>
</body>
</html>