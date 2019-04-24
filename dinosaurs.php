<!--LOGIN HEADER-->
<link type="text/css" rel="stylesheet" href="styles/main.css" /> 
<link href='http://fonts.googleapis.com/css?family=Signika' rel='stylesheet' type='text/css'>
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
?>
<!--END LOGIN HEADER-->
<html>
<head>
	<style>

	</style>
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
    <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<title>DINOSAUR SEARCH ENGINE</title>
	<script>
	$(document).ready(function() {
		$( "#sub" ).click(function() {
	  
		$.ajax({
			url: 'dinosaurEngine.php', 
			data: {searchChip: $( "#chip" ).val(),
				searchSpecies: $( "#species" ).val(),
				searchHealth: $( "#health" ).val(),
				searchDynamic: $( "#dynamic" ).val(),
				searchCaptive: $( "#captive" ).val(),
				searchAge: $( "#age" ).val(),
				searchHostility: $( "#hostility" ).val(),
				searchDiet: $( "#diet" ).val()
			},
			success: function(data){
				$('#LastNresult').html(data);      
				}
			});
		});  
	});
	</script>
</head>
<body>
	<h1>DINOSAURS</h1>
	<a href="landing.php"><font color=white>Go Back</font></a>
	</br><a href="createdinosaur.php"><font color=white>Add a new Dinosaur</font></a></br>
	<p style="font-family: Signika">Chip_ID: <input id="chip" type="search" placeholder="ChipID"/></p>
	<p style="font-family: Signika">Age: <input id="age" type="search" placeholder="Age"/></p>
	<p style="font-family: Signika">Species: <input id="species" type="search" placeholder="Species"/></p>
	<p style="font-family: Signika">Social Dynamic: <select id="dynamic">
		<option value="%">Any</option>
		<option value="Group">Group-based</option>
		<option value="Solitary">Solitary</option>
		</select>
	</p>
	<p style="font-family: Signika">Health: <select id="health">
		<option value="%">Any</option>
		<option value="healthy">Healthy</option>
		<option value="sick">Sick</option>
		<option value="dead">Dead</option>
		</select>
	</p>
	<p style="font-family: Signika">Captivity State: <select id="captive">
		<option value="%">Any</option>
		<option value="captured">Contained</option>
		<option value="escaped">Escaped</option>
		</select>
	</p>
	<p style="font-family: Signika">Hostility: <select id="hostility">
		<option value="%">Any</option>
		<option value="Hostile">Hostile</option>
		<option value="Non-hostil">Non-Hostile</option>
		</select>
	</p>
	<p style="font-family: Signika">Diet: <select id="diet">
		<option value="%">Any</option>
		<option value="carnivore">Carnivore</option>
		<option value="herbivore">Herbivore</option>
		<option value="omnivore">Omnivore</option>
		</select>
	</p>
	<p><input type="submit" id="sub" value="Search"/>
	<div id="LastNresult" style="font-family: Signika">Search Results</div>
</body>
</html>
