
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


$id = $_REQUEST['id'];
$status = $_REQUEST['status'];

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    if ($status == 'I') {
        $cadenax = "DELETE FROM u116753122_cw3completa.ordrequisicion_detalle where id ='" . $id . "'";
        $resultadox = mysqli_query($conetar, $cadenax);

    } else {
        $cadenaa = "update u116753122_cw3completa.ordrequisicion set estado='F' where id='" . $id . "'";
        $resultadoa = mysqli_query($conetar, $cadenaa);
    }
}
?>

