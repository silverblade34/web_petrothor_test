<?php 
require('../conexion.php');

$sql = "UPDATE tbproveedor SET 
            ruc = '".$ruc."',
            razonsocial = '".$rs."'
        WHERE id=".strval($id)."";
if ($conn->query($sql) === TRUE) {
    $conn->close();
    $resultado=1;
} else {
    $conn->close();
    $resultado=0;
}

?>  