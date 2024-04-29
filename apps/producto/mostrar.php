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
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {

    $cadena = "SELECT id_producto, nombre,estado, tipo_prod,referencia
    FROM  producto where 1=1";

    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $thefile = $thefile + 1;
        $datos[] = array(
            'thefile' =>  $thefile,
            'estado' => trim($filaP2['estado']),
            'id_producto' => trim($filaP2['id_producto']),
            'nombre' => $filaP2['nombre'],
            'tipo_prod' =>  trim($filaP2['tipo_prod']),
            'referencia' =>  trim($filaP2['referencia'])
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
