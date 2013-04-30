<?php
	include 'templates/header.php';
		
	$query = "SELECT * FROM movies WHERE ";
				
	if (empty($_GET[PARAM_SEARCH])) {
		$query = "SELECT * FROM movies";
	}
	else {
		$fields = mysqli_query($connection, "SHOW COLUMNS FROM movies");
		$searchTerm = trim($_GET[PARAM_SEARCH]);
			
		for ($index = 0; $index < mysqli_num_rows($fields); $index++) {
			$field = mysqli_fetch_row($fields);
				
			if ($index == 0) {
				$query = $query.$field[0]." LIKE'%".$searchTerm."%'";
			}
			else {
				$query = $query." OR ".$field[0]." LIKE '%".$searchTerm."%'";
			}
		}
		
		mysqli_free_result($fields);
	}
		
	$result = mysqli_query($connection, $query);
	$movies = mysqli_fetch_all($result);
	
	include 'templates/movies_list.php';
		
	mysqli_free_result($result);
	
	include 'templates/footer.php';
?>