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

    $id =  $_REQUEST['id'];

    $cadenax = "SELECT id,nombre
    FROM  u116753122_cw3completa.bodegastand where estado = '1' AND idbodega = '$id'";

    $resultadP2ax = $conetar->query($cadenax);
    $numerfiles2ax = mysqli_num_rows($resultadP2ax);
    while ($filaP2ax = mysqli_fetch_array($resultadP2ax)) {
        echo "<option value='" . trim($filaP2ax['id']) . "'";
        echo '>' . $filaP2ax['nombre'] . "</option>";
    }
}
