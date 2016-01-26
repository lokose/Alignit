


<html> 
<head>
            <link type="text/css" rel="stylesheet" href="css.css">

</head> 
<body> 
 
<?php
	include 'class.php';
    $a = new usuario();
    $a->sessionstarter();
    $b = new business_objectives();
    if ($a->edbu == 0){
	    	echo "You can't be here";
	    }
	else{
		echo "<form action = UpdateBU.php method='POST'>";
		$b->preupdatear();

		echo"Name     : <input type='text' name=name value=".$b->name."><br>";
		echo"<input type='text' name =id value=".$b->id." style='display:none'><br>";
		echo"<input type='submit' value='Send'>";
		echo"</form>";		
	}
?>

</body>  
</html>


