<?php
	include 'templates/header.php';
	
	// Database field constants
	define("CATEGORIES_NAME", 1);
	define("MOVIERATINGS_NAME", 1);
	define("MOVIES_ID", 0);
	define("MOVIES_TITLE", 1);
	define("MOVIES_COMPANY", 2);
	define("MOVIES_YEAR", 3);
	define("MOVIES_DESC", 4);
	define("MOVIES_RATING", 5);
	
	define("HREF_VIEWMOVIE", 'view_movie.php&#63;MovieId&#61;%d'); 
	
	//$connection = @mysqli_connect("helios.ite.gmu.edu", "user", "password", "mfarias");
	$connection = mysqli_connect("localhost", "rkime", "Ad7Mm12345!#", "mfarias");
	
	$movies = mysqli_query($connection, "SELECT * FROM movies");
	
	for ($index = 0; $index < mysqli_num_rows($movies); $index++) {
		$movie = mysqli_fetch_row($movies);
		
		echo "\t\t\t", '<div class="list_element">'.PHP_EOL;
		echo "\t\t\t\t", '<div class="column_200 text_center">'.PHP_EOL;
		echo "\t\t\t\t\tImage<br />TBD".PHP_EOL;
		echo "\t\t\t\t", '</div>'.PHP_EOL;
		echo "\t\t\t\t", '<div class="column_800">'.PHP_EOL;
		
		// Title and Feedback
		echo "\t\t\t\t\t", '<a href="', sprintf(HREF_VIEWMOVIE, $movie[MOVIES_ID]), '"><span class="movie_title">', $movie[MOVIES_TITLE], '</span></a><br />'.PHP_EOL;
		echo "Feedback: <br />".PHP_EOL;
		
		// Genre and Rating
		$movieCategories = mysqli_query($connection, "SELECT * FROM moviecategories WHERE MovieId=".$movie[MOVIES_ID]);
		$movieCategory = mysqli_fetch_row($movieCategories);
		$categories = mysqli_query($connection, "SELECT * FROM categories WHERE CategoryId=".$movieCategory[2]);
		$category = mysqli_fetch_row($categories);
		$movieRatings = mysqli_query($connection, "SELECT * FROM movieratings WHERE RatingId=".$movie[MOVIES_RATING]);
		$movieRating = mysqli_fetch_row($movieRatings);
		
		echo "\t\t\t\t\t", "Genre: ".$category[CATEGORIES_NAME]."<br />".PHP_EOL;
		echo "\t\t\t\t\t", "Rating: ".$movieRating[MOVIERATINGS_NAME]."<br />".PHP_EOL;
		
		mysqli_free_result($movieCategories);
		mysqli_free_result($movieRatings);
		
		// Description
		echo "\t\t\t\t\t", '<p>'.PHP_EOL;
		echo "\t\t\t\t\t\t", "Description: ", $movie[MOVIES_DESC].PHP_EOL;
		echo "\t\t\t\t\t", '</p>'.PHP_EOL;
		echo "\t\t\t\t", '</div>'.PHP_EOL;
		echo "\t\t\t", '</div>'.PHP_EOL;
	}
	
	mysqli_free_result($movies);
	mysqli_close($connection);
	
	include 'templates/footer.php';
?>