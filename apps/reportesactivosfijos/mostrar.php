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

if (isset($_GET['sede'])) {
    $sede = $_GET['sede'];
    if ($sede == "-1") {
        $sede = "";
    }
} else {
    $sede = "";
}

if (isset($_GET['estado'])) {
    $estado = $_GET['estado'];
    if ($estado == "-1") {
        $estado = "";
    }
} else {
    $estado = "";
}

$filtro = " and 1=1";

if ($sede != '') {
    $filtro .= " AND a.id_sedes = '$sede'";
}

if ($estado != '') {
    $filtro .= " AND p.estado = '$estado'";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    $cadena = "SELECT p.id_producto,p.referencia,p.lote,p.nombre AS nombrepro,p.estado,a.nombre 
            as nombresede FROM producto p INNER JOIN sedes a 
            ON p.id_sede = a.id_sedes WHERE id_categoria_producto = '1'" . $filtro;

    $resultadP2 = $conetar->query($cadena);

    $data = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {

        $data[] = array(
            'id' => trim($filaP2['id_producto']),                      //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
            'nombre' => $filaP2['nombrepro'],                         //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
            'estado' => $filaP2['estado'],
            'referencia' => $filaP2['referencia'],
            'nombresede' => $filaP2['nombresede']
        );
    }


    echo json_encode($data);
}

