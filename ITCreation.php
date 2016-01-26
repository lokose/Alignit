<html>

<head>
      <link type="text/css" rel="stylesheet" href="css.css">
<?php
	include 'class.php';
	$a = new usuario();
	$b = new IT_Assets();
	$a->sessionstarter();
	$b->name = $_POST['name'];
	$b->budg = $_POST['budg'];
	$b->head = $_POST['head'];
	$b->insertit($a->compid);
	if ($b->help == 1){
		echo "It has been successfully inserted";
		
header("Location:menuuser.php");
	}
	else {
		echo "Somethink went wrong, try again";
	}
	echo"<br><br>";
	echo"<a href = 'menuuser.php'><input type='submit' value='Back to Menu'></a>";
	echo"<br>";
	echo"<br>";
	echo"<br>";
	echo"<br>";
?>
</html>