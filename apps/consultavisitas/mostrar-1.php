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

if (isset($_GET['fecha_f'])) {
    $fecha_f = $_GET['fecha_f'];
    if ($fecha_f == "-1") {
        $fecha_f = "";
    }
} else {
    $fecha_f = "";
}

if (isset($_GET['aseco'])) {
    $aseco = $_GET['aseco'];
    if ($aseco == "-1") {
        $aseco = "";
    }
} else {
    $aseco = "";
}

$filtro = ""; 

if ($aseco != '') {
    $filtro .= "AND c.vendedor = '$aseco'";
}

if ($fecha1 != '' && $fecha2 != '') {
    $filtro .= " AND n.fechainicio BETWEEN '" . date('Y-m-d', strtotime($fecha1)) . "' AND '" . date('Y-m-d', strtotime($fecha2)) . "'";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ")" . $conetar->connect_error;
} else {

    $cadena = "SELECT cm.id, cm.latitud, cm.longitud, CONCAT(m.nombres, ' ', m.apellidos) AS medico, n.fechainicio, 
    CONCAT(p.nombre_1, ' ', p.apellido_1) 
    AS vendedor FROM comments_visitas cm INNER JOIN citas c ON cm.cita = c.id INNER JOIN medicos m ON c.medico = m.id_medicos 
    INNER JOIN negociaciones n ON c.id = n.cita INNER JOIN persona p ON c.vendedor = p.id_persona WHERE 1 ". $filtro ." 
    UNION SELECT cm.id, cm.latitud, cm.longitud, 
    e.nombre_comercial, n.fechainicio, CONCAT(p.nombre_1, ' ', p.apellido_1) AS vendedor FROM comments_visitas cm INNER JOIN citas c 
    ON cm.cita = c.id INNER JOIN empresas e ON c.empresa = e.id_empresas INNER JOIN negociaciones n ON c.id = n.cita INNER JOIN persona p 
    ON c.vendedor = p.id_persona WHERE 1 " . $filtro;
    //echo $cadena;
    //echo $fecha1;
    $thefile = 0; 
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $datos[] = array(
            'id' =>  trim($filaP2['id']),
            'vendedor' =>  trim($filaP2['vendedor']),
            'latitud' => trim($filaP2['latitud']),
            'longitud' => trim($filaP2['longitud']),
            'medico' => $filaP2['medico'],
            'fechainicio' => $filaP2['fechainicio'],
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
