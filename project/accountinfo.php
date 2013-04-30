<?php
	include 'templates/header.php';
	
	$query = 'SELECT * FROM users WHERE UserName="'.$_SESSION[SESSION_USER].'"';
	
	$results = mysqli_query($connection, $query);
	$user = mysqli_fetch_row($results);
?>
			<h1>Account Information</h1>
			<div class="view">
				<form method="post" action="authenticate.php">
					<div>
						<table class="center">
							<tr>
								<td class="column_label">First Name:</td>
								<td><input class="column_field" type="text" name="firstname" value="<?php echo $user[1]; ?>" /></td>
							</tr>
							<tr>
								<td class="column_label">Last Name:</td>
								<td><input class="column_field" type="text" name="lastname" value="<?php echo $user[2]; ?>" /></td>
							</tr>
							<tr>
								<td class="column_label">Email:</td>
								<td><input class="column_field" type="text" name="email" value="<?php echo $user[3]; ?>" /></td>
							</tr>
							<tr>
								<td class="column_label">Password:</td>
								<td><input class="column_field" type="password" name="password" value="<?php echo $user[5]; ?>" /></td>
							</tr>
						</table>
						<div class="column_155 center">	
							<input class="button" type="submit" value="Submit" />
							<input class="button" type="reset" value="Clear" />
							<input type="hidden" name="updateinfo" value="Yes" />
						</div>
					</div>
				</form>
			</div>
<?php
	mysqli_free_result($results);
	
	include 'templates/footer.php';
?>