<?php 
require('../conexion.php');

$sql1 = 'SELECT codigo FROM tblistaprecio WHERE codigo = "'.$codigo.'"';
$result1 = $conn->query($sql1);
if ($result1 -> num_rows>0) {

    $sql2 = 'SELECT codigo,status FROM tblistaprecio WHERE codigo="'.$codigo.'" AND status="'.$status.'"';
    $result2= $conn->query($sql2);
    if ($result2 -> num_rows>0) {
        $conn->close();
        $resultado = 2;
    } else {
        $sql = 'UPDATE tblistaprecio SET descripcion="'.$descripcion.'",status="'.$status.'" WHERE codigo="'.$codigo.'"';

        if ($conn->query($sql) === TRUE) {
            $conn->close();
            $resultado=1;
        } else {
            $conn->close();
            $resultado=0;
        }
        
    }
    
} else {

    $sql = 'INSERT INTO tblistaprecio(codigo,descripcion,status) VALUES ("'.$codigo.'","'.$descripcion.'",'.strval($status).')';

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        $resultado=true;
    } else {
        $conn->close();
        $resultado=false;
    }
}



?>