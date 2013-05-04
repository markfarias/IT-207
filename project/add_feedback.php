<!--Mark Farias
	Richard Kim
	IT 207
	Project
	Description: Provides the interface to the user to add feedback or review for a selected movie.
-->

<?php
	include 'templates/header.php';
?>
	<form method="get" action="store_feedback.php">
		<div id="dialog_entry" class="center" style="width: 700px">
			<div class="row_solid_background">
				<p class="font_label view">
					Review. What did you think about this movie? Please provide your feedback about this movie to help others decide if it is something they 
					would like to watch. Provide a grade of the movie starts, 1 being poor and 5 being the best.
				</p>
			</div>
			<div style="margin-top: 5px;" class="border_grey center">
				<div class="float_left" style="width: 150px; text-align:center">
					<img src="images/Review.png" width="100px" height="100px" alt="Feedback Picture" />
				</div>
				<div class="float_left" style="width: 550px">
					<table style="width: 100%">
						<tr>
							<td><h2>Rating:</h2></td>
							<td>
								<select name="rating">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</td>
						</tr>
						<tr>
							<td valign="top"><h2>Feedback:</h2></td>
							<td>
								<textarea name="feedback" cols="52" rows="5"></textarea>
							</td>
						</tr>
					</table>
				</div>
				<div class="clear_floats"></div>	
			</div>
			<div style="margin-top: 5px; text-align:right; width: 100%; padding-bottom: 10px">
				<div class="float_right" style="margin-right: 15px">
					<input class="button" type="submit" value="Add" />
				</div>
				<div class="float_right" style="margin-right: 5px">
					<input class="button" type="reset" value="Clear" />
				</div>
				<div class="clear_floats"></div>
				<input type="hidden" name="MovieId" value="<?php echo $_GET[PARAM_MOVIE_ID]; ?>" />
				<?php
					if (!empty($_GET[USER]) && !empty($_GET[USERS_NAME]) && !empty($_GET[USER_ADMIN])) {
						echo '<input type="hidden" name="user" value="'.$_GET[USER].'" />'.PHP_EOL;
						echo '<input type="hidden" name="usersName" value="'.$_GET[USERS_NAME].'" />'.PHP_EOL;
						echo '<input type="hidden" name="admin" value="'.$_GET[USER_ADMIN].'" />'.PHP_EOL;
					}
				?>
			</div>
		</div>
	</form>
			
<?php
	include 'templates/footer.php';
?>