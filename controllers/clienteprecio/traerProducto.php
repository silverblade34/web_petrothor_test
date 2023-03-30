<?php
//ENTRADAS
$status=1;

//MODELS
require('../../models/clienteprecio/traerProducto.php');

//SALIDA

print json_encode($res_producto,true);


?>