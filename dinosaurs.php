<!--LOGIN HEADER-->
<?php
	include("login_tools.php");
	session_start();
	Login_Tools::CheckLogin($_SESSION);
?>
<!--END LOGIN HEADER-->
<html>
<head>
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
	<a href="landing.php">Go Back</a>
	</br><a href="createdinosaur.php">Add a new Dinosaur</a></br>
	<p>Chip_ID: <input id="chip" type="search" placeholder="ChipID"/></p>
	<p>Age: <input id="age" type="search" placeholder="Age"/></p>
	<p>Species: <input id="species" type="search" placeholder="Species"/></p>
	<p>Social Dynamic: <select id="dynamic">
		<option value="%">Any</option>
		<option value="Group">Group-based</option>
		<option value="Solitary">Solitary</option>
		</select>
	</p>
	<p>Health: <select id="health">
		<option value="%">Any</option>
		<option value="healthy">Healthy</option>
		<option value="sick">Sick</option>
		<option value="dead">Dead</option>
		</select>
	</p>
	<p>Captivity State: <select id="captive">
		<option value="%">Any</option>
		<option value="captured">Contained</option>
		<option value="escaped">Escaped</option>
		</select>
	</p>
	<p>Hostility: <select id="hostility">
		<option value="%">Any</option>
		<option value="Hostile">Hostile</option>
		<option value="Non-hostil">Non-Hostile</option>
		</select>
	</p>
	<p>Diet: <select id="diet">
		<option value="%">Any</option>
		<option value="carnivore">Carnivore</option>
		<option value="herbivore">Herbivore</option>
		<option value="omnivore">Omnivore</option>
		</select>
	</p>
	<p><input type="submit" id="sub" value="Search"/>
	<div id="LastNresult">Search Results</div>
</body>
</html>
