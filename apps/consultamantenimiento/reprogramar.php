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

    $id = "";
    $aux = "";
    $fecha = "";

    if (isset($_POST['idactivo']) || isset($_POST['aux']) || isset($_POST['fecha'])) {
        $id = $_POST['idactivo'];
        $aux = $_POST['aux'];
        $fecha = $_POST['fecha'];
    }

    if ($aux == 'C') {
        $sql = "UPDATE correctivo SET fecha_final = '$fecha', estado_mantenimiento = 'P'
        WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);
    }else if ($aux == 'P') {
        $sql = "UPDATE preventiva SET fecha_final = '$fecha', estado_mantenimiento = 'P'
        WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);
    }
}

?>
