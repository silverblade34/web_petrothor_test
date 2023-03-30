<?php
require('../conexion.php');



//
$sql1='SELECT * FROM tbproveedor WHERE status=1;';
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    $res_proveedor=$result1 -> fetch_all(MYSQLI_ASSOC);
} else {
    $res_proveedor=null;
}


$conn->close();

?>
