<?php
//ENTRADA

$proveedor = $_POST['proveedor'];
$fecha = $_POST['fecha'];

//MODELS
require('../../models/proveedorprecio/traer_tabla_editar.php');

print json_encode($datos_precioproveedor,true);


?>