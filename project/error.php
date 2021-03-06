<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--Mark Farias
	Richard Kim
	IT 207
	Project
	Description: This page is displayed to the user to gracefully tell them an error occurred.
-->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<title>Movie Room</title>
		<link rel="stylesheet" href="./css/style.css" type="text/css" />
		<link rel="icon" type="image/x-icon" href="favicon.ico"/>
	</head>
	<body>
		<div id="header_outer">
			<div>
				<div id="title">
					<h3>The Movie Room</h3>
				</div>
				<div class="clear_floats"></div>
			</div>
		</div>
		<div id="menu_outer">
			<div id="menu_inner">
				&nbsp;
			</div>
		</div>
		<div id="content_outer">
			<div id="content_inner">
				<div id="dialog_message_box" class="center">
					<div id="dialog_message">
						<div class="float_left">
							<img src="images/error.png" height="100px" width="100px" alt="Error Picture" />
						</div>
						<div class="float_left" style="width: 350px; margin-left: 10px">
							<p class="error">We apologize for the inconvience, but an error has occurred in the application. <br /><br />Please try again later.</p>
							<p>
								<?php
									echo '<a href="index.php?'.sprintf(LOGIN_PARAMS, $_GET[USER], $_GET[PARAM_FIRSTNAME], $_GET[USER_ADMIN]).'">Click here to return</a>';
								?>
							</p>
						</div>
						<div class="clear_floats"></div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>