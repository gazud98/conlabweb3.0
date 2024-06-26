<?php
$result = "err";

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

    $query = "UPDATE mantenimientos SET estado = 4 WHERE fecha_final < CURDATE() AND estado != 2";
    $result = $conetar->query($query);
   
    // Verifica si la consulta se ejecutó correctamente
    if ($result) {
        echo "Estado actualizado correctamente.";
    } else {
        // Imprime el error de MySQL
        echo "Error al ejecutar la consulta: " . $conetar->error;
        // Imprime la consulta SQL generada
        echo "Consulta SQL: " . $query;
    }
}
