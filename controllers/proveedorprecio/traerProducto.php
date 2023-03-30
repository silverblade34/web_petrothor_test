<?php
//ENTRADAS



//MODELS
require('../../models/proveedorprecio/traerProducto.php');

//SALIDA
print json_encode($res_producto,true);
?>