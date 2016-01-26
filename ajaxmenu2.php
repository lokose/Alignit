<?php
include 'class.php';
    $a = new usuario();
		$a->sessionstarter1();

	$d = new Business_Objectives;
	$d->getmenu($a->compid);
	
?>