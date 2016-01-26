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
	
	public function connect(){//conectar base de datos
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
		$this->compid)");//		
		
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
    		echo 'Lo sentimos, ud no existe.';
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
        	echo "<h2>Bienvenido, ".$row[1]."</h2>";
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
		echo "<th>Nombre</th><th>Presupuesto</th><th>Headcount</th><th>Update</th><th>Detalle</th><th>Borrar</th>";
		echo "</tr>";

		while($row = mysqli_fetch_assoc($khe)){
			echo "<tr>";
   			echo "<td>".$row['name']."</td><td> ".$row['roundb']."</td><td> ".$row['roundhead']."</td>";
		    echo "<td><a href='modit.php?id=".$row['id']."'>Modificar Dato </a>     </td>";
		    echo "<td><a href='detit.php?id=".$row['id']."'>Detalle </a>     </td>";
		    echo "<td><a href='borrarit0.php?id=".$row['id']."'>Borrar Dato </a>     </td>";
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
		echo "<th>Nombre</th><th>Update</th><th>Detalle</th><th>Borrar</th>";
		echo "</tr>";

		while($row = mysqli_fetch_assoc($khe)){
			echo "<tr>";
   			echo "<td>".$row['name']."</td>";
		    echo "<td><a href='modbu.php?id=".$row['id']."'>Modificar Dato </a>     </td>";
		    echo "<td><a href='detbu.php?id=".$row['id']."'>Detalle </a>     </td>";
		    echo "<td><a href='borrarbu0.php?id=".$row['id']."'>Borrar Dato </a>";

   			echo "</tr>";
		}
		echo "</table>";

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
		if ($delete){
			$this->helpme = 1;
		}
		else{
			$this->helpme = 0;
		}
	}
}


