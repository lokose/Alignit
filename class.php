<?php
class usuario{
	public $conn;
	public $id;
	public $user;//usuario
	public $pass;//contraseña
	public $mail;//email
	public $posi;//posicion
	public $depa;//departamento
	public $edbu;//can fill business
	public $edit;//can fill it
	public $compid;//company id
	public $itsalive; //variable de control
	
	public function connect(){
		$this->conn = mysqli_connect("localhost","root","","project");
		if(mysqli_connect_errno()){
			echo "Error :". mysqli_connect_error();
		}
  	}
	public function Create_User(){
		$this->connect();
		$insert = mysqli_query($this->conn, "Insert user
			(username, password, email, position, department, can_fill_business,
			can_fill_it, company_id) values ('".$this->user."','".$this->pass."',
			'".$this->mail."','".$this->posi."','".$this->depa."',
			$this->edbu,
			$this->edit,
			$this->compid)");	
		
		if ($insert){
			$this->itsalive = 1;
		}
		else{
			$this->itsalive = 0;
		}
	}
	public function Who_am_I(){
		$this->connect();
		$sql = "SELECT can_fill_business, can_fill_it FROM user WHERE id = $this->id";
		$result = mysqli_query($this->conn, $sql);
		if ($row=mysqli_fetch_object($result)){
			$this->edbu=$row->can_fill_business;
			$this->edit=$row->can_fill_it;
		}
	}
	public function Update_User(){
		$update= mysqli_query($this->conn, "Update user set 
			username = '".$this->user."',
			password = '".$this->pass." ',
			email = '".$this->mail."',
			position = '".$this->posi." ',
			department = '".$this->depa." ',
			can_fill_business = '".$this->filbu." ',
			can_fill_it = '".$this->filit." ',
			where id = ' ".$this->id." ' ");
	}
	public function Delete_User(){
		$delete = mysqli_query($this->conn, "Delete from user 
			where id=".$this->id);

	}
	public function log_me_in($mail1){
        $query1 = "SELECT id, username, password FROM user WHERE email = '$mail1'";
        $this->connect();
        $result = mysqli_query($this->conn, $query1);
        if($row = mysqli_fetch_object($result)){
        	$this->id = $row->id;
        	$this->user = $row->username;
        	$this->pass = $row->password;
        	$this->itsalive = 1;
    	}
    	else{
    		echo 'We are sorry, you do not exist. <br>';
    		$this->itsalive = 0;
    	}
	}
	public function sessionstarter(){
		session_start();
        $this->connect();
        $sql = "SELECT id, username, company_id FROM user WHERE id=$_SESSION[id]";
        $result = mysqli_query($this->conn, $sql);
        if ($result == FALSE || $result == ""){
        	header("Location:login.php");
			echo ("Por favor, inicie sesion");
        }
        else{
        	$row = mysqli_fetch_array($result);
        	echo "<h2>Welcome, ".$row[1]."</h2>";
        	$this->id = $row[0];
        	$this->user = $row[1];
        	$this->compid = $row[2];
        	$this->Who_am_I();
        	mysqli_free_result($result);
    	}
    }
	
	public function sessionstarter1()
	{
		session_start();
        $this->connect();
        $sql = "SELECT id, username, company_id FROM user WHERE id=$_SESSION[id]";
        $result = mysqli_query($this->conn, $sql);
        if ($result == FALSE || $result == ""){
        	header("Location:login.php");
			echo ("Por favor, inicie sesion");
        }
        else{
        	$row = mysqli_fetch_array($result);
    
        	$this->id = $row[0];
        	$this->user = $row[1];
        	$this->compid = $row[2];
        	$this->Who_am_I();
        	mysqli_free_result($result);
    	}
    }
}	

class IT_Assets{
	public $conn;
	public $id;
	public $name;
	public $budg;
	public $head;
	public $company_id;
	public $help;
	public $itname;
	public function connect(){
		$this->conn = mysqli_connect("localhost","root","","project");
	}
	public function insertit($fk){
		$this->connect();
		$query = "INSERT INTO it_assets (name, budget, headcount, company_id) VALUES (
			'".$this->name."', $this->budg, $this->head, $fk)";
		$insert = mysqli_query($this->conn, $query);
		if ($insert){
			$this->help = 1;
		}
		else{
			$this->help = 0;
		}
	}
	public function show_table($fk){
		$this->connect();
		$que = "SELECT id, name, ROUND(budget,0) AS roundb, ROUND(headcount,0) AS roundhead FROM it_assets WHERE company_id = $fk";
		$khe = mysqli_query($this->conn, $que);
		
		echo "";
		echo "<table bgcolor='white' border='1'>";
		echo "<tr>";
		echo "<th>Name</th><th>Budget</th><th>Headcount</th><th>Update</th><th>Detail</th><th>Delete</th>";
		echo "</tr>";

		while($row = mysqli_fetch_assoc($khe)){
			echo "<tr>";
   			echo "<td>".$row['name']."</td><td> ".$row['roundb']."</td><td> ".$row['roundhead']."</td>";
		    echo "<td><a href='modit.php?id=".$row['id']."'>Modify Data </a>     </td>";
		    echo "<td><a href='detit.php?id=".$row['id']."'>Detail </a>     </td>";
		    echo "<td><a href='borrarit0.php?id=".$row['id']."'>Delete Data </a>     </td>";
   			echo "</tr>";
		}
		echo "</table>";

	}
	public function preupdatear(){
		$this->connect();
		$query = "SELECT id, name, budget, headcount FROM it_assets WHERE id = $_GET[id]";
		$result = mysqli_query($this->conn, $query);
		if ($row = mysqli_fetch_object($result)){
			$this->id = $row->id;
			$this->name = $row->name;
			$this->budg = $row->budget;
			$this->head = $row->headcount;
		} 
	}
	public function editar(){
		$this->connect();
		$query = "UPDATE it_assets set name = '".$this->name."', budget = $this->budg, headcount = $this->head 
			WHERE id = $this->id";
		$result = mysqli_query($this->conn, $query);
		if($result){
			$this->help = 1;
		}
		else{
			$this->help = 0;
		}
	}
	public function borrar(){
		$this->connect();

		$prev = "Delete from alignment_assets_excellence where it_assets_id =" .$_REQUEST['id'];
		$post = mysqli_query($this->conn, $prev);

		$del = "Delete from it_assets where id=".$_REQUEST['id'];
		$delete = mysqli_query($this->conn, $del);
		if ($delete){
			$this->help = 1;
		}
		else{
			$this->help = 0;
		}
	}
	
	public function getall($fk){
		$this->connect();
		$select = mysqli_query($this->conn, "SELECT * FROM it_assets WHERE company_id = $fk");
		While ($r = mysqli_fetch_assoc($select)){
			$rows[] = $r;
		}
		print json_encode($rows);
	}
	public function getmenu($fk){
		$this->connect();
		$select = mysqli_query($this->conn, "SELECT * FROM it_assets WHERE company_id = $fk");
		echo "[";
		$z=0;
		While($r = mysqli_fetch_object($select)){
			if($z==1){
				echo ",";
			}
			echo '{"name":"'.$r->name.'"}';
			$z=1;
		}
		echo "]";
	}
	
	public function getmenu1($fk){
		$this->connect();
		$this->itname = mysqli_query($this->conn, "SELECT * FROM it_assets WHERE company_id = $fk");
	}
	
}

class company{
	public $id;
	public $name;
	public $conn;
	public $porsiacaso; //variable de control
	public function connect(){
		$this->conn = mysqli_connect("localhost","root","","project");
   	}
   	public function crearco(){
   		$this->connect();
   		//echo $this->name;
   		$rev = "SELECT id from company where name = '".$this->name."'";
   		$rve = mysqli_query($this->conn, $rev);
   		$ver = mysqli_fetch_object($rve);
   		if ($ver != FALSE || $ver!= ""){
   			echo "La compañia ya existe. Se informará a sus superiores de su flojera";
   			$this->id = $ver->id;
   		}
   		else{
   			$sql = "INSERT into company (name) values ('$this->name')";
   			$insert = mysqli_query($this->conn, $sql);
   		
   			$sel = "SELECT id from company where name = '".$this->name."'";
   			$result = mysqli_query($this->conn, $sel);
   			$row = mysqli_fetch_array($result);
			$this->id = $row[0];
   		}
   	}
}
class Business_Objectives{
	public $id;
	public $name;
	public $company_id;
	public $helpme;
	public $buname;
	public $conn;
	public function connect(){
		$this->conn = mysqli_connect("localhost","root","","project");
   	}
	public function insertbu($fk){
		$this->connect();
		$query = "INSERT INTO business_objectives (name, company_id) VALUES (
		'".$this->name."', $fk)";
		$insert = mysqli_query($this->conn, $query);
		if ($insert){
			$this->helpme = 1;
		}
		else{
			$this->helpme = 0;
		}
	}
	public function show_table($fk){
		$this->connect();
		$que = "SELECT id, name FROM business_objectives WHERE company_id = $fk";
		$khe = mysqli_query($this->conn, $que);
		
		echo "";
		echo "<table bgcolor='white' border=1>";
		echo "<tr>";
		echo "<th>Name</th><th>Update</th><th>Detail</th><th>Delete</th>";
		echo "</tr>";

		while($row = mysqli_fetch_assoc($khe)){
			echo "<tr>";
   			echo "<td>".$row['name']."</td>";
		    echo "<td><a href='modbu.php?id=".$row['id']."'>Update Data </a>     </td>";
		    echo "<td><a href='detbu.php?id=".$row['id']."'>Detail </a>     </td>";
		    echo "<td><a href='borrarbu0.php?id=".$row['id']."'>Delete Data </a>";

   			echo "</tr>";
		}
		echo "</table>";

	}
	
	function getall($fk){
		$this->connect();
		$select = mysqli_query($this->conn, "SELECT id, name FROM business_objectives WHERE company_id = $fk");
		While ($r = mysqli_fetch_assoc($select)){
			$rows[] = $r;
		}
		print json_encode($rows);
	}
	
	public function getmenu1($fk){
		$this->connect();
		$this->buname = mysqli_query($this->conn, "SELECT * FROM business_objectives WHERE company_id = $fk");
	}
	
	public function getmenu($fk){
		$this->connect();
		$select = mysqli_query($this->conn, "SELECT * FROM business_objectives WHERE company_id = $fk");
		echo "[";
		$z=0;
		While($r = mysqli_fetch_object($select)){
			if($z==1){
				echo ",";
			}
			echo '{"name":"'.$r->name.'"}';
			$z=1;
		}
		echo "]";
	}
	
	
	public function preupdatear(){
		$this->connect();
		$query = "SELECT id, name FROM business_objectives WHERE id = $_GET[id]";
		$result = mysqli_query($this->conn, $query);
		if ($row = mysqli_fetch_object($result)){
			$this->id = $row->id;
			$this->name = $row->name;
		} 
	}
	public function editar(){
		$this->connect();
		$query = "UPDATE business_objectives set name = '".$this->name."' WHERE id = $this->id";
		$result = mysqli_query($this->conn, $query);
		if($result){
			$this->helpme = 1;
		}
		else{
			$this->helpme = 0;
		}
	}
	public function borrar(){
		$this->connect();

		$prev = "Delete from alignment_objectives_excellence where business_objectives_id =" .$_REQUEST['id'];
		$post = mysqli_query($this->conn, $prev);

		$del = "Delete from business_objectives where id=".$_REQUEST['id'];
		$delete = mysqli_query($this->conn, $del);
	}
}


class it_excellence{
	public $conn;
	public $id;
	public $fkid;
	public $res;
	public $manage_service_quality;
	public $realize_scale_economies;
	public $optimize_it_internal_processes;
	public $standardize_platforms_and_architecture;
	public $deliver_on_schedule;
	public $effectively_support_end_users;
	public $improve_business_productivity;
	public $propose_enabling_solutions;
	public $understand_emerging_technologies;
	public $understand_business_units_strengths;
	
