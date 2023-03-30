<?php
require('../conexion.php');

$sql='SELECT * FROM tbprecioproveedor WHERE proveedor="'.$proveedor.'" AND fecha="'.$fecha.'"';

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $datos_precioproveedor=$result -> fetch_all(MYSQLI_ASSOC);

} else {
    $datos_precioproveedor=null;
}

$conn->close();

?>