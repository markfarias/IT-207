<?php
	include 'templates/header.php';
	
	function ScoreToStars($score) {
		$returnString = "";
		
		for ($count = 0; $count < $score; $count++) {
			$returnString = $returnString."*";
		}
		
		return $returnString;
	}
	
	$movieId = $_GET[PARAM_MOVIE_ID];
	
	$movies = mysqli_query($connection, "SELECT * FROM movies WHERE MovieId=".$movieId);
	$movie = mysqli_fetch_row($movies);
	$categories = mysqli_query($connection, "SELECT * FROM categories WHERE CategoryId=".$movie[MOVIES_CATEGORY]);
	$category = mysqli_fetch_row($categories);
	$movieRatings = mysqli_query($connection, "SELECT * FROM movieratings WHERE RatingId=".$movie[MOVIES_RATING]);
	$movieRating = mysqli_fetch_row($movieRatings);
	$releaseCompanies = mysqli_query($connection, "SELECT * FROM releasecompanies WHERE CompanyId=".$movie[MOVIES_COMPANY]);
	$releaseCompany = mysqli_fetch_row($releaseCompanies);
	
	echo "\t\t\t", '<div class="list_view">'.PHP_EOL;
	echo "\t\t\t\t", '<div class="list_element">'.PHP_EOL;
	echo "\t\t\t\t\t", '<div class="column_125 float_left">'.PHP_EOL;
	echo "\t\t\t\t\t\t", '<img class="cover_image" src="' . $movie[MOVIES_COVER] . '" alt="' . $movie[MOVIES_TITLE] . '" />' .PHP_EOL;
	echo "\t\t\t\t\t", '</div>'.PHP_EOL;
	echo "\t\t\t\t\t", '<div class="column_600 float_left">'.PHP_EOL;
		
	// Movie Information
	echo "\t\t\t\t\t\t", '<span class="movie_title">', $movie[MOVIES_TITLE], '</span><br />'.PHP_EOL;
	echo "\t\t\t\t\t\t", "Genre: ".$category[CATEGORIES_NAME]."<br />".PHP_EOL;
	echo "\t\t\t\t\t\t", "Rating: ".$movieRating[MOVIERATINGS_NAME]."<br />".PHP_EOL;	
	echo "\t\t\t\t\t\t", "Release Company: ".$releaseCompany[RELEASECOMPANIES_NAME]."<br />".PHP_EOL;
	echo "\t\t\t\t\t\t", "Release Year: ".$movie[MOVIES_YEAR]."<br />".PHP_EOL;
	echo "\t\t\t\t\t\t", "Price: $".$movie[MOVIES_PRICE]."<br />".PHP_EOL;
	echo "\t\t\t\t\t\t", "Shipping: $".$movie[MOVIES_SHIPPING]."<br />".PHP_EOL;
	
	// Description
	echo "\t\t\t\t\t\t", '<p>'.PHP_EOL;
	echo "\t\t\t\t\t\t\t", "Description: ", $movie[MOVIES_DESC].PHP_EOL;
	echo "\t\t\t\t\t\t", '</p>'.PHP_EOL;
	
	if (!empty($_SESSION[SESSION_USER])) {
		echo "\t\t\t\t\t\t", '<a class="link_button" href="'.sprintf(HREF_FORMAT, "add_feedback.php", sprintf(HREF_GET_PARAM, "MovieId", $movieId)).'">Add Feedback</a>'.PHP_EOL;
	}
	
	echo "\t\t\t\t\t", '</div>'.PHP_EOL;
	echo "\t\t\t\t\t", '<div class="clear_floats"></div>'.PHP_EOL;
	echo "\t\t\t\t", '</div>'.PHP_EOL;
	echo "\t\t\t", '</div>'.PHP_EOL;
	
	mysqli_free_result($movieRatings);
	mysqli_free_result($releaseCompanies);
	mysqli_free_result($movies);
	
	// User Feedback
	echo "\t\t\t", '<div class="list_view">'.PHP_EOL;
	echo "\t\t\t\t", '<h1>User Reviews</h1>'.PHP_EOL;
	
	$reviews = mysqli_query($connection, "SELECT * FROM moviereviews WHERE MovieId=".$movieId);
	
	for ($index = 0; $index < mysqli_num_rows($reviews); $index++) {
		$review = mysqli_fetch_row($reviews);
		
		echo "\t\t\t\t", '<hr />'.PHP_EOL;
		echo "\t\t\t\t", '<div class="list_element_feedback">'.PHP_EOL;
		echo "\t\t\t\t\t", '<div>'.PHP_EOL;
		echo "\t\t\t\t\t\t", '<div class="column_150 float_left stars">'.PHP_EOL;
		echo "\t\t\t\t\t\t\t", ScoreToStars($review[REVIEWS_SCORE]).PHP_EOL;
		echo "\t\t\t\t\t\t", '</div>'.PHP_EOL;
		echo "\t\t\t\t\t\t", '<div class="column_150 float_left">'.PHP_EOL;
		echo "\t\t\t\t\t\t\t", '<h2>' . $review[REVIEWS_DATE] . '</h2>'.PHP_EOL;
		echo "\t\t\t\t\t\t", '</div>'.PHP_EOL;
		echo "\t\t\t\t\t\t", '<div class="column_500 float_left">'.PHP_EOL;
		echo "\t\t\t\t\t\t\t", $review[REVIEWS_COMMENTS].PHP_EOL;
		echo "\t\t\t\t\t\t", '</div>'.PHP_EOL;
		echo "\t\t\t\t\t\t", '<div class="clear_floats"></div>'.PHP_EOL;
		echo "\t\t\t\t\t", '</div>'.PHP_EOL;
		echo "\t\t\t\t", '</div>'.PHP_EOL;
	}
	
	echo "\t\t\t</div>".PHP_EOL;
	
	include 'templates/footer.php';
?>