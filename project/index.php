<?php
	include 'templates/header.php';
	
	function cmp_ascending($a, $b) {
		if ($a[1] == $b[1]) {
			return 0;
		}
		
		return ($a[1] < $b[1]) ? -1 : 1;
	}
	
	function cmp_descending($a, $b) {
		if ($a[1] == $b[1]) {
			return 0;
		}
		
		return ($b[1] < $a[1]) ? -1 : 1;
	}
	
	define("HREF_VIEWMOVIE", 'view_movie.php&#63;MovieId&#61;%d'); 
	define("HREF_GET_PARAM", '%s&#61;%s');
	define("MAX_LIST_ITEMS", 4);
	define("PARAM_LOWER_BOUND", "lowerBound");
	define("PARAM_UPPER_BOUND", "upperBound");
	
	$start = 0;
	$end = MAX_LIST_ITEMS;
	$params = array();	
	$query = "SELECT * FROM movies";
	
	if (!empty($_GET[PARAM_GENRE])) {
		if ($_GET[PARAM_GENRE] > 0) {
			$params[] = sprintf(HREF_GET_PARAM, PARAM_GENRE, $_GET[PARAM_GENRE]);
			
			$query = $query." WHERE MovieCategory=".$_GET[PARAM_GENRE];
		}
	}
	
	$result = mysqli_query($connection, $query);
	$movies = mysqli_fetch_all($result);
	
	if (count($movies) < MAX_LIST_ITEMS) {
		$end = count($movies);
	}
	
	echo "\t\t\t", '<div class="view text_align_right">'.PHP_EOL;
	if (!empty($_GET[PARAM_GENRE])) {
		echo "\t\t\t\t", '<a class="link_horizontal" href="index.php&#63;'.implode('&#38;', $params).'&#38;'.sprintf(HREF_GET_PARAM, PARAM_SORT, "ascending").'">Sort A-Z</a>'.PHP_EOL;
		echo "\t\t\t\t", '<a class="link_horizontal" href="index.php&#63;'.implode('&#38;', $params).'&#38;'.sprintf(HREF_GET_PARAM, PARAM_SORT, "descending").'">Sort Z-A</a><br />'.PHP_EOL;
	}
	else {
		echo "\t\t\t\t", '<a class="link_horizontal" href="index.php&#63;'.sprintf(HREF_GET_PARAM, PARAM_SORT, "ascending").'">Sort A-Z</a>'.PHP_EOL;
		echo "\t\t\t\t", '<a class="link_horizontal" href="index.php&#63;'.sprintf(HREF_GET_PARAM, PARAM_SORT, "descending").'">Sort Z-A</a><br />'.PHP_EOL;
	}
	echo "\t\t\t", '</div>'.PHP_EOL;
	
	if (!empty($_GET[PARAM_SORT])) {		
		$params[] = sprintf(HREF_GET_PARAM, PARAM_SORT, $_GET[PARAM_SORT]);
		
		if ($_GET[PARAM_SORT] == "ascending") {
			usort($movies, 'cmp_ascending');
		}
		else {
			usort($movies, 'cmp_descending');
		}
	}
	
	if (!empty($_GET[PARAM_LOWER_BOUND]) && !empty($_GET[PARAM_UPPER_BOUND])) {		
		$start = $_GET[PARAM_LOWER_BOUND];
		$end = $_GET[PARAM_UPPER_BOUND];
	}
	
	echo "\t\t\t", '<div class="column_1000">'.PHP_EOL;
	if ($start != 0) {
		echo '<a class="link_prev" href="index.php&#63;'.implode('&#38;', $params).'&#38;'.sprintf(HREF_GET_PARAM, PARAM_LOWER_BOUND, $start - MAX_LIST_ITEMS).'&#38;'.sprintf(HREF_GET_PARAM, PARAM_UPPER_BOUND, $end - MAX_LIST_ITEMS).'"><< Prev</a>'.PHP_EOL;
	}
	
	if ($end != count($movies)) {	
		if ($end + MAX_LIST_ITEMS < count($movies)) {
			echo '<a class="link_next" href="index.php&#63;'.implode('&#38;', $params).'&#38;'.sprintf(HREF_GET_PARAM, PARAM_LOWER_BOUND, $start + MAX_LIST_ITEMS).'&#38;'.sprintf(HREF_GET_PARAM, PARAM_UPPER_BOUND, $end + MAX_LIST_ITEMS).'">Next >></a>'.PHP_EOL;
		}
		else {
			echo '<a class="link_next" href="index.php&#63;'.implode('&#38;', $params).'&#38;'.sprintf(HREF_GET_PARAM, PARAM_LOWER_BOUND, $start + MAX_LIST_ITEMS).'&#38;'.sprintf(HREF_GET_PARAM, PARAM_UPPER_BOUND, count($movies)).'">Next >></a>'.PHP_EOL;
		}
	}
	echo "\t\t\t", '</div><br />'.PHP_EOL;
	
	echo "\t\t\t", '<div class="list_view">'.PHP_EOL;
	for ($start; $start < $end; $start++) {
		$movie = $movies[$start];
		$categories = mysqli_query($connection, "SELECT * FROM categories WHERE CategoryId=".$movie[MOVIES_CATEGORY]);
		$category = mysqli_fetch_row($categories);
		$movieRatings = mysqli_query($connection, "SELECT * FROM movieratings WHERE RatingId=".$movie[MOVIES_RATING]);
		$movieRating = mysqli_fetch_row($movieRatings);
		
		echo "\t\t\t\t", '<div class="list_element">'.PHP_EOL;
		echo "\t\t\t\t\t", '<div class="column_200 float_left">'.PHP_EOL;
		echo "\t\t\t\t\t\t", '<img class="cover_image" src="' . $movie[MOVIES_COVER] . '" alt_text="' . $movie[MOVIES_TITLE] . '" />' .PHP_EOL;
		echo "\t\t\t\t\t", '</div>'.PHP_EOL;
		echo "\t\t\t\t\t", '<div class="column_750 float_left">'.PHP_EOL;
		
		// Movie Info
		echo "\t\t\t\t\t\t", '<a href="', sprintf(HREF_VIEWMOVIE, $movie[MOVIES_ID]), '"><span class="movie_title">', $movie[MOVIES_TITLE], '</span></a><br />'.PHP_EOL;		
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
	echo "\t\t\t", '</div>'.PHP_EOL;	
	
	mysqli_free_result($result);
	
	include 'templates/footer.php';
?>