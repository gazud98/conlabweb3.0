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

    $formapago = "";
    $tipotarjeta = "";
    $doc = "";
    $valor = "";
    $numero_orden = "";

    if (isset($_POST['formapago']) || isset($_POST['tipotarjeta']) || isset($_POST['doc']) || isset($_POST['valor'])
    || isset($_POST['numero_orden'])) {
        $formapago = $_POST['formapago'];
        $tipotarjeta = $_POST['tipotarjeta'];
        $doc = $_POST['doc'];
        $valor = $_POST['valor'];
        $numero_orden = $_POST['numero_orden'];
    }

    $sql = "INSERT INTO detalle_pago(forma_pago, tipo_tarjeta, documento, valor,num_orden) 
    VALUES ('$formapago','$tipotarjeta','$doc','$valor','$numero_orden')";

    $rest = mysqli_query($conetar, $sql);
}
