<?php
	include 'templates/header.php';
	
	define("PARAM_EMAIL", "email");
	define("PARAM_FIRSTNAME", "firstname");
	define("PARAM_LASTNAME", "lastname");
	define("PARAM_PASSWORD", "password");
	define("PARAM_REGISTRATION", "registration");
	
	//$connection = @mysqli_connect("helios.ite.gmu.edu", "user", "password", "mfarias");
	$connection = mysqli_connect("localhost", "rkime", "Ad7Mm12345!#", "mfarias");
	
	if (!empty($_POST[PARAM_REGISTRATION])) {
		if (!empty($_POST[PARAM_EMAIL]) && !empty($_POST[PARAM_FIRSTNAME]) && !empty($_POST[PARAM_LASTNAME]) && 
			!empty($_POST[PARAM_PASSWORD]) && !empty($_POST[PARAM_USERNAME])) {
			$query = 'INSERT INTO users VALUES (NULL, "'.$_POST[PARAM_FIRSTNAME].'", "'.$_POST[PARAM_LASTNAME].'", "'.$_POST[PARAM_EMAIL].'", 0, "'.$_POST[PARAM_PASSWORD].'")';		
			mysqli_query($connection, $query);
		
			echo "Successfully Registered".PHP_EOL;
		}
		else {
			echo "You must enter a value in each field. Click your browser's Back button to return to the form.".PHP_EOL;
		}
		
		mysqli_close($connection);
	}
	else {
		mysqli_close($connection);
	}
	
	include 'templates/footer.php';
?>