<?php

	session_start();
	session_regenerate_id(TRUE);
	error_reporting(0);
	$username = "";
	$email    = "";
	$errors = array();


	if(isset($_POST['adauga_bani'])){

		$db=mysqli_connect('localhost','root','','registration');
		$username=mysqli_real_escape_string($db,$_POST['username']);
		$suma=mysqli_real_escape_string($db,$_POST['suma']);
		if(empty($suma)){array_push($errors,"Sum of money required");}
		if(count($errors)==0){
			$que1="SELECT suma from users WHERE username='$username'";
			$res1=mysqli_query($db,$que1);
			$value = mysqli_fetch_assoc($res1);
			$suma=$suma+$value['suma'];
			$que="UPDATE users SET suma='$suma' WHERE username='$username'";
			$res=mysqli_query($db,$que);
			$_SESSION['suma'] = $suma;
			header('location: index.php');
		}
	}

	if (isset($_POST['reg_user'])) {
		$db = mysqli_connect('localhost', 'root', '', 'registration');
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		$que="SELECT * FROM users WHERE username='$username'";//aici si mai jos verific unicitatea numelui
		$res=mysqli_query($db,$que);

		if(mysqli_num_rows($res)==1){
			array_push($errors,"The username is taken");
		}
		else{
			if (count($errors) == 0) {
				$password = md5($password_1);
				$query = "INSERT INTO users (username, email, password)  VALUES('$username', '$email', '$password')";
				mysqli_query($db, $query);

				$select_user = "SELECT suma FROM users WHERE username='$username' LIMIT 1"; //wrap it with ` around the field or don't wrap with anything at all
				$result = mysqli_query($db, $select_user);
				$value = mysqli_fetch_assoc($result);
				$_SESSION['suma'] = $value['suma'];
				$_SESSION['username']=$username;
				$_SESSION['success']="YOU are now logged in";
				header('location: index.php');
	  		}
		}
	}

	if(isset($_POST['add_command'])){

		$db1=mysqli_connect('localhost','root','','comenzi');
		$adresa=mysqli_real_escape_string($db1,$_POST['adresa']);
		$mail=mysqli_real_escape_string($db1,$_POST['mail']);
		$meniu=mysqli_real_escape_string($db1,$_POST['categorie']);
		$pret=mysqli_real_escape_string($db1,$_POST['pret']);
		$durata=mysqli_real_escape_string($db1,$_POST['durata']);
		$suma=$_SESSION['suma'];

		if(empty($adresa)){
			array_push($errors,"Please enter an address");
		}
		if(empty($mail)){
			array_push($errors,"Please enter your mail");
		}
		if($suma < $pret){
			array_push($errors,"You don't have money");
		}
		$name=$_SESSION['username'];
		if(count($errors)==0){
			$suma1=$suma-$pret;
			$_SESSION['suma'] = $suma1;
			$db = mysqli_connect('localhost', 'root', '', 'registration');
			$que="UPDATE users SET suma='$suma1' WHERE username='$name'";
			$res=mysqli_query($db,$que);
			$query="INSERT into comanda (persoana,adresa,mail,meniu,durata) VALUES ('$name','$adresa','$mail','$meniu','$durata')";
			mysqli_query($db1,$query);
			header('location: index.php?categorie=meniu');
		}
	}

	if(isset($_POST['add_comment'])){

		$db1=mysqli_connect('localhost','root','','forum');
		$comment=mysqli_real_escape_string($db1,$_POST['comment']);
		$categorie=mysqli_real_escape_string($db1,$_POST['categorie']);
		if(empty($categorie)){
			array_push($errors,"Please enter a category");
		}
		if(empty($comment)){
			array_push($errors,"Please enter a comment");
		}
		$name=$_SESSION['username'];
		if(count($errors)==0){
			$query="INSERT into comentarii (nume,categorie,text) VALUES ('$name','$categorie','$comment')";
			mysqli_query($db1,$query);
			header('location: index.php');
		}
	}

	if(isset($_POST['add_food'])){
		$db1 = mysqli_connect('localhost', 'root', '', 'marfa');
		$name=mysqli_real_escape_string($db1,$_POST['name']);
		$recipe=mysqli_real_escape_string($db1,$_POST['recipe']);
		$pret=mysqli_real_escape_string($db1,$_POST['pret']);

		if(empty($name)){
			array_push($errors,"Name of the recipe required");
		}
		if(empty($recipe)){
			array_push($errors,"Recipe requred");
		}
		if(count($errors)==0){
		$query="SELECT *FROM prep WHERE Nume='$name' AND Reteta='$recipe' AND Pret='$pret'";
		$results=mysqli_query($db1,$query);
		if(mysqli_num_rows($results)==0){
			$query2="INSERT INTO prep (Nume,Reteta,Pret) VALUES ('$name','$recipe','$pret')";
			mysqli_query($db1,$query2);
		}
		header('location: admin.php');
		}

	}

	if (isset($_POST['login_user'])) {
		$db = mysqli_connect('localhost', 'root', '', 'registration');
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);


			$select_user = "SELECT suma FROM users WHERE username='$username' LIMIT 1"; //wrap it with ` around the field or don't wrap with anything at all
			$result = mysqli_query($db, $select_user);
			$value = mysqli_fetch_assoc($result);
			$_SESSION['suma'] = $value['suma'];


			if(mysqli_num_rows($results)==1 and $username=='admin'){
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: admin.php');
			}
			else if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	if(isset($_GET['logout'])){
		unset($_SESSION['username']);
		unset($_SESSION['suma']);
		unset($_SESSION['success']);
		session_destroy();
		header('location: login.php');
	}
?>
