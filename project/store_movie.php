<?php
	// Load the header
	include 'templates/header.php';
	
	// Define the constants
	define("PARAM_MOVIENAME", "MovieName");
	define("PARAM_DESCRIPTION", "Description");
	define("PARAM_CATEGORY", "Category");
	define("PARAM_RELCOMPANY", "ReleaseCompany");
	define("PARAM_RELYEAR", "ReleaseYear");
	define("PARAM_RATING", "Rating");
	define("PARAM_PRICE", "Price");
	define("PARAM_SHIPPING", "Shipping");
	define("PARAM_COVER", "CoverImage");
	
	// Initalize the insert query
	$insertmoviequery = "INSERT INTO movies(MovieName, MovieCategory, ReleaseCompany, ReleaseYear, Description, Rating, Price, ShippingRate, CoverImage) ";
	$insertmoviequery .= "VALUES ('%s', %u, %u, '%s', '%s', %u, %.2f, %.2f, '%s')";
	
	// Intialize the message
	$outputMessage = '<div>';
	
	// If we have values, insert the new movie
	if(empty($_POST[PARAM_MOVIENAME]) ||
		empty($_POST[PARAM_DESCRIPTION]) ||
		empty($_POST[PARAM_RATING]) ||
		empty($_POST[PARAM_CATEGORY]) ||
		empty($_POST[PARAM_RELCOMPANY]) ||
		empty($_POST[PARAM_RELYEAR]) ||
		empty($_POST[PARAM_PRICE]) ||
		empty($_POST[PARAM_SHIPPING]) ||
		!isset($_FILES[PARAM_COVER]) ||
		!is_uploaded_file($_FILES[PARAM_COVER]['tmp_name'])) {
		
		// Set the message to the user
		//$outputMessage .= '<p>You must enter all of the data for a movie. Please go back and re-enter the details.</p>';
		//$outputMessage .= '<p><a href="add_movie.php">Go Back</a></p>';
		header('Location: add_movie.php?Error=1');
	}
	else {
		// Check for an acceptable file type
		if((($_FILES[PARAM_COVER]["type"] != "image/jpeg") &&
			($_FILES[PARAM_COVER]["type"] != "image/jpg") &&
			($_FILES[PARAM_COVER]["type"] != "image/png") &&
			($_FILES[PARAM_COVER]["type"] != "image/gif"))) {
			
			// Set the message to the user
			//$outputMessage .= '<p>Your cover file is not the correct type(jpeg, jpg, png, or gif). Please go back and try again.</p>';
			//$outputMessage .= '<p><a href="add_movie.php">Go Back</a></p>';
			header('Location: add_movie.php?Error=2');
		}
		elseif($_FILES[PARAM_COVER]["size"] > 75000) {
			// Set the message to the user
			//$outputMessage .= '<p>Your cover file is too big (exceeds 75Kb). Please go back and try again.</p>';
			//$outputMessage .= '<p><a href="add_movie.php">Go Back</a></p>';
			header('Location: add_movie.php?Error=3');
		}
		elseif(file_exists("images/covers/" . $_FILES[PARAM_COVER]["name"])) {
			// Set the message to the user
			//$outputMessage .= '<p>A file with the same name was already uploaded. Please go back and try again.</p>';
			//$outputMessage .= '<p><a href="add_movie.php">Go Back</a></p>';
			header('Location: add_movie.php?Error=4');
		}
		else {
			// The file is good, proceed to upload and save
			$filepath = "images/covers/" . $_FILES[PARAM_COVER]["name"];
			$finalquery = sprintf($insertmoviequery, 
				mysqli_real_escape_string($connection, $_POST[PARAM_MOVIENAME]), $_POST[PARAM_CATEGORY],
				$_POST[PARAM_RELCOMPANY], mysqli_real_escape_string($connection, $_POST[PARAM_RELYEAR]),
				mysqli_real_escape_string($connection, $_POST[PARAM_DESCRIPTION]), $_POST[PARAM_RATING],
				$_POST[PARAM_PRICE], $_POST[PARAM_SHIPPING],
				$filepath);
			
			$result = mysqli_query($connection, $finalquery);
			// Check for errors or no results
			if(!$result || (mysqli_affected_rows($connection) == 0) || (mysqli_errno($connection) <> 0)) {
				header('Location: error.html');
			}
			else {
				// Inserting to the database worked, so store the cover image to the file system
				move_uploaded_file($_FILES[PARAM_COVER]["tmp_name"], $filepath);
				
				// Set the message to the user
				$outputMessage .= '<p>Your addition of ' . $_POST[PARAM_MOVIENAME] . ' was successful!</p>';
				$outputMessage .= '<p><a href="add_movie.php">Add Another Movie...</a></p>';
			}
		}
	}
	
	// Display the message to the user
	$outputMessage .= '</div>';
	echo $outputMessage;
?>

<?php
	// Load the footer
	include 'templates/footer.php';
?>