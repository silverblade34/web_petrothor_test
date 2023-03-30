<?php
require('../conexion.php');

$sql1='SELECT * FROM tblistaprecio WHERE status=1 ORDER BY codigo ASC';
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    $listaprecio=$result1 -> fetch_all(MYSQLI_ASSOC);
} else {
    $listaprecio=null;
}

$sql2='SELECT codlistaprecio FROM tbcliente WHERE codigo="'.$cliente.'" ORDER BY codigo ASC';
$result2= $conn->query($sql2);
if ($result2->num_rows > 0) {
    $ordenCliente=$result2 -> fetch_all(MYSQLI_ASSOC);
} else {
    $ordenCliente=null;
}
$res_listaprecio=array();
$clientesArray=array();

    $cambio=$ordenCliente[0]['codlistaprecio'];
    $resultado = str_replace("[", "", $cambio);
    $resultado = str_replace("]", "", $resultado);
    $codPrecioLista=explode(",",$resultado);

for ($i=0; $i < count($listaprecio); $i++) { 
    for ($k=0; $k <count($codPrecioLista); $k++) { 
        if ($listaprecio[$i]['codigo']==$codPrecioLista[$k]) {
            $res_listaprecio[]=$listaprecio[$i];
        }
    }
}

// foreach ($arrayClientes as $itemArrayCliente) {
     $resultado_final = array();
     for ($i=0; $i < count($res_listaprecio) ; $i++) { 
        
         // -- Una cosa de locos
         $sql4 = 'SELECT * FROM tbcliente WHERE codigo="'.$cliente.'" ORDER BY codigo ASC';
     
         //$sql4 = 'SELECT * FROM tbcliente WHERE codigo="'.$codigo_cliente.'"';
         // --
         $result4 = $conn->query($sql4);
         // --
         $array_cliente_producto = array();

         //print('hola');   
        
    
         if ($result4->num_rows > 0) {
             // -- 
             $sql4_2 = 'SELECT id, codigo, descripcion, codlistaprecio, status FROM tbproducto WHERE STATUS = 1 ORDER BY codigo ASC;';
             $result4_2 = $conn->query($sql4_2);
            $array_producto=array();

             foreach($result4_2 as $data){
                $traer=$data['codlistaprecio'];
                $quitar=str_replace("[","",$traer);
                $quitar=str_replace("]","",$quitar);
                $agrupar = explode(",",$quitar);
                foreach($agrupar as $quedar){
                    if ($quedar == $res_listaprecio[$i]['codigo']) {
                        $array_producto[]=array(
                            'codigo'=> $data['codigo'],
                            'producto'=>$data['descripcion'],
                            'codlistaprecio'=>$res_listaprecio[$i]['codigo']
                        );
                        break;
                    }
                }
             }
             //print_r($array_producto);
             

             $array_fecha=array();
             foreach ($result4 as $value) {
                 // --
                 $sql4_1 = 'SELECT id, lp, fecha, codcliente, producto, precio FROM tbpreciocliente
                 WHERE codcliente = "'.$value['codigo'].'" AND lp="'.$res_listaprecio[$i]['codigo'].'" 
                 AND fecha = ( SELECT MAX(fecha) FROM tbpreciocliente WHERE codcliente = "'.$value['codigo'].'" AND lp="'.$res_listaprecio[$i]['codigo'].'")';
                 // --
                 $result4_1 = $conn->query($sql4_1);
                 $array_precios_producto = array();
                 $array_precio_producto_final = array();
                         // --
                     if ($result4_2->num_rows > 0) {
                         // --
                         foreach ($array_producto as $row) {
                             // --
                             $array_precios_producto[] = array(
                                 'codigo' => $row['codigo'],
                                 'producto' => $row['producto'],
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

                    // -- nuevo para agregar con 0 los producto que faltan
                    $producto_en_0=array();
                    if ($result4_2->num_rows > 0) {
                        // --
                        foreach ($result4_2 as $key) {
                            $producto_en_0[]=array(
                                'codigo'=>$key['codigo'],
                                'producto'=>$key['descripcion'],
                                'precio'=>'0'
                            );
                        }
                       
                    } 
                    $devueltaFinal=array();
                    foreach($producto_en_0 as $ruce){
                        foreach($array_precio_producto_final as $minruce){
                            if ($ruce['codigo']==$minruce['codigo']) {
                                $ruce['precio']=$minruce['precio'];
                            }
                        }
                        $devueltaFinal[]=$ruce;
                    }
                    //print_r($devueltaFinal);

                     if ($result4_1->num_rows > 0) {
                         foreach ($result4_1 as $fecha) {
                             // --
                            
                         }
                     }
                     $array_fecha[]=$fecha;
                 // --
                 $array_cliente_producto[] = array(
                     // --
                     'cliente' => $value['razonsocial'],
                     'codigo_cliente' => $value['codigo'],
                     'producto' => $devueltaFinal,
                     'fecha'=>$array_fecha
                 );
                 $resultado_final[]=$array_cliente_producto;
             }
         }
     }
    
    
    // $megaArrayClientes[]=$resultado_final;
// }

$conn->close();

?>


