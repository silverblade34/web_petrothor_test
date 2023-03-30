<?php 

//ENTRADAS:
$id=$_POST["id"];

/////////MODELS:
require('../../models/proveedorprecio/eliminar_proveedorprecio.php');

print json_encode($resultado,true);

?>