	public $a = array();
	public function connect(){
		$this->conn = mysqli_connect("localhost","root","","project");
	}
		public function arreglo(){
		
		array ( $arr[1] = 'manage_service_quality',
				$arr[2] = 'realize_scale_economies',
				$arr[3] = 'optimize_it_internal_processes',
				$arr[4] = 'standardize_platforms_and_architecture',
				$arr[5] = 'deliver_on_schedule',
				$arr[6] = 'effectively_support_end_users',
				$arr[7] = 'improve_business_productivity',
				$arr[8] = 'propose_enabling_solutions',
				$arr[9] = 'understand_emerging_technologies',
				$arr[10] = 'understand_business_units_strengths'
		);
	}
	
	public function arreglo2(){
		
		array(  $arre[1] = 'Manage Service Quality',
				$arre[2] = 'Realize Scale Economies',
				$arre[3] = 'Optimize It Internal Processes',
				$arre[4] = 'Standardize Platforms and Architecture',
				$arre[5] = 'Deliver on Schedule',
				$arre[6] = 'Effectively Support end Users',
				$arre[7] = 'Improve Business Productivity',
				$arre[8] = 'Propose Enabling Solutions',
				$arre[9] = 'Understand Emerging Technologies',
				$arre[10] = 'Understand Business Units Strengths'
				
		);
		
	}
	public function check(){
		$this->connect();
		$this->id = $_GET['id'];

		$was = "SELECT company_id FROM it_assets WHERE id = $this->id";
		$wes = mysqli_query($this->conn, $was);
		$cid = mysqli_fetch_array($wes);
		
		$fast = "SELECT name from it_assets WHERE id = $this->id";
		$quer = mysqli_query($this->conn, $fast);
		if ($col = mysqli_fetch_array($quer)){
			echo $col[0];
		}

		echo "";
		echo "<table border=1>";
		echo "<tr>";
		echo "<th>Operational Excellence</th><th>Check</th>";
		echo "</tr>";
		
		$que = "SELECT *
		FROM alignment_assets_excellence, it_assets 
		WHERE alignment_assets_excellence.it_assets_id = it_assets.id and it_assets.id = $this->id
		and it_assets.company_id = $cid[0]";
		$khe = mysqli_query($this->conn, $que);
		$z = 1;
		
		while($fila = mysqli_fetch_object($khe)){
			$z = 0;
			$i = 1;
			
			while(isset($arr[$i])){
				
				if($fila->operational_excellence_dimensions_id == $i){
						$this->$arr[$i] = "X";
				}
			$i++;
			}
		}

		if($z == 0){		
		
			echo "<form method ='post' action='procesit.php?id=".$this->id."'>";
			
			$i = 1;
		
			while(isset($arr[$i])) {

			if ($this->$arr[$i] == "X"){
				echo "<tr><td>".$arre[$i]."</td><td><input type='checkbox' name='ed".$i."' checked></td></tr>";				
			}
			else{
				echo "<tr><td>".$arre[$i]."</td><td><input type='checkbox' name='ed".$i."'></td></tr>";				
			}
			$i++;
			}
			echo "<input type='hidden' name='fkid' >";
			echo "</tr>";
			echo "</table>";
			echo "<br><input type='submit' value='Submit'></br>";
			} 
		
		if ($z == 1) {
			$i=1;
			echo "<form method ='post' action='procesit.php?id=".$this->id."'>";
			
			while(isset($arre[$i])){
				echo "<tr><td>".$arre[$i]."</td><td><input type='checkbox' name='ed".$i."'></td></tr>";
			}
			echo "</tr>";
			echo "</table>";
			echo "<br><input type='submit' value='Submit'></br>";
		}
}

