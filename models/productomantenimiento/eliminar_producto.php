<?php 
require('../conexion.php');

// sql to delete a record
$sql = 'UPDATE tbproducto SET status=0 WHERE id='.$id;

if ($conn->query($sql) === TRUE) {
    $conn->close();
    $resultado=true;
} else {
    $conn->close();
    $resultado=false;
}

?>