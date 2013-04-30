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
	$insertmoviequery = "INSERT INTO movies VALUES ('%s', '%s', %u, %u, '%s', %u, %.2f, %.2f, '%s')";
	
	// Intialize the message
	$outputMessage = "<div>";
	
	// If we have values, insert the new movie
	if(empty($_GET[PARAM_MOVIENAME]) ||
		empty($_GET[PARAM_DESCRIPTION]) ||
		empty($_GET[PARAM_RATING]) ||
		empty($_GET[PARAM_CATEGORY]) ||
		empty($_GET[PARAM_RELCOMPANY]) ||
		empty($_GET[PARAM_RELYEAR]) ||
		empty($_GET[PARAM_PRICE]) ||
		empty($_GET[PARAM_SHIPPING]) ||
		empty($_GET[PARAM_COVER]) ||
		!isset($_FILES['CoverImage']) ||
		!is_uploaded_file($_FILES['CoverImage']['tmp_name'])) {
		
		// Set the message to the user
		$outputMessage .= '<p>You must enter all of the data for a movie. Please go back and re-enter the details.</p>'
		$outputMessage .= '<p><a href="add_movie.php">Go Back</a></p>';
	}
	else {
		// Check for an acceptable file type
		//$allowedTypes = array("jpeg", "jpg", "gif", "png");
		//$fileExtension = end(explode(".", $_FILES["CoverImage"]["name"]));
		if((($_FILES["CoverImage"]["type"] != "image/jpeg") &&
			($_FILES["CoverImage"]["type"] != "image/jpg") &&
			($_FILES["CoverImage"]["type"] != "image/png") &&
			($_FILES["CoverImage"]["type"] != "image/gif"))) {
			
			// Set the message to the user
			$outputMessage .= '<p>Your cover file is not the correct type(jpeg, jpg, png, or gif). Please go back and try again.</p>'
			$outputMessage .= '<p><a href="add_movie.php">Go Back</a></p>';
		}
		elseif($_FILES["CoverImage"]["size"] > 75000) {
			// Set the message to the user
			$outputMessage .= '<p>Your cover file is too big (exceeds 75Kb). Please go back and try again.</p>'
			$outputMessage .= '<p><a href="add_movie.php">Go Back</a></p>';
		}
		elseif(file_exists("images/covers/" . $_FILES["CoverImage"]["name"])) {
			// Set the message to the user
			$outputMessage .= '<p>A file with the same name was already uploaded. Please go back and try again.</p>'
			$outputMessage .= '<p><a href="add_movie.php">Go Back</a></p>';
		}
		else {
			// The file is good, proceed to upload and save
			$filepath = "images/covers/" . $_FILES["CoverImage"]["name"];
			$result = mysqli_query($connection, sprintf($insertmoviequery, 
				$_GET[PARAM_MOVIENAME], $_GET[PARAM_CATEGORY],
				$_GET[PARAM_RELCOMPANY], $_GET[PARAM_RELYEAR],
				$_GET[PARAM_DESCRIPTION], $_GET[PARAM_RATING],
				$_GET[PARAM_PRICE], $_GET[PARAM_SHIPPING],
				$filepath));
			// Check for errors or no results
			if(!$result && mysqli_affected_rows($connection) > 0) {
				header('Location: error.html');
			}
			else {
				// Inserting to the database worked, so store the cover image to the file system
				move_uploaded_file($_FILES["file"]["tmp_name"], $filepath);
				
				// Set the message to the user
				$outputMessage .= '<p>Your addition of ' . $_GET[PARAM_MOVIENAME] . ' was successful!</p>'
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