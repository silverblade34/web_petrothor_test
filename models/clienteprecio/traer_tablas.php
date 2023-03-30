<?php
require('../conexion.php');

// $sql1='SELECT * FROM tblistaprecio WHERE status="'.$status.'"';
// $result1 = $conn->query($sql1);
// if ($result1->num_rows > 0) {
//     $res_listaprecio=$result1 -> fetch_all(MYSQLI_ASSOC);
// } else {
//     $res_listaprecio=null;
// }
$sql1='SELECT id, lp, fecha, codcliente, producto, precio FROM tbpreciocliente
WHERE lp="'.$solucion.'" AND fecha = ( SELECT MAX(fecha) FROM tbpreciocliente WHERE lp ="'.$solucion.'") LIMIT 1';
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    $res_listaprecio=$result1 -> fetch_all(MYSQLI_ASSOC);
} else {
    $res_listaprecio=null;
}

$sql2='SELECT * FROM tbcliente WHERE status="'.$status.'" ORDER BY codigo ASC';
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    $res_cliente=$result2 -> fetch_all(MYSQLI_ASSOC);
} else {
    $res_cliente=null;
}
//print_r($res_cliente);
$clientesArray=array();
for ($i=0; $i < count($res_cliente); $i++) { 
    $cambio=$res_cliente[$i]['codlistaprecio'];
    $resultado = str_replace("[", "", $cambio);
    $resultado = str_replace("]", "", $resultado);
    $codPrecioLista=explode(",",$resultado);
    //print_r($codPrecioLista);
    for ($j=0; $j < count($codPrecioLista) ; $j++) { 
        if ($codPrecioLista[$j]==$solucion) {
            $clientesArray[]=$res_cliente[$i];
        }
    }
}
//print_r($clientesArray);

$sql3='SELECT * FROM tbproducto WHERE status="'.$status.'" ORDER BY codigo ASC';
$result3 = $conn->query($sql3);
if ($result3->num_rows > 0) {
    $res_producto=$result3 -> fetch_all(MYSQLI_ASSOC);
} else {
    $res_producto=null;
}
$productosArray=array();
for ($i=0; $i < count($res_producto); $i++) { 
    $cambios = $res_producto[$i]['codlistaprecio'];
    $resultados= str_replace("[", "", $cambios);
    $resultados = str_replace("]", "", $resultados);
    $codPreciosLista=explode(",",$resultados);
    for ($j=0; $j < count($codPreciosLista) ; $j++) { 
        if ($codPreciosLista[$j]==$solucion) {
            $productosArray[]=$res_producto[$i];
        }
    }
}
//print_r($productosArray);
// -- Una cosa de locos
$sql4 = 'SELECT * FROM tbcliente WHERE status="'.$status.'"';
// --
$result4 = $conn->query($sql2);
// --
$array_cliente_producto = array();
// --
if ($result4->num_rows > 0) {
    // -- 
    $sql4_2 = 'SELECT id, codigo, descripcion, status FROM tbproducto WHERE STATUS = 1 ORDER BY codigo ASC;';
    $result4_2 = $conn->query($sql4_2);
    
   // -- $res_cliente=$result2 -> fetch_all(MYSQLI_ASSOC);
   foreach ($clientesArray as $value) {
       // --
       $sql4_1 = 'SELECT id, lp, fecha, codcliente, producto, precio FROM tbpreciocliente
       WHERE codcliente = "'.$value['codigo'].'" AND lp ="'.$solucion.'" AND fecha = ( SELECT MAX(fecha) FROM tbpreciocliente WHERE codcliente = "'.$value['codigo'].'" AND lp ="'.$solucion.'") ';
       // --
       $result4_1 = $conn->query($sql4_1);
       $array_precios_producto = array();
       $array_precio_producto_final = array();
            // --
        if ($result4_2->num_rows > 0) {
            // --
            foreach ($productosArray as $row) {
                // --
                $array_precios_producto[] = array(
                    'codigo' => $row['codigo'],
                    'producto' => $row['descripcion'],
                    'precio' => '0'
                );
            }
        } 


        // --
        foreach ($array_precios_producto as $itemPrecio) {
            // -- Ahora si se viene lo chido
            if ($result4_1->num_rows > 0) {
                foreach ($result4_1 as $item) {
                    // --
                    if ($itemPrecio['codigo'] == $item['producto']) {
                        $itemPrecio['precio'] = $item['precio'];  
                    }
                }
            }
            // --
            $array_precio_producto_final[] = $itemPrecio;
        }
       
       // --
       $array_cliente_producto[] = array(
           // --
           'cliente' => $value['razonsocial'],
           'codigo_cliente' => $value['codigo'],
           'producto' => $array_precio_producto_final
       );
   }
}
