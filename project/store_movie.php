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
	
	// If we have values, insert the new movie
	if(empty($_GET[PARAM_MOVIENAME]) ||
		empty($_GET[PARAM_DESCRIPTION]) ||
		empty($_GET[PARAM_RATING]) ||
		empty($_GET[PARAM_CATEGORY]) ||
		empty($_GET[PARAM_RELCOMPANY]) ||
		empty($_GET[PARAM_RELYEAR]) ||
		empty($_GET[PARAM_PRICE] ||
		empty($_GET[PARAM_SHIPPING] ||
		empty($_GET[PARAM_COVER])) {
		
	}
	else {
	
	}
?>

<p><a href="add_movie.php">Add another movie...</a></p>

<?php
	// Load the footer
	include 'templates/footer.php';
?>