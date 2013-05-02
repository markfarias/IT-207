<?php
	include 'templates/header.php';
	
	/*
	 Comparison function for ascending sort.
	 */
	function cmp_ascending($a, $b) {
		if ($a[1] == $b[1]) {
			return 0;
		}
		
		return ($a[1] < $b[1]) ? -1 : 1;
	}
	
	/*
	 Comparision function for descending sort.
	 */
	function cmp_descending($a, $b) {
		if ($a[1] == $b[1]) {
			return 0;
		}
		
		return ($b[1] < $a[1]) ? -1 : 1;
	}
	
	/*
	 Constructs an array from the SQL query results.
	 @param connection - MYSQLI connection object.
	 @param query - SQL search query.
	 @return - Array of results.
	 */
	function fetch_array($connection, $query) {
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_array($result, MYSQLI_NUM);
		
		do {
			if ($row != NULL) {
				$rows[] = $row;
			}
			
			$row = mysqli_fetch_array($result, MYSQLI_NUM);
		} while($row);
		
		mysqli_free_result($result);
		
		return $rows;
	}
	
	$query = "SELECT * FROM Movies";
	$href_sort_ascending = sprintf(HREF_FORMAT, $_SERVER['SCRIPT_NAME'], sprintf(HREF_GET_PARAM, PARAM_SORT, "ascending"));
	$href_sort_descending = sprintf(HREF_FORMAT, $_SERVER['SCRIPT_NAME'], sprintf(HREF_GET_PARAM, PARAM_SORT, "descending"));
	
	if (!empty($_GET[PARAM_GENRE])) {
		if ($_GET[PARAM_GENRE] > 0) {
			$href_sort_ascending = $href_sort_ascending.ASCII_AND.sprintf(HREF_GET_PARAM, PARAM_GENRE, $_GET[PARAM_GENRE]);
			$href_sort_descending = $href_sort_descending.ASCII_AND.sprintf(HREF_GET_PARAM, PARAM_GENRE, $_GET[PARAM_GENRE]);
			
			$query = $query." WHERE MovieCategory=".$_GET[PARAM_GENRE];
		}
	}
	
	$movies = fetch_array($connection, $query);
	
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
	
	include 'templates/footer.php';
?>