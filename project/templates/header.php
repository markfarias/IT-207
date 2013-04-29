<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--Mark Farias
	Richard Kim
	IT 207
	Project
	Description: 
-->
<?php
	session_start();
	//$connection = @mysqli_connect("helios.ite.gmu.edu", "user", "password", "mfarias");
	//$connection = mysqli_connect("localhost", "rkime", "Ad7Mm12345!#", "mfarias");
	$connection = mysqli_connect("localhost", "mfarias", "GoldRush?49", "mfarias", "3306");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<title>Movie Room</title>
		<link rel="stylesheet" href="./css/style.css" type="text/css" />
		<link rel="icon" type="image/x-icon" href="favicon.ico"/>
	</head>
	<body>
		<div id="header">
			<?php
				define("PARAM_GENRE", "genre");
				define("SESSION_USER", "user");
				
				// Database field constants
				define("CATEGORIES_ID", 0);
				define("CATEGORIES_NAME", 1);
				define("MOVIERATINGS_NAME", 1);
				define("MOVIES_ID", 0);
				define("MOVIES_TITLE", 1);
				define("MOVIES_CATEGORY", 2);
				define("MOVIES_COMPANY", 3);
				define("MOVIES_YEAR", 4);
				define("MOVIES_DESC", 5);
				define("MOVIES_RATING", 6);
				define("MOVIES_PRICE", 7);
				define("MOVIES_SHIPPING", 8);
				define("MOVIES_COVER", 9);
				define("RELEASECOMPANIES_NAME", 1);
				define("REVIEWS_DATE", 2);
				define("REVIEWS_SCORE", 3);
				define("REVIEWS_COMMENTS", 4);
				
				if (empty($_SESSION[SESSION_USER])) {
					echo '<a class="header_link" href="login.php">Log-In</a>'.PHP_EOL;
					echo "\t\t\t", '<a class="header_link" href="register.php">Register</a>'.PHP_EOL;
				}
				else {
					echo '<a class="header_link" href="logout.php">Log-Out</a>'.PHP_EOL;;
					echo "\t\t\t", '<a class="header_link" href="accountinfo.php">Account Info</a>'.PHP_EOL;
				}
			?>
			
			<form method="get" action="search.php">
				<input type="text" name="search" <?php if (!empty($_GET["search"])) { echo 'value="'.$_GET["search"].'"'; } ?>/>
				<input class="button" type="submit" value="Search" />
			</form>
			
			<img src="images/banner.png" alt="Movie Room Banner" />
			
			<div id="menu">
				<ul>
					<?php					
						$genres = array("Action", "Adventure", "Comedy", "Documentary", "Romance", "Sci-Fi", "Thriller");
						
						if (empty($_GET[PARAM_GENRE])) {
							echo '<li class="active"><a href="index.php">All</a></li>'.PHP_EOL;
							
							foreach ($genres as $genre) {
								echo "\t\t\t\t", '<li><a href="index.php&#63;genre&#61;', $genre, '">', $genre, '</a></li>'.PHP_EOL;
							}
						}
						else {
							echo '<li><a href="index.php">All</a></li>'.PHP_EOL;
							
							foreach ($genres as $genre) {
								if ($genre == $_GET[PARAM_GENRE]) {
									echo "\t\t\t\t", '<li class="active"><a href="index.php&#63;genre&#61;', $genre, '">', $genre, '</a></li>'.PHP_EOL;
								}
								else {
									echo "\t\t\t\t", '<li><a href="index.php&#63;genre&#61;', $genre, '">', $genre, '</a></li>'.PHP_EOL;
								}
							}
						}
					?>
				</ul>
			</div>
		</div>
		<div id="content">
