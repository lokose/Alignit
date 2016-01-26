<?php
	include 'class.php';
    $a = new usuario();
    $a->sessionstarter();
    $b = new Business_Objectives();
	$b->id = $_REQUEST['id'];
    $b->borrar();
    ?>