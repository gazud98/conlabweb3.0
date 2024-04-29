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


    $aux = "";

    if(isset($_REQUEST['aux'])){
        $aux = $_REQUEST['aux'];
    }

    if($aux == 1){

        $motivo = "";

        if(isset($_POST['motivo'])){
            $motivo = $_POST['motivo'];
        }

        $sql = "INSERT INTO motivos_reprogramar(descripcion) VALUES ('$motivo')";

        $rest = mysqli_query($conetar, $sql);

    }

}
