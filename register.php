<!--Mark Farias
	Richard Kim
	IT 207
	Project
	Description: 
-->		
<?php
	include 'templates/header.php';
?>
	<h1>Registration</h1>
	
	<form method="post" action="authenticate.php">
		<div>
			<table class="center">
				<tr>
					<td class="column_label">First Name:</td>
					<td><input class="column_field" type="text" name="firstname" /></td>
				</tr>
				<tr>
					<td class="column_label">Last Name:</td>
					<td><input class="column_field" type="text" name="lastname" /></td>
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
					<td><input class="column_field" type="text" name="password" /></td>
				</tr>
			</table>
			<div class="column_155 center">	
				<input class="button" type="submit" value="Submit" />
				<input class="button" type="reset" value="Clear" />
			</div>
		</div>
	</form>
<?php
	include 'templates/footer.php';
?>