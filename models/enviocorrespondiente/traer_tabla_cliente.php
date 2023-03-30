<?php
require('../conexion.php');

$sql = 'SELECT * FROM tbcliente WHERE status=1 ORDER BY codigo ASC';

$resultado=$conn->query($sql);
if ($resultado->num_rows > 0) {
    $res_cliente=$resultado -> fetch_all(MYSQLI_ASSOC);
}else{
    $res_cliente=null;
}
$conn->close();

?>