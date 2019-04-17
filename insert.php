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


if(!isset($_POST['species']) OR !isset($_POST['social']) OR !isset($_POST['health']) OR !isset($_POST['hostility']) OR !isset($_POST['diet']) OR !isset($_POST['age']) OR !isset($_POST['scientist']) OR $_POST['species'] == "" OR $_POST['age'] == 0) {
	echo "Bad data. No records added";
}
else {
	try {
		//Need to do this as a transaction since it is a dependent set of inserts
		$db->autocommit(FALSE);
		$db->begin_transaction();
	
		//Create dinosaur
		if($stmt->prepare("INSERT INTO ss9ud.Dinosaur(captivity_state,species,social_dynamic,health,hostility,diet,age) VALUES(\"captured\",?, ?, ?, ?, ?, ?);") or die(mysqli_error($db))) {
			$stmt->bind_param("sssssi",$_POST['species'],$_POST['social'],$_POST['health'],$_POST['hostility'],$_POST['diet'],$_POST['age']);
			$stmt->execute();
			echo "Record added";
		}
		
		$dino_new = $stmt->insert_id;
		//Crate bred_by entry.
		if($stmt->prepare("INSERT INTO Bred_by(chip_id,staff_id) VALUES(?, ?);") or die(mysqli_error($db))) {

			$stmt->bind_param("ii",$dino_new,$_POST['scientist']);
			$stmt->execute();
			echo "Record added";
		}
		echo("</br>Transaction success. Commit.");
		$db->commit();
		$stmt->close();
	}
	catch(Exception $e) {
		echo("Failure during transaction. Rollback. Error: ");
		$db->rollback();
		$stmt->close();
	}
	
}

echo ("</br><a href=\"createdinosaur.php\">Add Another Dinosaur</a></br>");
echo("<a href=\"landing.php\">Landing</a>");
$db->close();
?>