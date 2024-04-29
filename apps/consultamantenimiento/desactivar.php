<?php
$result = "err";
//     presntadio n par todos lod produtos tipo ACTVOS FIJOS

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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $id = $_REQUEST['id'];
    $tip = $_REQUEST['tip'];

    if ($tip == 'C') {
        $cadena = "select estado_mantenimiento from u116753122_cw3completa.correctivo where id='" . $id . "'";
        $resultadP2a = $conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if ($numerfiles2a >= 1) {
            $filaP2a = mysqli_fetch_array($resultadP2a);
            $estado = trim($filaP2a['estado_mantenimiento']);
            if ($estado == 'F') {
                $estado = 'P';
            } else {
                $estado = 'F';
            }
        }

        $cadena = "UPDATE u116753122_cw3completa.correctivo SET estado_mantenimiento='" . $estado . "' WHERE id='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    } else  if ($tip == 'P') {
        $cadena = "select estado_mantenimiento from u116753122_cw3completa.preventiva where id='" . $id . "'";
        $resultadP2a = $conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if ($numerfiles2a >= 1) {
            $filaP2a = mysqli_fetch_array($resultadP2a);
            $estado = trim($filaP2a['estado_mantenimiento']);
            if ($estado == 'F') {
                $estado = 'P';
            } else {
                $estado = 'F';
            }
        }

        $cadena = "UPDATE u116753122_cw3completa.preventiva SET estado_mantenimiento='" . $estado . "' WHERE id='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    }

}//de hay cneion e bbd
