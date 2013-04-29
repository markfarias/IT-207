<?php
	session_start();
	session_unset();
    session_destroy();
	
	include 'templates/header.php';
	
	echo "<h2>Logged out.</h2>".PHP_EOL;
		
	include 'templates/footer.php';
?>