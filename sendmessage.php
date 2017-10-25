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
$durata=$_POST['durata'];

include(ignoremessage.php);

$message="Meniul :$meniu se va livra la: $adresa pentru persoana: $persoana in aproximativ $durata minute.";

$subject="Comanda pe cale de livrare";

$headers = 'From: <bigKitchen@yahoo.com>' . "\r\n";

mail($mail,$subject,$message,$headers);

$db1 = mysqli_connect('localhost', 'root', '', 'comenzi');
$query="DELETE from comanda where adresa='$adresa' and mail='$mail' and meniu='$meniu' and persoana='$persoana'";
mysqli_query($db1,$query);

header('location: admin.php');
 ?>
