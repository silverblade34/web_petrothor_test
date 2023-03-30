<?php 
require('../conexion.php');

$sql1 = 'SELECT codigo FROM tbproducto WHERE codigo="'.$codigo.'"';
$result1= $conn->query($sql1);
if ($result1 -> num_rows>0) {

    $sql2 = 'SELECT codigo,status FROM tbproducto WHERE codigo="'.$codigo.'" AND status="'.$status.'"';
    $result2= $conn->query($sql2);
    if ($result2 -> num_rows>0) {
        $conn->close();
        $resultado = 2;
    } else {
        $sql = 'UPDATE tbproducto SET descripcion="'.$descripcion.'",codlistaprecio="'.$checkes.'",status="'.$status.'" WHERE codigo="'.$codigo.'"';

        if ($conn->query($sql) === TRUE) {
            $conn->close();
            $resultado=1;
        } else {
            $conn->close();
            $resultado=0;
        }
        
    }
    
} else {

    $sql = 'INSERT INTO tbproducto(codigo,descripcion,codlistaprecio,status) VALUES ("'.$codigo.'","'.$descripcion.'","'.$checkes.'",'.strval($status).')';

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        $resultado=1;
    } else {
        $conn->close();
        $resultado=0;
    }
}


?>