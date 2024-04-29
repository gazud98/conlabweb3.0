<?php



require_once  'TCPDF-main/tcpdf.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
ob_start();
function createFile( $emailprove)
{
   
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
   
    // Configura el documento
    $pdf->SetCreator('Tu Nombre');
    $pdf->SetAuthor('Tu Nombre');
    $pdf->SetTitle('Mi primer PDF con TCPDF');
    $pdf->SetSubject('Ejemplo de creación de PDF con TCPDF');

    // Agrega una página
    $pdf->AddPage();

    // Establece el contenido del PDF (HTML y/o texto)
    $pdfContent = ob_get_clean();
    $pdf->writeHTML($pdfContent);

    $num = consecutiveNumber();

    $ruta = __DIR__ . '/files/cotizacion-' . $num . '.pdf';

    // Cierra y genera el PDF
    $pdf->Output($ruta, 'F');

    sendMail($num, $emailprove);
  
}

function sendMail($num, $email)
{

    require_once 'PHPMailer-master/src/Exception.php';
    require_once 'PHPMailer-master/src/PHPMailer.php';
    require_once 'PHPMailer-master/src/SMTP.php';

    $mail = new PHPMailer(true);

    $archive = __DIR__ . '/files/cotizacion-' . $num . '.pdf';

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
        $mail->addAddress($email);

        $mail->isHTML(false);
        $mail->Subject = 'Prueba de envío de archivo';
        $mail->Body = "Nombre: Didier Desarrollo\n";
        $mail->Body .= "Email: contacto@sicodj.com\n\n";
        $mail->Body .= "Mensaje:\nHola PasteurLab\n";
        $mail->addAttachment($archive);
        $mail->send();
        
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}" . $email;
    }
}

function consecutiveNumber()
{
    $archivo_numeros = __DIR__ . '/files/ultimo_numero.txt';

    if (!file_exists($archivo_numeros)) {
        file_put_contents($archivo_numeros, '1');
    }

    $ultimo_numero = (int)file_get_contents($archivo_numeros);
    $nuevo_numero = $ultimo_numero + 1;

    file_put_contents($archivo_numeros, $nuevo_numero);

    return $nuevo_numero;
}
