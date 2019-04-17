<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
	Login_Tools::RestrictAccess($_SESSION['username'],'Admin');
?>

<?php
//Some info from https://www.w3schools.com/js/js_json_php.asp
header("Content-Type: application/json; charset=UTF-8");

class Dinosaur {
	public $chip_id;
	public $captivity_state;
	public $species;
	public $social_dynamic;
	public $health;
	public $hostility;
	public $diet;
	public $age;
	function __construct($cid,$cs,$sp,$sd,$he,$ho,$di,$ag) {
		$this->chip_id = $cid;
		$this->captivity_state = $cs;
		$this->species = $sp;
		$this->social_dynamic = $sd;
		$this->health = $he;
		$this->hostility = $ho;
		$this->diet = $di;
		$this->age = $ag;
	}
}
class Ranger {
	public $staff_id;
	public $phone_number;
	public $first_name;
	public $last_name;
	public $age;
	function __construct($sid,$pn,$fn,$ln,$ag) {
		$this->staff_id = $sid;
		$this->phone_number = $pn;
		$this->first_name = $fn;
		$this->last_name = $ln;;
		$this->age = $ag;
	}
}
class Scientist {
	public $staff_id;
	public $phone_number;
	public $first_name;
	public $last_name;
	public $age;
	public $focus;
	public $lab;
	function __construct($sid,$pn,$fn,$ln,$ag,$fo,$la) {
		$this->staff_id = $sid;
		$this->phone_number = $pn;
		$this->first_name = $fn;
		$this->last_name = $ln;;
		$this->age = $ag;
		$this->focus = $fo;
		$this->lab = $la;
	}
}
class Visitor {
	public $visitor_number;
	public $age;
	public $name;
	public $allowed;
	
	function __construct($vi,$ag,$na,$al) {
		$this->visitor_number = $vi;
		$this->age = $ag;
		$this->name = $na;
		$this->allowed = $al;
	}
}
class Location {
	public $location_number;
	public $description;
	
	function __construct($ln,$de) {
		$this->location_number = $ln;
		$this->description = $de;
	}
}
class AttacksRel {
	public $chip_id;
	public $visitor_number;
	
	function __construct($a,$b) {
		$this->chip_id = $a;
		$this->visitor_number = $b;
	}
}
class BredByRel {
	public $chip_id;
	public $staff_id;
	
	function __construct($a,$b) {
		$this->chip_id = $a;
		$this->staff_id = $b;
	}
}
class CaresForRel {
	public $chip_id;
	public $staff_id;
	
	function __construct($a,$b) {
		$this->chip_id = $a;
		$this->staff_id = $b;
	}
}
class LivesInRel {
	public $chip_id;
	public $location_number;
	
	function __construct($a,$b) {
		$this->chip_id = $a;
		$this->location_number = $b;
	}
}
class PatrolsRel {
	public $location_number;
	public $staff_id;
	
	function __construct($a,$b) {
		$this->location_number = $a;
		$this->staff_id = $b;
	}
}

$db = Login_Tools::DBADMIN_Login();
$stmt = $db->stmt_init();
echo("{\"DB\":");
//Dino export
if($stmt->prepare("SELECT * FROM Dinosaur") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($cid,$captivity,$species,$social,$health,$hostility,$diet,$age);
	echo("{\"Dinosaur\":[");
	$firstdino = true;
	while($stmt->fetch()) {
		if(!$firstdino) {
			echo(",");
		}
		else {
			$firstdino = false;
		}
		$item = new Dinosaur($cid,$captivity,$species,$social,$health,$hostility,$diet,$age);
		echo(json_encode($item));
	}
	echo("]");
	
}
//Ranger export
if($stmt->prepare("SELECT * FROM Ranger") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($staff,$phone,$first,$last,$age);
	echo(",\"Ranger\":[");
	$firstranger = true;
	while($stmt->fetch()) {
		if(!$firstranger) {
			echo(",");
		}
		else {
			$firstranger = false;
		}
		$item = new Ranger($staff,$phone,$first,$last,$age);
		echo(json_encode($item));
	}
	echo("]");
}
//Scientist export
if($stmt->prepare("SELECT * FROM Scientist") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($staff,$phone,$first,$last,$age,$focus,$lab);
	echo(",\"Scientist\":[");
	$firstscientist = true;
	while($stmt->fetch()) {
		if(!$firstscientist) {
			echo(",");
		}
		else {
			$firstscientist = false;
		}
		$item = new Scientist($staff,$phone,$first,$last,$age,$focus,$lab);
		echo(json_encode($item));
	}
	echo("]");
}
//Visitor export
if($stmt->prepare("SELECT * FROM Visitor") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($vis,$age,$name,$allowed);
	echo(",\"Visitor\":[");
	$firstvisitor = true;
	while($stmt->fetch()) {
		if(!$firstvisitor) {
			echo(",");
		}
		else {
			$firstvisitor = false;
		}
		$item = new Visitor($vis,$age,$name,$allowed);
		echo(json_encode($item));
	}
	echo("]");
}
//Location export
if($stmt->prepare("SELECT * FROM Location") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($locnum,$desc);
	echo(",\"Location\":[");
	$firstloc = true;
	while($stmt->fetch()) {
		if(!$firstloc) {
			echo(",");
		}
		else {
			$firstloc = false;
		}
		$item = new Location($locnum,$desc);
		echo(json_encode($item));
	}
	echo("]");
}
// RELATIONS NOW
//Attacks export
if($stmt->prepare("SELECT * FROM Attacks") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($f1,$f2);
	echo(",\"Attacks\":[");
	$firstatk = true;
	while($stmt->fetch()) {
		if(!$firstatk) {
			echo(",");
		}
		else {
			$firstatk = false;
		}
		$item = new AttacksRel($f1,$f2);
		echo(json_encode($item));
	}
	echo("]");
}
//Bred_by export
if($stmt->prepare("SELECT * FROM Bred_by") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($f1,$f2);
	echo(",\"Bred_by\":[");
	$firstbb = true;
	while($stmt->fetch()) {
		if(!$firstbb) {
			echo(",");
		}
		else {
			$firstbb = false;
		}
		$item = new BredByRel($f1,$f2);
		echo(json_encode($item));
	}
	echo("]");
}
//Cares_for export
if($stmt->prepare("SELECT * FROM Cares_for") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($f1,$f2);
	echo(",\"Cares_for\":[");
	$firstcf = true;
	while($stmt->fetch()) {
		if(!$firstcf) {
			echo(",");
		}
		else {
			$firstcf = false;
		}
		$item = new CaresForRel($f1,$f2);
		echo(json_encode($item));
	}
	echo("]");
}
//Lives_in export
if($stmt->prepare("SELECT * FROM Lives_in") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($f1,$f2);
	echo(",\"Lives_in\":[");
	$firstli = true;
	while($stmt->fetch()) {
		if(!$firstli) {
			echo(",");
		}
		else {
			$firstli = false;
		}
		$item = new LivesInRel($f1,$f2);
		echo(json_encode($item));
	}
	echo("]");
}
//Patrols export
if($stmt->prepare("SELECT * FROM Patrols") or die(mysqli_error($db))) {
	$stmt->execute();
	$stmt->bind_result($f1,$f2);
	echo(",\"Patrols\":[");
	$firstp = true;
	while($stmt->fetch()) {
		if(!$firstp) {
			echo(",");
		}
		else {
			$firstp = false;
		}
		$item = new PatrolsRel($f1,$f2);
		echo(json_encode($item));
	}
	echo("]");
}
echo("}}");
$stmt->close();
$db->close();


?>