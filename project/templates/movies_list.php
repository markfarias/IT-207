<?php
	define("MAX_ITEMS", 5);
	define("PARAM_LOWER_BOUND", "lowerBound");
	define("PARAM_UPPER_BOUND", "upperBound");
	
	$lowerBound = 0;
	$upperBound = MAX_ITEMS;
	$nextUpperBound = $upperBound + MAX_ITEMS;
	$prevUpperBound = $upperBound - MAX_ITEMS;
	
	// Calculate the lower and upper bounds for pagination
	if (!empty($_GET[PARAM_LOWER_BOUND]) && !empty($_GET[PARAM_UPPER_BOUND])) {		
		$lowerBound = $_GET[PARAM_LOWER_BOUND];
		$upperBound = $_GET[PARAM_UPPER_BOUND];
		
		$nextUpperBound = $upperBound + MAX_ITEMS;
		$prevUpperBound = $upperBound - MAX_ITEMS;
		
		if ($upperBound + MAX_ITEMS >= count($movies)) {
			$nextUpperBound = count($movies);
		}
		
		if ($upperBound == count($movies)) {
			$prevUpperBound = $upperBound - ($upperBound % MAX_ITEMS);
		}
	}
	else if ($upperBound + MAX_ITEMS >= count($movies)) {
		$nextUpperBound = count($movies);
	}
	
	// Constructing HREF used by the Next and Prev links
	$href_next = $_SERVER['SCRIPT_NAME'].ASCII_QUESTION.sprintf(HREF_GET_PARAM, PARAM_LOWER_BOUND, $lowerBound + MAX_ITEMS).ASCII_AND.sprintf(HREF_GET_PARAM, PARAM_UPPER_BOUND, $nextUpperBound);
	$href_prev = $_SERVER['SCRIPT_NAME'].ASCII_QUESTION.sprintf(HREF_GET_PARAM, PARAM_LOWER_BOUND, $lowerBound - MAX_ITEMS).ASCII_AND.sprintf(HREF_GET_PARAM, PARAM_UPPER_BOUND, $prevUpperBound);
	
	if (!empty($_GET[PARAM_SORT])) {		
		$href_next = $href_next.ASCII_AND.sprintf(HREF_GET_PARAM, PARAM_SORT, $_GET[PARAM_SORT]);
		$href_prev = $href_prev.ASCII_AND.sprintf(HREF_GET_PARAM, PARAM_SORT, $_GET[PARAM_SORT]);
	}
	
	if (!empty($_GET[PARAM_GENRE])) {
		if ($_GET[PARAM_GENRE] > 0) {
			$href_next = $href_next.sprintf(HREF_GET_PARAM, PARAM_GENRE, $_GET[PARAM_GENRE]);
			$href_prev = $href_prev.sprintf(HREF_GET_PARAM, PARAM_GENRE, $_GET[PARAM_GENRE]);
		}
	}
?>
	<div>
		<?php
			if ($lowerBound != 0) {
				echo '<a class="link_prev" href="'.$href_prev.'"><< Prev</a>'.PHP_EOL;
			}
			else {
				echo '<span class="link_prev_disabled"><< Prev</span>'.PHP_EOL;
			}
			
			if ($upperBound != count($movies)) {
				echo '<a class="link_next" href="'.$href_next.'">Next >></a>'.PHP_EOL;
			}
			else {
				echo '<span class="link_next_disabled">Next >></span>'.PHP_EOL;
			}
		?>
	</div><br />
	
	<div class="list_view center">
		<?php
				for ($count = $lowerBound; $count < $upperBound; $count++) {
				$movie = $movies[$count];
				$categories = mysqli_query($connection, "SELECT * FROM categories WHERE CategoryId=".$movie[MOVIES_CATEGORY]);
				$category = mysqli_fetch_row($categories);
				$movieRatings = mysqli_query($connection, "SELECT * FROM movieratings WHERE RatingId=".$movie[MOVIES_RATING]);
				$movieRating = mysqli_fetch_row($movieRatings);
				
				echo "\t\t\t\t", '<div class="list_element center">'.PHP_EOL;
				echo "\t\t\t\t\t", '<div class="column_125 float_left">'.PHP_EOL;
				echo "\t\t\t\t\t\t", '<img class="cover_image" src="' . $movie[MOVIES_COVER] . '" alt_text="' . $movie[MOVIES_TITLE] . '" />' .PHP_EOL;
				echo "\t\t\t\t\t", '</div>'.PHP_EOL;
				echo "\t\t\t\t\t", '<div class="column_700 float_left">'.PHP_EOL;
				
				// Movie Info
				echo "\t\t\t\t\t\t", '<a href="', sprintf(HREF_FORMAT, "view_movie.php", "MovieId=".$movie[MOVIES_ID]), '"><span class="movie_title">', $movie[MOVIES_TITLE], '</span></a><br />'.PHP_EOL;		
				echo "\t\t\t\t\t\t", "Genre: ".$category[CATEGORIES_NAME]."<br />".PHP_EOL;
				echo "\t\t\t\t\t\t", "Rating: ".$movieRating[MOVIERATINGS_NAME]."<br />".PHP_EOL;
				
				// Description
				echo "\t\t\t\t\t\t", '<p>'.PHP_EOL;
				echo "\t\t\t\t\t\t\t", "Description: ", $movie[MOVIES_DESC].PHP_EOL;
				echo "\t\t\t\t\t\t", '</p>'.PHP_EOL;
				echo "\t\t\t\t\t", '</div>'.PHP_EOL;
				echo "\t\t\t\t", '</div>'.PHP_EOL;
				echo "\t\t\t\t", '<div class="clear_floats"></div>'.PHP_EOL;
				
				mysqli_free_result($categories);
				mysqli_free_result($movieRatings);
			}
		?>
	</div>