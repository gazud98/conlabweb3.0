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

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $user = $_REQUEST['user'];

    $fchhora = date('Y-m-d');

    $cadena = "SELECT t.id_tarea, t.tarea, t.fecha_inicio, t.fecha_fin, t.fecha_creacion, t.prioridad, t.responsable, 
    CONCAT(p.nombre_1, ' ', p.apellido_1) as nombre, t.coments, t.usuario, t.estado, u.username 
    FROM tareas t, persona p, users u WHERE t.responsable = p.id_persona AND t.usuario = u.id_users 
    AND t.estado in(2) AND fecha_fin < CURRENT_DATE() AND t.usuario = '$user'";

    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $datos[] = array(
            'id_tarea' =>  trim($filaP2['id_tarea']),
            'tarea' => trim($filaP2['tarea']),
            'fecha_inicio' => trim($filaP2['fecha_inicio']),
            'fecha_fin' => trim($filaP2['fecha_fin']),
            'fecha_creacion' => trim($filaP2['fecha_creacion']),
            'prioridad' => trim($filaP2['prioridad']),
            'responsable' => trim($filaP2['nombre']),
            'coments' => trim($filaP2['coments']),
            'usuario' => trim($filaP2['username']),
            'estado' => trim($filaP2['estado']),
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