	public function mod(){
		$this->connect();
		$this->fkid = $_REQUEST['fkid'];
		
		$sql = "Delete from alignment_assets_excellence where it_assets = $this->id";
		$delete = mysqli_query($this->conn,$sql);
	$i = 1;
		
	while(isset($arr[$i])){
			if( $this->$arr[$i] == "X"){ 					
		$sql = "insert into alignment_assets_excellence	values($i, $this->id)";
		$insert=mysqli_query($this->conn, $sql);
		}
		$i++;
	}}

	//-------------------------------------------------------------------------------------------------------
	public function the_great_table($fk){
		$this->connect();
		
		$que = "SELECT name, id
		FROM it_assets WHERE company_id = $fk";
		$khe = mysqli_query($this->conn, $que);
		$f=0;
		echo "[";
		while($row = mysqli_fetch_object($khe)){
			$i=1;
			while(isset($arr[$i])){
				$this->$arr[$i] = " ";
				$i++;
			}
				
			$query = "SELECT * from alignment_assets_excellence 
			WHERE it_assets = ".$row->id;
			$do = mysqli_query($this->conn, $query);
			while ($fila = mysqli_fetch_object($do)){
				$i=1;
				while(isset($arr[$i])){
				if($fila->operational_excellence_dimensions_id == $i){
					$this->$arr[$i] = "X";
				}
				$i++;
				}				
			}
			
			if($f!=0){ 
				echo ", ";
			}
				echo '{"idit":"'.$row->id.'",'.
						'"name":"'.$row->name.'",';
						
			while(isset($arr[$i])){				
				echo '"'.$arr[$i].'":"'.$this->$arr[$i].'",';
				$i++;
			}
			$f=1;
		}
			echo "]";

	}
	
