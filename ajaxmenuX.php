<?php
include 'class.php';
    $a = new usuario();
		$a->sessionstarter1();

	$d = new it_assets;
		
	$e = new business_objectives;
		
	$b = new it_excellence();
		
	$c = new bu_excellence();
	$m = 1;
echo "[";
	
$e->getmenu1($a->compid);	
while($bu = mysqli_fetch_object($e->buname)){
	
	$d->getmenu1($a->compid);
	while($it = mysqli_fetch_object($d->itname)){
		
		$x = " ";
		if($m == 2){
			echo ",";
		}
		$m = 2;
		$c->menu($bu->id);
		while($bus = mysqli_fetch_object($c->res)){
			
			
			$b->menu($it->id);
			while($its = mysqli_fetch_object($b->res)){
				
				
				if($its->operational_excellence_dimensions_id == $bus->operational_excellence_dimensions_id){
					$x = "X";
				}
					
			}
				
		}
		echo '{"equis":"'.$x.'"}';	
	
	}
}
echo "]";
?>