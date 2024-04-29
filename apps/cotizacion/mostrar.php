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

    $cadena = "SELECT a.id, a.fecha, CONCAT(b.nombre_1,' ',b.nombre_2,' ',b.apellido_1,' ',b.apellido_2) as nombre,@row_number := @row_number + 1 as numero_file,case when a.estado = 'P' then 'Pendiente' end as estado_solicitud
    FROM   u116753122_cw3completa.ordrequisicion a, u116753122_cw3completa.persona b join (select @row_number := 0) as init
    where b.id_persona = a.id_persona and a.estado ='P'";

    //echo $cadena;
    /* */

    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {

  
        $datos[] = array(
            'thefile' =>  trim($filaP2['numero_file']),
            'fecha' => $filaP2['fecha'],
            'codigo' => trim($filaP2['id']),
            'nombre' => trim($filaP2['nombre']),
            'estado_solicitud' => trim($filaP2['estado_solicitud'])
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