	public function getallgran($fk){
		$this->connect();
		$sql = "SELECT * FROM alignment_assets_excellence,it_assets WHERE it_assets_id = id and company_id = $fk";
		$select = mysqli_query($this->conn, $sql);
		While ($r = mysqli_fetch_assoc($select)){
			$rows[] = $r;
		}
		print json_encode($rows);
	}
	
	public function menu($fk) {
		$this->connect();
		$sql = "SELECT * FROM alignment_assets_excellence WHERE it_assets_id = $fk";
		$this->res = mysqli_query($this->conn, $sql);
			
	}}
	
	
	//--------------------------------------------------------------------------------------------------------------





class bu_excellence{
	public $conn;
	public $id;
	public $fkid;
	public $res;
	public $manage_service_quality;
	public $realize_scale_economies;
	public $optimize_it_internal_processes;
	public $standardize_platforms_and_architecture;
	public $deliver_on_schedule;
	public $effectively_support_end_users;
	public $improve_business_productivity;
	public $propose_enabling_solutions;
	public $understand_emerging_technologies;
	public $understand_business_units_strengths;
	
	public $a = array();
	
	public function arreglo(){
		
		array ( $arr[1] = 'manage_service_quality',
				$arr[2] = 'realize_scale_economies',
				$arr[3] = 'optimize_it_internal_processes',
				$arr[4] = 'standardize_platforms_and_architecture',
				$arr[5] = 'deliver_on_schedule',
				$arr[6] = 'effectively_support_end_users',
				$arr[7] = 'improve_business_productivity',
				$arr[8] = 'propose_enabling_solutions',
				$arr[9] = 'understand_emerging_technologies',
				$arr[10] = 'understand_business_units_strengths'
		);
	}
	
