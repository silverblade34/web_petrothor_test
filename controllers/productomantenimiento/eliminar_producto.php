<?php 

//ENTRADAS:
$id=$_POST["id"];

/////////MODELS:
require('../../models/productomantenimiento/eliminar_producto.php');

print json_encode($resultado,true);

?>
