<?php 

/////////MODELOS:
$id=$_POST["id"];

//OBTENER TABLA DE INSTALACIONES:
require('../../models/listapreciomantenimiento/obtener_listaprecio.php');

print json_encode($datos_listaprecio,true);

?>

