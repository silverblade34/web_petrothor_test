<?php

//--ENTRADA
$fecha=$_POST['fecha'];
$codigolistaprecio=$_POST['codigolistaprecio'];

//--MODELS
require('../../models/clienteprecio/no_repeat_fecha.php');


//SALIDA

print json_encode($validar,true);


?>