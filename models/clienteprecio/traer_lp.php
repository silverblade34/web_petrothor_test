<?php
require('../conexion.php');

$sql1='SELECT * FROM tblistaprecio WHERE status="'.$status.'" ORDER BY codigo ASC';
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    $res_listaprecio=$result1 -> fetch_all(MYSQLI_ASSOC);
} else {
    $res_listaprecio=null;
}


$conn->close();

?>