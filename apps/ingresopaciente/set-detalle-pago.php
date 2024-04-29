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

    $numorden_pago = "";
    $tipo_pago = "";
    $valor_pago = "";
    $fecha_ingreso = "";

    if (isset($_POST['numorden_pago']) || isset($_POST['tipo_pago']) || isset($_POST['valor_pago']) || isset($_POST['fecha_ingreso'])) {
        $numorden_pago = $_POST['numorden_pago'];
        $tipo_pago = $_POST['tipo_pago'];
        $valor_pago = $_POST['valor_pago'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
    }

    $sql = "INSERT INTO pago(num_orden, tipo_pago, valor_pago, fecha_ingreso) 
    VALUES ('$numorden_pago','$tipo_pago','$valor_pago','$fecha_ingreso')";

    $rest = mysqli_query($conetar, $sql);
}
