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


$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $modeeditstatus = isset($_REQUEST['modeeditstatus']) ? $_REQUEST['modeeditstatus'] : 0;
    $id = isset($_REQUEST['id']) ? trim($_REQUEST['id']) : 0;
    $codcups = isset($_POST['codcups']) ? trim($_POST['codcups']) : 0;
    $nomexamen = isset($_POST['nomexamen']) ? trim($_POST['nomexamen']) : 0;
    $nombrealterno = isset($_POST['nombrealterno']) ? trim($_POST['nombrealterno']) : 0;
    $abreviatura = isset($_POST['abreviatura']) ? trim($_POST['abreviatura']) : 0;
    $referencia = isset($_POST['referencia']) ? trim($_POST['referencia']) : 0;
    $costo = isset($_POST['costo']) ? trim($_POST['costo']) : 0;
    

    if ($modeeditstatus == "D") { //es de desahibilitar/habikitr
        //          si estadio es 1 pasa ra 0 o v iceversa
        $cadena = "select estado from u116753122_cw3completa.examenes where id_examenes='" . $id . "'";
        $resultadP2a = $conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if ($numerfiles2a >= 1) {
            $filaP2a = mysqli_fetch_array($resultadP2a);
            $estado = trim($filaP2a['estado']);
        } else {
            $estado = '1';
        }
        if ($estado == '1') {
            $estado = '0';
        } else {
            $estado = '1';
        }
        $cadena = "update  u116753122_cw3completa.examenes set estado='" . $estado . "' where id_examenes='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    } else if ($modeeditstatus == 'C') {
        $consulta = "SELECT nombre_examen FROM u116753122_cw3completa.examenes WHERE nombre_examen = '$nomexamen'";
        $resultado = mysqli_query($conetar, $consulta);
        if (mysqli_num_rows($resultado) > 0) {
            $respuesta = 1;
            echo $respuesta;
        } else {
            $cadena = "INSERT INTO u116753122_cw3completa.examenes(codigo_cups, nombre_examen, nombre_alterno, abreviatura, referencia, costo, estado)
            values('" . $codcups . "','" . $nomexamen . "','" . $nombrealterno . "','" . $abreviatura . "','" . $referencia . "','" . $costo . "',1)";
            $resultado = mysqli_query($conetar, $cadena);
        }
    } else if ($modeeditstatus == 'E') {
        $cadena = "update u116753122_cw3completa.examenes set
                            codigo_cups='" . $codcups . "',
                            nombre_examen='" . $nomexamen . "',
                            nombre_alterno='" . $nombrealterno . "',
                            abreviatura='" . $abreviatura . "',
                            referencia='" . $referencia . "',
                            costo='" . $costo . "'
                            where id_examenes='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
    } else {
        if ($modeeditstatus == "B") { //acgualzucsion
            $cadena = "DELETE FROM u116753122_cw3completa.examenes where id_examenes='" . $id . "'";
            $resultado = mysqli_query($conetar, $cadena);
        }
    }
}
