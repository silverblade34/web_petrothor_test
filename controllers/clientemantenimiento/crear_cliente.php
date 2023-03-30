<?php 

//ENTRADAS:
$status=1;
$codigo=$_POST['codigo'];

$rs=$_POST['rs'];
$correo=$_POST['correo'];

$checkes=$_POST['checkes'];

/////////MODELS:
require('../../models/clientemantenimiento/crear_cliente.php');

print json_encode($resultado,true);

?>
