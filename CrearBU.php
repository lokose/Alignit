<?php
	    include 'class.php';
	    $a = new usuario();
	    $a->sessionstarter();
	    if ($a->edbu == 0){
	    	echo "Ud no tiene permiso para estar aca.";
	    }
?>
<!DOCTYPE html> 
<html> 
<head>
	<title>Create a Business Objectives</title> 
	<link type="text/css" rel="stylesheet" href="css.css">
</head> 
<br>
<h2>Create a Business Objectives</h2> 
	<body>
		<?php
			if ($a->edbu == 1){
	echo"
	<pre><br>
		<form method ='post' action='BUCreation.php'> 
			Name:          <input id='name' type='text' name='name'><br><br>
			<input type='submit' value='Add Business Objectives'></br>
			<a href = 'menuuser.php' > Go Back</a>
	</form>
	</pre>";}
		?> 
	</body>  
</html>