class it_excellence{
	public $conn;
	public $id;
	public $fkid;
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
	public function check(){
		$this->connect();
		$this->id = $_GET['id'];
		//echo $this->id;

		$was = "SELECT company_id FROM it_assets WHERE id = $this->id";
		$wes = mysqli_query($this->conn, $was);
		$cid = mysqli_fetch_array($wes);

		
		//$row = mysqli_fetch_assoc($khe)
		
		$fast = "SELECT name from it_assets WHERE id = $this->id";
		$quer = mysqli_query($this->conn, $fast);
		if ($col = mysqli_fetch_array($quer)){
			echo $col[0];
		}
		//echo .$_REQUEST['id'];}

		echo "";
		echo "<table border=1>";
		echo "<tr>";
		echo "<th>Operational Excellence</th><th>Check</th>";
		echo "</tr>";
		
		
		//$ex3 = mysqli_fetch_assoc($ex2);
		$que = "SELECT *
		FROM alignment_assets_excellence,operational_excellence_dimensions, it_assets 
		WHERE operational_excellence_dimensions.id = operational_excellence_dimensions_id and 
		alignment_assets_excellence.it_assets_id = it_assets.id and it_assets.id = $this->id
		and it_assets.company_id = $cid[0]";
		$khe = mysqli_query($this->conn, $que);
		$z = 1;
		
		while($row = mysqli_fetch_object($khe)){
			$z = 0;
/////////////////que y khe estan dando complicaciones
/*		echo "arr";
		echo "<br>";
		for ($r = 0; $r<count($arr); $r++){
			echo $arr[$r];
		}
		echo "<br>";
		echo "ar2";
		for ($j = 0; $j<count($ar2); $j++){
			echo $ar2[$j];
		}*/
///////////////////////////////////////////////////7

		echo "<form method ='post' action='procesit.php?ord=1&id=".$this->id."'>";

		if ($row->manage_service_quality == "X"){
			echo "<tr><td>Manage Service Quality</td><td><input type='checkbox' name='ed01' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Manage Service Quality</td><td><input type='checkbox' name='ed01'></td></tr>";				
		}

		if ($row->realize_scale_economies == "X"){
			echo "<tr><td>Realize Scale Economies</td><td><input type='checkbox' name='ed02' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Realize Scale Economies</td><td><input type='checkbox' name='ed02'></td></tr>";				
		}
		
		if ($row->optimize_it_internal_processes == "X"){
			echo "<tr><td>Optimize IT Internal Process</td><td><input type='checkbox' name='ed03' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Optimize IT Internal Process</td><td><input type='checkbox' name='ed03'></td></tr>";				
		}
		
		if ($row->standardize_platforms_and_architecture == "X"){
			echo "<tr><td>Standardize Platforms and Architecture</td><td><input type='checkbox' name='ed04' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Standardize Platforms and Architecture</td><td><input type='checkbox' name='ed04'></td></tr>";				
		}
		
		if ($row->deliver_on_schedule == "X"){
			echo "<tr><td>Deliver on Schedule</td><td><input type='checkbox' name='ed05' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Deliver on Schedule</td><td><input type='checkbox' name='ed05'></td></tr>";				
		}
		
		if ($row->effectively_support_end_users == "X"){
			echo "<tr><td>Effectively Support End Users</td><td><input type='checkbox' name='ed06' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Effectively Support End Users</td><td><input type='checkbox' name='ed06'></td></tr>";				
		}
		
		if ($row->improve_business_productivity == "X"){
			echo "<tr><td>Improve Business Productivity</td><td><input type='checkbox' name='ed07' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Improve Business Productivity</td><td><input type='checkbox' name='ed07'></td></tr>";				
		}
		
		if ($row->propose_enabling_solutions == "X"){
			echo "<tr><td>Propose Enabling Solutions</td><td><input type='checkbox' name='ed08' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Propose Enabling Solutions</td><td><input type='checkbox' name='ed08'></td></tr>";				
		}
		
		if ($row->understand_emerging_technologies == "X"){
			echo "<tr><td>Understand Emerging Technologies</td><td><input type='checkbox' name='ed09' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Understand Emerging Technologies</td><td><input type='checkbox' name='ed09'></td></tr>";				
		}
		
		if ($row->understand_business_units_strengths == "X"){
			echo "<tr><td>Understand Business Units Strenghs</td><td><input type='checkbox' name='ed10' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Understand Business Units Strenghs</td><td><input type='checkbox' name='ed10'></td></tr>";				
		}
		echo "<input type='hidden' name='fkid' value='$row->operational_excellence_dimensions_id'>";
		echo "</tr>";
		echo "</table>";
		echo "<br><input type='submit' value='Submit'></br>";
		} 
		
		if ($z == 1) {
			echo "<form method ='post' action='procesit.php?ord=2&id=".$this->id."'>";
			echo "<tr><td>Manage Service Quality</td><td><input type='checkbox' name='ed01'></td></tr>";
			echo "<tr><td>Realize Scale Economies</td><td><input type='checkbox' name='ed02'></td></tr>";
			echo "<tr><td>Optimize IT Internal Process</td><td><input type='checkbox' name='ed03'></td></tr>";
			echo "<tr><td>Standardize Platforms and Architecture</td><td><input type='checkbox' name='ed04'></td></tr>";
			echo "<tr><td>Deliver on Schedule</td><td><input type='checkbox' name='ed05'></td></tr>";
			echo "<tr><td>Effectively Support End Users</td><td><input type='checkbox' name='ed06'></td></tr>";
			echo "<tr><td>Improve Business Productivity</td><td><input type='checkbox' name='ed07'></td></tr>";
			echo "<tr><td>Propose Enabling Solutions</td><td><input type='checkbox' name='ed08'></td></tr>";
			echo "<tr><td>Understand Emerging Technologies</td><td><input type='checkbox' name='ed09'></td></tr>";
			echo "<tr><td>Understand Business Units Strenghs</td><td><input type='checkbox' name='ed10'></td></tr>";
		echo "</tr>";
		echo "</table>";
		echo "<br><input type='submit' value='Submit'></br>";
		}
}
	public function crear(){
		$this->connect();
		$this->id = $_REQUEST['id'];
		
			$sql = "insert into operational_excellence_dimensions
				(manage_service_quality,
				realize_scale_economies,
				optimize_it_internal_processes,
				standardize_platforms_and_architecture,
				deliver_on_schedule,
				effectively_support_end_users,
				improve_business_productivity,
				propose_enabling_solutions,
				understand_emerging_technologies,
				understand_business_units_strengths) 
			values(
				'$this->manage_service_quality',
				'$this->realize_scale_economies',
				'$this->optimize_it_internal_processes',
				'$this->standardize_platforms_and_architecture',
				'$this->deliver_on_schedule',
				'$this->effectively_support_end_users',
				'$this->improve_business_productivity',
				'$this->propose_enabling_solutions',
				'$this->understand_emerging_technologies',
				'$this->understand_business_units_strengths')";
			
			$insert=mysqli_query($this->conn, $sql);
			
			$que = "SELECT id FROM project.operational_excellence_dimensions where id in (SELECT MAX(id) as id FROM project.operational_excellence_dimensions)";
			
			$khe = mysqli_query($this->conn, $que);
			While($row = mysqli_fetch_object($khe)) {
				
				$sqli = "Insert into project.alignment_assets_excellence(it_assets_id , operational_excellence_dimensions_id)
				values('$this->id','$row->id')";
				
				$insert=mysqli_query($this->conn,$sqli);
			}
		
	}

