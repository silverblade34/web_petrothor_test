<?php 
require('../conexion.php');
for ($i=0; $i < count($codigoProducto); $i++) { 
    
    $sql='INSERT INTO tbprecioproveedor(proveedor,producto,precio,fecha,status)
          VALUES("'.$proveedor.'","'.$codigoProducto[$i].'",'.floatval($todosPrecios[$i]).',"'.$fecha.'",'.strval($status).')';

    if ($conn->query($sql) === TRUE) {
        $resultado=true;
    } else {
        $resultado=false;
    }

}



$conn->close();


?>