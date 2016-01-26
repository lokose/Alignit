
<html> 
<head>
            <link type="text/css" rel="stylesheet" href="css.css">

</head> 
<body> 
 
<?php
	include 'class.php';
    $a = new usuario();
    $a->sessionstarter();
    $b = new IT_Assets();
    if ($a->edit == 0){
	    	echo "You can't be here";
	    }
	else{
		echo "<form action = UpdateIT.php method='POST'>";
		$b->preupdatear();

		echo"Name : <input type='text' name=name value=".$b->name."><br>";
		echo"Budget :  	<input type='number' name=budg value=".$b->budg."><br>";
		echo"Headcount : <input type='number' name=head value=".$b->head."><br>";
		echo"<input type='text' name =id value=".$b->id." style='display:none'><br>";
		echo"<input type='submit' value='Send'>";
		echo"</form>";		
	}
?>
</body>  
</html>



