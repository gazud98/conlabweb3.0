<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


$mail = new PHPMailer(true);

$archive = "/files/cotizacion.pdf";

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contacto@sicodj.com';
    $mail->Password = 'D1d13r1203*#';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    set_time_limit(60);

    $mail->setFrom('contacto@sicodj.com', 'Didier Desarrollo');
    $mail->addAddress('eduardo.gazud@gmail.com');

    $mail->isHTML(false);
    $mail->Subject = 'Prueba de envío de archivo';
    $mail->Body = "Nombre: Didier Desarrollo\n";
    $mail->Body .= "Email: contacto@sicodj.com\n\n";
    $mail->Body .= "Mensaje:\nHola PasteurLab\n";
    $mail->addAttachment($archive);
    
    $mail->send();
    echo "El mensaje ha sido enviado correctamente.";
} catch (Exception $e) {
    echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
}
