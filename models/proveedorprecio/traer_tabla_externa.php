<?php
require('../conexion.php');

$sql1='SELECT * FROM tbproveedor WHERE (status=1) OR (razonsocial="'.$idproveedor.'")';
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    $datos_proveedor=$result1 -> fetch_all(MYSQLI_ASSOC);
} else {
    $datos_proveedor=null;
}





$sql2='SELECT * FROM tbproducto';

$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    $datos_producto=$result2 -> fetch_all(MYSQLI_ASSOC);
} else {
    $datos_producto=null;
}

$conn->close();

?>