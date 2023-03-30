<?php
require('../conexion.php');

$sql1 = 'SELECT codigo FROM tbcliente WHERE codigo="' . $codigo . '"';
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {

    $sql2 = 'SELECT codigo,status FROM tbcliente WHERE codigo="' . $codigo . '" AND status="' . $status . '"';
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        $conn->close();
        $resultado = 2;
    } else {
        //--Actualizar al cliente que ya existe
        $sql = 'UPDATE tbcliente SET razonsocial="' . $rs . '",correo="' . $correo . '",codlistaprecio="' . $checkes . '",status="' . $status . '" 
        WHERE codigo="' . $codigo . '"';

        if ($conn->query($sql) === TRUE) {
            $conn->close();
            $resultado = 1;
        } else {
            $conn->close();
            $resultado = 0;
        }
    }
} else {
    //--Crear el cliente que no existe
    $sql = 'INSERT INTO tbcliente(codigo,razonsocial,correo,codlistaprecio,status)
        VALUES("' . $codigo . '","' . $rs . '","' . $correo . '","' . $checkes . '","' . $status . '")';

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        $resultado = 1;
    } else {
        $conn->close();
        $resultado = 0;
    }
}
