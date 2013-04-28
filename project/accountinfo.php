<?php
	include 'templates/header.php';
	
	//$connection = @mysqli_connect("helios.ite.gmu.edu", "user", "password", "mfarias");
	$connection = mysqli_connect("localhost", "rkime", "Ad7Mm12345!#", "mfarias");
	$query = 'SELECT * FROM users WHERE UserName="'.$_SESSION["USER"].'"';
	
	$results = mysqli_query($connection, $query);
	$user = mysqli_fetch_row($results);
?>
	<h1>Account Information</h1>
	
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
					<td><input class="column_field" type="text" name="password" value="<?php echo $user[5]; ?>" /></td>
				</tr>
			</table>
			<div class="column_155 center">	
				<input class="button" type="submit" value="Submit" />
				<input class="button" type="reset" value="Clear" />
				<input type="hidden" name="updateinfo" value="Yes" />
			</div>
		</div>
	</form>
<?php
	mysqli_free_result($results);
	mysqli_close($connection);
	
	include 'templates/footer.php';
?>