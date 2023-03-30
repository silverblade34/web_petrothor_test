<?php 

//ENTRADAS:
$id=$_POST["id"];

/////////MODELS:
require('../../models/clientemantenimiento/eliminar_cliente.php');

print json_encode($resultado,true);

?>
