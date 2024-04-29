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

    $cadena = "SELECT P.id_proveedores, P.numero_identificacion, P.razon_social,P.estado
    FROM  proveedores P";
    //echo $cadena;
    /* */
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $thefile = $thefile + 1;
        $datos[] = array(
            'thefile' =>  $thefile,
            'estado' => trim($filaP2['estado']),
            'codigo' => trim($filaP2['id_proveedores']),
            'identificacion' => $filaP2['numero_identificacion'],
            'nombre' => $filaP2['razon_social']
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
