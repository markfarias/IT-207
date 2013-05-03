<!--Mark Farias
	Richard Kim
	IT 207
	Project
	Description: Application logic that handles a search request by the user.
-->

<?php
	include 'templates/header.php';
	
	/*
	 Constructs an array from the SQL query results.
	 @param connection - MYSQLI connection object.
	 @param query - SQL search query.
	 @return - Array of results.
	 */
	function fetch_array($connection, $query) {
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_array($result, MYSQLI_NUM);
		$rows = array();
		
		do {
			if ($row != NULL) {
				array_push($rows, $row);
			}
			
			$row = mysqli_fetch_array($result, MYSQLI_NUM);
		} while($row);
		
		mysqli_free_result($result);
		
		return $rows;
	}
	
	$query = "SELECT * FROM Movies WHERE ";
				
	if (empty($_GET[PARAM_SEARCH])) {
		$query = "SELECT * FROM Movies";
	}
	else {
		$fields = mysqli_query($connection, "SHOW COLUMNS FROM Movies");
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
		
	$movies = fetch_array($connection, $query);
	
	include 'templates/movies_list.php';
	
	include 'templates/footer.php';
?>