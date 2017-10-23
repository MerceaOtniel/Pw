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
<body style="background-image:url(../img/order.jpg)">
	<div class="header">
		<h2>Comanda</h2>
	</div>
	<form method="post" action="comanda.php">

		<?php include('errors.php'); ?>
    <input type="hidden" name="categorie" value="<?php echo $_POST['categorie']; ?>">
    <div class="input-group">
      <label>Adresa</label>
      <TEXTAREA name="adresa" rows="10" cols="30"></TEXTAREA>
      <label>Adresa Mail<label>
        <input type="email" name="mail">
    </div>
    <button type="submit" class="btn" name="add_command">Add</button>
    <a href="index.php" class="btn"> Inapoi </a>
	</form>
</body>
<HEAD>
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
</html>
