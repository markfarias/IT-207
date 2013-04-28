<?php
	include 'templates/header.php';
	
	define("PARAM_USERNAME", "username");
	define("PARAM_PASSWORD", "password");
	define("PARAM_EMAIL", "email");
	define("PARAM_FIRSTNAME", "firstname");
	define("PARAM_LASTNAME", "lastname");
	define("PARAM_REGISTRATION", "registration");
	define("PARAM_UPDATE_INFO", "updateinfo");
	
	$insertquery = "INSERT INTO users VALUES ('%s', '%s', '%s', '%s', 0, '%s')";
	$selectquery = "SELECT * FROM users WHERE UserName='%s' AND Password='%s'";
	$updatequery = "UPDATE users SET %s='%s' WHERE UserName='%s'";
		
	if (!empty($_POST[PARAM_REGISTRATION])) {
		
		if (!empty($_POST[PARAM_EMAIL]) && !empty($_POST[PARAM_FIRSTNAME]) && !empty($_POST[PARAM_LASTNAME]) && 
			!empty($_POST[PARAM_PASSWORD]) && !empty($_POST[PARAM_USERNAME])) {
			mysqli_query($connection, sprintf($insertquery, $_POST[PARAM_USERNAME], $_POST[PARAM_FIRSTNAME], $_POST[PARAM_LASTNAME], $_POST[PARAM_EMAIL], $_POST[PARAM_PASSWORD]));
			
			echo "Successfully Registered".PHP_EOL;
		}
		else {
			echo "You must enter a value in each field. Click your browser's Back button to return to the form.".PHP_EOL;
		}
	}
	else if (!empty($_POST[PARAM_UPDATE_INFO])) {
		mysqli_query($connection, sprintf($updatequery, "FirstName", $_POST[PARAM_FIRSTNAME], $_SESSION[SESSION_USER]));
		mysqli_query($connection, sprintf($updatequery, "LastName", $_POST[PARAM_LASTNAME], $_SESSION[SESSION_USER]));
		mysqli_query($connection, sprintf($updatequery, "EmailAddress", $_POST[PARAM_EMAIL], $_SESSION[SESSION_USER]));
		mysqli_query($connection, sprintf($updatequery, "Password", $_POST[PARAM_PASSWORD], $_SESSION[SESSION_USER]));
		
		echo "Update successful.".PHP_EOL;
	}
	else {
		if (!empty($_POST[PARAM_PASSWORD]) && !empty($_POST[PARAM_USERNAME])) {
			$result = mysqli_query($connection, sprintf($selectquery, $_POST[PARAM_USERNAME], $_POST[PARAM_PASSWORD]));
			
			if (mysqli_num_rows($result) == 1) {
				$_SESSION[SESSION_USER] = $_POST[PARAM_USERNAME];
				echo "Log-in successful.".PHP_EOL;
			}
			else {
				echo "Log-in failed.".PHP_EOL;
			}
		}
		else {
			echo "You must enter a value in each field. Click your browser's Back button to return to the form.".PHP_EOL;
		}	
	}
	
	include 'templates/footer.php';
?>