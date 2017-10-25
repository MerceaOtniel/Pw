<?php include('server.php');
if(empty($_SESSION['username'])){
	header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>BigKitchen</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
</head>
<body style="background-image:url(../img/image.png)">
       <div class="header">
		<h2>Home page</h2>
       </div>

       <div class="content">
		<?php if (isset($_SESSION['success'])): ?>
			<div class="error success">
				<h3>
					<?php
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<?php if (isset($_SESSION["username"])): ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>

			<p>Ai suma disponibila de <strong><?php
				echo $_SESSION['suma'];
			?></strong></p>

			<p><a href="index.php?logout='1'" style="color: red">Logout</a></p>
		<?php endif ?>
	</div>
	<?php include('afisare_tabel.php'); ?>
</body>
<HEAD>
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
</html>
