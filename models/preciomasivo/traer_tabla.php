<?php
require('../conexion.php');

$sql3='SELECT * FROM tbproducto WHERE status=1 ORDER BY codigo ASC';
$result3 = $conn->query($sql3);
if ($result3->num_rows > 0) {
    $res_producto=$result3 -> fetch_all(MYSQLI_ASSOC);
} else {
    $res_producto=null;
}


$array_cliente_producto=array();
$sql1='SELECT * FROM tbcliente WHERE status=1 ORDER BY codigo ASC';
$result1=$conn->query($sql1);
if ($result1->num_rows>0) {


   foreach ($result1 as $value) {

   
        $sql2 = 'SELECT id, codigo, descripcion, status FROM tbproducto WHERE STATUS = 1 ORDER BY codigo ASC;';
        $result2 = $conn->query($sql2);
        foreach ($result1 as $key) {
            $array_precios_producto=array();

            if ($result2->num_rows > 0) {
                // --
                foreach ($result2 as $row) {
                    // --
                    $array_precios_producto[] = array(
                        'codigo' => $row['codigo'],
                        'producto' => $row['descripcion'],
                        'precio' => '0'
                    );
                }
            }
            $array_cliente_producto[]=array(
                'cliente' => $key['razonsocial'],
            'codigo_cliente' => $key['codigo'],
            'producto' => $array_precios_producto
            );
            
            

        }

    }
    
} else{
    $res_cliente= null;
}


$conn->close();
?>