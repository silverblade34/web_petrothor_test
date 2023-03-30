<?php 

//ENTRADAS:
$status="1";
$codigo=$_POST['codigo'];
$descripcion=$_POST['descripcion'];


/////////MODELS:
require('../../models/listapreciomantenimiento/crear_listaprecio.php');

print json_encode($resultado,true);

?>
