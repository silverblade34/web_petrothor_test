<?php
//ENTRADAS
$status="1";
$proveedor=$_POST['proveedor'];
$codigoProducto=$_POST['codigoProducto'];
$todosPrecios=$_POST['todosPrecios'];
$fecha=$_POST['fecha'];
//MODELS
require('../../models/proveedorprecio/crear_proveedorprecio.php');

//SALIDA

print json_encode($resultado,true);



?>