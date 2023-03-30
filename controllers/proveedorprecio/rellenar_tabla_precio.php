<?php 

//PARAMETROS DE ENTRADA



/////////MODELOS:

//OBTENER TABLA DE INSTALACIONES:
require('../../models/proveedorprecio/rellenar_tabla_precio.php');



//PARAMETROS DE SALIDA
$resultado=$groupNewProveedor;



//MOSTRAR
print json_encode($resultado,true);
?>
