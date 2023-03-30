<?php 

//ENTRADAS:
$codigo=$_POST["codigo"];
$descripcion=$_POST["descripcion"];
$id = $_POST['id'];
/////////MODELS:
require('../../models/listapreciomantenimiento/editar_listaprecio.php');


//SALIDA
$res=$resultado;


print $res;

?>


