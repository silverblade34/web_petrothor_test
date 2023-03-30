<?php
// -- Libraries
require '../../vendor/autoload.php';
require '../conexion.php';
// --
use \Spipu\Html2Pdf\Html2Pdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$resultado = $_POST['resultado'];

$correo = $_POST['correo'];


//$tabla = $_POST['pdf'];
$html = '';
$html .= '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- Styles -->
        <style type="text/css">
        #c{
            padding:20px 80px 20px 65px;
            width:150%;
        }
        
        table{
            border-collapse:collapse;
            width:85%;
        }
        th,tr,td{
            width:28%;
            height:20px;
            vertical-align:middle;
        }
        th{
            color:#fff;
            background-color: #252525;
        }
        body{
            margin:200px 5px 200px 5px;
        }
    
        tr:nth-child(odd) td{
            background-color:#eee;
        }		
    
        </style>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Precios de productos "PETROTHOR"</title>
        </head>
    ';
$sql = 'SELECT id, lp, fecha, codcliente, producto, precio FROM tbpreciocliente WHERE codcliente = "' . $resultado[0][0][0]['codigo_cliente'] . '" AND lp="001" AND 
    fecha = ( SELECT DISTINCT fecha FROM tbpreciocliente WHERE codcliente = "' . $resultado[0][0][0]['codigo_cliente'] . '" AND lp="001" ORDER BY fecha DESC LIMIT 1,1) LIMIT 7';
// print_r($sql);
$consulta = $conn->query($sql);
if ($consulta->num_rows > 0) {

    $datos = $consulta->fetch_all(MYSQLI_ASSOC);
} else {
    $datos = null;
}
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
setlocale(LC_TIME, "es_PE");
date_default_timezone_set("America/Lima");
$mes = $meses[date('n') - 1];
$date1 = new DateTime(date("Y-m-d"));
$date2 = new DateTime(date_format(date_create($resultado[0][0][0]['fecha'][0]['fecha']), 'Y-m-d'));
$dia = '';
if ($date1 <= $date2) {
    $diff = $date1->diff($date2);
    if ($diff->days == 0) {
        $dia = 'de hoy';
    } elseif ($diff->days == 1) {
        $dia = 'de mañana';
    }
}

$html .= '
        <body>
            <div id="c">
                <div><img src="http://67.205.184.183/petrothor_b/public/images/petrothor1.png" width="200" height="40"></div>
                <div>
                    <p style="margin-left:426px;">Lima, ' . strftime('%d de ' . $mes . ' del %Y') . '</p>
                    <p>Señores:<br/>
                    <a style="color:#000000;font-size:15px">' . $resultado[0][0][0]['cliente'] . '</a><br/>
                    <a style="color:#000000;">Presente.-</a></p>
                    <p style="text-align:justify;">Asunto: Variación de Precios de los combustibles.</p>
                    <p>Por intermedio de la presente les informamos,&nbsp; que el día <b>' . date("d-m-Y") . '</b> 
                    se publicó en la Página web de la<br/> Refinería La Pampilla, &nbsp;la
                    variación &nbsp; de &nbsp; precios de &nbsp; algunos &nbsp; combustibles en &nbsp; el &nbsp; cual incluye el IGV,<br/> determinándose de la siguiente manera, los nuevos precios
                    serán trasladados a &nbsp;su tarifa a partir de los<br/> consumos del día ' . $dia . ' <b>' . date_format(date_create($resultado[0][0][0]['fecha'][0]['fecha']), 'd-m-Y') . '</b> desde las 00:00 hrs.</p>
                    </div><br/>
    ';

$html .= '
                  
                <table class="table table-responsive table-bordered" border="0">
                    <thead>
                        <tr>
                            <td style="border-bottom:1px solid #000;width=35%";><b>ZONA</b></td>
        ';
for ($t = 0; $t < count($resultado[0][0][0]['producto']); $t++) {
    $generarColor = $resultado[0][0][0]['producto'][$t]['precio'] - $datos[$t]['precio'];
    if ($generarColor == 0) {
        $html .= '
                            <td style="border-bottom:1px solid #000;text-align:center;"><b>' . $resultado[0][0][0]['producto'][$t]['codigo'] . '</b></td>
        ';
    } else {
        $html .= '
                            <td style="color:red;border-bottom:1px solid #000;text-align:center;"><b>' . $resultado[0][0][0]['producto'][$t]['codigo'] . '</b></td>
        ';
    }
}

