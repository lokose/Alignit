<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="css.css">
        <title>Login Screen</title>
        <link href="icon.jpg" rel='shortcut icon' type='image/x-icon'/>

    </head>
    <body>
<div style="text-align:center; margin-top: -200px; margin-left:auto; margin-right:auto;">        
    <img src="background1.jpg" alt="" usemap="#Map" />
<map name="Map" id="Map">
</map>
</div>

<!---<div style="position: absolute; top: 300px; margin: 0 auto; text-align:center"  class="formulario">
<form action="pagina2.php" method="post" >
		
Ingrese su nombre de usuario:   <input type="text" name="nombre"><br><br>
Ingrese su clave:   <input type="password" name="clave"><br><br>

<div style="text-align: center">
<input type="submit" name="Enviar">
<br>
<br>
¿Olvidó su clave? <a href="Clave.php">Haga click aquí</a>
</div>          
</form>  
</div>
 -->     
 <form action="pagina2.php" method="post" style="text-align:center">
            
            <table border="0" style="margin: 0 auto; position: absolute; top:200px; left: 37%;" class="formulario">
                <tr>
                    <td>Ingrese su mail:              
                    
                     <input type="text" name="nombre"></td>
                </tr>
                <tr>
                    <td>Ingrese su clave:
                        <input type="password" name="clave"></td>
                </tr>
                <tr><td><input type="submit" name="Enviar"></td></tr>
                <tr><td><a href="Clave.php" class="olvidoclave">¿Olvido su clave? haga click aca.</a></td></tr>
                <tr><td><a href="crear.php">Crear nuevo usuario.</a></td></tr>
            </table>
        
    </body>
</html>



