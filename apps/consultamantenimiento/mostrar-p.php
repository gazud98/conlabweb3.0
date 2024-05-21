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
if (isset($_GET['fecha2'])) {
    $fecha2 = $_GET['fecha2'];
    if ($fecha2 == "-1") {
        $fecha2 = "";
    }
} else {
    $fecha2 = "";
}
if (isset($_GET['estado'])) {
    $estado = $_GET['estado'];
    if ($estado == "-1") {
        $estado = "";
    }
} else {
    $estado = "";
}
if (isset($_GET['sede'])) {
    $sede = $_GET['sede'];
    if ($sede == "-1") {
        $sede = "";
    }
} else {
    $sede = "";
}

if (isset($_GET['activo'])) {
    $activo = $_GET['activo'];
    if ($activo == "-1") {
        $activo = "";
    }
} else {
    $activo = "";
}

if (isset($_GET['year'])) {
    $year = $_GET['year'];
    if ($year == "-1") {
        $year = "";
    }
} else {
    $year = "";
}

// Crea una variable para el filtro SQL
$filtro = " and 1=1"; // Filtro base

if ($fecha1 != '' && $fecha2 != '') {
    $filtro .= " AND p.comienzo BETWEEN '" . date('Y-m-d', strtotime($fecha1)) . "' AND '" . date('Y-m-d', strtotime($fecha2)) . "'";
}
if ($estado != '') {
    $filtro .= " AND p.estado_mantenimiento LIKE '%" . $estado . "%'";
}
if ($sede != '') {
    $filtro .= " AND p.id_sede LIKE '%" . $sede . "%'";
}

if ($activo != '') {
    $filtro .= " AND a.nombre LIKE '%" . $activo . "%'";
}

if ($year != '') {
    $filtro .= " AND p.comienzo LIKE '%" . $year . "%'";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {

    $cadena = "SELECT p.id,p.comienzo,p.desc_mantenimiento,p.responsable,p.estado,p.estado_mantenimiento, p.fecha_final,a.nombre,s.nombre AS sede_mant 
    FROM preventiva p, producto a, sedes s WHERE p.id_sede = s.id_sedes AND a.id_producto = p.equipo" . $filtro;
    //echo $cadena;
    /* */
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $datos[] = array(
            'id' =>  trim($filaP2['id']),
            'nombre' => $filaP2['nombre'],
            'desc_mantenimiento' =>  trim($filaP2['desc_mantenimiento']),
            'responsable' => trim($filaP2['responsable']),
            'comienzo' => trim($filaP2['comienzo']),
            'fecha_final' => trim($filaP2['fecha_final']),
            'estado' => trim($filaP2['estado']),
            'sede' => trim($filaP2['sede_mant']),
            'estado_mantenimiento' => $filaP2['estado_mantenimiento'],
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
