<?php
require('../conexion.php');
if(!isset($_SESSION)) 
{ 
    session_start();
}

$sql1="SELECT * FROM tboperador WHERE usuario = '$user' AND clave = '$pass'";


$result1 = $conn->query($sql1);
//print_r($result);
if ($result1->num_rows > 0) {
    $res=$result1 -> fetch_all(MYSQLI_ASSOC);
    $respuesta=1;
    $_SESSION['contenido']="existe";
    $conn->close();

} else {
    $respuesta=0;
    $conn->close();
}


?>
