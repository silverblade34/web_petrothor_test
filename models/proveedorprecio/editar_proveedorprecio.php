<?php 
require('../conexion.php');

$sql='SELECT * FROM tbprecioproveedor WHERE fecha="'.$fecha.'"';

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $res_producto=$result -> fetch_all(MYSQLI_ASSOC);
    $resultado=2;
} else {
    $res_producto=null;
    for ($i=0; $i < count($producto); $i++) { 

        $sql = "UPDATE tbprecioproveedor SET 
                proveedor = '".$proveedor."',
                producto = '".$producto[$i]."',
                precio = '".$precio[$i]."',
                fecha = '".$fecha."'
            WHERE id=".strval($id[$i])."";


        if ($conn->query($sql) === TRUE) {
        
            $resultado=1;
        } else {
            $resultado=0;
        }

    }
}

$conn->close();

?>  