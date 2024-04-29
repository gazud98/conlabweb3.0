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
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ")" . $conetar->connect_error;
} else {

    $cadena = "SELECT p.id,p.fecha_final,p.daño,p.estado_mantenimiento, a.nombre FROM u116753122_cw3completa.correctivo p, 
    u116753122_cw3completa.producto a WHERE a.id_producto = p.equipo  
    UNION SELECT p.id,p.fecha_final,p.desc_mantenimiento,p.estado_mantenimiento, a.nombre 
    FROM u116753122_cw3completa.preventiva p, u116753122_cw3completa.producto a WHERE a.id_producto = p.equipo ";
    /* */
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $datos[] = array(
            'id' =>  trim($filaP2['id']),
            'nombre' =>  trim($filaP2['nombre']),
            'dan' => trim($filaP2['daño']),
            'estado_c' => trim($filaP2['estado_mantenimiento']),
            'fecha_final' => $filaP2['fecha_final'],
            'aux' => 'C',
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
