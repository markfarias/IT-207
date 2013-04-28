<?php
	session_start();
	session_unset();
    session_destroy();
	
	include 'templates/header.php';
	
	echo "Logged out.".PHP_EOL;
		
	include 'templates/footer.php';
?>