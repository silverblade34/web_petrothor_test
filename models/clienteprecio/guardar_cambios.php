<?php
require('../conexion.php');


for ($i=0; $i < count($check) ; $i++) { 
    //print_r($codigolistaprecio);
   // print_r($check[$i]);
    for ($j=0; $j < count($precio[$i]) ; $j++) { 
        //print_r($precio[$i][$j]);
        //print_r($productos[$j]);
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