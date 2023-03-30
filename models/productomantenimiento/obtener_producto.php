<?php
require('../conexion.php');

$sql='SELECT * FROM tbproducto WHERE id='.strval($id);

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $datos_producto=$result -> fetch_all(MYSQLI_ASSOC);

} else {
    $datos_producto=null;
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
