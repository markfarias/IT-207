<?php
	include 'templates/header.php';
	
	define("HREF_VIEWMOVIE", 'view_movie.php&#63;MovieId&#61;%d'); 
	$query = "SELECT * FROM movies";
	
	if (!empty($_GET[PARAM_GENRE])) {
		$filters = mysqli_query($connection, "SELECT * FROM categories WHERE CategoryName=".'"'.$_GET[PARAM_GENRE].'"');
		$filter = mysqli_fetch_row($filters);
		
		$query = $query." WHERE MovieCategory=".$filter[CATEGORIES_ID];
	}
	
	$movies = mysqli_query($connection, $query);
	
	for ($index = 0; $index < mysqli_num_rows($movies); $index++) {
		$movie = mysqli_fetch_row($movies);
		$categories = mysqli_query($connection, "SELECT * FROM categories WHERE CategoryId=".$movie[MOVIES_CATEGORY]);
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
		
		mysqli_free_result($categories);
		mysqli_free_result($movieRatings);
	}
	
	mysqli_free_result($movies);
	
	include 'templates/footer.php';
?>