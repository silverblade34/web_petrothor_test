<?php
//ENTRADDAS



//MODELS
require('../../models/preciomasivo/traer_tabla.php');


//SALIDAS
$resultado=[$array_cliente_producto,$res_producto];
print json_encode($resultado,true);

?>