<?php
	include 'class.php';
    $a = new usuario();
    $a->sessionstarter();
    $b = new Business_Objectives();
    $b->id = $_POST['id'];
    $b->name = $_POST['name'];
    $b->editar();
    if ($b->helpme == 1){
    	header("Location: menuuser.php");
    	echo "Actualizacion exitosa";
    }
    else{
    	//header("Location: ModifIT.php");
    	echo "Algo salio muy mal....";
    }
    ?>
