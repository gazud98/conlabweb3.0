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
    $fecha1 = 0;
}
if (isset($_GET['fecha2'])) {
    $fecha2 = $_GET['fecha2'];
    if ($fecha2 == "-1") {
        $fecha2 = "";
    }
} else {
    $fecha2 = 0;
}
// Crea una variable para el filtro SQL
$filtro = " and 1=1"; 

// Agrega condiciones de filtro según los valores proporcionados


if ($fecha1 != '' && $fecha2 != '') {
    $filtro .= " AND STR_TO_DATE(b.fecha, '%d-%m-%Y') BETWEEN '" . $fecha1 . "' AND '" . $fecha2 . "'";
}
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {

    $cadena = "SELECT 
    nombre_examen,
    SUM(total_valor) AS total_valor,
    MAX(valord_admin) AS valord_admin,
    MAX(STR_TO_DATE(fecha, '%d-%m-%Y')) AS fecha,
    MAX(hora) AS hora
FROM (
    SELECT 
        e.nombre_examen,
        SUM(a.valor) AS total_valor,
        b.valord_admin,
        b.fecha,
        b.hora
    FROM 
        costo_indirecto a 
        JOIN calculo_costos b ON b.id_calculo = a.id 
        JOIN examenes e ON e.id_examenes = b.id_examen 
    WHERE 
          b.tipo_calculo = 'CI' ".$filtro."
    GROUP BY 
        e.nombre_examen, b.valord_admin, b.fecha, b.hora

    UNION 

    SELECT 
        e.nombre_examen,
        SUM(am.valor) AS total_valor,
        b.valord_admin,
        b.fecha,
        b.hora
    FROM 
        materia_prima am 
        JOIN calculo_costos b ON b.id_calculo = am.id 
        JOIN examenes e ON e.id_examenes = b.id_examen 
    WHERE 
         b.tipo_calculo = 'MT'  ".$filtro."
    GROUP BY 
        e.nombre_examen, b.valord_admin, b.fecha, b.hora

    UNION 

    SELECT 
        e.nombre_examen,
        SUM(mo.salario) AS total_valor,
        b.valord_admin,
        b.fecha,
        b.hora
    FROM 
        mano_obra mo 
        JOIN calculo_costos b ON b.id_calculo = mo.id 
        JOIN examenes e ON e.id_examenes = b.id_examen
    WHERE 
       b.tipo_calculo = 'MO' ".$filtro."
    GROUP BY 
        e.nombre_examen, b.valord_admin, b.fecha, b.hora
) AS subquery
GROUP BY 
    nombre_examen;

";




    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {


        $datos[] = array(
            'valor' => trim($filaP2['total_valor']),
            'nombre_examen' => trim($filaP2['nombre_examen']),
            'valord_admin' => trim($filaP2['valord_admin']),
            'fecha' => trim($filaP2['fecha']),
            'hora' => trim($filaP2['hora'])
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
