<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'TCPDF-main/tcpdf.php';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

if (file_exists("config/accesosystems.php")) {
    include("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include("../../config/accesosystems.php");
        }
    }
}


$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    ob_start()

?>

    <table>

        <thead>
            <tr>
                <th>ID PRODUCTO</th>
                <th>FECHA</th>
                <th>CANTIDAD</th>
                <th>NOMBRE</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if (isset($_REQUEST['idreq'])) {
                $idr = $_REQUEST['idreq'];
            } else {
                $idr = 0;
            }

            $cadena = "SELECT distinct id_proveedor
            FROM  u116753122_cw3completa.cotizacion_insumos
            where estado_cot='PP' and norequisicion = '$idr'";

            $resultadP2 = $conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);
            if ($numerfiles2 >= 1) {
                while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                    $id_proveedor = $filaP2['id_proveedor'];

                    $cadena23 = "SELECT p.id_proveedor, p.id_producto, p.cantidad, p.fecha, pv.nombre_comercial, 
                        pv.email, a.id, a.id_req, c.nombre as pp FROM u116753122_cw3completa.cotizacion_insumos p 
                        INNER JOIN u116753122_cw3completa.ordrequisicion_detalle a ON p.norequisicion = a.id_req 
                        INNER JOIN u116753122_cw3completa.proveedores pv ON p.id_proveedor = pv.id_proveedores 
                        INNER JOIN u116753122_cw3completa.producto c ON a.id_producto = c.id_producto 
                        WHERE p.id_proveedor = '$id_proveedor' and a.id_producto = p.id_producto and p.norequisicion='$idr';";

                    $resultadP23 = $conetar->query($cadena23);
                    $numerfiles23 = mysqli_num_rows($resultadP23);
                    if ($numerfiles23 >= 1) {
                        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
                            $emailprove = $filaP23['email'];
            ?>
                            <tr>
                                <td><?php echo $filaP23['id_producto']; ?></td>
                                <td><?php echo $filaP23['fecha']; ?></td>
                                <td><?php echo $filaP23['cantidad']; ?></td>
                                <td><?php echo $filaP23['pp']; ?></td>
                                <td><?php echo $numerfiles23; ?></td>
                            </tr>
            <?php

                        }
                    }
                    createFile($pdf, $emailprove, $numerfiles2);
                }
            }
            ?>
        </tbody>
    </table>

<?php
}

    function createFile($pdf, $emailprove, $num2)
    {
        for ($i = 1; $i < $num2; $i++) {
            // Configura el documento
            $pdf->SetCreator('Tu Nombre');
            $pdf->SetAuthor('Tu Nombre');
            $pdf->SetTitle('Mi primer PDF con TCPDF');
            $pdf->SetSubject('Ejemplo de creación de PDF con TCPDF');

            // Agrega una página
            $pdf->AddPage();

            // Establece el contenido del PDF (HTML y/o texto)
            $pdf->writeHTML(ob_get_clean());

            $num = consecutiveNumber();

            $ruta = __DIR__ . '/files/cotizacion-' . $num . '.pdf';

            // Cierra y genera el PDF
            $pdf->Output($ruta, 'F');

            sendMail($num, $emailprove);
        }
    }

    function sendMail($num, $email)
    {

        require 'PHPMailer-master/src/Exception.php';
        require 'PHPMailer-master/src/PHPMailer.php';
        require 'PHPMailer-master/src/SMTP.php';

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
            echo "El mensaje ha sido enviado correctamente.";
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

?>