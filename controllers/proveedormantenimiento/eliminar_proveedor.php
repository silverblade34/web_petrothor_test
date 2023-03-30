<?php 

//ENTRADAS:
$id=$_POST["id"];

/////////MODELS:
require('../../models/proveedormantenimiento/eliminar_proveedor.php');

print json_encode($resultado,true);

?>
