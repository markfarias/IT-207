<?php
	session_start();
	session_unset();
    session_destroy();
	
	include 'templates/header.php';
	
	header('Location: index.php');
		
	include 'templates/footer.php';
?>