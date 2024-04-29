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
    include('reglasdenavegacion.php');

    $id = trim($_POST['id']);
    $observacion = trim($_POST['observacion']);

    $cadena = "update u116753122_cw3completa.eventos set
    observacion='" . $observacion . "',
    estado = 0
     where id='" . $id . "'";
    $resultado = mysqli_query($conetar, $cadena);
}

?>
