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
	define("REVIEWS_DATE", 2);
	define("REVIEWS_SCORE", 3);
	define("REVIEWS_COMMENTS", 4);
	
	define("PARAM_MOVIE_ID", "MovieId");
	
	$movieId = $_GET[PARAM_MOVIE_ID];
	
	//$connection = @mysqli_connect("helios.ite.gmu.edu", "user", "password", "mfarias");
	$connection = mysqli_connect("localhost", "rkime", "Ad7Mm12345!#", "mfarias");
	
	$movies = mysqli_query($connection, "SELECT * FROM movies WHERE MovieId=".$movieId);
	$movie = mysqli_fetch_row($movies);
	
	echo "\t\t\t", '<div class="list_element">'.PHP_EOL;
	echo "\t\t\t\t", '<div class="column_200 text_center">'.PHP_EOL;
	echo "\t\t\t\t\tImage<br />TBD".PHP_EOL;
	echo "\t\t\t\t", '</div>'.PHP_EOL;
	echo "\t\t\t\t", '<div class="column_800">'.PHP_EOL;
		
	// Title and Feedback
	echo "\t\t\t\t\t", '<span class="movie_title">', $movie[MOVIES_TITLE], '</span><br />'.PHP_EOL;
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
	
	// Description
	echo "\t\t\t\t\t", '<p>'.PHP_EOL;
	echo "\t\t\t\t\t\t", "Description: ", $movie[MOVIES_DESC].PHP_EOL;
	echo "\t\t\t\t\t", '</p>'.PHP_EOL;
	echo "\t\t\t\t", '</div>'.PHP_EOL;
	echo "\t\t\t", '</div>'.PHP_EOL;
		
	mysqli_free_result($movieCategories);
	mysqli_free_result($movieRatings);
	mysqli_free_result($movies);
		
	// User Feedback
	echo "\t\t\t", '<hr />'.PHP_EOL;
	echo "\t\t\t", '<div>'.PHP_EOL;
	echo "\t\t\t\t", '<h2>User Reviews</h2>'.PHP_EOL;
	
	$reviews = mysqli_query($connection, "SELECT * FROM moviereviews WHERE MovieId=".$movieId);
	
	for ($index = 0; $index < mysqli_num_rows($reviews); $index++) {
		$review = mysqli_fetch_row($reviews);
		
		echo "\t\t\t\t", '<div>'.PHP_EOL;
		echo "\t\t\t\t\t", '<div class="column_200">'.PHP_EOL;
		echo "\t\t\t\t\t\t", $review[REVIEWS_SCORE].PHP_EOL;
		echo "\t\t\t\t\t", '</div>'.PHP_EOL;
		echo "\t\t\t\t\t", '<div class="column_200">'.PHP_EOL;
		echo "\t\t\t\t\t\t", $review[REVIEWS_DATE].PHP_EOL;
		echo "\t\t\t\t\t", '</div>'.PHP_EOL;
		echo "\t\t\t\t\t", '<div class="column_600">'.PHP_EOL;
		echo "\t\t\t\t\t\t", $review[REVIEWS_COMMENTS].PHP_EOL;
		echo "\t\t\t\t\t", '</div>'.PHP_EOL;
		echo "\t\t\t\t", '</div>'.PHP_EOL;
	}
	
	echo "\t\t\t</div>".PHP_EOL;
	
	mysqli_close($connection);
	
	include 'templates/footer.php';
?>