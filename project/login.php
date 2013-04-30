<?php
	include 'templates/header.php';
?>
			<div class="view">
				<h1>Log-In</h1>
				
				<form method="post" action="authenticate.php">
					<div>
						<table class="center">
							<tr>
								<td class="column_label">Username:</td>
								<td><input class="column_field" type="text" name="username" /></td>
							</tr>
							<tr>
								<td class="column_label">Password:</td>
								<td><input class="column_field" type="password" name="password" /></td>
							</tr>
						</table>
					</div>
					<div class="column_155 center">
						<input class="button" type="submit" value="Log-In" />
						<input class="button" type="reset" value="Clear" />
					</div>
				</form>
			</div>
<?php
	include 'templates/footer.php';
?>