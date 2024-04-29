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

    $cadena = "SELECT a.id,a.id_proveedor,a.fecha,b.nombre_comercial,a.estado_orden
    FROM  orden_compra a, proveedores b
    where b.id_proveedores=a.id_proveedor";
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
            'estado_orden' => $filaP2['estado_orden'],
            'nombre' => $filaP2['nombre_comercial'],
            'fecha' => $filaP2['fecha']
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
