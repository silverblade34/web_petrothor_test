<?php
//ENTRADA
$id=$_POST['ed_ids'];
$proveedor=$_POST['ed_proveedor'];
$producto=$_POST['ed_idProducto'];
$precio=$_POST['ed_todosPrecios'];
$fecha=$_POST['ed_fecha'];

//MODELS
require('../../models/proveedorprecio/editar_proveedorprecio.php');

//SALIDA

print $resultado;
?>