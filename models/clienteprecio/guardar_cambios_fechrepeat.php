<?php
require('../conexion.php');

$sqldelete='DELETE FROM tbpreciocliente WHERE fecha="'.$fecha.'" AND lp="'.$codigolistaprecio.'"';
$resultdelete = $conn->query($sqldelete);
 for ($i=0; $i < count($check) ; $i++) { 
    //  print_r($check[$i]);
     for ($j=0; $j < count($precio[$i]) ; $j++) { 
        //  print_r($precio[$i][$j]);
        //  print_r($productos[$j]);
        $sql= 'INSERT INTO tbpreciocliente(lp,fecha,codcliente,producto,precio) 
        VALUES("'.$codigolistaprecio.'","'.$fecha.'","'.$check[$i].'","'.$productos[$j].'",'.floatval($precio[$i][$j]).')';
        if ($conn->query($sql) === TRUE) {
            $resultado=true;
        } else {
            $resultado=false;
        }
     }
 }
$conn->close();



?>