<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>BigKitchen</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
</head>
<body style="background-image:url(../img/photo4.jpg)">

	<div class="header">
			Welcome to he BigKitchen.
	</div>
	<div class="header">
		<h2>Login</h2>
	</div>
	<form method="post" action="login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php" style="text-decoration:none;">Sign up</a>
		</p>
	</form>
	<div class="content">
		<iframe width="400" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1392.4990309746297!2d21.201726656472836!3d45.73113367910494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47455d08a246b3c3%3A0x123ee418ebfb5bbe!2sAleea+Actorilor%2C+Timi%C8%99oara!5e0!3m2!1sen!2sro!4v1509000206558">
		</iframe>
	</div>
</body>
<HEAD>
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
</html>
