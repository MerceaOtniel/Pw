<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>BigKitchen</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
</head>
<body>

	<div class="header">
		<h2>Adauga Bani</h2>
	</div>
	<form method="post" action="adaugabani.php">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Suma</label>
			<input type="number" step="0.01" name="suma" >
		</div>
    <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
    <div class="input-group">
			<button type="submit" class="btn" name="adauga_bani">Adauga</button>
      <a href="index.php" class="btn">Inapoi</a>
		</div>
	</form>
</body>
<HEAD>
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
</html>
