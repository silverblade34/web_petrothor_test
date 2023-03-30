<?php
//ENTRADAS
$codigolistaprecio=$_POST['codigolistaprecio'];
$fecha = $_POST['fecha'];
$check = $_POST['check'];
$precio = json_decode($_POST['precio']);
$productos = $_POST['productos'];


//MODELS
require('../../models/clienteprecio/guardar_cambios_fechrepeat.php');

//SALIDA
print json_encode($resultado,true);

?>