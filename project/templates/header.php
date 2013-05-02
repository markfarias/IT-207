<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--Mark Farias
	Richard Kim
	IT 207
	Project
	Description: 
-->
<?php
	session_start();
	$connection = @mysqli_connect("helios.ite.gmu.edu", "mfarias", "GoldRush?49", "mfarias");
	
	if(mysqli_connect_errno($connection)) {
		header('Location: ./error.html');
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<title>The Movie Room</title>
		<link rel="stylesheet" href="./css/style.css" type="text/css" />
		<link rel="icon" type="image/x-icon" href="favicon.ico"/>
	</head>
	<body>
		<div id="header_outer">
			<div id="header_inner">
				<?php
					define("ASCII_AND", '&#38;');
					define("ASCII_EQUAL", '&#61;');
					define("ASCII_QUESTION", '&#63;');
					
					define("HREF_FORMAT", '%s'.ASCII_QUESTION.'%s');
					define("HREF_GET_PARAM", '%s'.ASCII_EQUAL.'%s');
					
					// Common parameters
					define("PARAM_GENRE", "genre");
					define("PARAM_MOVIE_ID", "MovieId");
					define("PARAM_SEARCH", "search");
					define("PARAM_SORT", "sort");
					
					// Session variables
					define("SESSION_USER", "user");
					define("SESSION_USERS_NAME", "usersName");
					define("SESSION_USER_ADMIN", "admin");
					
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
					
					$links = "";
					if (empty($_SESSION[SESSION_USER])) {
						$links .= '<p><a class="header_link" href="login.php">Log-In</a>&nbsp;|';
						$links .= '<a class="header_link" href="register.php">Register</a></p>';
					}
					else {
						$links .= '<p><span class="username">Welcome, '.$_SESSION[SESSION_USERS_NAME]. '</span>&nbsp;|';
						$links .= '<a class="header_link" href="logout.php">Log-Out</a>&nbsp;|';
						$links .= '<a class="header_link" href="accountinfo.php">Account</a></p>';
					}
				?>
				<div>
					<div id="title">
						<h3>The Movie Room</h3>
					</div>
					<div id="linksandsearch">
						<div>
							<?php
								echo $links;
							?>
						</div>
						<div>
							<form method="get" action="search.php">
								<p>Movie Search:&nbsp;
								<input type="text" name="search" <?php if (!empty($_GET[PARAM_SEARCH])) { echo 'value="'.$_GET[PARAM_SEARCH].'"'; } ?>/>
								<input class="button" type="submit" value="Search" /></p>
							</form>
						</div>
					</div>
					<div class="clear_floats"></div>
				</div>
			</div>
		</div>
		
		<div id="menu_outer">
			<div id="menu_inner">
				<ul>
					<?php			
						// Setup the menu
						// Set the Home and All items
						echo '<li><a href="index.php">Home</a></li>'.PHP_EOL;
						if(!empty($_GET[PARAM_GENRE]) && ($_GET[PARAM_GENRE] == "a")) {
							//echo $_GET[PARAM_GENRE];
							echo '<li class="active"><a href="index.php&#63;genre&#61;a">All</a></li>'.PHP_EOL;

						}
						else {
							echo '<li><a href="index.php&#63;genre&#61;a">All</a></li>'.PHP_EOL;
						}
						// Set the category items
						$menu = "";
						$categories = mysqli_query($connection, "SELECT * FROM Categories");
						while($category = mysqli_fetch_row($categories)) {
							if(!empty($_GET[PARAM_GENRE]) && ($_GET[PARAM_GENRE] == $category[CATEGORIES_ID])) {
								$menu .= '<li class="active"><a href="index.php&#63;genre&#61;' . $category[CATEGORIES_ID] . '">' . $category[CATEGORIES_NAME] . '</a></li>'.PHP_EOL;
							}
							else {
								$menu .= '<li><a href="index.php&#63;genre&#61;' . $category[CATEGORIES_ID] . '">' . $category[CATEGORIES_NAME] . '</a></li>'.PHP_EOL;
							}
						}
						// Display the menu
						echo $menu;
						
						// Free the results
						mysqli_free_result($categories);
						
						// Include an Add Movie selection if its the Admin
						if(!empty($_SESSION[SESSION_USER]) && ($_SESSION[SESSION_USER_ADMIN] == 1)) {
							echo '<li><a href="add_movie.php">Add Movie</a></li>'.PHP_EOL;
						}
					?>
				</ul>
			</div>
		</div>

		<div id="content_outer">
			<div id="content_inner">
