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
    echo $error;
} else {
 

    $cadena = "SELECT id_tarea, fecha_inicio, fecha_fin FROM tareas  ";

    $resultadP2 = $conetar->query($cadena);

    $numerfiles2a = mysqli_num_rows($resultadP2);

    echo $numerfiles2a;

    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $fechaFin = $filaP2['fecha_fin'];
        $id_tarea = $filaP2['id_tarea'];
        // Verifica si la fecha_fin es menor que la fecha actual
        if (strtotime($fechaFin) < strtotime(date("Y-m-d"))) {

            $sql = "UPDATE tareas SET estado = '1' WHERE id_tarea = '$id_tarea'";

            $rest = mysqli_query($conetar, $sql);
            echo 'OK';
        }
    }
}
