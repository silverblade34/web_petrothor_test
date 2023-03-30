<?php
require('../conexion.php');
set_time_limit(0);



// $sqlexterno='SELECT * FROM tblistaprecio WHERE status=1';
// $resultexterno = $conn->query($sqlexterno);
// if ($resultexterno->num_rows > 0) {
//     $res_listaprecio2=$resultexterno -> fetch_all(MYSQLI_ASSOC);
    
// } else {
//     $res_listaprecio2=null;
// }



// for ($k=0; $k < count($res_listaprecio2) ; $k++) { 
//     $sqles='SELECT * FROM tbpreciocliente WHERE fecha="'.$fecha.'" AND lp="'.$res_listaprecio2[$k]['codigo'].'"';

//     $resultes = $conn->query($sqles);

//     if ($resultes->num_rows > 0) {
//         $res_producto=$resultes -> fetch_all(MYSQLI_ASSOC);

//         $sqldelete='DELETE FROM tbpreciocliente WHERE fecha="'.$fecha.'" AND lp="'.$res_listaprecio2[$k]['codigo'].'"';

//         $resultdelete = $conn->query($sqldelete);
        
        
//     } else {
//         $res_producto=null;
        
//     }

// }

$sql1='SELECT * FROM tblistaprecio WHERE status=1 ORDER BY codigo ASC';
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    $res_listaprecio=$result1 -> fetch_all(MYSQLI_ASSOC);
} else {
    $res_listaprecio=null;
}


$resultado_final = array();
for ($i=0; $i < count($res_listaprecio) ; $i++) { 
    
    // -- Una cosa de locos
    $sql4 = 'SELECT * FROM tbcliente WHERE status=1 ORDER BY codigo ASC';
 
    //$sql4 = 'SELECT * FROM tbcliente WHERE codigo="'.$codigo_cliente.'"';
    // --
    $result4 = $conn->query($sql4);
    // --

    $array_lp_clientes=array();
    

    if ($result4->num_rows > 0) {
        // -- 
        $sql4_2 = 'SELECT id, codigo, descripcion, status FROM tbproducto WHERE STATUS = 1 ORDER BY codigo ASC;';
        $result4_2 = $conn->query($sql4_2);
    // -- $res_cliente=$result2 -> fetch_all(MYSQLI_ASSOC);
        foreach ($result4 as $value) {
            // --
            $sql4_1 = 'SELECT id, lp, fecha, codcliente, producto, precio FROM tbpreciocliente
            WHERE codcliente = "'.$value['codigo'].'" AND lp="'.$res_listaprecio[$i]['codigo'].'" AND
            fecha = ( SELECT MAX(fecha) FROM tbpreciocliente WHERE codcliente = "'.$value['codigo'].'" AND lp="'.$res_listaprecio[$i]['codigo'].'")';
            // --
            $result4_1 = $conn->query($sql4_1);
            $array_cliente_producto = array();
            $array_precios_producto = array();
            $array_precio_producto_final = array();
                    // --
                if ($result4_2->num_rows > 0) {
                    // --
                    foreach ($result4_2 as $row) {
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
            $array_lp_clientes[]=array(
                'lpClientes'=>$array_cliente_producto
            );
            
        }
        $resultado_final[]=$array_lp_clientes;
    }
    
}

//--bucle para crear filas en la bd
for ($j=0; $j < count($res_listaprecio) ; $j++) { 
    for ($c=0; $c < count($check) ; $c++) { 
        for ($p=0; $p < count($precio[$c]) ; $p++) { 
           //print_r($precio);
           if ($resultado_final[$j][$c]['lpClientes'][0]['producto'][$p]['precio']==0) {
                $suma=0;
                $sql='INSERT INTO tbpreciocliente(lp,fecha,codcliente,producto,precio) 
                VALUES("'.$res_listaprecio[$j]['codigo'].'","'.$fecha.'","'.$check[$c].'","'.$productos[$p].'",'.floatval($suma).')';

                if ($conn->query($sql) === TRUE) {
                    $resultado=true;
                } else {
                    $resultado=false;
                }
                
           }else{
                $suma=$precio[$c][$p]+$resultado_final[$j][$c]['lpClientes'][0]['producto'][$p]['precio'];
                $sql='INSERT INTO tbpreciocliente(lp,fecha,codcliente,producto,precio) 
                VALUES("'.$res_listaprecio[$j]['codigo'].'","'.$fecha.'","'.$check[$c].'","'.$productos[$p].'",'.floatval($suma).')';

                if ($conn->query($sql) === TRUE) {
                    $resultado=true;
                } else {
                    $resultado=false;
                }
            }
        }  
    }
}

$conn->close();

?>