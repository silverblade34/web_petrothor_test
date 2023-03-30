<?php
require('../conexion.php');

$sql='SELECT * FROM tbprecioproveedor WHERE fecha="'.$fecha.'"';

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