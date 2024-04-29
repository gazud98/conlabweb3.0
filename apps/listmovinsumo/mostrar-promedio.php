<?php

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

$mes = date('m');

$filtro = " and 1=1"; // Filtro base

if ($fecha1 != '' && $fecha2 != '') {
    $filtro .= " AND a.fecha_entrega BETWEEN '" . date('Y-m-d', strtotime($fecha1)) . "' AND '" . date('Y-m-d', strtotime($fecha2)) . "'";
    $mes = date('m', strtotime($fecha2));
}



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
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {

    $id = "";

    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];
    }

    $cadena = "SELECT a.idproducto, p.nombre as nombre_producto, d.nombre as nombre_departamento, a.fecha_entrega, SUM(ABS(a.cant_recibida) )
    AS cantidad, a.valorunidad 
    FROM movi_insumos a, producto p, departamentos d where a.idproducto = p.id_producto and d.id = a.depdestino 
    and a.idproducto = '$id' ". $filtro;
    //echo $cadena;
    /* */
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $valortotal= round($filaP2['cantidad']) * $filaP2['valorunidad'];
        $thefile = $thefile + 1;
        $datos[] = array(
            'idproducto' => $filaP2['idproducto'],
            'nombre_producto' => $filaP2['nombre_producto'],
            'fecha_entrega' => $filaP2['fecha_entrega'],
            'cantidad' => round(($filaP2['cantidad'] / $mes), 0),
            'valorunidad' => $valortotal,
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
