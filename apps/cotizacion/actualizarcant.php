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

$cantm = $_REQUEST['cantm'];
$id = $_REQUEST['id'];

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

 
    $cadena = "update u116753122_cw3completa.ordrequisicion_detalle set cantidad  ='" . $cantm . "' where id='" . $id ." '";
    $resultado = mysqli_query($conetar, $cadena);
}
