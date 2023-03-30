<?php
require('../conexion.php');

$sql = 'SELECT * FROM tbproveedor WHERE status=1';

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $datos_proveedor = $result->fetch_all(MYSQLI_ASSOC);
}else{
    $datos_proveedor = null;
}
$conn->close();

?>