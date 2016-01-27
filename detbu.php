
<html> 
<head>
            <link type="text/css" rel="stylesheet" href="css.css">

</head> 
<body> 
 
<?php
	    include 'class.php';
	    $a = new usuario();
	    $a->sessionstarter();
	    if ($a->edbu == 0){
	    	echo "You can be here";
	    }
	    
	    $c = new bu_excellence();
	    $c->check();
	    ?>

		
<a href = 'menuuser.php'>Go to Menu</a>

</body>  
</html>


