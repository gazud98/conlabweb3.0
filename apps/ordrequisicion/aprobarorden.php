<?php if (file_exists("config/accesosystems.php")) {
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

$iduser = $_REQUEST['iduser'];
$cantm = $_REQUEST['cantm'];
$idsol = $_REQUEST['idsol'];

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $valor = $_REQUEST['valor'];
    $cadena = "update u116753122_cw3completa.ordrequisicion_temp set cantidad  ='" . $cantm . "' where id='" . $idsol ." '";
    $resultado = mysqli_query($conetar, $cadena);
}
