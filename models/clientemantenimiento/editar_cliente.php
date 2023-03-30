<?php 
require('../conexion.php');

$sql1 = 'SELECT codigo FROM tbcliente WHERE codigo = "'.$codigo.'" AND id='.strval($id).'';
$result1 = $conn->query($sql1);
if ($result1->num_rows>0) {
    $sql = "UPDATE tbcliente SET 
            codigo = '".$codigo."',
            razonsocial = '".$rs."',
            correo = '".$correo."',
            codlistaprecio='".$checkes."'
        WHERE id=".strval($id)."";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        $resultado=1;
    } else {
        $conn->close();
        $resultado=0;
    }
} else {
    $sql2 = 'SELECT codigo FROM tbcliente WHERE codigo="'.$codigo.'"';
    $result2= $conn->query($sql2);
    if ($result2->num_rows>0) {
        $conn->close();
        $resultado=2;
    } else {
        $sql = "UPDATE tbcliente SET 
            codigo = '".$codigo."',
            razonsocial = '".$rs."',
            correo = '".$correo."',
            codlistaprecio='".$checkes."'
        WHERE id=".strval($id)."";
        if ($conn->query($sql) === TRUE) {
            $conn->close();
            $resultado=1;
        } else {
            $conn->close();
            $resultado=0;
        }
    }
}

?>  