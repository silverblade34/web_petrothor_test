<?php 

/////////MODELOS:
$id=$_POST["id"];

//OBTENER TABLA DE INSTALACIONES:
require('../../models/productomantenimiento/obtener_producto.php');
$resultado=[$datos_producto,$datos_lp];
print json_encode($resultado,true);

?>

