<!--Mark Farias
	Richard Kim
	IT 207
	Project
	Description: Logs the user out of the application and clears the session.
-->

<?php
	session_start();
	session_unset();
    session_destroy();
	
	include 'templates/header.php';
	
	header('Location: index.php');
		
	include 'templates/footer.php';
?>