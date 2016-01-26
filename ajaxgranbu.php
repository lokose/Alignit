<?php
include 'class.php';
    $a = new usuario();
    $a->sessionstarter1();
	$c = new bu_excellence();
    if ($a->edbu == 0){
	    	echo "Ud no tiene permiso para estar aca.";
	    }
	else{
		$c->the_great_table($a->compid);
	}
	
?>