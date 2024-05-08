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

if (isset($_GET['examen'])) {
    $examen = $_GET['examen'];
    if ($examen == "-1") {
        $examen = "";
    }
} else {
    $examen = 0;
}

$filtro = " and 1=1"; // Filtro base

if ($examen != '') {
    $filtro .= " AND id_examen LIKE '%" . $examen . "%'";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {

    $cadena = "SELECT id, descripcion, valor
    FROM  u116753122_cw3completa.materia_prima";
   
    $thefile = 0;
 
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $thefile = $thefile + 1;
        $datos[] = array(
            'thefile' =>  $thefile,
            'codigo' => trim($filaP2['id']),
            'valor' => $filaP2['valor'],
            'descripcion' => $filaP2['descripcion']

        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
