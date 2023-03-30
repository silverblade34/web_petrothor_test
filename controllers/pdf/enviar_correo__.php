<?php
// -- Libraries
require '../../vendor/autoload.php';
// --


// --
$resultado = $_GET['resultado'];

$arrayClientes = explode(",", $resultado);

function generarPdfDínamicos ($rowCliente) {
    echo ' <script>window.open("test.php?codigo='.$rowCliente.'","_blank"); </script>';
}

foreach ($arrayClientes as $rowCliente) {
    generarPdfDínamicos($rowCliente);

}

echo "<script languaje='javascript' type='text/javascript'>window. close();</script>"


?>