<html>
<head>
    <link type="text/css" rel="stylesheet" href="css.css">

</head>

<body>
<?php
	include 'class.php';
    $a = new usuario();
    $a->sessionstarter();
    $b = new IT_Assets();
    //$b->borrar();
    $id=$_REQUEST['id'];

    echo "Are you sure to delete this?";
    echo "<br>";
    echo "<a href='borrarbu.php?id=$id'>Yes</a>";
    echo"<br>";
    echo "<a href='granBU.php'>No</a>";
    ?>
</body>
</html>