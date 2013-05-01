<?php
	include 'templates/header.php';
?>			<h1>Feedback</h1>
			<div class="view">
				<form method="post" action="store_feedback.php">
					<div>
						<table class="center">
							<tr>
								<td>Rating:</td>
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
								<td>Feedback:</td>
								<td>
									<textarea name="feedback" cols="75" rows="5"></textarea>
								</td>
							</tr>
						</table>
					</div>
					<div class="column_155 center">
						<input class="button" type="submit" value="Add" />
						<input class="button" type="reset" value="Clear" />
						<input type="hidden" name="MovieId" value="<?php echo $_GET[PARAM_MOVIE_ID]; ?>" />
					</div>
				</form>
			</div>
<?php
	include 'templates/footer.php';
?>