<?php 

/////////MODELOS:
$id=$_POST["id"];

//OBTENER TABLA DE INSTALACIONES:
require('../../models/proveedormantenimiento/obtener_proveedor.php');

print json_encode($datos_proveedor,true);

?>

