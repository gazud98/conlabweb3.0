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


    if (isset($_POST['user'])) {
        $user = $_POST['user'];
        if ($user == "-1") {
            $user = "";
        }
    } else {
        $user = "";
    }

    $filtro = " and 1=1"; // Filtro base

    if ($user != '') {
        $filtro .= " AND responsable = $user";
    } else{
        $filtro .= " AND responsable = '0'";
    }

    $cadena = "SELECT id_tarea  FROM tareas WHERE estado = '3'" .$filtro;

    $resultadP2 = $conetar->query($cadena);

    $numerfiles2a = mysqli_num_rows($resultadP2);

    echo $numerfiles2a;
}
