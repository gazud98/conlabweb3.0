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

    $num_orden = "";

    if(isset($_REQUEST['numorden'])){
        $num_orden = $_REQUEST['numorden'];
    }

    $sql = "SELECT d.id, d.forma_pago, d.tipo_tarjeta, d.documento, d.valor, d.num_orden, d.id_paciente, i.fecha_ingreso
    FROM detalle_pago d, ingreso i WHERE d.num_orden = i.numero_orden AND d.num_orden = '$num_orden'";

    $rest = mysqli_query($conetar, $sql);

    $datos = array();

    while($data = mysqli_fetch_array($rest)){

        $datos[] = array(
            'fecha_ingreso' => $data['fecha_ingreso'],
            'forma_pago' => $data['forma_pago'],
            'tipo_tarjeta' => $data['tipo_tarjeta'],
            'documento' => $data['documento'],
            'valor' => $data['valor'],
        );

    }

    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
