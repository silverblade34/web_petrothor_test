<?php
//ENTRADAS
$idproveedor=$_POST['idproveedor'];

//MODELS
require('../../models/proveedorprecio/traer_tabla_externa.php');

//SALIDA

$salida=[$datos_producto,$datos_proveedor];


print json_encode($salida,true);



?>