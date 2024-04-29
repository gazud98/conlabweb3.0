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

    $cadena = "SELECT a.id,a.id_sede,a.ccosto, a.id_producto,c.nombre_1,c.nombre_2,c.apellido_1,c.apellido_2,a.id_persona,a.cantidad,e.nombre
    FROM u116753122_cw3completa.ordrequisicion_temp a,u116753122_cw3completa.producto e, u116753122_cw3completa.persona c
     where a.id_producto = e.id_producto and a.id_persona = c.id_persona";
    //echo $cadena;
    /* */
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $thefile = $thefile + 1;
        $datos[] = array(
            'thefile' =>  $thefile,
            'codigo' => trim($filaP2['id']),
            'nombre' => $filaP2['nombre'],
            'nombre_resp' => $filaP2['nombre_1']." ".$filaP2['nombre_2']." ".$filaP2['apellido_1']." ".$filaP2['apellido_2'],
            'cantidad' => $filaP2['cantidad'],
            
          
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
