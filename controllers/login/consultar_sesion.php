<?php
//ENTRADAS

$user=$_POST["username"];
$pass=$_POST["pass"];

//MODELS
require('../../models/login/consultar_sesion.php');

//SALIDA

$res = $respuesta;
print $res;


?>