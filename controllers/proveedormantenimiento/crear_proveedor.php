<?php 

//ENTRADAS:
$status="1";
$ruc=$_POST['ruc'];
$rs=$_POST['rs'];


/////////MODELS:
require('../../models/proveedormantenimiento/crear_proveedor.php');

print json_encode($resultado,true);

?>
