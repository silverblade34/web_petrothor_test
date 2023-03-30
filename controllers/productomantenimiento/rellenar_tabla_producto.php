<?php 

//PARAMETROS DE ENTRADA



/////////MODELOS:

//OBTENER TABLA DE INSTALACIONES:
require('../../models/productomantenimiento/rellenar_tabla_producto.php');



//PARAMETROS DE SALIDA
$resultado=$datos_producto;



//MOSTRAR
print json_encode($resultado,true);
?>
