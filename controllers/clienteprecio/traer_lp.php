<?php
//ENTRADAS
$status=1;



//MODELS
require('../../models/clienteprecio/traer_lp.php');

//SALIDA

$respuesta = [$res_listaprecio];

print json_encode($respuesta,true);

