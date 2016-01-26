<?php
	    include 'class.php';
	    $a = new usuario();
	    $a->sessionstarter();
	    if ($a->edit == 0){
	    	echo "Ud no tiene permiso para estar aca.";
	    }
?>

<!DOCTYPE html> 
<html> 
<head>
        <link type="text/css" rel="stylesheet" href="css.css">

    <title>Create IT Assets</title> 
</head> 
  	<h1>Create IT Assets</h1> 
<body> <center>
        <?php
        if ($a->edit == 1){ 
        echo"
		<pre> 
		<form method ='post' action='ITCreation.php'> 
		Name:			<input type='text' name='name'>
		Budget:			<input type='number' name='budg'>
		Headcount:		<input type='number' name='head'>
		
		
		<br>
		<input type='submit' value='Add It Assets'><br>
		<a href = 'menuuser.php'>Go Back</a>
		</form>
		
		
	</pre> 
";


    }
    ?>
</center></body>  
</html>