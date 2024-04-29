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
    $cadena = "SELECT P.id_persona, P.nombre_1,P.nombre_2,P.apellido_1,P.apellido_2,P.estado, PE.last_login,PE.id_rol 
    FROM persona P, users PE where P.id_persona=PE.id_users";

    //echo $cadena;
    /* */
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $thefile = $thefile + 1;
        $nombre=$filaP2['nombre_1']." ".$filaP2['nombre_2']." ".$filaP2['apellido_1']." ".$filaP2['apellido_2'];
        $datos[] = array(
            'thefile' =>  $thefile,
            'estado' => trim($filaP2['estado']),
            'codigo' => trim($filaP2['id_persona']),
            'last_login' => $filaP2['last_login'],
            'id_rol' => $filaP2['id_rol'],
            'nombre' =>   $nombre
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
