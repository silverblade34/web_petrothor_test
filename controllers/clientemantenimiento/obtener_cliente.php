<?php 

/////////MODELOS:
$id=$_POST["id"];

//OBTENER TABLA DE INSTALACIONES:
require('../../models/clientemantenimiento/obtener_cliente.php');

$resuelto = [$datos_cliente,$datos_lp];
print json_encode($resuelto,true);

?>

