<?php
// -- Libraries
require '../../vendor/autoload.php';
// --
use \Spipu\Html2Pdf\Html2Pdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$resultado=$_POST['resultado'];
$correo=$_POST['correo'];

$html2='';
$html2 .= '
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
        border:1px solid #000;
        width:28%;
        height:20px;
        vertical-align:middle;
        text-align:center;
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
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$mes=$meses[date('n')-1];
$html2 .= '
    <body>
        <div id="c">
            <div>
                <p style="margin-left:450px;">Lima, '.strftime('%d de '.$mes.' del %Y').'</p>
                <p>Señores:<br/>
                <a style="color:#000000;font-size:15px">'.$resultado[0][0][0]['cliente'].'</a><br/>
                <a style="color:#000000;">Presente.-</a></p>
                <p style="text-align:justify;">Asunto: Variación de Precios de los combustibles.</p>
                <p>Por intermedio de la presente les informamos,&nbsp; que el día <b>'.date_format(date_create($resultado[0][0][0]['fecha'][0]['fecha']),'d-m-Y').'</b> 
                se publicó en la Página web de la<br/> Refinería La Pampilla, &nbsp;la
                variación &nbsp; de &nbsp; precios de &nbsp; algunos &nbsp; combustibles en &nbsp; el &nbsp; cual incluye el IGV,<br/> determinándose de la siguiente manera, los nuevos precios
                serán trasladados a &nbsp;su tarifa a partir de los<br/> consumos del día de hoy <b>'.date("d-m-Y").'</b> desde las 00:00 hrs.</p>
                </div><br/>
';
    $html2 .= '
              
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <td style="width:90px"><b>Lista de precios</b></td>
    ';
    for ($t=0; $t < count($resultado[0][0][0]['producto']); $t++) { 
        $html2 .='
                        <td><b>'.$resultado[0][0][0]['producto'][$t]['codigo'].'</b></td>
        ';
    }

    $html2 .= '      </tr>
                </thead>
                <tbody>
                    
';
for ($r=0; $r < count($resultado[1]); $r++) { 
    $html2 .= '<tr>
                <td>'.$resultado[1][$r]['descripcion'].'</td>';



    for ($b=0; $b <count($resultado[0][0][0]['producto']) ; $b++) { 
    $html2 .= '           <td>S/.'.$resultado[0][$r][0]['producto'][$b]['precio'].'</td>
    ';
    }
    $html2 .='       </tr>
             
    ';
}
$html2 .='       </tbody>
            </table>
        <br/><p>Sin otro particular.</p>
         <p>Atentamente,</p><br/>
         <img src="../../public/images/firma-adm-petrothor.png">
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
';

//--PDF2 un segundo PDF para mostrar al cliente
$html3pdf = new Html2Pdf('P', 'A4', 'es');
$html3pdf->writeHTML($html2);
 //$html2pdf->output('Petro.pdf');
$html3pdf->output('petro2.pdf');
// --
$document2 = $html3pdf->Output('Petro2.pdf', 'S');


$mail = new PHPMailer(true);

try {
    //Server settings

    $mail->isSMTP();                                            //Send using SMTP

    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'reportes.petrothor@gmail.com';                     //SMTP username
    $mail->Password   = 'Sys4Log$$sa';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;                                 //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    //Recipients
    $mail->setFrom('reportes.petrothor@gmail.com', 'PETROTHOR');
    $mail->addAddress('abrhm972@gmail.com', 'Prueba');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Lista de precio de los productos';
    $mail->Body    = 'PETROTHOR';
    $mail->AltBody = 'M';
    
    
    $mail->addStringAttachment($document2,'petrothor2.pdf', 'base64', 'application/pdf');
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



?>