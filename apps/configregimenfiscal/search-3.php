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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    include('reglasdenavegacion.php');


    //genera elos procesos de crud al formulario del directorio dond eesoy ubicado
    $fchhora = date('m-d-Y h:i:s a', time());

    $id = trim($_REQUEST['id']);

    $cadena2 = "SELECT id_iva, codigo_iva, descripcion, porcentaje 
    FROM u116753122_cw3completa.config_iva
    WHERE id_iva = '$id'";
    $resultadP2 = $conetar->query($cadena2);

    while ($fileP2 = mysqli_fetch_array($resultadP2)) {
        $id = trim($fileP2['id_iva']);
        $codiva = trim($fileP2['codigo_iva']);
        $nombreiva = trim($fileP2['descripcion']);
        $porcentajeiva = trim($fileP2['porcentaje']);
    }

    $data[] = array(
        'id' => $id,
        'cod' => $codiva,
        'desc' => $nombreiva,
        'porcentaje' => $porcentajeiva
    );

    echo json_encode($data);
}