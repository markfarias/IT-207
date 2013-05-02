<?php
	include 'templates/header.php';
	
	define("PARAM_USERNAME", "username");
	define("PARAM_PASSWORD", "password");
	define("PARAM_EMAIL", "email");
	define("PARAM_FIRSTNAME", "FirstName");
	define("PARAM_LASTNAME", "LastName");
	define("PARAM_REGISTRATION", "registration");
	define("PARAM_UPDATE_INFO", "updateinfo");
	define("PARAM_ADMIN", "Administrator");
	
	$insertquery = "INSERT INTO Users VALUES ('%s', '%s', '%s', '%s', 0, '%s')";
	$selectquery = "SELECT * FROM Users WHERE UserName='%s' AND Password='%s'";
	$updatequery = "UPDATE Users SET %s='%s' WHERE UserName='%s'";
		
	if (!empty($_POST[PARAM_REGISTRATION])) {
		
		if (!empty($_POST[PARAM_EMAIL]) && !empty($_POST[PARAM_FIRSTNAME]) && !empty($_POST[PARAM_LASTNAME]) && 
			!empty($_POST[PARAM_PASSWORD]) && !empty($_POST[PARAM_USERNAME])) {
			mysqli_query($connection, sprintf($insertquery, $_POST[PARAM_USERNAME], $_POST[PARAM_FIRSTNAME], $_POST[PARAM_LASTNAME], $_POST[PARAM_EMAIL], $_POST[PARAM_PASSWORD]));
			// Redirect to the Login page
			header('Location: login.php?LoginMsg=3');
		}
		else {
			// Redirect back to the registration page
			header('Location: register.php?RegisterMsg=1');
		}
	}
	else if (!empty($_POST[PARAM_UPDATE_INFO])) {
		mysqli_query($connection, sprintf($updatequery, "FirstName", $_POST[PARAM_FIRSTNAME], $_SESSION[SESSION_USER]));
		mysqli_query($connection, sprintf($updatequery, "LastName", $_POST[PARAM_LASTNAME], $_SESSION[SESSION_USER]));
		mysqli_query($connection, sprintf($updatequery, "EmailAddress", $_POST[PARAM_EMAIL], $_SESSION[SESSION_USER]));
		mysqli_query($connection, sprintf($updatequery, "Password", $_POST[PARAM_PASSWORD], $_SESSION[SESSION_USER]));
		$_SESSION[SESSION_USERS_NAME] = $_POST[PARAM_FIRSTNAME] . " " . $_POST[PARAM_LASTNAME];
		// Redirect back to the Account Info page
		header('Location: accountinfo.php?Update=1');
	}
	else {		
		if (!empty($_POST[PARAM_PASSWORD]) && !empty($_POST[PARAM_USERNAME])) {
			// Query the User table for the attempted login
			$result = mysqli_query($connection, sprintf($selectquery, $_POST[PARAM_USERNAME], $_POST[PARAM_PASSWORD]));
			if (mysqli_num_rows($result) == 1) {
				// Populate session values with the User details
				$_SESSION[SESSION_USER] = $_POST[PARAM_USERNAME];
				$row = mysqli_fetch_assoc($result);
				$_SESSION[SESSION_USERS_NAME] = $row[PARAM_FIRSTNAME] . " " . $row[PARAM_LASTNAME];
				$_SESSION[SESSION_USER_ADMIN] = $row[PARAM_ADMIN];
				// Free up the results
				mysqli_free_result($result);
				// Redirect the authenticated user to the home page
				header('Location: index.php');
			}
			else {
				// Redirect back to the Login page to show an invalid account error
				header('Location: login.php?LoginMsg=1');
			}
		}
		else {
			header('Location: login.php?LoginMsg=2');
		}	
	}
	
	include 'templates/footer.php';
?>