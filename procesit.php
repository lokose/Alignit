<?php
	    include 'class.php';
	    $a = new usuario();
	    $a->sessionstarter();
	    if ($a->edit == 0){
	    	echo "Ud no tiene permiso para estar aca.";
	    }
	    $c = new it_excellence();
	    $c->id = $_REQUEST['id'];
		
	    
$i = 1;
while (isset($arr[$i])){
	
if(isset($_REQUEST["ed'.$i.'"]) == 1 ){
		$c->$arr[$i] = "X";
		} 
else { $c->$arr[$i] = "";
		}
		
$i++;
}
		
		
	$c->mod();
	
		header("Location:GranIT.php");
		
	    

	    ?>