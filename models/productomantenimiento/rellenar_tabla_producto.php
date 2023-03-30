<?php
require('../conexion.php');

$sql = 'SELECT * FROM tbproducto WHERE status=1';

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $datos_producto = $result->fetch_all(MYSQLI_ASSOC);
}else{
    $datos_producto = null;
}
$conn->close();

?>