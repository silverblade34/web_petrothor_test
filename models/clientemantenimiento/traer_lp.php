<?php
require('../conexion.php');

$sql='SELECT codigo,descripcion FROM tblistaprecio WHERE status=1';
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $datos_lp=$result -> fetch_all(MYSQLI_ASSOC);

} else {
    $datos_lp=null;
}

$conn->close();
?>


