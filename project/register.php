<?php
	include 'templates/header.php';
?>
	<div class="center error" style="margin-top: 20px; width: 500px; text-align: center">
		<?php
			if(!empty($_GET["RegisterMsg"])) {
				echo "You must enter a value in each field. Try again.";
			}
		?>
	</div>
	<form method="post" action="authenticate.php">
		<div id="dialog_entry" class="center" style="width: 600px">
			<div class="row_solid_background">
				<p class="font_label view">
					Registration. Please enter the information below to create a new account in the Movie Room. All fields are required. After a successful 
					creation of your account, login to the site to begin using it.
				</p>
			</div>
			<div style="margin-top: 5px;" class="border_grey center">
				<div class="float_left" style="width: 200px; text-align:center">
					<img src="images/AddAccount.png" width="100px" height="100px" alt="Register Picture" />
				</div>
				<div class="float_left" style="width: 400px">
					<table cellspacing="0" cellpadding="3" width="100%">
						<tr>
							<td style="width:120px"><h2>First Name:</h2></td>
							<td>
								<input class="column_field" type="text" name="FirstName" />
							</td>
						</tr>
						<tr>
							<td><h2>Last Name:</h2></td>
							<td>
								<input class="column_field" type="text" name="LastName" />
							</td>
						</tr>
						<tr>
							<td><h2>Email:</h2></td>
							<td><input class="column_field" type="text" name="email" /></td>
						</tr>
						<tr>
							<td><h2>User Name:</h2></td>
							<td><input class="column_field" type="text" name="username" /></td>
						</tr>
						<tr>
							<td><h2>Password:</h2></td>
							<td><input class="column_field" type="password" name="password" /></td>
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
				<input type="hidden" name="registration" value="Yes" />
			</div>
		</div>
	</form>
<?php
	include 'templates/footer.php';
?>