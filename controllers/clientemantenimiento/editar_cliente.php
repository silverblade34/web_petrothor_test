<?php 

//ENTRADAS:
$codigo=$_POST["codigo"];

$rs=$_POST["rs"];
$correo=$_POST["correo"];

$id=$_POST["id"];
$checkes=$_POST['checkes'];

/////////MODELS:
require('../../models/clientemantenimiento/editar_cliente.php');


//SALIDA
$res=$resultado;


print $res;

?>


