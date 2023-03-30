<?php 
require('../conexion.php');

// sql to delete a record
$sql = 'INSERT INTO tbproveedor(ruc,razonsocial,status) VALUES ("'.$ruc.'","'.$rs.'",'.strval($status).')';

if ($conn->query($sql) === TRUE) {
    $conn->close();
    $resultado=true;
} else {
    $conn->close();
    $resultado=false;
}

?>