	public function arreglo2(){
		
		array(  $arre[1] = 'Manage Service Quality',
				$arre[2] = 'Realize Scale Economies',
				$arre[3] = 'Optimize It Internal Processes',
				$arre[4] = 'Standardize Platforms and Architecture',
				$arre[5] = 'Deliver on Schedule',
				$arre[6] = 'Effectively Support end Users',
				$arre[7] = 'Improve Business Productivity',
				$arre[8] = 'Propose Enabling Solutions',
				$arre[9] = 'Understand Emerging Technologies',
				$arre[10] = 'Understand Business Units Strengths'
				
		);
		
	}
	
	public function connect(){
		$this->conn = mysqli_connect("localhost","root","","project");
	}
	public function check(){
		$this->connect();
		$this->id = $_GET['id'];

		$was = "SELECT company_id FROM business_objectives WHERE id = $this->id";
		$wes = mysqli_query($this->conn, $was);
		$cid = mysqli_fetch_array($wes);
		
		$fast = "SELECT name from business_objectives WHERE id = $this->id";
		$quer = mysqli_query($this->conn, $fast);
		if ($col = mysqli_fetch_array($quer)){
			echo $col[0];
		}

		echo "";
		echo "<table border=1>";
		echo "<tr>";
		echo "<th>Operational Excellence</th><th>Check</th>";
		echo "</tr>";
		
		$que = "SELECT *
		FROM alignment_objectives_excellence, business_objectives 
		WHERE alignment_objectives_excellence.business_objectives_id = business_objectives.id and business_objectives.id = $this->id
		and business_objectives.company_id = $cid[0]";
		$khe = mysqli_query($this->conn, $que);
		$z = 1;
		
		while($fila = mysqli_fetch_object($khe)){
			$z = 0;
			$i = 1;
			
			while(isset($arr[$i])){
				
				if($fila->operational_excellence_dimensions_id == $i){
						$this->$arr[$i] = "X";
				}
			$i++;
			}
		}

		if($z == 0){		
		
			echo "<form method ='post' action='procesbu.php?id=".$this->id."'>";
			
			$i = 1;
		
			while(isset($arr[$i])) {

			if ($this->$arr[$i] == "X"){
				echo "<tr><td>".$arre[$i]."</td><td><input type='checkbox' name='ed".$i."' checked></td></tr>";				
			}
			else{
				echo "<tr><td>".$arre[$i]."</td><td><input type='checkbox' name='ed".$i."'></td></tr>";				
			}
			$i++;
			}
			echo "<input type='hidden' name='fkid' >";
			echo "</tr>";
			echo "</table>";
			echo "<br><input type='submit' value='Submit'></br>";
			} 
		
		if ($z == 1) {
			$i=1;
			echo "<form method ='post' action='procesbu.php?id=".$this->id."'>";
			
			while(isset($arre[$i])){
				echo "<tr><td>".$arre[$i]."</td><td><input type='checkbox' name='ed".$i."'></td></tr>";
			}
			echo "</tr>";
			echo "</table>";
			echo "<br><input type='submit' value='Submit'></br>";
		}
}

