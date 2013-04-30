<?php
	include 'templates/header.php';
?>
			<h1>Registration</h1>
			<div class="view">
				<form method="post" action="authenticate.php">
					<div>
						<table class="center">
							<tr>
								<td class="column_label">First Name:</td>
								<td><input class="column_field" type="text" name="FirstName" /></td>
							</tr>
							<tr>
								<td class="column_label">Last Name:</td>
								<td><input class="column_field" type="text" name="LastName" /></td>
							</tr>
							<tr>
								<td class="column_label">Email:</td>
								<td><input class="column_field" type="text" name="email" /></td>
							</tr>
							<tr>
								<td class="column_label">User Name:</td>
								<td><input class="column_field" type="text" name="username" /></td>
							</tr>
							<tr>
								<td class="column_label">Password:</td>
								<td><input class="column_field" type="password" name="password" /></td>
							</tr>
						</table>
						<div class="column_155 center">	
							<input class="button" type="submit" value="Submit" />
							<input class="button" type="reset" value="Clear" />
							<input type="hidden" name="registration" value="Yes" />
						</div>
					</div>
				</form>
			</div>
<?php
	include 'templates/footer.php';
?>