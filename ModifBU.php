<!DOCTYPE html>
 <html>
 <head>
 <title>Business Objectives</title>
     <link type="text/css" rel="stylesheet" href="css.css">

 </head>
 <body>

<?php
	include 'class.php';
    $a = new usuario();
    $a->sessionstarter();
    $b = new Business_Objectives();
    if ($a->edbu == 0){
	    	echo "You Can't be here";
	    }
	else{
    $b->show_table($a->compid);
	}
	echo"<br>";
	echo"<br>";
	echo"<a href = 'menuuser.php'>Go Back</a>";
	echo"<br>";




    ?>