<?php
//ENTRADAS



//MODELS
require('../../models/proveedorprecio/traer_producto_para_tabla.php');

//SALIDA
print json_encode($res_producto,true);
?>