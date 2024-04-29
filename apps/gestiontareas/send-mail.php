<?php

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

    $fchhora = date('Y-m-d');
    
    if(isset($_REQUEST['user'])){
        $user = $_REQUEST['user'];
    }

    $sql = "SELECT email FROM users WHERE id_users = '$user'";
    $res = $conetar->query($sql);
    $data = mysqli_fetch_array($res);
    $email = $data['email'];

    $cadena = "SELECT t.id_tarea, t.tarea, t.fecha_inicio, t.fecha_fin, t.fecha_creacion, t.prioridad, t.responsable, 
    CONCAT(p.nombre_1, ' ', p.apellido_1) as nombre, t.coments, t.usuario, t.estado, u.username, u.email FROM tareas t, persona p, users u 
    WHERE t.responsable = p.id_persona AND t.usuario = u.id_users AND t.estado in(2) AND fecha_inicio < CURRENT_DATE() 
    AND t.usuario = '$user'";

    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {

        if($filaP2['estado'] == 2){
            $estado = 'Pendiente';
        }

        $txt .= '<tr style="border: 1px solid #0853E0;">
        <td>'.$filaP2['tarea'].'</td>
        <td>'.$filaP2['fecha_fin'].'</td>
        <td>'.$estado.'</td>
        </tr>';
    }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);
//$archive = "files/prueba-mail.txt";

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

    $mail->isHTML(true);
    $mail->Subject = 'Tareas Pendientes';
    $mail->Body = "Nombre: Didier Desarrollo\n";
    $mail->Body .= "Email: contacto@sicodj.com\n\n";
    $mail->Body .= "Mensaje:\nTienes tareas pendientes po realizar:\n";

    $message = '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Tareas pendientes por realizar</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
            }
            .container {
                max-width: 700px;
                margin: 0 auto;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            #contentLogoMail {
                width: 100%;
                text-align: center;
            }
            #theadtaraeas {
                background: #0853E0;
                color:white;
            }
            .table{
                text-align: center;
            }
            .table tr {
                border: 1px solid #0853E0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <p><div id="contentLogoMail"><img src="https://conlabweb3.tierramontemariana.org/apps/gestiontareas/files/logopasteur.png" width="200"></div></p>
            <h4>Tareas pendientes por realizar</h4>
            <div class="row" style="width: 100%;">
                <table class="table" style="width: 100%;">
                    <thead>
                        <tr id="theadtaraeas">
                            <th>Descripción</th>
                            <th>Fecha de Vencimientos</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        '.$txt.'
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>
    ';     

    // Establecer el cuerpo del mensaje
    $mail->msgHTML($message);
    //$mail->addAttachment($archive);

    $mail->send();
    echo "El mensaje ha sido enviado correctamente.";
} catch (Exception $e) {
    echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
}

echo $email;