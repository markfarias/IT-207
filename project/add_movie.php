<?php
	include 'templates/header.php';
	
	define("PARAM_MOVIENAME", "MovieName");
	define("PARAM_DESCRIPTION", "Description");
	define("PARAM_CATEGORY", "Category");
	define("PARAM_RELCOMPANY", "ReleaseCompany");
	define("PARAM_RELYEAR", "ReleaseYear");
	define("PARAM_RATING", "Rating");
	define("PARAM_PRICE", "Price");
	define("PARAM_SHIPPING", "Shipping");
	define("PARAM_COVER", "CoverImage");
	
	$selectcategoriesquery = "SELECT * FROM categories";
	$selectratingsquery = "SELECT * FROM movieratings";
	$selectrelcompanies = "SELECT * FROM releasecompanies";
?>
	<div class="center error" style="margin-top: 20px; width: 700px; text-align: center">
		<?php
			if(!empty($_GET["Error"])) {
				switch($_GET["Error"]) {
					case "1":
						echo "You must enter all of the data for a movie. Try again.";
						break;
					case "2":
						echo "Your cover file is not the correct type(jpeg, jpg, png, or gif). Try again.";
						break;
					case "3":
						echo "Your cover file is too big (exceeds 75Kb). Try again.";
						break;
					case "4":
						echo "A file with the same name was already uploaded. Try again.";
					default:
						echo "";
				}
			}
		?>
	</div>
	<form enctype="multipart/form-data" method="post" action="store_movie.php">
		<div id="dialog_entry" class="center" style="width: 700px">
			<div class="row_solid_background">
				<p class="font_label view">
					Add Movie. Add any new movie to the library from this module. Please make sure that all entry points below are properly filled in or set, as all fields 
					are required. Please note the file restrictions related to the selected cover image for a given movie.
				</p>
			</div>
			<div style="margin-top: 5px;" class="border_grey center">
				<div style="width: 660px" class="center">
					<table cellspacing="0" cellpadding="3" width="100%">
						<tr>
							<td><h2>Movie Name:</h2></td><td><input type="text" maxlength="50" class="column_field_large" name="MovieName" /></td>
						</tr>
						<tr>
							<td valign="top"><h2>Desription:</h2></td><td><textarea rows="4" cols="50" name="Description"></textarea></td>
						</tr>
						<tr>
							<td><h2>Rating:</h2></td>
							<td>
								<select name="Rating">
								<?php
									$option = "";
									$ratings = mysqli_query($connection, $selectratingsquery);
									while($rating = mysqli_fetch_assoc($ratings)) {
										$option .= '<option value="' . $rating["RatingId"] . '">' . $rating["RatingName"] . '</option>';
									}
									echo $option;
									mysqli_free_result($ratings);
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td><h2>Category:</h2></td>
							<td>
								<select name="Category">
								<?php
									$option = "";
									$categories = mysqli_query($connection, $selectcategoriesquery);
									while($category = mysqli_fetch_assoc($categories)) {
										$option .= '<option value="' . $category['CategoryId'] . '">' . $category['CategoryName'] . '</option>';
									}
									echo $option;
									mysqli_free_result($categories);
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td><h2>Release Company:</h2></td>
							<td>
								<select name="ReleaseCompany">
								<?php
									$option = "";
									$relcompanies = mysqli_query($connection, $selectrelcompanies);
									while($relcompany = mysqli_fetch_assoc($relcompanies)) {
										$option .= '<option value="' . $relcompany['CompanyId'] . '">' . $relcompany['CompanyName'] . '</option>';
									}
									echo $option;
									mysqli_free_result($relcompanies);
								?>
								</select>
							</td>
						</tr>
						<tr>
							<td><h2>Year Released:</h2></td><td><input type="text" name="ReleaseYear" maxlength="4" class="column_field_small" /></td>
						</tr>
						<tr>
							<td><h2>Price:</h2></td><td>$<input type="text" name="Price" maxlength="5" size="7" /></td>
						</tr>
						<tr>
							<td><h2>Shipping Rate:</h2></td><td>$<input type="text" name="Shipping" maxlength="5" size="7" /></td>
						<tr>
							<td valign="top"><h2>Cover Image:</h2></td>
							<td>
								<input name="CoverImage" type="file" /><br />
								<span class="font_disclaimer">(Types allowed: jpeg / jpg / png / gif | Max size: 75KB)</span>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div style="margin-top: 5px; text-align:right; width: 100%; padding-bottom: 10px">
				<div class="float_right" style="margin-right: 5px">
					<input type="submit" value="Add Movie" />
				</div>
				<div class="clear_floats"></div>
			</div>
		</div>
	</form>

<?php
	include 'templates/footer.php';
?>