<?php 
 // -- Libraries
require '../../vendor/autoload.php';
use \Spipu\Html2Pdf\Html2Pdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
// --
$codigo_cliente = $_GET['codigo'];
//MODELS
require('../../models/pdf/traer_tabla_para_pdf.php');
$resultado=[$resultado_final,$res_listaprecio];
$html = '';
$html .= '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- Styles -->
        <style type="text/css">
        table{
            border-collapse:collapse;
        }
        th,tr,td{
            border:1px solid #000;
            width:150px;
            height:45px;
            vertical-align:middle;
            text-align:center;
        }
        th{
            color:#fff;
            background-color: #252525;
        }
        tr:nth-child(odd) td{
            background-color:#eee;
        }		
        </style>
        <title>Precios de productos "PETROTHOR"</title>
        </head>
    ';
    $html .= '
        <body>
            <div>
                <h2>Para: '.$resultado[0][0][0]['cliente'].'</h2>
    ';
    for ($r=0; $r < count($resultado[1]); $r++) { 
        $html .= '
                <div>
                    <h4 style="float:left;">'.$resultado[1][$r]['descripcion'].':</h4>
                    <p style="float:right;">'.$resultado[0][$r][0]['fecha'][0]['fecha'].'</p>
                </div>
                <table>
                    <thead>
                        <tr>
        ';
        for ($t=0; $t < count($resultado[0][0][0]['producto']); $t++) { 
            $html .='
                            <td>'.$resultado[0][$r][0]['producto'][$t]['producto'].'</td>
            ';
        }
 
        $html .= '      </tr>
                    </thead>
                    <tbody>
                        <tr>
    ';
        for ($b=0; $b <count($resultado[0][0][0]['producto']) ; $b++) { 
        $html .= '           <td>S/.'.$resultado[0][$r][0]['producto'][$b]['precio'].'</td>
        ';
        }
        $html .='       </tr>
                    </tbody>
                </table>
        ';
    }
    $html .='</div>
        </body>
    </html>
    ';
         
// --
$html2pdf = new Html2Pdf('P', 'A4', 'es');
$html2pdf->writeHTML($html);
ob_end_clean();
$html2pdf->output('Petro.pdf', 'D');
$document = $html2pdf->output('Petro.pdf', 'S');
$mail = new PHPMailer(true);
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
try {
    //Server settings
    $mail->isSMTP();              
                                  //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'josisoto559@gmail.com';                     //SMTP username
    $mail->Password   = '992200099';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    //Recipients
    $mail->setFrom('josisoto559@gmail.com', 'PETROTHOR');
    $mail->addAddress('abrhm972@gmail.com', $resultado[0][0][0]['cliente']);     //Add a recipient
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Lista de precio de los productos';
    $mail->Body    = 'PETROTHOR';
    $mail->AltBody = 'M';
 
 
    $mail->addStringAttachment($document,'petrothor.pdf', 'base64', 'application/pdf');
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


?>