<?php
//entradas
$cliente=$_POST['cliente'];
$status=1;
//MOLDES
require('../../models/pdf/traer_tabla_para_pdf.php');

//SALIDA
$resultado=[$resultado_final,$res_listaprecio];

print json_encode($resultado,true);


?>