<?php 

//ENTRADAS:
$id=$_POST["id"];

/////////MODELS:
require('../../models/listapreciomantenimiento/eliminar_listaprecio.php');

print json_encode($resultado,true);

?>
