<?php
if(empty($_SESSION['username'])){
	header('location: login.php');
}
else if($_SESSION['username']!='admin'){
	header('location: index.php');
}
$adresa=$_POST['adresa'];
$mail=$_POST['mail'];
$meniu=$_POST['meniu'];
$persoana=$_POST['persoana'];
$db1 = mysqli_connect('localhost', 'root', '', 'comenzi');
$query="DELETE from comanda where adresa='$adresa' and mail='$mail' and meniu='$meniu' and persoana='$persoana'";
mysqli_query($db1,$query);
header('location: admin.php');
 ?>
