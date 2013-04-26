<?php
	include 'templates/header.php';
	
	define("PARAM_MOVIE_ID", "MovieId");
	
	function ScoreToStars($score) {
		$returnString = "";
		
		for ($count = 0; $count < $score; $count++) {
			$returnString = $returnString."*";
		}
		
		return $returnString;
	}
	
	$movieId = $_GET[PARAM_MOVIE_ID];
	
	//$connection = @mysqli_connect("helios.ite.gmu.edu", "user", "password", "mfarias");
	$connection = mysqli_connect("localhost", "rkime", "Ad7Mm12345!#", "mfarias");
	
	$movies = mysqli_query($connection, "SELECT * FROM movies WHERE MovieId=".$movieId);
	$movie = mysqli_fetch_row($movies);
	$movieCategories = mysqli_query($connection, "SELECT * FROM moviecategories WHERE MovieId=".$movie[MOVIES_ID]);
	$movieCategory = mysqli_fetch_row($movieCategories);
	$categories = mysqli_query($connection, "SELECT * FROM categories WHERE CategoryId=".$movieCategory[2]);
	$category = mysqli_fetch_row($categories);
	$movieRatings = mysqli_query($connection, "SELECT * FROM movieratings WHERE RatingId=".$movie[MOVIES_RATING]);
	$movieRating = mysqli_fetch_row($movieRatings);
	$releaseCompanies = mysqli_query($connection, "SELECT * FROM releasecompanies WHERE CompanyId=".$movie[MOVIES_COMPANY]);
	$releaseCompany = mysqli_fetch_row($releaseCompanies);
	
	echo "\t\t\t", '<div class="list_element">'.PHP_EOL;
	echo "\t\t\t\t", '<div class="column_200 text_center">'.PHP_EOL;
	echo "\t\t\t\t\tImage<br />TBD".PHP_EOL;
	echo "\t\t\t\t", '</div>'.PHP_EOL;
	echo "\t\t\t\t", '<div class="column_800">'.PHP_EOL;
		
	// Movie Information
	echo "\t\t\t\t\t", '<span class="movie_title">', $movie[MOVIES_TITLE], '</span><br />'.PHP_EOL;
	echo "\t\t\t\t\t", "Genre: ".$category[CATEGORIES_NAME]."<br />".PHP_EOL;
	echo "\t\t\t\t\t", "Rating: ".$movieRating[MOVIERATINGS_NAME]."<br />".PHP_EOL;	
	echo "\t\t\t\t\t", "Release Company: ".$releaseCompany[RELEASECOMPANIES_NAME]."<br />".PHP_EOL;
	echo "\t\t\t\t\t", "Release Year: ".$movie[MOVIES_YEAR]."<br />".PHP_EOL;
	echo "\t\t\t\t\t", "Price: $".$movie[MOVIES_PRICE]."<br />".PHP_EOL;
	echo "\t\t\t\t\t", "Shipping: $".$movie[MOVIES_SHIPPING]."<br />".PHP_EOL;
	
	// Description
	echo "\t\t\t\t\t", '<p>'.PHP_EOL;
	echo "\t\t\t\t\t\t", "Description: ", $movie[MOVIES_DESC].PHP_EOL;
	echo "\t\t\t\t\t", '</p>'.PHP_EOL;
	echo "\t\t\t\t", '</div>'.PHP_EOL;
	echo "\t\t\t", '</div>'.PHP_EOL;
		
	mysqli_free_result($movieCategories);
	mysqli_free_result($movieRatings);
	mysqli_free_result($releaseCompanies);
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
		echo "\t\t\t\t\t\t", ScoreToStars($review[REVIEWS_SCORE]).PHP_EOL;
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