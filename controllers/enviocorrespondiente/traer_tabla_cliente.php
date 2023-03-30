<?php
//--ENTRADAS


//--MODELS
require('../../models/enviocorrespondiente/traer_tabla_cliente.php');


//--SALIDA
print json_encode($res_cliente,true);


?>