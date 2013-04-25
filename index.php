<?php
	include 'templates/header.php';
	
	define("HREF_VIEWMOVIE", 'view_movie.php&#63;MovieId&#61;%d'); 
	
	//$connection = @mysqli_connect("helios.ite.gmu.edu", "user", "password", "mfarias");
	$connection = mysqli_connect("localhost", "rkime", "Ad7Mm12345!#", "mfarias");
	
	// TODO: Update after modifications to the database to enable filtering
	if (!empty($_GET[PARAM_GENRE])) {
		$query = "SELECT * FROM categories WHERE CategoryName=".$_GET[PARAM_GENRE];
	}
	
	$movies = mysqli_query($connection, "SELECT * FROM movies");
	
	for ($index = 0; $index < mysqli_num_rows($movies); $index++) {
		$movie = mysqli_fetch_row($movies);
		$movieCategories = mysqli_query($connection, "SELECT * FROM moviecategories WHERE MovieId=".$movie[MOVIES_ID]);
		$movieCategory = mysqli_fetch_row($movieCategories);
		$categories = mysqli_query($connection, "SELECT * FROM categories WHERE CategoryId=".$movieCategory[2]);
		$category = mysqli_fetch_row($categories);
		$movieRatings = mysqli_query($connection, "SELECT * FROM movieratings WHERE RatingId=".$movie[MOVIES_RATING]);
		$movieRating = mysqli_fetch_row($movieRatings);
		
		echo "\t\t\t", '<div class="list_element">'.PHP_EOL;
		echo "\t\t\t\t", '<div class="column_200 text_center">'.PHP_EOL;
		echo "\t\t\t\t\tImage<br />TBD".PHP_EOL;
		echo "\t\t\t\t", '</div>'.PHP_EOL;
		echo "\t\t\t\t", '<div class="column_800">'.PHP_EOL;
		
		// Movie Info
		echo "\t\t\t\t\t", '<a href="', sprintf(HREF_VIEWMOVIE, $movie[MOVIES_ID]), '"><span class="movie_title">', $movie[MOVIES_TITLE], '</span></a><br />'.PHP_EOL;		
		echo "\t\t\t\t\t", "Genre: ".$category[CATEGORIES_NAME]."<br />".PHP_EOL;
		echo "\t\t\t\t\t", "Rating: ".$movieRating[MOVIERATINGS_NAME]."<br />".PHP_EOL;
		
		// Description
		echo "\t\t\t\t\t", '<p>'.PHP_EOL;
		echo "\t\t\t\t\t\t", "Description: ", $movie[MOVIES_DESC].PHP_EOL;
		echo "\t\t\t\t\t", '</p>'.PHP_EOL;
		echo "\t\t\t\t", '</div>'.PHP_EOL;
		echo "\t\t\t", '</div>'.PHP_EOL;
		
		mysqli_free_result($movieCategories);
		mysqli_free_result($categories);
		mysqli_free_result($movieRatings);
	}
	
	mysqli_free_result($movies);
	mysqli_close($connection);
	
	include 'templates/footer.php';
?>