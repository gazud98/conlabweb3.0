<?php
if (file_exists("config/accesosystems.php")) {
    include ("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include ("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include ("../../config/accesosystems.php");
        }
    }
}
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    if (isset($_REQUEST['id_examen'])) {
        $id_examen = $_REQUEST['id_examen'];
        if ($id_examen == "-1") {
            $id_examen = "";
        }
    } else {
        $id_examen = 0;
    }

    if (isset($_REQUEST['codigo'])) {
        $codigo = $_REQUEST['codigo'];
        if ($codigo == "-1") {
            $codigo = "";
        }
    } else {
        $codigo = 0;
    }

    if (isset($_REQUEST['costo_administrativo'])) {
        $costo_administrativo = $_REQUEST['costo_administrativo'];
        if ($costo_administrativo == "-1") {
            $costo_administrativo = "";
        }
    } else {
        $costo_administrativo = 0;
    }
    if (isset($_REQUEST['tipo'])) {
        $tipo = $_REQUEST['tipo'];
        if ($tipo == "-1") {
            $tipo = "";
        }
    } else {
        $tipo = 0;
    }
    date_default_timezone_set('America/Bogota');
    $fechaActual = date('d-m-Y');
    $fecha = $fechaActual;
    $hora = date("h:i:s");

    $cadena = "insert into u116753122_cw3completa.calculo_costos(id_examen,id_calculo,valord_admin,tipo_calculo,fecha,hora)values('" . $id_examen .
        "','" . $codigo . "','" . $costo_administrativo . "','" . $tipo . "','" . $fechaActual . "','" . $hora . "')";
    $resultado = mysqli_query($conetar, $cadena);
    if ($resultado) {
        $data = array(
            'fecha' => $fechaActual,
            'hora' => $hora
        );
        // Convertir el arreglo en JSON y enviarlo como respuesta
        echo json_encode($data);
    } else {
        echo json_encode(array('error' => 'Error al insertar en la base de datos.'));
    }
}
