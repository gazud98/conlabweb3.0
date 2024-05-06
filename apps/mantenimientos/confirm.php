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
    $tipomant = "";
    $fechamant = "";

    if (isset($_REQUEST['id']) || isset($_REQUEST['tipomant']) || isset($_REQUEST['fechamant'])) {
        $id = $_REQUEST['id'];
        $tipomant = $_REQUEST['tipomant'];
        $fechamant = $_REQUEST['fechamant'];
    }

    if ($tipomant == 'C') {
        $sql = "UPDATE correctivo SET fecha_realizacion = '$fechamant', estado_mantenimiento = 'F' WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);
    } else if ($tipomant == 'P') {
        $sql = "UPDATE preventiva SET fecha_realizacion = '$fechamant', estado_mantenimiento = 'F' WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);
    }
}
