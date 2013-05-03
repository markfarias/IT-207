<!--Mark Farias
	Richard Kim
	IT 207
	Project
	Description:	Builds up the footer portion of the web application and is used as an include file.
					Closes the existing database connection.
-->
			</div>
		</div>
		<div id="footer">
			<p class="font_disclaimer">Website by Richard Kim and Mark Farias</p>
		</div>
	</body>
</html>
<?php
	mysqli_close($connection);
?>