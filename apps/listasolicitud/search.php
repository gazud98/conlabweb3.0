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
if (isset($_GET['id_producto2'])) {
    $id_producto2 = $_GET['id_producto2'];
    if ($id_producto2 == "-1") {
        $id_producto2 = "";
    }
} else {
    $id_producto2 = "";
}
if (isset($_GET['id_departamento'])) {
    $id_departamento = $_GET['id_departamento'];
    if ($id_departamento == "-1") {
        $id_departamento = "";
    }
} else {
    $id_departamento = "";
}


if (isset($_GET['id_sede'])) {
    $id_sede = $_GET['id_sede'];
    if ($id_sede == "-1") {
        $id_sede = "";
    }
} else {
    $id_sede = "";
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
if (isset($_GET['nosolicitud'])) {
    $nosolicitud = $_GET['nosolicitud'];
    if ($nosolicitud == "-1") {
        $nosolicitud = "";
    }
} else {
    $nosolicitud = "";
}


// Crea una variable para el filtro SQL
$filtro = " and 1=1"; // Filtro base

// Agrega condiciones de filtro según los valores proporcionados


if ($fecha1 != '' && $fecha2 != '') {
    $filtro .= " AND a.fecha BETWEEN '" . date('d/m/Y', strtotime($fecha1)) . "' AND '" . date('d/m/Y', strtotime($fecha2)) . "'";
}
if ($estado != '') {
    $filtro .= " AND a.estado LIKE '%" . $estado . "%'";
}
if ($id_departamento != '') {
    $filtro .= " AND d.id_departamento LIKE '%" . $id_departamento . "%'";
}

if ($id_sede != '') {
    $filtro .= " AND a.id_sede LIKE '%" . $id_sede . "%'";
}
if ($nosolicitud != '') {
    $filtro .= " AND a.id LIKE '%" . $nosolicitud . "%'";
}



$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {

    // Query para obtener registros basados en el término de búsqueda
    $query = "SELECT distinct a.id,a.fecha,c.nombre as nombre_sede,de.nombre as nombre_dpto,  case when a.estado = 'P' then 'Pendiente' WHEN a.estado = 'F' THEN 'Finalizado' end as estado_solicitud, 
        b.nombre_1,b.nombre_2,b.apellido_1,b.apellido_2
         FROM  u116753122_cw3completa.ordrequisicion a, u116753122_cw3completa.persona b,u116753122_cw3completa.sedes c ,
         u116753122_cw3completa.ordrequisicion_detalle d,u116753122_cw3completa.departamentos de,u116753122_cw3completa.producto prd
          where  b.id_persona = a.id_persona 
          and a.id_sede = c.id_sedes  and a.id = d.id_req and prd.id_producto = d.id_producto and  prd.nombre  like '%".$id_producto2."%'   and de.id = d .id_departamento" . $filtro;

    $resultado = mysqli_query($conetar, $query);
    if (!$resultado) {
        die('Error en la consulta SQL: ' . mysqli_error($conetar));
    } {
        // Crear un array para almacenar los resultados
        $resultados = array();
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $resultados[] = array(
                'id' => $fila['id'],
                'nombre_persona' => $fila['nombre_1'] . " " . $fila['nombre_2'] . " " . $fila['apellido_1'] . " " . $fila['apellido_2'],
                'nombre_sede' => $fila['nombre_sede'],
                'fecha' => $fila['fecha'],
                'estados' => $fila['estado_solicitud'],
                'nombre_dpto' => $fila['nombre_dpto']

            );
        }
    }
    // Devuelve los resultados como formato JSON
    echo json_encode($resultados);
}
