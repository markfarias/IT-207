<!--Mark Farias
	Richard Kim
	IT 207
	Project
	Description: Application logic that handles registration, login, and account update functionality.
-->

<?php
	include 'templates/header.php';
	
	define("PARAM_USERNAME", "UserName");
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
		
	if (!empty($_GET[PARAM_REGISTRATION])) {
		
		if (!empty($_GET[PARAM_EMAIL]) && !empty($_GET[PARAM_FIRSTNAME]) && !empty($_GET[PARAM_LASTNAME]) && 
			!empty($_GET[PARAM_PASSWORD]) && !empty($_GET[PARAM_USERNAME])) {
			mysqli_query($connection, sprintf($insertquery, $_GET[PARAM_USERNAME], $_GET[PARAM_FIRSTNAME], $_GET[PARAM_LASTNAME], $_GET[PARAM_EMAIL], $_GET[PARAM_PASSWORD]));
			
			// Redirect to the Login page
			header('Location: login.php?LoginMsg=3');
		}
		else {
			// Redirect back to the registration page
			header('Location: register.php?RegisterMsg=1');
		}
	}
	else if (!empty($_GET[PARAM_UPDATE_INFO])) {
		if (!empty($_GET[PARAM_FIRSTNAME]) && !empty($_GET[PARAM_LASTNAME]) && !empty($_GET[PARAM_EMAIL]) && !empty($_GET[PARAM_PASSWORD])) {
			mysqli_query($connection, sprintf($updatequery, "FirstName", $_GET[PARAM_FIRSTNAME], $_GET[USER]));
			mysqli_query($connection, sprintf($updatequery, "LastName", $_GET[PARAM_LASTNAME], $_GET[USER]));
			mysqli_query($connection, sprintf($updatequery, "EmailAddress", $_GET[PARAM_EMAIL], $_GET[USER]));
			mysqli_query($connection, sprintf($updatequery, "Password", $_GET[PARAM_PASSWORD], $_GET[USER]));
			
			// Redirect back to the Account Info page
			header('Location: accountinfo.php?'.sprintf(LOGIN_PARAMS, $_GET[USER], $_GET[PARAM_FIRSTNAME], $_GET[USER_ADMIN]).'&Update=1');
		}
		else {
			$href = sprintf(HREF_FORMAT, "accountinfo.php", sprintf(LOGIN_PARAMS, $_GET[USER], $_GET[USERS_NAME], $_GET[USER_ADMIN]));
		
			// Set the message to the user
			$outputMessage = '<p>You must enter fields. Please go back and re-enter all information.</p>';
			$outputMessage .= '<p><a href="'.$href.'">Go Back</a></p>';
			echo $outputMessage;
		}
	}
	else {		
		if (!empty($_GET[PARAM_PASSWORD]) && !empty($_GET[PARAM_USERNAME])) {
			// Query the User table for the attempted login
			$result = mysqli_query($connection, sprintf($selectquery, $_GET[PARAM_USERNAME], $_GET[PARAM_PASSWORD]));
			if (mysqli_num_rows($result) == 1) {
				// Populate session values with the User details
				$row = mysqli_fetch_assoc($result);
				
				// Free up the results
				mysqli_free_result($result);
				
				$isAdmin = "no";
				if ($row[PARAM_ADMIN] == 1) {
					$isAdmin = "yes";
				}
				
				// Redirect the authenticated user to the home page
				header('Location: index.php?'.sprintf(LOGIN_PARAMS, $row[PARAM_USERNAME], $row[PARAM_FIRSTNAME], $isAdmin));
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