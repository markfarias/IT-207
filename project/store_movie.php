<!--Mark Farias
	Richard Kim
	IT 207
	Project
	Description: Application logic that handles saving the added movie to the database. Checks for invalid entry.
-->

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
	$insertmoviequery = "INSERT INTO Movies(MovieName, MovieCategory, ReleaseCompany, ReleaseYear, Description, Rating, Price, ShippingRate, CoverImage) ";
	$insertmoviequery .= "VALUES ('%s', %u, %u, '%s', '%s', %u, %.2f, %.2f, '%s')";
	
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
		
		// Redirect the user back
		header('Location: add_movie.php?'.sprintf(LOGIN_PARAMS, $_POST[USER], $_POST[USERS_NAME], $_POST[USER_ADMIN]).'&Error=1');
	}
	else {
		// Check for an acceptable file type
		if((($_FILES[PARAM_COVER]["type"] != "image/jpeg") &&
			($_FILES[PARAM_COVER]["type"] != "image/jpg") &&
			($_FILES[PARAM_COVER]["type"] != "image/png") &&
			($_FILES[PARAM_COVER]["type"] != "image/gif"))) {
			
			// Redirect the user back
			header('Location: add_movie.php?'.sprintf(LOGIN_PARAMS, $_POST[USER], $_POST[USERS_NAME], $_POST[USER_ADMIN]).'&Error=2');
		}
		elseif($_FILES[PARAM_COVER]["size"] > 75000) {
			// Redirect the user back
			header('Location: add_movie.php?'.sprintf(LOGIN_PARAMS, $_POST[USER], $_POST[USERS_NAME], $_POST[USER_ADMIN]).'&Error=3');
		}
		elseif(file_exists("images/covers/" . $_FILES[PARAM_COVER]["name"])) {
			// Redirect the user back
			header('Location: add_movie.php?'.sprintf(LOGIN_PARAMS, $_POST[USER], $_POST[USERS_NAME], $_POST[USER_ADMIN]).'&Error=4');
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
			}
		}
	}
	
	// Display the message to the user
?>
	<div id="dialog_message_box" class="center">
		<div id="dialog_message">
			<div class="float_left">
				<img src="images/Success.png" height="100px" width="100px" />
			</div>
			<div class="float_left" style="width: 350px; margin-left: 10px">
				<p class="feedback">Your new movie has been added!</p>
				<p>
					<?php
						echo '<a href="add_movie.php?'.sprintf(LOGIN_PARAMS, $_POST[USER], $_POST[USERS_NAME], $_POST[USER_ADMIN]).'">Add another Movie...</a>';
					?>
				</p>
			</div>
			<div class="clear_floats"></div>
		</div>
	</div>
<?php
	// Load the footer
	include 'templates/footer.php';
?>