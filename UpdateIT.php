<?php
	include 'class.php';
    $a = new usuario();
    $a->sessionstarter();
    $b = new IT_Assets();
    $b->id = $_POST['id'];
    $b->name = $_POST['name'];
    $b->budg = $_POST['budg'];
    $b->head = $_POST['head'];
    $b->editar();
    if ($b->help == 1){
    	header("Location: menuuser.php");
    	echo "Actualizacion exitosa";
    }
    else{
    	//header("Location: ModifIT.php");
    	echo "Algo salio muy mal....";
    }
    ?>
