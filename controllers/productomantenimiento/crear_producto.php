<?php 

//ENTRADAS:
$status="1";
$codigo=$_POST['codigo'];
$descripcion=$_POST['descripcion'];
$checkes=$_POST['checkes'];

/////////MODELS:
require('../../models/productomantenimiento/crear_producto.php');

print json_encode($resultado,true);

?>
