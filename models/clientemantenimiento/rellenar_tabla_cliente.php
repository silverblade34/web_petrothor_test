<?php
require('../conexion.php');

$sql = 'SELECT * FROM tbcliente WHERE status=1 ORDER BY codigo ASC';

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $datos_cliente= $result->fetch_all(MYSQLI_ASSOC);
}else{
    $datos_cliente = null;
}
$conn->close();

?>