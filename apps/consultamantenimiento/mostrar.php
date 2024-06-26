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
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ")" . $conetar->connect_error;
} else {
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

    if (isset($_GET['tipman'])) {
        $tipman = $_GET['tipman'];
        if ($tipman == "-1") {
            $tipman = "";
        }
    } else {
        $tipman = "";
    }


    $filtro = " and 1=1"; // Filtro base

    if ($fecha1 != '' && $fecha2 != '') {
        $filtro .= " AND m.fecha_inicio BETWEEN '" . date('Y-m-d', strtotime($fecha1)) . "' AND '" . date('Y-m-d', strtotime($fecha2)) . "'";
    }
    if ($estado != '') {
        $filtro .= " AND m.estado LIKE '%" . $estado . "%'";
    }
    if ($sede != '') {
        $filtro .= " AND m.id_sede LIKE '%" . $sede . "%'";
    }

    if ($activo != '') {
        $filtro .= " AND m.id_equipo LIKE '%" . $activo . "%'";
    }

    if ($year != '') {
        $filtro .= " AND m.fecha_final LIKE '%" . $year . "%'";
    }

    if ($tipman != '') {
        $filtro .= " AND m.tipo_mantenimiento LIKE '%" . $tipman . "%'";
    }
    $cadena = "SELECT 
    p.nombre,
    s.nombre AS nombre_sede,
    d.nombre AS nombre_departamento,
    a.nombre AS nombre_area,
    m.fecha_inicio, 
    m.fecha_final,
    m.responsable,
    m.descripcion,
    CASE 
        WHEN m.tipo_mantenimiento = 'P' THEN 'Preventivo'
        WHEN m.tipo_mantenimiento = 'C' THEN 'Correctivo'
        ELSE m.tipo_mantenimiento
    END AS tipo_mantenimiento,
   m.estado
FROM 
    mantenimientos m
JOIN 
    producto p ON m.id_equipo = p.id_producto
JOIN 
    sedes s ON m.id_sede = s.id_sedes
JOIN 
    departamentos d ON d.id = m.id_departamento
JOIN 
    area_laboratorio a ON a.id_departamento = m.id_departamento

". $filtro;
    /* */
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $datos[] = array(
            'nombre' =>  trim($filaP2['nombre']),
            'nombre_sede' =>  trim($filaP2['nombre_sede']),
            'nombre_departamento' => trim($filaP2['nombre_departamento']),
            'nombre_area' => trim($filaP2['nombre_area']),
            'fecha_inicio' => $filaP2['fecha_inicio'],
            'fecha_final' => $filaP2['fecha_final'],
            'responsable' => $filaP2['responsable'],
            'descripcion' => $filaP2['descripcion'],
            'tipo_mantenimiento' => $filaP2['tipo_mantenimiento'],
            'estado' => $filaP2['estado']
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
