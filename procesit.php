<?php
	    include 'class.php';
	    $a = new usuario();
	    $a->sessionstarter();
	    if ($a->edit == 0){
	    	echo "Ud no tiene permiso para estar aca.";
	    }
	    $c = new it_excellence();
	    $c->id = $_REQUEST['id'];
		
		if(isset($_REQUEST['ed01']) == 1){
		$c-> manage_service_quality = "X";
		} else { $c-> manage_service_quality = "";}
		
		if(isset($_REQUEST['ed02']) == 1){
		$c-> realize_scale_economies = "X";
		} else { $c-> realize_scale_economies = "";}
		
		if(isset($_REQUEST['ed03']) == 1){
		$c-> optimize_it_internal_processes = "X";
		} else { $c-> optimize_it_internal_processes = "";}
		
		if(isset($_REQUEST['ed04']) == 1){
		$c-> standardize_platforms_and_architecture = "X";
		} else { $c-> standardize_platforms_and_architecture = "";}
		
		if(isset($_REQUEST['ed05']) == 1){
		$c-> deliver_on_schedule = "X";
		} else { $c-> deliver_on_schedule = "";}
		
		if(isset($_REQUEST['ed06']) == 1){
		$c-> effectively_support_end_users = "X";
		} else { $c-> effectively_support_end_users = "";}
		
		if(isset($_REQUEST['ed07']) == 1){
		$c-> improve_business_productivity = "X";
		} else { $c-> improve_business_productivity = "";}
		
		if(isset($_REQUEST['ed08']) == 1){
		$c-> propose_enabling_solutions = "X";
		} else { $c-> propose_enabling_solutions = "";}
		
		if(isset($_REQUEST['ed09']) == 1){
		$c-> understand_emerging_technologies = "X";
		} else { $c-> understand_emerging_technologies = "";}
		
		if(isset($_REQUEST['ed10']) == 1){
		$c-> understand_business_units_strengths = "X";
		} else { $c-> understand_business_units_strengths = "";}
		
		
	$c->mod();
	
		header("Location:GranIT.php");
		
	    

	    ?>