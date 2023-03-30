<?php

//--ENTRADA
$fecha=$_POST['fecha'];

//--MODELS
require('../../models/proveedorprecio/no_repeat_fecha.php');


//SALIDA

print json_encode($validar,true);


?>