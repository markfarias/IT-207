<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--Mark Farias
	Richard Kim
	IT 207
	Project
	Description: 	Builds up the header portion of the web application and is used as an include file.
					Establishes the database connection.
-->
<?php
	//$connection = @mysqli_connect("helios.ite.gmu.edu", "mfarias", "GoldRush?49", "mfarias");
	$connection = @mysqli_connect("localhost", "mfarias", "GoldRush?49", "mfarias", "3306");
	
	if(mysqli_connect_errno($connection)) {
		header('Location: ./error.php');
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
					
					define("LOGIN_PARAMS", 'user=%s&usersName=%s&admin=%s');
					
					// Common parameters
					define("PARAM_GENRE", "genre");
					define("PARAM_MOVIE_ID", "MovieId");
					define("PARAM_SEARCH", "search");
					define("PARAM_SORT", "sort");
					
					// User account variables
					define("USER", "user");
					define("USERS_NAME", "usersName");
					define("USER_ADMIN", "admin");
					
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
					
					// To account for the need of a POST for a file upload, stuff the GET with the user's info from POST
					if(!empty($_POST[USER])) {
						$_GET[USER] = $_POST[USER];
						$_GET[USERS_NAME] = $_POST[USERS_NAME];
						$_GET[USER_ADMIN] = $_POST[USER_ADMIN];
					}
					
					$links = "";
					if (empty($_GET[USER]) && empty($_POST[USER])) {
						$links .= '<p><a class="header_link" href="login.php">Log-In</a>&nbsp;|';
						$links .= '<a class="header_link" href="register.php">Register</a></p>';
					}
					else {
						$links .= '<p><span class="username">Welcome, '.$_GET[USERS_NAME]. '</span>&nbsp;|';
						$links .= '<a class="header_link" href="logout.php">Log-Out</a>&nbsp;|';
						$links .= '<a class="header_link" href="accountinfo.php?'.sprintf(LOGIN_PARAMS, $_GET[USER], $_GET[USERS_NAME], $_GET[USER_ADMIN]).'">Account</a></p>';
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
									<input class="button" type="submit" value="Search" />
									<?php
										if (!empty($_GET[USER]) && !empty($_GET[USERS_NAME]) && !empty($_GET[USER_ADMIN])) {
											echo '<input type="hidden" name="user" value="'.$_GET[USER].'" />'.PHP_EOL;
											echo '<input type="hidden" name="usersName" value="'.$_GET[USERS_NAME].'" />'.PHP_EOL;
											echo '<input type="hidden" name="admin" value="'.$_GET[USER_ADMIN].'" />'.PHP_EOL;
										}
									?>
								</p>
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
						echo '<li><a href="index.php';
						if (!empty($_GET[USER]) && !empty($_GET[USERS_NAME]) && !empty($_GET[USER_ADMIN])) {
							echo '?'.sprintf(LOGIN_PARAMS, $_GET[USER], $_GET[USERS_NAME], $_GET[USER_ADMIN]);
						}
						echo '">Home</a></li>'.PHP_EOL;
						
						if(!empty($_GET[PARAM_GENRE]) && ($_GET[PARAM_GENRE] == "a")) {
							echo '<li class="active"><a href="index.php&#63;genre&#61;a';
							if (!empty($_GET[USER]) && !empty($_GET[USERS_NAME]) && !empty($_GET[USER_ADMIN])) {
								echo '&'.sprintf(LOGIN_PARAMS, $_GET[USER], $_GET[USERS_NAME], $_GET[USER_ADMIN]);
							}
							echo '">All</a></li>'.PHP_EOL;
						}
						else {
							echo '<li><a href="index.php&#63;genre&#61;a';
							if (!empty($_GET[USER]) && !empty($_GET[USERS_NAME]) && !empty($_GET[USER_ADMIN])) {
								echo '&'.sprintf(LOGIN_PARAMS, $_GET[USER], $_GET[USERS_NAME], $_GET[USER_ADMIN]);
							}
							echo '">All</a></li>'.PHP_EOL;
						}
						// Set the category items
						$menu = "";
						$categories = mysqli_query($connection, "SELECT * FROM Categories");
						while($category = mysqli_fetch_row($categories)) {
							if(!empty($_GET[PARAM_GENRE]) && ($_GET[PARAM_GENRE] == $category[CATEGORIES_ID])) {
								$menu .= '<li class="active"><a href="index.php&#63;genre&#61;' . $category[CATEGORIES_ID];
								if (!empty($_GET[USER]) && !empty($_GET[USERS_NAME]) && !empty($_GET[USER_ADMIN])) {
									$menu .= '&'.sprintf(LOGIN_PARAMS, $_GET[USER], $_GET[USERS_NAME], $_GET[USER_ADMIN]);
								}
								$menu .= '">' . $category[CATEGORIES_NAME] . '</a></li>'.PHP_EOL;
							}
							else {
								$menu .= '<li><a href="index.php&#63;genre&#61;' . $category[CATEGORIES_ID];
								if (!empty($_GET[USER]) && !empty($_GET[USERS_NAME]) && !empty($_GET[USER_ADMIN])) {
									$menu .= '&'.sprintf(LOGIN_PARAMS, $_GET[USER], $_GET[USERS_NAME], $_GET[USER_ADMIN]);
								}								
								$menu .= '">' . $category[CATEGORIES_NAME] . '</a></li>'.PHP_EOL;
							}
						}
						// Display the menu
						echo $menu;
						
						// Free the results
						mysqli_free_result($categories);
						
						// Include an Add Movie selection if its the Admin
						if(!empty($_GET[USER]) && ($_GET[USER_ADMIN] == "yes")) {
							echo '<li><a href="add_movie.php?'.sprintf(LOGIN_PARAMS, $_GET[USER], $_GET[USERS_NAME], $_GET[USER_ADMIN]).'">Add Movie</a></li>'.PHP_EOL;
						}
					?>
				</ul>
			</div>
		</div>

		<div id="content_outer">
			<div id="content_inner">
