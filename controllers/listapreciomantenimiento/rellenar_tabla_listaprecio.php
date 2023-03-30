<?php 

//PARAMETROS DE ENTRADA



/////////MODELOS:

//OBTENER TABLA DE INSTALACIONES:
require('../../models/listapreciomantenimiento/rellenar_tabla_listaprecio.php');



//PARAMETROS DE SALIDA
$resultado=$datos_listaprecio;



//MOSTRAR
print json_encode($resultado,true);
?>
