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
	
	$query = "SELECT * FROM movies";
	$href_sort_ascending = sprintf(HREF_FORMAT, $_SERVER['SCRIPT_NAME'], sprintf(HREF_GET_PARAM, PARAM_SORT, "ascending"));
	$href_sort_descending = sprintf(HREF_FORMAT, $_SERVER['SCRIPT_NAME'], sprintf(HREF_GET_PARAM, PARAM_SORT, "descending"));
	
	if (!empty($_GET[PARAM_GENRE])) {
		if ($_GET[PARAM_GENRE] > 0) {
			$href_sort_ascending = $href_sort_ascending.ASCII_AND.sprintf(HREF_GET_PARAM, PARAM_GENRE, $_GET[PARAM_GENRE]);
			$href_sort_descending = $href_sort_descending.ASCII_AND.sprintf(HREF_GET_PARAM, PARAM_GENRE, $_GET[PARAM_GENRE]);
			
			$query = $query." WHERE MovieCategory=".$_GET[PARAM_GENRE];
		}
	}
	
	$result = mysqli_query($connection, $query);
	$movies = mysqli_fetch_all($result);
	
	if (!empty($_GET[PARAM_SORT])) {
		if ($_GET[PARAM_SORT] == "ascending") {
			usort($movies, 'cmp_ascending');
		}
		else {
			usort($movies, 'cmp_descending');
		}
	}
?>
	<div class="text_align_right">
		<a class="link_horizontal" href="<?php echo $href_sort_ascending; ?>">Sort A-Z</a>
		<a class="link_horizontal" href="<?php echo $href_sort_descending; ?>">Sort Z-A</a>
	</div>
<?php	
	include 'templates/movies_list.php';	
	
	mysqli_free_result($result);
	
	include 'templates/footer.php';
?>