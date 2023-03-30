<?php
require('../conexion.php');

$sql1='SELECT * FROM tblistaprecio WHERE status=1';
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    $res_listaprecio=$result1 -> fetch_all(MYSQLI_ASSOC);
} else {
    $res_listaprecio=null;
}



for ($i=0; $i < count($res_listaprecio) ; $i++) { 
    $sql='SELECT * FROM tbpreciocliente WHERE fecha="'.$fecha.'" AND lp="'.$res_listaprecio[$i]['codigo'].'"';

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $res_producto=$result -> fetch_all(MYSQLI_ASSOC);
        $validar=true;
    } else {
        $res_producto=null;
        $validar=false;
    }
    if ($validar===true) {
        $validar=true;
        break;
        
    }
}



$conn->close();

?>