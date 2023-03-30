<?php 

//ENTRADAS:
$codigo=$_POST["codigo"];
$descripcion=$_POST["descripcion"];
$id = $_POST['id'];
$checkes=$_POST['checkes'];
/////////MODELS:
require('../../models/productomantenimiento/editar_producto.php');


//SALIDA
$res=$resultado;


print $res;

?>


