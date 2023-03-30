<?php 

//PARAMETROS DE ENTRADA



/////////MODELOS:

//OBTENER TABLA DE INSTALACIONES:
require('../../models/proveedormantenimiento/rellenar_tabla_proveedor.php');



//PARAMETROS DE SALIDA
$resultado=$datos_proveedor;



//MOSTRAR
print json_encode($resultado,true);
?>
