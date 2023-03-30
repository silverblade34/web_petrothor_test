<?php
require('../conexion.php');

$sql = 'SELECT * FROM tblistaprecio WHERE status=1';

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $datos_listaprecio = $result->fetch_all(MYSQLI_ASSOC);
}else{
    $datos_listaprecio = null;
}
$conn->close();

?>