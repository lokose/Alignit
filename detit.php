
<html> 
<head>
            <link type="text/css" rel="stylesheet" href="css.css">

</head> 
<body> 
 <pre>
<?php
	    include 'class.php';
	    $a = new usuario();
	    $a->sessionstarter();
	    if ($a->edit == 0){
	    	echo "You can't be here";
	    }
	    
	    $c = new it_excellence();
	    $c->check();
	    ?>
		

<a href = 'ModifIT.php'>Go Back</a>
</pre>
</body>  
</html>