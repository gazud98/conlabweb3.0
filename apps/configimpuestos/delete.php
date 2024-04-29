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

    include('reglasdenavegacion.php');

    $fchhora = date('m-d-Y h:i:s a', time());

    $id = trim($_REQUEST['id']);
    $aux = trim($_REQUEST['aux']);


    if ($aux == '1') {
        $cadena2 = "DELETE FROM u116753122_cw3completa.config_impuestos WHERE id_config_imp = '$id'";
        $resultadP2 = $conetar->query($cadena2);
        $numerfiles2 = mysqli_num_rows($resultadP2);
    }else if($aux == '2'){
        $cadena2 = "DELETE FROM u116753122_cw3completa.regimen_fiscal_config WHERE idreg = '$id'";
        $resultadP2 = $conetar->query($cadena2);
        $numerfiles2 = mysqli_num_rows($resultadP2);
    }else if($aux == '3'){
        $cadena2 = "DELETE FROM u116753122_cw3completa.config_iva WHERE id_iva = '$id'";
        $resultadP2 = $conetar->query($cadena2);
        $numerfiles2 = mysqli_num_rows($resultadP2);
    }else if($aux == '4'){
        $cadena2 = "DELETE FROM u116753122_cw3completa.config_ctaxpagar WHERE id_ctapagar = '$id'";
        $resultadP2 = $conetar->query($cadena2);
        $numerfiles2 = mysqli_num_rows($resultadP2);
    }
}
