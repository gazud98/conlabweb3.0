<?php
$result = "err";

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

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv . bbserver1);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    include('reglasdenavegacion.php');

    $fchhora = date('m-d-Y h:i:s a', time());

    $modeeditstatus = $_REQUEST['modeeditstatus'];
    $id = $_REQUEST['id'];

    if ($modeeditstatus == "D") {

        $cadena = "select estado from cw3completa.pacientes where id_pacientes='" . $id . "'";
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
        $cadena = "update cw3completa.pacientes set estado='" . $estado . "' where id_pacientes='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    } else {

        $id_tipo_identificacion = trim($_POST['id_tipo_identificacion']);
        $documento = trim($_POST['numero_ide']);
        $nombre_1 = trim($_POST['nombre_1']);
        $nombre_2 = trim($_POST['nombre_2']);
        $apellido_1 = trim($_POST['apellido_1']);
        $apellido_2 = trim($_POST['apellido_2']);
        $id_tipo_genero = trim($_POST['id_tipo_genero']);
        $fecha_nacimiento = trim($_POST['fecha_nacimiento']);
        $direccion = trim($_POST['direccion']);
        $telefono = trim($_POST['telefono']);
        $movil = trim($_POST['movil']);
        $ciudad = trim($_POST['ciudad']);
        $dep = trim($_POST['dep']);
        //$email = trim($_POST['email']);
        //$id_departamentos = trim($_POST['id_departamentos']);
        $tipo_sangre = trim($_POST['tiposangre']);

        if ($modeeditstatus == "C") {

            $cadena = "insert into cw3completa.pacientes(
                id_tipo_identificacion, documento,
                nombre_1, nombre_2, apellido_1, apellido_2,
                id_tipo_genero, fecha_nacimiento, direccion, telefono,
                movil, ciudad,departamento, tipo_sangre, estado
               )values('" .
                $id_tipo_identificacion . "','" . $documento . "','" .
                $nombre_1 . "','" . $nombre_2 . "','" . $apellido_1 . "','" . $apellido_2 . "','" .
                $id_tipo_genero . "','" . $fecha_nacimiento . "','" . $direccion . "','" . $telefono . "','" .
                $movil . "','" . $ciudad . "','" . $dep . "','" . $tipo_sangre . "','1')";
            $resultado = mysqli_query($conetar, $cadena);
        } else {
            if ($modeeditstatus == "E") {
                $cadena = "UPDATE cw3completa.pacientes SET
                                id_tipo_identificacion = '" . $id_tipo_identificacion . "',
                                documento = '" . $documento . "',
                                nombre_1 = '" . $nombre_1 . "',
                                nombre_2 = '" . $nombre_2 . "',
                                apellido_1 = '" . $apellido_1 . "',
                                apellido_2 = '" . $apellido_2 . "',
                                id_tipo_genero = '" . $id_tipo_genero . "',
                                fecha_nacimiento = '" . $fecha_nacimiento . "',
                                direccion = '" . $direccion . "',
                                telefono = '" . $telefono . "',
                                movil = '" . $movil . "',
                                ciudad = '" . $ciudad . "',
                                departamento = '" . $dep . "',
                                tipo_sangre = '" . $tipo_sangre . "'
                            WHERE id_pacientes = '" . $id . "'";
                $resultado = mysqli_query($conetar, $cadena);
            } else {
                if ($modeeditstatus == "B") {
                    $cadena = "DELETE FROM cw3completa.pacientes where id_pacientes='" . $id . "'";
                    $resultado = mysqli_query($conetar, $cadena);
                }
            }
        }
    }
}
