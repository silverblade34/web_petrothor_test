<?php
require('../conexion.php');

$sql = 'SELECT * FROM tbproducto WHERE status=1 ORDER BY codigo ASC';
$result=$conn->query($sql);
if ($result->num_rows>0) {
    $res_producto=$result->fetch_all(MYSQLI_ASSOC);
}else{
    $res_producto=null;
}

$conn->close();


?>