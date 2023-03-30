<?php 
require('../conexion.php');
for ($i=0; $i < count($producto); $i++) { 

    $sql = "UPDATE tbprecioproveedor SET 
            proveedor = '".$proveedor."',
            producto = '".$producto[$i]."',
            precio = '".$precio[$i]."'
        WHERE id=".strval($id[$i])."";


    if ($conn->query($sql) === TRUE) {
    
        $resulte=1;
    } else {
        $resulte=0;
    }

}


$conn->close();

?>  