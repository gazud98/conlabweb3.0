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

    $cadena = "SELECT trim(P.id_persona) as id_persona,trim(CONCAT( P.nombre_1,' ',P.nombre_2,' ',P.apellido_1,' ',P.apellido_2)) as nombre,trim(P.estado) as estado,
   trim(C.nombre) as nmbcargo,@row_number := @row_number + 1 as numero_file
 FROM  persona P,
persona_empleados PE,
cargos C join (select @row_number := 0) as init
where P.id_persona=PE.id_persona
    and PE.id_cargos=C.id";

    //echo $cadena;
    /* */

    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {

        $nombre = $filaP2['nombre'];
        $datos[] = array(
            'thefile' =>  trim($filaP2['numero_file']),
            'estado' => trim($filaP2['estado']),
            'codigo' => trim($filaP2['id_persona']),
            'nombre' => $nombre,
            'nmbcargo' => $filaP2['nmbcargo']
          
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
