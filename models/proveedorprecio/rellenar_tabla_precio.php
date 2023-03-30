<?php
require('../conexion.php');

// --
function groupArray($array, $groupkey)
{
    if (count($array) > 0) {
        $keys = array_keys($array[0]);
        $removekey = array_search($groupkey, $keys);
        if ($removekey === false)
            return array("Clave \"$groupkey\" no existe");
        else
            unset($keys[$removekey]);
        $groupcriteria = array();
        $return = array();
        foreach ($array as $value) {
            $item = null;
            foreach ($keys as $key) {
                $item[$key] = $value[$key];
            }
            $busca = array_search($value[$groupkey], $groupcriteria);
            if ($busca === false) {
                $groupcriteria[] = $value[$groupkey];
                $return[] = array($groupkey => $value[$groupkey], 'groupeddata' => array());
                $busca = count($return) - 1;
            }
            $return[$busca]['groupeddata'][] = $item;
        }
        return $return;
    } else
        return array();
}
// $sql = 'SELECT tb1.id, tb0.razonsocial as proveedor,tb1.idproducto,tb1.precio,tb1.fecha 

//         FROM tbprecioproveedor tb1
//         LEFT JOIN tbproveedor tb0
//             ON tb0.id=tb1.idproveedor
//         WHERE tb1.status=1
//         GROUP BY tb1.id ORDER BY tb1.fecha DESC;
//         ';

// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//     $datos = $result->fetch_all(MYSQLI_ASSOC);
// }else{
//     $datos = null;
// }
// $conn->close();
$sql = 'SELECT * FROM tbprecioproveedor WHERE status=1 ORDER BY fecha desc';

$result = $conn->query($sql);
// --
$groupNewProveedor = array();
// --
if ($result->num_rows > 0) {
    // -- PRODUCTOS
    $sql1 = 'SELECT id,codigo,descripcion,status FROM tbproducto WHERE status=1;';
    $result1 = $conn->query($sql1);

    // --
    $newArray = array();

    foreach ($result as $value) {
        // --
        $newArray[] = $value;
    }

    $groupProveedor = groupArray($newArray, 'proveedor');
    
    // --
    foreach ($groupProveedor as $item) {
        // --
        $groupFechaProveedor = groupArray($item['groupeddata'], 'fecha');
        $groupNewFechaProveedor = array();
        // --
        foreach ($groupFechaProveedor as $row) {
            // --
            $array_precios_producto = array();
            $array_precio_producto_final = array();
            // --
            if ($result1->num_rows > 0) {
                // -- RECORREMOS LOS PRODUCTOS DE LA TABLA PRODUCTOS
                foreach ($result1 as $product) {
                    // --
                    $array_precios_producto[] = array(
                        'codigo' => $product['codigo'],
                        'producto' => $product['descripcion'],
                        'precio' => '0'
                    );
                }
            }

            // -- RECORREMOS LOS PRODUCTOS POR FECHA DE LA TABLA PRECIOS PROVEEDOR
            foreach ($array_precios_producto as $itemPrecio) {
                // --
                foreach ($row['groupeddata'] as $rowx) {
                    // --
                    if ($itemPrecio['codigo'] == $rowx['producto']) {
                        $itemPrecio['precio'] = $rowx['precio'];
                    }
                }
                // --
                $array_precio_producto_final[] = $itemPrecio;
            }

            // -- SON COSAS QUE PASAN EN EL BARRIO FINO

            $groupNewFechaProveedor[] = array(
                'fecha' => $row['fecha'],
                'productos' => $array_precio_producto_final
            );
        }
        // -- SALIMOS PAL CASERIO
        $groupNewProveedor[] = array(
            'cliente' => $item['proveedor'],
            'fecha' => $groupNewFechaProveedor
        );
    }
   
}



$conn->close();
// -- ALT + SHIFT + A