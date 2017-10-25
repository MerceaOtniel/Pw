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

$start = "Aleea Actorilor,Timisoara, Romania";
$destination = $adresa;
$apiUrl = 'http://maps.googleapis.com/maps/api/directions/json';
$url = $apiUrl . '?' . 'origin=' . urlencode($start) . '&destination=' . urlencode($destination);
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$res = curl_exec($curl);
if(curl_errno($curl)){
	throw new Exception(curl_error($curl));
}
curl_close($curl);
$json = json_decode(trim($res), true);
$route = $json['routes'][0];
$totalDuration = 0;
foreach($route['legs'] as $leg){
	$totalDuration = $totalDuration + $leg['duration']['value'];
}
$totalDuration=round($totalDuration/60)+2;
echo 'Total time  is ' . $totalDuration . ' min ';

$durata=$durata+$totalDuration;

$message="Meniul :$meniu se va livra la: $adresa pentru persoana: $persoana in aproximativ $durata minute.";

$subject="Comanda pe cale de livrare";

$headers = 'From: <bigKitchen@yahoo.com>' . "\r\n";

mail($mail,$subject,$message,$headers);

$db1 = mysqli_connect('localhost', 'root', '', 'comenzi');
$query="DELETE from comanda where adresa='$adresa' and mail='$mail' and meniu='$meniu' and persoana='$persoana'";
mysqli_query($db1,$query);

header('location: admin.php');
 ?>
