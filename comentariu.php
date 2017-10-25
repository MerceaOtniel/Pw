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
<body style="background-image:url(../img/comment.png)">
	<div class="header">
		<h2>Comment</h2>
	</div>
	<form method="post" action="comentariu.php">

		<?php include('errors.php'); ?>
    <input type="hidden" name="categorie" value="<?php echo $_POST['categorie']; ?>">
    <div class="input-group">
      <label>Comentariu</label>
      <TEXTAREA name="comment" rows="10" cols="30"></TEXTAREA>
    </div>
    <button type="submit" class="btn" name="add_comment">Add</button>
    <a href="index.php" style="text-decoration:none;" class="btn"> Inapoi </a>
	</form>
</body>
<HEAD>
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
</HEAD>
</html>
