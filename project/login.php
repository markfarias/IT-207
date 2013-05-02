<?php
	include 'templates/header.php';
?>
	<div class="center error" style="margin-top: 20px; width: 500px; text-align: center">
		<?php
			if(!empty($_GET["LoginMsg"])) {
				switch($_GET["LoginMsg"]) {
					case "1":
						echo "Username or password was invalid. Try again.";
						break;
					case "2":
						echo "You must enter values for Username and Password. Try again.";
						break;
					case "3":
						echo "Account Created. Login below.";
						break;
					default:
						echo "";
				}
			}
		?>
	</div>
	<form method="post" action="authenticate.php">
		
		<div id="dialog_entry" class="center" style="width: 500px">
			<div class="row_solid_background">
				<p class="font_label view">
					Welcome to the Movie Room. Please login below to contribute to the reviews for our library of movie selections. 
					You do not have to subscribe to view our collection, but if you want to add your reviews of a movie, please register 
					for an account.
				</p>
			</div>
			<div style="margin-top: 5px;" class="border_grey center">
				<div class="float_left" style="width: 150px; text-align:center">
					<img src="images/login.png" width="100px" height="100px" alt="Login Picture" />
				</div>
				<div class="float_left" style="width: 350px">
					<table cellspacing="0" cellpadding="3" width="100%">
						<tr>
							<td align="right" style="width=25%"><h2>Username:</h2></td>
							<td>
								<input class="column_field" type="text" maxlength="32" name="username" />
							</td>
						</tr>
						<tr>
							<td align="right"><h2>Password:</h2></td>
							<td>
								<input class="column_field" type="password" maxlength="20" name="password" />
							</td>
						</tr>
					</table>
				</div>
				<div class="clear_floats"></div>
			</div>
			<div style="margin-top: 5px; width: 100%; text-align: center">
				<p><a href="register.php">Create a New Account</a></p>
			</div>
			<div style="margin-top: 5px; text-align:right; width: 100%; padding-bottom: 10px">
				<div class="float_right" style="margin-right: 5px">
					<input class="button" type="submit" value="Log-In" />
				</div>
				<div class="float_right" style="margin-right: 5px">
					<input class="button" type="reset" value="Clear" />
				</div>
				<div class="clear_floats"></div>
			</div>
		</div>
	</form>
<?php
	include 'templates/footer.php';
?>