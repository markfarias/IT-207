<?php
	include 'templates/header.php';
	
	define("HREF_VIEWMOVIE", 'view_movie.php&#63;MovieId&#61;%d'); 
	
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
	
	$query = "SELECT * FROM movies";
	
	if (!empty($_GET[PARAM_GENRE])) {
		$filters = mysqli_query($connection, "SELECT * FROM categories WHERE CategoryName=".'"'.$_GET[PARAM_GENRE].'"');
		$filter = mysqli_fetch_row($filters);
		
		$query = $query." WHERE MovieCategory=".$filter[CATEGORIES_ID];
	}
	
	$result = mysqli_query($connection, $query);
	$movies = mysqli_fetch_all($result);
	mysqli_free_result($result);
	
	if (!empty($_GET["sort"])) {
		if ($_GET["sort"] == "ascending") {
			uasort($movies, 'cmp_ascending');
		}
		else {
			uasort($movies, 'cmp_descending');
		}
	}
	
	echo "\t\t\t", '<div class="view text_align_right">'.PHP_EOL;
	echo "\t\t\t\t", '<a class="link_horizontal" href="index.php&#63;sort&#61;ascending">Sort A-Z</a>'.PHP_EOL;
    echo "\t\t\t\t", '<a class="link_horizontal" href="index.php&#63;sort&#61;descending">Sort Z-A</a><br />'.PHP_EOL;
	echo "\t\t\t", '</div>'.PHP_EOL;
	
	echo "\t\t\t", '<div class="list_view">'.PHP_EOL;
	foreach ($movies as $movie) {
		$categories = mysqli_query($connection, "SELECT * FROM categories WHERE CategoryId=".$movie[MOVIES_CATEGORY]);
		$category = mysqli_fetch_row($categories);
		$movieRatings = mysqli_query($connection, "SELECT * FROM movieratings WHERE RatingId=".$movie[MOVIES_RATING]);
		$movieRating = mysqli_fetch_row($movieRatings);
		
		echo "\t\t\t\t", '<div class="list_element">'.PHP_EOL;
		echo "\t\t\t\t\t", '<div class="column_200 text_center">'.PHP_EOL;
		echo "\t\t\t\t\t\t", '<img class="cover_image" src="' . $movie[MOVIES_COVER] . '" alt_text="' . $movie[MOVIES_TITLE] . '" />' .PHP_EOL;
		echo "\t\t\t\t\t", '</div>'.PHP_EOL;
		echo "\t\t\t\t\t", '<div class="column_750">'.PHP_EOL;
		
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
	
	include 'templates/footer.php';
?>