	public function mod(){
		$this->connect();
		$this->fkid = $_REQUEST['fkid'];
		
		$sql = "Delete from alignment_objectives_excellence where business_objectives_id = $this->id";
		$delete = mysqli_query($this->conn,$sql);
	$i = 1;
		
	while(isset($arr[$i])){
			if( $this->$arr[$i] == "X"){ 					
		$sql = "insert into alignment_objectives_excellence	values($i, $this->id)";
		$insert=mysqli_query($this->conn, $sql);
		}
		$i++;
	}}

	//-------------------------------------------------------------------------------------------------------
	public function the_great_table($fk){
		$this->connect();
		
		$que = "SELECT name, id
		FROM business_objectives WHERE company_id = $fk";
		$khe = mysqli_query($this->conn, $que);
		$f=0;
		echo "[";
		while($row = mysqli_fetch_object($khe)){
			$i=1;
			while(isset($arr[$i])){
				$this->$arr[$i] = " ";
				$i++;
			}
				
			$query = "SELECT * from alignment_objectives_excellence 
			WHERE business_objectives_id = ".$row->id;
			$do = mysqli_query($this->conn, $query);
			while ($fila = mysqli_fetch_object($do)){
				$i=1;
				while(isset($arr[$i])){
				if($fila->operational_excellence_dimensions_id == $i){
					$this->$arr[$i] = "X";
				}
				$i++;
				}				
			}
			
			if($f!=0){ 
				echo ", ";
			}
				echo '{"idob":"'.$row->id.'",'.
						'"name":"'.$row->name.'",';
						
			while(isset($arr[$i])){				
				echo '"'.$arr[$i].'":"'.$this->$arr[$i].'",';
				$i++;
			}
			$f=1;
		}
			echo "]";

	}
	
	public function getallgran($fk){
		$this->connect();
		$sql = "SELECT * FROM alignment_objectives_excellence,business_objectives WHERE business_objectives_id = id and company_id = $fk";
		$select = mysqli_query($this->conn, $sql);
		While ($r = mysqli_fetch_assoc($select)){
			$rows[] = $r;
		}
		print json_encode($rows);
	}
	
	public function menu($fk) {
		$this->connect();
		$sql = "SELECT * FROM alignment_objectives_excellence WHERE business_objectives_id = $fk";
		$this->res = mysqli_query($this->conn, $sql);
			
	}
	
	
	//--------------------------------------------------------------------------------------------------------------




}
?>