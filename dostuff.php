<?php
//session_start();
include 'class.php';
//Lo qe se recive de la pag anterior
$user = $_POST['user'];
$mail = $_POST['mail'];
$pass = $_POST['pass'];
$com1 = $_POST['com1']; //id de compañia qe eligio
$com2 = $_POST['com2']; //nombre de compañia qe agrego
$posi = $_POST['posi'];
$depa = $_POST['depa'];
//$edit = $_POST['edit'];
//$edbu = $_POST['edbu'];
//ocd ftw
$a = new usuario();
$a->connect();

$z = 0;   // comprobar que no existe el email
$con = mysqli_connect("localhost","root","","project");
$cons = mysqli_query($con, "Select email from user");
while($row = mysqli_fetch_object($cons))
{
	if($mail == $row->email){
		$z = 1;
	}
}
if($z == 1 ){
	
	echo ("Mail ya registrado, utilice uno diferente");
	
}
else{
if($pass != "" && $user != "" && $mail != "" && $posi != "" && $depa != ""){
	$a->user = $user;
	$a->mail = $mail;
	$a->pass = $pass;
	$a->posi = $posi;
	$a->depa = $depa;
	$b = new company();
	if ($com1 != ''){
		$a->compid = $com1;
		$b->porsiacaso = 1;
	}
	elseif ($com1 == '' && $com2 != ""){
		//$b = new company();
		$b->name = $com2;
		$b->crearco();
		$a->compid = $b->id;
		$b->porsiacaso = 1;
	}
	if ($b->porsiacaso == 1){
		if (isset($_POST['edit'])){
			$a->edit = 1;
		}
		else{
			$a->edit = 0;
		}
		if (isset($_POST['edbu'])){
			$a->edbu = 1;
		}
		else{
			$a->edbu = 0;
		}
		$a->Create_User($a->compid);
		if ($a->itsalive == 1){
			header("Location:login.php");
			echo ("Se ha creado exitosamente");
		}
		else{
			header("Location:Reg.php");
			echo("Something went wrong");
		}
	}
}
elseif($user == ""){
	echo ("What's your name?");
}
elseif($mail==""){
	echo ("Enter a Mail");
}
elseif ($pass=="")
{
	echo("Chose a Password");
//	echo "PORFAVOR LLENE TODOS LOS CAMPOS OBLIGATORIOS";
}
elseif($com1 == '' && $com2 == ""){
	echo ("In what company works?");
}
elseif($posi==""){
	echo ("Enter a valid Position");
}
elseif($depa == ""){
	echo ("Enter a valid Departament");
}}
?>
 <link type="text/css" rel="stylesheet" href="css.css">
 <br>
<a href = "reg.php">Back to Sign In</a>