	public function mod(){
		$this->connect();
		$this->fkid = $_REQUEST['fkid'];
		
			$sql = "Update project.operational_excellence_dimensions set 
					manage_service_quality = '$this->manage_service_quality', 
					realize_scale_economies = '$this->realize_scale_economies',
					optimize_it_internal_processes = '$this->optimize_it_internal_processes',
					standardize_platforms_and_architecture = '$this->standardize_platforms_and_architecture',
					deliver_on_schedule = '$this->deliver_on_schedule',
					effectively_support_end_users = '$this->effectively_support_end_users',
					improve_business_productivity = '$this->improve_business_productivity',
					propose_enabling_solutions = '$this->propose_enabling_solutions',
					understand_emerging_technologies = '$this->understand_emerging_technologies',
					understand_business_units_strengths = '$this->understand_business_units_strengths'
					where id = '$this->fkid'";
		
		$update= mysqli_query($this->conn, $sql);

		
	}

	//-------------------------------------------------------------------------------------------------------
	public function the_great_table($fk){
		$this->connect();
	
		echo "";
		echo "<font size=2> <table border='1' class='table table-condensed' style='text-align: center; width: 100%'>";
		echo "<tr bgcolor ='#FFFFFF'>";
		echo "<th></th>
		<th>Manage Service Quality</th>
		<th>Realize Scale Economies</th>
		<th>Optimize IT Internal Process</th>
		<th>Standardize Platforms and Architecture</th>
		<th>Deliver on Schedule</th>
		<th>Effectively Support End Users</th>
		<th>Improve Business Productivity</th>
		<th>Propose Enabling Solutions</th>
		<th>Understand Emerging Technologies</th>
		<th>Understand Business Units Strenghs</th>";
		echo "</tr>";
		
		$que = "SELECT name, id
		FROM it_assets WHERE company_id = $fk";
		$khe = mysqli_query($this->conn, $que);
		$f=0;
		while($row = mysqli_fetch_object($khe)){
			if($f%2 ==0){
				echo "<tr bgcolor =#CBD8F5>";
			}
			else{
				echo "<tr bgcolor ='#FFFFFF'>";
			}
			$f++;	
			echo "<th>".$row->name."</th>";
			$query = "SELECT * from operational_excellence_dimensions,alignment_assets_excellence 
			WHERE operational_excellence_dimensions.id = alignment_assets_excellence.operational_excellence_dimensions_id and
			it_assets_id = ".$row->id;
			$do = mysqli_query($this->conn, $query);
			while ($fila = mysqli_fetch_object($do)){
				echo "<td>".$fila->manage_service_quality."</td>
				<td>".$fila->realize_scale_economies."</td>
				<td>".$fila->optimize_it_internal_processes."</td>
				<td>".$fila->standardize_platforms_and_architecture."</td>
				<td>".$fila->deliver_on_schedule."</td>
				<td>".$fila->effectively_support_end_users."</td>
				<td>".$fila->improve_business_productivity."</td>
				<td>".$fila->propose_enabling_solutions."</td>
				<td>".$fila->understand_emerging_technologies."</td>
				<td>".$fila->understand_business_units_strengths."</td>";
		}}
		echo "</table></font>";

	}
	//--------------------------------------------------------------------------------------------------------------




}

