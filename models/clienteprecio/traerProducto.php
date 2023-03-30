<?php
require('../conexion.php');



//
$sql1='SELECT * FROM tbproducto WHERE status="'.$status.'" ORDER BY codigo ASC';
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    $res_producto=$result1 -> fetch_all(MYSQLI_ASSOC);
} else {
    $res_producto=null;
}


$conn->close();

?>