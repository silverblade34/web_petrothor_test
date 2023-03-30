<?php
require('../conexion.php');

$sql='SELECT * FROM tbcliente WHERE id='.strval($id);

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $datos_cliente=$result -> fetch_all(MYSQLI_ASSOC);

} else {
    $datos_cliente=null;
}

$sql1='SELECT codigo,descripcion FROM tblistaprecio WHERE status=1';
$resulta = $conn->query($sql1);

if ($resulta->num_rows > 0) {

    $datos_lp=$resulta -> fetch_all(MYSQLI_ASSOC);

} else {
    $datos_lp=null;
}
$conn->close();
?>