$html .= '      </tr>
                    </thead>
                    <tbody>
                        
    ';
for ($r = 0; $r < count($resultado[1]); $r++) {
    $html .= '<tr>
                    <td style="width=35%;">' . $resultado[1][$r]['descripcion'] . '</td>';



    for ($b = 0; $b < count($resultado[0][0][0]['producto']); $b++) {
        if ($resultado[0][$r][0]['producto'][$b]['precio'] == 0) {
            $html .= '<td style="text-align:center;"></td>
                ';
        } else {
            $html .= '<td style="text-align:center;">' . $resultado[0][$r][0]['producto'][$b]['precio'] . '</td>
                ';
        }
    }
    $html .= '       </tr>
                 
        ';
}


$html .= '       </tbody>
                </table>
                <br/>
                <p style="font-size:15px"><b>NOTA: </b>precios indicando que solo las gasolinas <b>CAMBIAN</b> en todas las ciudades.<br/>';
if ($datos == null) {
} else {
    for ($q = count($datos) - 1; -1 < $q; $q--) {
        $respuesta = $resultado[0][0][0]['producto'][$q]['precio'] - $datos[$q]['precio'];
        if ($datos[$q]['precio'] == 0) {
        } else if ($respuesta == 0) {
        } else {

            if ($respuesta < 0) {
                $killmenos = round($respuesta, 4, PHP_ROUND_HALF_UP);
                $html .= '<b>' . $resultado[0][0][0]['producto'][$q]['producto'] . '.- Baja S/ ' . str_replace('-', '', strval($killmenos)) . ' centavos por galón.</b><br/>';
            } else {
                $html .= '<b>' . $resultado[0][0][0]['producto'][$q]['producto'] . '.- Sube S/ ' . round($respuesta, 4, PHP_ROUND_HALF_UP) . ' centavos por galón.</b><br/>';
            }
        }
    }
}

$html .= '</p><p>Sin otro particular.</p>
             <p>Atentamente,</p><br/>
             <img src="../../public/images/firma-adm-petrothor.png">
            </div>
        </body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </html>
    ';

//print_r($resultado);
//print_r($datos);
// --
$texto = 'Buenos días';
$estado = date("H");


if ($estado < '04' || $estado > '17') {
    $texto = 'Buenas noches';
} elseif ('11' < $estado || $estado > '18') {
    $texto = 'Buenas tardes';
}


$html2pdf = new Html2Pdf('P', 'A4', 'es');
$html2pdf->writeHTML($html);
//$html2pdf->output('Petro.pdf');
$html2pdf->output('petro.pdf');
// --
$document = $html2pdf->Output('Petro.pdf', 'S');

$mail = new PHPMailer(true);

try {
    //Server settings

    $mail->isSMTP();                                            //Send using SMTP

    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'reportes.petrothor@gmail.com';                     //SMTP username
    $mail->Password   = 'fwadjqyeueejklyp';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;                                 //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    //Recipients
    $mail->setFrom('reportes.petrothor@gmail.com', 'PETROTHOR');
    for ($i = 0; $i < count($correo); $i++) {
        $mail->addAddress($correo[$i]);            //Add a recipient

    }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'CAMBIO DE PRECIOS';
    //$mail->AddEmbeddedImage('<img src="../../public/images/petrothor1.png">', 'my-attach', '<img src="../../public/images/petrothor1.png">');
    $mail->Body    = '<div style="color:black;">' . $texto . ',<br><p>Estimados adjunto la carta de precios<br>actualizado que rige a partir del día ' . $dia . '<br>' . date_format(date_create($resultado[0][0][0]['fecha'][0]['fecha']), 'd-m-Y') . '</p>
    <p style="color:MidnightBlue;">Saludos cordiales.</p>
    <div><img src="http://67.205.184.183/petrothor_b/public/images/petrothor1.png" width="175" height="40"></div>
    <p style="font-family: Times;font-size:16px"><b><span style="color:#0f0f30;">Alignet :</span> <span style="color:#1a677f;">Empresas</span></b></p>
    <p><span style="color:blue">Av. Manuel Olguin 335</span>, Ofic. 605, Santiago de Surco<br>
    Lima - Perú</p></div>';
    $mail->addStringAttachment($document, 'petrothor.pdf', 'base64', 'application/pdf');
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
