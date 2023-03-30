<?php
//ENTRADA
$id=$_POST['ed_ids'];
$proveedor=$_POST['ed_proveedor'];
$producto=$_POST['ed_idProducto'];
$precio=$_POST['ed_todosPrecios'];

//MODELS
require('../../models/proveedorprecio/editar_sin_cambiarfecha.php');

//SALIDA

print $resulte;
?>