<!DOCTYPE html>
 <html>
 <head>
 <title>IT Assets</title>
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
    $b->show_table($a->compid);
	}
	echo"<br>";
	echo"<br>";
	echo"<a href = 'granit.php'>Go Back</a>";
	echo"<br>";




    ?>