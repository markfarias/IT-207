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
<h1>Add New Movie</h1>
<form enctype="multipart/form-data" method="post" action="store_movie.php">
	<table style="width: 600px" cellpadding="3" cellspacing="0" class="center">
		<tr>
			<td>Movie Name:</td><td><input type="text" maxlength="50" size="50" name="MovieName" /></td>
		</tr>
		<tr>
			<td valign="top">Desription:</td><td><textarea rows="4" cols="50" name="Description"></textarea></td>
		</tr>
		<tr>
			<td>Rating:</td>
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
			<td>Category:</td>
			<td>
				<select name="Category">
				<?php
					$option = "";
					$categories = mysqli_query($connection, $selectcategoriesquery);
					while($category = mysqli_fetch_assoc($categories)) {
						$option .= '<option value="' . $category['CategoryId'] . '">' . $category['CategoryName'] . '</option>';
					}
					echo $option;
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Release Company:</td>
			<td>
				<select name="ReleaseCompany">
				<?php
					$option = "";
					$relcompanies = mysqli_query($connection, $selectrelcompanies);
					while($relcompany = mysqli_fetch_assoc($relcompanies)) {
						$option .= '<option value="' . $relcompany['CompanyId'] . '">' . $relcompany['CompanyName'] . '</option>';
					}
					echo $option;
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Year Released:</td><td><input type="text" name="ReleaseYear" maxlength="4" size="6" /></td>
		</tr>
		<tr>
			<td>Price:</td><td>$<input type="text" name="Price" maxlength="5" size="7" /></td>
		</tr>
		<tr>
			<td>Shipping Rate:</td><td>$<input type="text" name="Shipping" maxlength="5" size="7" /></td>
		<tr>
			<td>Cover Image:</td><td><input name="CoverImage" type="file" />&nbsp;</td>
		</tr>
	</table>
	<br />
	<div class="column_155 center">
		<input type="submit" value="Add Movie" />
	</div>
</form>

<?php
	include 'templates/footer.php';
?>