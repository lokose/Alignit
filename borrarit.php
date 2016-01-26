<?php
	include 'class.php';
    $a = new usuario();
    $a->sessionstarter();
    $b = new IT_Assets();
    $b->borrar();
    if ($b->help == 1){
    	header("Location: granit.php");
    	echo "Actualizacion exitosa";
    }
    else{
    	//header("Location: ModifIT.php");
    	echo "Algo salio muy mal....";
    }
    ?>