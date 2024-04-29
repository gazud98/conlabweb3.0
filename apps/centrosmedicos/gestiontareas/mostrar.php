<?php
$result = "err";
//     presntadio n par todos lod produtos tipo ACTVOS FIJOS

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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    $cadena = "INSERT INTO tareas(tarea, fecha_inicio, fecha_fin, fecha_creacion, prioridad, responsable, coments, estado) 
    VALUES('$tarea', '$fechaini', '$fechafin', '$fchhora', '$prioridad', '$responsable', '$coments', '1')";

    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {

        $nombre = $filaP2['nombre'];
        $datos[] = array(
            'motivo_costo' =>  trim($filaP2['numero_file']),
            'valor' => trim($filaP2['valor']),
            'id_examen' => trim($filaP2['id_examen']),
            'fecha' => trim($filaP2['fecha']),
            'hora' => trim($filaP2['hora']),
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
