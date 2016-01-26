<?php
include 'class.php';
$sql = "SELECT id, name FROM company";
$a = new company();
$a->connect();
$result = mysqli_query($a->conn,$sql);

?>

<!DOCTYPE html> 
<html> 
<head>
    <title>Sign In</title> 
    <link type="text/css" rel="stylesheet" href="css.css">
</head> 



<body> 



  	<h1>Sign In</h1> 
<table>
	<tr>
		<td>
			<pre>
				<h2>Personal data</h2><form method ='post' action="dostuff.php">
					User:			<input type="text" name="user">
					E-Mail:		<input type="text" name="mail">
					Password:		<input type="password" name="pass">
			</pre>
			<pre>
		<h2>Select your company</h2>
¿Your company is in the list of options?	<?php
                echo "<select name = 'com1'>";
                echo "<option value=''>My company isn't listed here (Default)</option>";
                while ($rows = mysqli_fetch_array($result)){
                    echo"<option value='".$rows['id']."'>".$rows['name']."</option>";
                    }
                echo "</select>";
                ?>
				
				
If your company is NOT listed, enter it.
		Name of the Company:        	<input type="text" name="com2">
			</pre>
			<pre>
		<h2>Charge</h2>
                Position:				<input type="text" name="posi">
                Departament:			<input type="text" name="depa">
				

	<h2>Faculties</h2>
				<input type="checkbox" name="edit"> Can modify IT Assets?
				
				<input type="checkbox" name="edbu"> Can modify Business Objetives?
		</td>
	</tr>
</table>
			<pre>
<br><input type="submit" value="Sign In"></br> 
        </form>
 <a href = "login.php">Back to Home</a> 
			</pre>
</body>  
</html>