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

    $cadena = "SELECT id, nombre,estado,@row_number := @row_number + 1 as numero_file
    FROM  u116753122_cw3completa.tipo_activo_fijos join (select @row_number := 0) as init order by 1 ";

    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
       
        $datos[] = array(
            'thefile' =>  trim($filaP2['numero_file']),
            'estado' => trim($filaP2['estado']),          
            'codigo' => $filaP2['id'],
            'nombre' => $filaP2['nombre']

            
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
