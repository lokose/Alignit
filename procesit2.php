<?php
	    include 'class.php';
	    $a = new usuario();
	    $a->sessionstarter();
	    if ($a->edit == 0){
	    	echo "Ud no tiene permiso para estar aca.";
	    }
	    $c = new it_excellence();
	    $c->id = $_POST['fkid'];
		
		if($_POST['ed01'] == "on"){
			
		$c-> manage_service_quality = "X";
		} else { $c-> manage_service_quality = "";}
		if($_POST['ed02'] == "on"){
	
		$c-> realize_scale_economies = "X";
		} else { $c-> realize_scale_economies = "";}
		if($_POST['ed03'] == "on"){
			
		$c-> optimize_it_internal_processes = "X";
		} else { $c-> optimize_it_internal_processes = "";}
		if($_POST['ed04'] == "on"){
			
		$c-> standardize_platforms_and_architecture = "X";
		} else { $c-> standardize_platforms_and_architecture = "";}
		if($_POST['ed05'] == "on"){
			
		$c-> deliver_on_schedule = "X";
		} else { $c-> deliver_on_schedule = "";}
		if($_POST['ed06'] == "on"){
			
		$c-> effectively_support_end_users = "X";
		} else { $c-> effectively_support_end_users = "";}
		if($_POST['ed07'] == "on"){
			
		$c-> improve_business_productivity = "X";
		} else { $c-> improve_business_productivity = "";}
		if($_POST['ed08'] == "on"){
			
		$c-> propose_enabling_solutions = "X";
		} else { $c-> propose_enabling_solutions = "";}
		if($_POST['ed09'] == "on"){
			
		$c-> understand_emerging_technologies = "X";
		} else { $c-> understand_emerging_technologies = "";}
		if($_POST['ed10'] == "on"){
			
		$c-> understand_business_units_strengths = "X";
		} else { $c-> understand_business_units_strengths = "";}
	
		$c->mod();
		//header("Location:detit.php?id=$c->id");
	    

	    ?>