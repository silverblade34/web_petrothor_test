<?php
require('../conexion.php');

$sql='SELECT * FROM tbpreciocliente WHERE fecha="'.$fecha.'" AND lp="'.$codigolistaprecio.'"';

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $res_producto=$result -> fetch_all(MYSQLI_ASSOC);
    $validar=true;
} else {
    $res_producto=null;
    $validar=false;
}


$conn->close();

?>