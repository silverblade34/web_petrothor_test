<?php 

//ENTRADAS:
$ruc=$_POST["ruc"];
$rs=$_POST["rs"];
$id = $_POST['id'];
/////////MODELS:
require('../../models/proveedormantenimiento/editar_proveedor.php');


//SALIDA
$res=$resultado;


print $res;

?>


