<?php

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

$id_tipo_identificacion = "";
$documento = "";
$nombres = "";
$apellidos = "";
$fecha_nacimiento = "";
$id_tipo_genero = "";
$dep = "";
$ciudad = "";
$barrio = "";
$tp_via = "";
$numvia = "";
$direccion = "";
$telefono = "";
$movil = "";
$movil2 = "";
$email = "";
$email2 = "";

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $id_tipo_identificacion = trim($_POST['id_tipo_identificacion']);
    $documento = trim($_POST['documento']);
    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $fecha_nacimiento = trim($_POST['fecha_nacimiento']);
    $id_tipo_genero = trim($_POST['id_tipo_genero']);
    $dep = trim($_POST['dep']);
    $ciudad = trim($_POST['ciudad']);
    $barrio = trim($_POST['barrio']);
    $tp_via = trim($_POST['tp_via']);
    $numvia = trim($_POST['numvia']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);
    $movil = trim($_POST['movil']);
    $movil2 = trim($_POST['movil2']);
    $email = trim($_POST['email']);
    $email2 = trim($_POST['email2']);


    $consulta = "SELECT documento FROM pacientes WHERE documento = '$documento'";
    $resultado = mysqli_query($conetar, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        $cadena = "UPDATE pacientes SET
            id_tipo_identificacion = '" . $id_tipo_identificacion . "',
            documento = '" . $documento . "',
            nombre_1 = '" . $nombres . "',
            apellido_1 = '" . $apellidos . "',
            fecha_nacimiento = '" . $fecha_nacimiento . "',
            id_tipo_genero = '" . $id_tipo_genero . "',
            departamento = '" . $dep . "',
            ciudad = '" . $ciudad . "',
            id_tipovia = '" . $tp_via . "',
            n_via = '" . $numvia . "',
            numero_vivienda = '" . $direccion . "',
            telefono = '" . $telefono . "',
            movil = '" . $movil . "',
            movil_2 = '" . $movil2 . "',
            email = '" . $email . "',
            email_2 = '" . $email2 . "',
            barrio = '" . $barrio . "'
        WHERE documento = '" . $documento . "'";
        $resultado = mysqli_query($conetar, $cadena);

        echo $result = 1;
    } else {
        $cadena = "INSERT into pacientes(
                              id_tipo_identificacion,documento, nombre_1, apellido_1, fecha_nacimiento,
                              id_tipo_genero,departamento,ciudad,id_tipovia,n_via,numero_vivienda,
                              telefono,movil,movil_2,email,email_2,barrio
                            )values('" .
            $id_tipo_identificacion . "','" . $documento . "','" .
            $nombres . "','" . $apellidos . "','" . $fecha_nacimiento . "','" . $id_tipo_genero . "','" .
            $dep . "','" . $ciudad . "','" . $tp_via . "','" . $numvia . "','" .
            $direccion . "','" . $telefono . "','" . $movil . "'
                ,'" . $movil2 . "','" . $email . "','" . $email2 . "','" . $barrio . "')";
        echo $cadena;
        $resultado = mysqli_query($conetar, $cadena);
        echo $result = 2;
    }
}//de hay cneion e bbd
