<!--Mark Farias
	Richard Kim
	IT 207
	Project
	Description: Application logic that handles saving the user's provided feedback/review to the database.
-->

<?php
	include 'templates/header.php';
	
	define("PARAM_RATING", "rating");
	define("PARAM_FEEDBACK", "feedback");
	define("FORMAT_DATE", '%d-%d-%d');
	
	$parameters = sprintf(LOGIN_PARAMS, $_GET[USER], $_GET[USERS_NAME], $_GET[USER_ADMIN]);
	 
	if(empty($_GET[PARAM_MOVIE_ID]) ||
	   empty($_GET[PARAM_RATING]) ||
	   empty($_GET[PARAM_FEEDBACK])) {		
		$href = sprintf(HREF_FORMAT, "add_feedback.php", 'MovieId'.ASCII_EQUAL.$_GET[PARAM_MOVIE_ID].ASCII_AND.$parameters);
		
		// Set the message to the user
		$outputMessage = '<p>You must enter fields. Please go back and re-enter all information.</p>';
		$outputMessage .= '<p><a href="'.$href.'">Go Back</a></p>';
		echo $outputMessage;
	}
	else {
		$currDate = getDate();
		$query = 'INSERT INTO MovieReviews VALUES (NULL, %d, "'.sprintf(FORMAT_DATE, $currDate["year"], $currDate["mon"], $currDate["mday"]).'", %d, "%s")';
		$result = mysqli_query($connection, sprintf($query, $_GET[PARAM_MOVIE_ID], $_GET[PARAM_RATING], $_GET[PARAM_FEEDBACK]));
		
		// Check for errors or no results
		if(!$result || (mysqli_affected_rows($connection) == 0) || (mysqli_errno($connection) <> 0)) {
			header('Location: error.html?'.$parameters);
		}
		else {
			header('Location: view_movie.php?MovieId='.$_GET[PARAM_MOVIE_ID].'&'.$parameters);
		}
	}
	
	include 'templates/footer.php';
?>