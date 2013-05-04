<!--Mark Farias
	Richard Kim
	IT 207
	Project
	Description: Provides the interface to a registered user to alter their account information.
-->

<?php
	include 'templates/header.php';
	
	$query = 'SELECT * FROM Users WHERE UserName="'.$_GET[USER].'"';
	
	$results = mysqli_query($connection, $query);
	$user = mysqli_fetch_row($results);
?>
	<div class="center feedback" style="margin-top: 20px; width: 500px; text-align: center">
		<?php
			if(!empty($_GET["Update"])) {
				echo "Update successful!";
			}
		?>
	</div>
	<form method="post" action="authenticate.php">
		<div id="dialog_entry" class="center" style="width: 600px">
			<div class="row_solid_background">
				<p class="font_label view">
					Account details. The following is the information we have on record for your account. If any of the information is incorrect, please update 
					it below and click Submit to save your record.
				</p>
			</div>
			<div style="margin-top: 5px;" class="border_grey center">
				<div class="float_left" style="width: 150px; text-align:center">
					<img src="images/AccountInfo.png" width="100px" height="100px" alt="Account Info Picture" />
				</div>
				<div class="float_left" style="width: 450px">
					<table cellspacing="0" cellpadding="3" width="100%">
						<tr>
							<td style="width=150px"><h2>First Name:</h2></td>
							<td>
								<input class="column_field" type="text" name="FirstName" value="<?php echo $user[1]; ?>" />
							</td>
						</tr>
						<tr>
							<td><h2>Last Name:</h2></td>
							<td>
								<input class="column_field" type="text" name="LastName" value="<?php echo $user[2]; ?>" />
							</td>
						</tr>
						<tr>
							<td><h2>Email:</h2></td>
							<td><input class="column_field" type="text" name="email" value="<?php echo $user[3]; ?>" /></td>
						</tr>
						<tr>
							<td><h2>Password:</h2></td>
							<td><input class="column_field" type="password" name="password" value="<?php echo $user[5]; ?>" /></td>
						</tr>
					</table>
				</div>
				<div class="clear_floats"></div>
			</div>
			<div style="margin-top: 5px; text-align:right; width: 100%; padding-bottom: 10px">
				<div class="float_right" style="margin-right: 5px">
					<input class="button" type="submit" value="Submit" />
				</div>
				<div class="float_right" style="margin-right: 5px">
					<input class="button" type="reset" value="Clear" />
				</div>
				<div class="clear_floats"></div>
				<input type="hidden" name="updateinfo" value="Yes" />
			</div>
		</div>
	</form>
<?php
	mysqli_free_result($results);
	
	include 'templates/footer.php';
?>