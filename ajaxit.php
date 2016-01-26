<?php
include 'class.php';
    $a = new usuario();
    $a->sessionstarter1();
	$c = new IT_Assets();
    if ($a->edbu == 0){
	    	echo "Ud no tiene permiso para estar aca.";
	    }
	else{
		$c->getall($a->compid);
	}
	
?>