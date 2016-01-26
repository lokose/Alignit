<?php
include 'class.php';
    $a = new usuario();
    $a->sessionstarter1();
	$c = new Business_Objectives();
    if ($a->edbu == 0){
	    	echo "Ud no tiene permiso para estar aca.";
	    }
	else{
		$c->getall($a->compid);
	}
	
?>