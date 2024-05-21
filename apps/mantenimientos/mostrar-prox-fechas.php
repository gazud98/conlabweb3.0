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
    
    $id = "";

    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];
    }

    $cadena = "SELECT p.id, p.equipo, p.prox_fechas, e.nombre FROM preventiva p, producto e WHERE p.equipo = e.id_producto AND p.id = '$id'";
    //echo $cadena;
    /* */
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $datos[] = array(
            'id' =>  trim($filaP2['id']),
            'nombre' => trim($filaP2['nombre']),
            'prox_fechas' => trim($filaP2['prox_fechas']),
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
