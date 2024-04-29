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
if (isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];
    if ($fecha == "-1") {
        $fecha = "";
    }
} else {
    $fecha = 0;
}
if (isset($_GET['hora'])) {
    $hora = $_GET['hora'];
    if ($hora == "-1") {
        $hora = "";
    }
} else {
    $hora = 0;
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {

    $cadena = "SELECT
    a.motivo_costo AS descripcion,
    a.valor,
    b.tipo_calculo,
    CASE
        WHEN b.tipo_calculo = 'MT' THEN 'Materia Prima'
        WHEN b.tipo_calculo = 'CI' THEN 'Costo Indirecto'
        WHEN b.tipo_calculo = 'MO' THEN 'Mano Obra'
        ELSE 'Otro' -- Ajusta según sea necesario
    END AS tipo_categoria
FROM costo_indirecto a
JOIN calculo_costos b ON b.id_calculo = a.id
WHERE b.fecha = '" . $fecha . "' AND b.hora = '" . $hora . "' AND b.tipo_calculo = 'CI'

UNION

SELECT
    am.descripcion,
    am.valor,
    b.tipo_calculo,
    CASE
        WHEN b.tipo_calculo = 'MT' THEN 'Materia Prima'
        WHEN b.tipo_calculo = 'CI' THEN 'Costo Indirecto'
        WHEN b.tipo_calculo = 'MO' THEN 'Mano Obra'
        ELSE 'Otro' -- Ajusta según sea necesario
    END AS tipo_categoria
FROM materia_prima am
JOIN calculo_costos b ON b.id_calculo = am.id
WHERE b.fecha = '" . $fecha . "' AND b.hora = '" . $hora . "' AND b.tipo_calculo = 'MT'

UNION

SELECT
    mo.cargo AS descripcion,
    mo.salario AS valor,
    b.tipo_calculo,
    CASE
        WHEN b.tipo_calculo = 'MT' THEN 'Materia Prima'
        WHEN b.tipo_calculo = 'CI' THEN 'Costo Indirecto'
        WHEN b.tipo_calculo = 'MO' THEN 'Mano Obra'
        ELSE 'Otro' -- Ajusta según sea necesario
    END AS tipo_categoria
FROM mano_obra mo
JOIN calculo_costos b ON b.id_calculo = mo.id
WHERE b.fecha = '" . $fecha . "' AND b.hora = '" . $hora . "' AND b.tipo_calculo = 'MO';
";


    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {


        $datos[] = array(
            'descripcion' =>  trim($filaP2['descripcion']),
            'valor' => trim($filaP2['valor']),
            'tipo_calculo' => trim($filaP2['tipo_categoria'])
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