class bu_excellence{
	public $conn;
	public $id;
	public $a = array();
	public function connect(){
		$this->conn = mysqli_connect("localhost","root","","project");
	}
	public function check(){
		$this->connect();
		$this->id = $_GET['id'];
		//echo $this->id;

		$was = "SELECT company_id FROM business_objectives WHERE id = $this->id";
		$wes = mysqli_query($this->conn, $was);
		$cid = mysqli_fetch_array($wes);

		
		//$row = mysqli_fetch_assoc($khe)
		
		$fast = "SELECT name from business_objectives WHERE id = $this->id";
		$quer = mysqli_query($this->conn, $fast);
		if ($col = mysqli_fetch_array($quer)){
			echo $col[0];
		}
		//echo .$_REQUEST['id'];}

		echo "";
		echo "<table border=1>";
		echo "<tr>";
		echo "<th>Operational Excellence</th><th>Check</th>";
		echo "</tr>";

		$que = "SELECT alignment_objectives_excellence.operational_excellence_dimensions_id
		FROM alignment_objectives_excellence, business_objectives 
		WHERE alignment_objectives_excellence.business_objectives_id = business_objectives.id and business_objectives.id = $this->id
		and business_objectives.company_id = $cid[0]
		ORDER BY alignment_objectives_excellence.business_objectives_id";
		$khe = mysqli_query($this->conn, $que);
		$arr = array();
		while($row = mysqli_fetch_assoc($khe)){
			array_push($arr, $row['operational_excellence_dimensions_id']);
		}
		$ex1 = "SELECT id from operational_excellence_dimensions";
		$ex2 = mysqli_query($this->conn, $ex1);
		$ar2 = array();
		while($row = mysqli_fetch_assoc($ex2)){
			array_push($ar2, $row['id']);
		}

		echo "<form method ='post' action='procesbu.php?id=".$this->id."'>";
		

		if (in_array($ar2[0], $arr)){
			echo "<tr><td>Manage</td><td><input type='checkbox' name='ed00' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Manage</td><td><input type='checkbox' name='ed00'></td></tr>";				
		}
		
		if (in_array($ar2[1], $arr)){
			echo "<tr><td>Service Quality</td><td><input type='checkbox' name='ed01' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Service Quality</td><td><input type='checkbox' name='ed01'></td></tr>";				
		}

		if (in_array($ar2[2], $arr)){
			echo "<tr><td>Realize Scale Economies</td><td><input type='checkbox' name='ed02' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Realize Scale Economies</td><td><input type='checkbox' name='ed02'></td></tr>";				
		}
		
		if (in_array($ar2[3], $arr)){
			echo "<tr><td>Optimize IT Internal Process</td><td><input type='checkbox' name='ed03' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Optimize IT Internal Process</td><td><input type='checkbox' name='ed03'></td></tr>";				
		}
		
		if (in_array($ar2[4], $arr)){
			echo "<tr><td>Standardize Platforms and Architecture</td><td><input type='checkbox' name='ed04' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Standardize Platforms and Architecture</td><td><input type='checkbox' name='ed04'></td></tr>";				
		}
		
		if (in_array($ar2[5], $arr)){
			echo "<tr><td>Deliver on Schedule</td><td><input type='checkbox' name='ed05' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Deliver on Schedule</td><td><input type='checkbox' name='ed05'></td></tr>";				
		}
		
		if (in_array($ar2[6], $arr)){
			echo "<tr><td>Effectively Support End Users</td><td><input type='checkbox' name='ed06' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Effectively Support End Users</td><td><input type='checkbox' name='ed06'></td></tr>";				
		}
		
		if (in_array($ar2[7], $arr)){
			echo "<tr><td>Improve Business Productivity</td><td><input type='checkbox' name='ed07' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Improve Business Productivity</td><td><input type='checkbox' name='ed07'></td></tr>";				
		}
		
		if (in_array($ar2[8], $arr)){
			echo "<tr><td>Propose Enabling Solutions</td><td><input type='checkbox' name='ed08' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Propose Enabling Solutions</td><td><input type='checkbox' name='ed08'></td></tr>";				
		}
		
		if (in_array($ar2[9], $arr)){
			echo "<tr><td>Understand Emerging Technologies</td><td><input type='checkbox' name='ed09' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Understand Emerging Technologies</td><td><input type='checkbox' name='ed09'></td></tr>";				
		}
		
		if (in_array($ar2[10], $arr)){
			echo "<tr><td>Understand Business Units Strenghs</td><td><input type='checkbox' name='ed10' checked></td></tr>";				
		}
		else{
			echo "<tr><td>Understand Business Units Strenghs</td><td><input type='checkbox' name='ed10'></td></tr>";				
		}
		echo "<input type='hidden' name='fkid' value='$this->id'>";
		echo "</tr>";
		echo "</table>";
		echo "<br><input type='submit' value='Submit'></br>";
}
	public function mod(){
		$this->connect();
		$this->id = $_GET['id'];
		


		for ($i = 0; $i<11; $i++){
			$q00 = "SELECT operational_excellence_dimensions_id
			FROM alignment_objectives_excellence
			WHERE business_objectives_id = $this->id 
			and operational_excellence_dimensions_id = $i+1";
			$q01 = mysqli_query($this->conn, $q00);
			if ($q01->num_rows !== 0){
				if ($this->a[$i] == 0){
					$w00 = "DELETE from alignment_objectives_excellence
					where business_objectives_id = $this->id
					and operational_excellence_dimensions_id = $i+1";
					$delete1 = mysqli_query($this->conn, $w00);
			
				}
			}
			if ($q01->num_rows === 0){
				if ($this->a[$i] == 1){
					$w01 = "INSERT INTO alignment_objectives_excellence
					(operational_excellence_dimensions_id, business_objectives_id)
					values ($i+1, $this->id)";
					$hola = mysqli_query($this->conn, $w01);
				}
			}
		}
	}

public function the_great_table($fk){
		$this->connect();
	
		echo "";
		echo "<font size=2> <table border='1' class='table table-condensed' style='text-align: center; width: 100%'>";
		echo "<tr bgcolor =#FFFFFF>";
		echo "<th></th>
		<th>Manage Service Quality</th>
		<th>Realize Scale Economies</th>
		<th>Optimize IT Internal Process</th>
		<th>Standardize Platforms and Architecture</th>
		<th>Deliver on Schedule</th>
		<th>Effectively Support End Users</th>
		<th>Improve Business Productivity</th>
		<th>Propose Enabling Solutions</th>
		<th>Understand Emerging Technologies</th>
		<th>Understand Business Units Strenghs</th>";
		echo "</tr>";
		
		$que = "SELECT name, id
		FROM business_objectives WHERE company_id = $fk";
		$khe = mysqli_query($this->conn, $que);
		$f=0;
		while($row = mysqli_fetch_object($khe)){
			if($f%2 ==0){
				echo "<tr bgcolor =#CBD8F5>";
			}
			else{
				echo "<tr bgcolor =#FFFFFF>";
			}
			$f++;	
			echo "<th>".$row->name."</th>";
			$query = "SELECT * from operational_excellence_dimensions,alignment_objectives_excellence 
			WHERE operational_excellence_dimensions.id = alignment_objectives_excellence.operational_excellence_dimensions_id and
			business_objectives_id = ".$row->id;
			$do = mysqli_query($this->conn, $query);
			while ($fila = mysqli_fetch_object($do)){
				echo "<td>".$fila->manage_service_quality."</td>
				<td>".$fila->realize_scale_economies."</td>
				<td>".$fila->optimize_it_internal_processes."</td>
				<td>".$fila->standardize_platforms_and_architecture."</td>
				<td>".$fila->deliver_on_schedule."</td>
				<td>".$fila->effectively_support_end_users."</td>
				<td>".$fila->improve_business_productivity."</td>
				<td>".$fila->propose_enabling_solutions."</td>
				<td>".$fila->understand_emerging_technologies."</td>
				<td>".$fila->understand_business_units_strengths."</td>";
		}}
		echo "</table></font>";

	}


}
?>