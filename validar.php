 <link type="text/css" rel="stylesheet" href="css.css">
<?php
session_start();
//$dbconn = pg_connect("host=localhost port=5432 dbname=MyBD user=postgres password=123")
  //  or die('<h1>No se ha podido conectar: </h1>' . pg_last_error());
include 'class.php';
$mail = $_POST['mail']; 
$pass = $_POST['pass'];
if($mail != "" && $pass != ""){
    $a = new usuario();
    //$a->connect();
    $a->log_me_in($mail);
    //if ($a ==1){
    if ($a->itsalive = 1){
        /*$sql = "SELECT idmaestro, pseudonimo, pass FROM maestro WHERE mail='$mail'";
        $result = pg_query($sql);
        if($row = pg_fetch_array($result)){*/
            if($a->pass == $pass)
                {
                $_SESSION[id] = $a->id;
                header("Location: menuuser.php");
            }
            else{
                echo 'Invalid Password';
				echo "<br><a href = 'login.php'>Go to Login</a>";
            }
        }
        //else{
          //  echo 'No existes'; Esto esta en la funcion log me in
        }
     //   pg_free_result($result);
    
else{
    echo 'Fill all the fields';
	echo "<br><a href = 'login.php'>Go to Login</a>";
}


//pg_close($dbconn);
?>