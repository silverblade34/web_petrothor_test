<?php
//ENTRADAS
$status=1;

$solucion=$_POST['solucion'];

//MODELS
require('../../models/clienteprecio/traer_tablas.php');

//SALIDA

$respuesta = [$res_listaprecio,$res_cliente,$productosArray, $array_cliente_producto];

print json_encode($respuesta,true);


?>