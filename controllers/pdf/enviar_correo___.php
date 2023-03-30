<?php
// -- Libraries
require '../../vendor/autoload.php';
// --

use \Spipu\Html2Pdf\Html2Pdf;
use \PHPMailer\PHPMailer\PHPMailer;


$mail = new PHPMailer(true);

  
$mail = new PHPMailer(true);

try {
    //Server settings

    $mail->isSMTP();                                            //Send using SMTP

    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = false;                                   //Enable SMTP authentication
    $mail->Username   = 'josisoto559@gmail.com';                     //SMTP username
    $mail->Password   = '992200099';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;                                 //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    //Recipients
    $mail->setFrom('josisoto559@gmail.com', 'PETROTHOR');
    $mail->addAddress('abrhm972@gmail.com', 'asdsa');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Lista de precio de los productos';
    $mail->Body    = 'PETROTHOR';
    $mail->AltBody = 'M';
    
    
    // $mail->addStringAttachment($document,'petrothor.pdf', 'base64', 'application/pdf');

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

    ?>