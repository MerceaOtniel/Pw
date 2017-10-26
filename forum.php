<?php include('server.php');
if(empty($_SESSION['username'])){
	header('location: login.php');
}
?>
<html>
<head>
	<title>BigKitchen</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
</head>
<body style="<?php echo "background-image:url(".$_POST['path'].")"; ?>">
<?php
	$db1 = mysqli_connect('localhost', 'root', '', 'forum');
	$categorie=$_POST['categorie'];
	$cerere="SELECT * FROM comentarii WHERE categorie = '$categorie' ";
	$rezultat=mysqli_query($db1,$cerere);

	while($rand=mysqli_fetch_array($rezultat))
	{
		?>
		<p>
			<div class="header">
				<?php echo "Categoria ";?>
				<?php echo htmlspecialchars($rand["categorie"], ENT_QUOTES, 'UTF-8');?>
				<?php echo ": Userul ";?>
				<?php echo htmlspecialchars($rand["nume"], ENT_QUOTES, 'UTF-8');?>
				<?php echo " says:";?>
				<?php echo htmlspecialchars($rand["text"], ENT_QUOTES, 'UTF-8');?>
			</div>
		</p>
		<?php
  }
	?>
</body>
<HEAD>
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
</html>
