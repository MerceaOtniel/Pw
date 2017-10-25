<?php include('server.php');
if(empty($_SESSION['username'])){
	header('location: login.php');
}

if (isset($_GET["vote"],$_GET["id"])){

	 $db1 = mysqli_connect('localhost', 'root', '', 'marfa');
	 $db2= mysqli_connect('localhost','root','','voturi');
	 $nume=$_SESSION['username'];
	 $optiune=$_GET["vote"];
	 $cerere="SELECT * from vot WHERE nume='$nume' AND optiune='$optiune'";

	 $rezultat=mysqli_query($db2,$cerere);

	 if(mysqli_num_rows($rezultat)==0){
		 $product_id=(int)$_GET["id"];
		 $vote =($_GET["vote"]==="up") ? 1 : -1;
		 $id=$_GET["id"];
		 echo $id;
		 $sql="UPDATE prep SET voturi=voturi + $vote where $id=id";
		 mysqli_query($db1, $sql);
		 $query = "INSERT INTO vot (nume, optiune)  VALUES('$nume', '$optiune')";
		 mysqli_query($db2,$query);

	 }
	  header('location: index.php');
}

?>
<?php
	$db1 = mysqli_connect('localhost', 'root', '', 'marfa');
	$cerere="SELECT * FROM prep order by voturi Desc";
	$rezultat=mysqli_query($db1,$cerere);

	while($rand=mysqli_fetch_array($rezultat))
	{
		?>
		<p class="header">
			<?php echo "Numele este: ";?>
			<?php echo htmlspecialchars($rand["Nume"], ENT_QUOTES, 'UTF-8');?>
			<br>
			<?php echo "Reteta este: ";?>
			<?php echo htmlspecialchars($rand["Reteta"], ENT_QUOTES, 'UTF-8');?>
			<br>
			<?php echo "Numarul de voturi este: ".$rand["voturi"];?>
			<br>
			<?php echo "Pretul este: ".$rand["Pret"]." lei";?>
			<br>
			<a href="?vote=up&amp;id=<?php echo $rand["id"]; ?>">Up</a>
			<br>
			<a href="?vote=down&amp;id=<?php echo $rand["id"]; ?>">Down</a>
			<form method="post" action="comentariu.php" style="padding: 1px; width: 10%;text-align:centre;">
				<input type="hidden" name="categorie" value="<?php echo $rand["Nume"] ?>">
				<button type="submit" class="btn" name="add">Adauga comment</button>
			</form>
			<form method="post" action="forum.php" style="padding: 1px; width: 10%;text-align:centre;">
				<input type="hidden" name="categorie" value="<?php echo $rand["Nume"] ?>">
				<button type="submit" class="btn" name="view">Vizualizeaza Comentariile</button>
			</form>
			<form method="post" action="comanda.php" style="padding: 1px; width: 10%;text-align:centre;">
				<input type="hidden" name="categorie" value="<?php echo $rand["Nume"] ?>">
				<input type="hidden" name="pret" value="<?php echo $rand["Pret"]  ?>">
				<button type="submit" class="btn" name="send_mail">Adauga comanda</button>
			</form>
		</p>
		<?php
  }
	?>
