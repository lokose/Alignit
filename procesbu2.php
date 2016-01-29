<?php
	    include 'class.php';
	    $a = new usuario();
	    $a->sessionstarter();
	    if ($a->edit == 0){
	    	echo "Ud no tiene permiso para estar aca.";
	    }
	    $c = new bu_excellence();
	    $c->id = $_POST['fkid'];
	    if(isset($_POST['ed00'])){
	    	echo "a";
	    	$c->a[0] = 1;
		}
		else{
			$c->a[0] = 0;
		}
	    if(isset($_POST['ed1'])){
	    	$c->a[1] = 1;
		}
		else{
			$c->a[1] = 0;
		}
	    if(isset($_POST['ed2'])){
	    	$c->a[2] = 1;
		}
		else{
			$c->a[2] = 0;
		}
	    if(isset($_POST['ed3'])){
	    	$c->a[3] = 1;
		}
		else{
			$c->a[3] = 0;
		}
	    if(isset($_POST['ed4'])){
	    	$c->a[4] = 1;
		}
		else{
			$c->a[4] = 0;
		}
	    if(isset($_POST['ed5'])){
	    	$c->a[5] = 1;
		}
		else{
			$c->a[5] = 0;
		}
	    if(isset($_POST['ed6'])){
	    	$c->a[6] = 1;
		}
		else{
			$c->a[6] = 0;
		}
	    if(isset($_POST['ed7'])){
	    	$c->a[7] = 1;
		}
		else{
			$c->a[7] = 0;
		}
	    if(isset($_POST['ed8'])){
	    	$c->a[8] = 1;
		}
		else{
			$c->a[8] = 0;
		}
	    if(isset($_POST['ed9'])){
	    	$c->a[9] = 1;
		}
		else{
			$c->a[9] = 0;
		}
	    if(isset($_POST['ed10'])){
	    	$c->a[10] = 1;
		}
		else{
			$c->a[10] = 0;
		}
		$c->mod();
		header("Location:detbu.php?id=$c->id");
	    

	    ?>