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
     
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $cadena = "SELECT p.id,p.fecha_final,p.daño,p.estado_mantenimiento,p.respuestos,p.tecnico, a.nombre FROM correctivo p, 
    producto a WHERE a.id_producto = p.equipo AND a.id_producto = '$id' AND estado_mantenimiento in('V', 'F', 'P')
    UNION SELECT p.id,p.fecha_final,p.desc_mantenimiento,p.estado_mantenimiento,p.desc_mantenimiento, p.resp_mantenimiento, a.nombre 
    FROM preventiva p, producto a WHERE a.id_producto = p.equipo 
    AND a.id_producto = '$id' AND estado_mantenimiento in('V', 'F', 'P')";

    //echo $cadena;
    /* */
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $thefile = $thefile + 1;
        $datos[] = array(
            'respuestos' => trim($filaP2['respuestos']),
            'tecnico' => trim($filaP2['tecnico']),
            'fecha_final' => trim($filaP2['fecha_final']),
            'estado_mantenimiento' => trim($filaP2['estado_mantenimiento'])
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
