<?php 

//PARAMETROS DE ENTRADA



/////////MODELOS:

//OBTENER TABLA DE INSTALACIONES:
require('../../models/clientemantenimiento/rellenar_tabla_cliente.php');



//PARAMETROS DE SALIDA
$resultado=$datos_cliente;



//MOSTRAR
print json_encode($resultado,true);
?>
