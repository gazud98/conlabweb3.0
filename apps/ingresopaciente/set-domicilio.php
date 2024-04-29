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

    $rutasdomicilios = "";
    $tecnico = "";
    $fechaDomicilio = "";
    $horaDomicilio = "";
    $valorDomicilio = "";
    $numorden_pago = "";
    $id_paciente = "";


    if (
        isset($_POST['rutasdomicilios']) || isset($_POST['tecnico']) || isset($_POST['fechaDomicilio'])
        || isset($_POST['horaDomicilio']) || isset($_POST['valorDomicilio']) || isset($_REQUEST['numorden']) || isset($_REQUEST['idpac'])
    ) {
        $rutasdomicilios = $_POST['rutasdomicilios'];
        $tecnico = $_POST['tecnico'];
        $fechaDomicilio = $_POST['fechaDomicilio'];
        $horaDomicilio = $_POST['horaDomicilio'];
        $valorDomicilio = $_POST['valorDomicilio'];
        $numorden = $_POST['numorden'];
        $id_paciente = $_POST['idpac'];
    }

    $sql = "INSERT INTO domicilios(ruta, valor, fecha, hora, tecnico, num_orden, id_paciente) 
    VALUES ('$rutasdomicilios','$valorDomicilio','$fechaDomicilio','$horaDomicilio','$tecnico','$numorden','$id_paciente')";

    $rest = mysqli_query($conetar, $sql);
}
