<?php

if (file_exists("config/global_config.php")) {
    include("config/accesosystems.php");
} else {
    if (file_exists("../config/global_config.php")) {
        include("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/global_config.php")) {
            include("../../config/accesosystems.php");
        }
    }
}

if (isset($_GET['fecha1'])) {
    $fecha1 = $_GET['fecha1'];
    if ($fecha1 == "-1") {
        $fecha1 = "";
    }
} else {
    $fecha1 = "";
}

if (isset($_GET['fecha2'])) {
    $fecha2 = $_GET['fecha2'];
    if ($fecha2 == "-1") {
        $fecha2 = "";
    }
} else {
    $fecha2 = "";
}

$fecha_i = date('Y-m-d', strtotime($fecha1));
$fecha_f = date('Y-m-d', strtotime($fecha2));

$filtro = "WHERE 1 ";

if ($fecha1 != '' && $fecha2 != '') {
    $filtro .= "AND ilk.date_expiration BETWEEN '$fecha_i' AND '$fecha_f'";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $cadena = "SELECT ifo.name_examen,ilk.id_info_live_kit, ilk.estado, 
                ilk.date_start,ilk.date_expiration,ilk.id_info_kit,ilk.pruebas_permitidas,idk.id_info_day_kit,idk.start,
                idk.n_pruebas, idk.n_calibradores, idk.n_controles,idk.n_verificaciones,idk.n_diluciones,
                idk.comentario,idk.estado as 'estado_dia' FROM info_live_kit 
                as ilk INNER JOIN info_day_kit as idk 
                ON (ilk.id_info_live_kit = idk.id_info_live_kit) INNER JOIN info_kit 
                as ifo ON (ilk.id_info_kit = ifo.id_info_kit)" . $filtro;


    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    $datos = array();

    while ($filaP2 = mysqli_fetch_array($resultadP2)) {

        $datos[] = array(
            'name_examen' => $filaP2['name_examen'],
            'diaprueba' => $filaP2['start'],
            'n_controles' => $filaP2['n_controles'],
            'n_calibradores' => $filaP2['n_calibradores'],
            'n_verificaciones' => $filaP2['n_verificaciones'],
            'n_diluciones' => $filaP2['n_diluciones'],
            'id_info_kit' => $filaP2['id_info_live_kit'],
            'fecha_apertura' => $filaP2['date_start'],
            'fecha_cierre' => $filaP2['date_expiration'],
            'rendimiento' => ($filaP2['n_pruebas'] * 100) / $filaP2['pruebas_permitidas']
        );
    }


    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
