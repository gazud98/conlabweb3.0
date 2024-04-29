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

if (isset($_GET['fecha1'])) {
    $fecha1 = $_GET['fecha1'];
    if ($fecha1 == "-1") {
        $fecha1 = "";
    }
} else {
    $fecha1 = "";
}

$filtro = " and 1=1"; 

if ($fecha1 != '' && $fecha2 != '') {
    $filtro .= " AND p.comienzo BETWEEN '" . date('d/m/Y', strtotime($fecha1)) . "' AND '" . date('d/m/Y', strtotime($fecha2)) . "'";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ")" . $conetar->connect_error;
} else {

    $cadena = "SELECT id, CONCAT(fecha,'-',hora) fecha_hora, nombre_contacto, celular_contacto, email_contacto, estado FROM citas";
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $datos[] = array(
            'id' =>  trim($filaP2['id']),
            'fecha_hora' =>  trim($filaP2['fecha_hora']),
            'nombre_contacto' => trim($filaP2['nombre_contacto']),
            'celular_contacto' => trim($filaP2['celular_contacto']),
            'email_contacto' => $filaP2['email_contacto'],
            'estado' => $filaP2['estado'],
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
