<?php include('server.php');
if(empty($_SESSION['username'])){
	header('location: login.php');
}
else if($_SESSION['username']!='admin'){
	header('location: index.php');
}
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<title>Registration system PHP and MySQL</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
		<META HTTP-EQUIV="Expires" CONTENT="-1">
	</HEAD>
	<BODY style="background-image:url(../img/photo3.jpg);">
		<div class="header">
			<h2>Add food</h2>
		</div>
		<FORM action="admin.php"method ="post">
			<?php include('errors.php'); ?>

			<div class="input-group">
				<label>Name</label>
				<input type="text" name="name" >
			</div>
			<div class="input-group">
				<label>Reteta</label>
				<TEXTAREA name="recipe" rows="10" cols="30"></TEXTAREA>
			</div>
			<div class="input-group">
				<label>Pret</label>
				<input type="number" name="pret" >
			</div>
			<button type="submit" class="btn" name="add_food">Add</button>
			<p><a href="index.php?logout='1'" style="color: red">Logout</a></p>
		</FORM>
		<?php

			$db1 = mysqli_connect('localhost', 'root', '', 'comenzi');
			$cerere="SELECT * FROM comanda";
			$rezultat=mysqli_query($db1,$cerere);

			while($rand=mysqli_fetch_array($rezultat))
			{
				?>
				<p class="header">
					<?php echo "Numele este: ";?>
					<?php echo htmlspecialchars($rand["persoana"], ENT_QUOTES, 'UTF-8');?>
					<br>
					<?php echo "Locatia este: ";?>
					<?php echo htmlspecialchars($rand["adresa"], ENT_QUOTES, 'UTF-8');?>
					<br>
		      <?php echo "Mailul este: ";?>
		      <?php echo htmlspecialchars($rand["mail"], ENT_QUOTES, 'UTF-8');?>
					<br>
		      <?php echo "Meniul este: ";?>
		      <?php echo htmlspecialchars($rand["meniu"], ENT_QUOTES, 'UTF-8');?>
					<form method="post" action="sendmessage.php" style="padding: 8px; width: 8%;text-align:centre;">
		        <input type="hidden" name="mail" value="<?php echo $rand["mail"] ?>">
		        <input type="hidden" name="persoana" value="<?php echo $rand["persoana"] ?>">
		        <input type="hidden" name="meniu" value="<?php echo $rand["meniu"] ?>">
		        <input type="hidden" name="adresa" value="<?php echo $rand["adresa"] ?>">
		        <button type="submit" class="btn" name="send_mail">Accepta comanda</button>
		    	</form>
					<form method="post" action="ignoremessage.php" style="padding: 8px; width: 8%;text-align:centre;">
		        <input type="hidden" name="mail" value="<?php echo $rand["mail"] ?>">
		        <input type="hidden" name="persoana" value="<?php echo $rand["persoana"] ?>">
		        <input type="hidden" name="meniu" value="<?php echo $rand["meniu"] ?>">
		        <input type="hidden" name="adresa" value="<?php echo $rand["adresa"] ?>">
		        <button type="submit" class="btn" name="send_mail">Ignora comanda</button>
		    	</form>

					<br>
				</p>
				<?php
		  }
			?>
	</BODY>
	<HEAD>
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
		<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
</HTML>
