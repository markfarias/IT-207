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
	
	// If we have values, insert the new movie
	if(empty($_POST[PARAM_MOVIE_ID]) ||
	   empty($_POST[PARAM_RATING]) ||
	   empty($_POST[PARAM_FEEDBACK])) {		
		// Set the message to the user
		$outputMessage .= '<p>You must enter fields. Please go back and re-enter all information.</p>';
		$outputMessage .= '<p><a href="add_movie.php">Go Back</a></p>';
	}
	else {
		$currDate = getDate();
		$query = 'INSERT INTO MovieReviews VALUES (NULL, %d, "'.sprintf(FORMAT_DATE, $currDate["year"], $currDate["mon"], $currDate["mday"]).'", %d, "%s")';
		$result = mysqli_query($connection, sprintf($query, $_POST[PARAM_MOVIE_ID], $_POST[PARAM_RATING], $_POST[PARAM_FEEDBACK]));
		
		// Check for errors or no results
		if(!$result || (mysqli_affected_rows($connection) == 0) || (mysqli_errno($connection) <> 0)) {
			header('Location: error.html');
		}
		else {
			header('Location: view_movie.php?MovieId='.$_POST[PARAM_MOVIE_ID]);
		}
	}
	
	include 'templates/footer.php';
?>