<?php
//ENTRADAS
$fecha = $_POST['fecha'];
$check = $_POST['check'];
$precio = json_decode($_POST['precio']);
$productos = $_POST['productos'];
// print_r($fecha);
// print_r($check);
// print_r($precio);
// print_r($productos);
//MODELS
require('../../models/preciomasivo/guardar_cambios_fechrepeat.php');

//SALIDA
print json_encode($resultado,true);

?>