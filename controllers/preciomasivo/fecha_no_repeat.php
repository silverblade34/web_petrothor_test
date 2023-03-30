<?php

//--ENTRADA
$fecha=$_POST['fecha'];


//--MODELS
require('../../models/preciomasivo/fecha_no_repeat.php');


//SALIDA

print json_encode($validar,true);


?>