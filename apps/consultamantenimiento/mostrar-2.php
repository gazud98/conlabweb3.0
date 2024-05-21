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

if (isset($_GET['sede'])) {
    $sede = $_GET['sede'];
    if ($sede == "-1") {
        $sede = "";
    }
} else {
    $sede = "";
}

// Crea una variable para el filtro SQL
$filtro = " and 1=1"; // Filtro base

if ($fecha1 != '' && $fecha2 != '') {
    $filtro .= " AND p.fecha_final BETWEEN '" . date('Y-m-d', strtotime($fecha1)) . "' AND '" . date('Y-m-d', strtotime($fecha2)) . "'";
}
if ($estado != '') {
    $filtro .= " AND p.estado_mantenimiento LIKE '%" . $estado . "%'";
}

if ($year != '') {
    $filtro .= " AND p.fecha_final LIKE '%" . $year . "%'";
}

if ($activo != '') {
    $filtro .= " AND a.nombre LIKE '%" . $activo . "%'";
}

if ($sede != '') {
    $filtro .= " AND p.id_sede LIKE '%" . $sede . "%'";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ")" . $conetar->connect_error;
} else {

    $cadena = "(SELECT p.id,p.comienzo,p.danio,p.estado_mantenimiento, p.id_sede, a.nombre, s.nombre AS sede_mant, p.aux 
    FROM correctivo p, producto a, sedes s WHERE a.id_producto = p.equipo
    AND p.id_sede = s.id_sedes ". $filtro .") UNION ALL (SELECT p.id, p.comienzo, p.desc_mantenimiento,p.estado_mantenimiento, 
    p.id_sede, a.nombre, s.nombre AS sede_mant, p.aux FROM preventiva p, producto a, sedes s 
    WHERE a.id_producto = p.equipo AND p.id_sede = s.id_sedes " . $filtro . ") ORDER BY comienzo DESC";
    //echo $cadena;
    /* */
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $datos[] = array(
            'id' =>  trim($filaP2['id']),
            'nombre' =>  trim($filaP2['nombre']),
            'dan' => trim($filaP2['danio']),
            'estado_c' => trim($filaP2['estado_mantenimiento']),
            'fecha_final' => $filaP2['comienzo'],
            'sede' => $filaP2['sede_mant'],
            'aux' => $filaP2['aux'],
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
