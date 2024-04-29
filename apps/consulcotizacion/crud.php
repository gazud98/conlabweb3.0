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
    $fchhora = date('Y-d-m', time());

    $modeeditstatus = "E";
    $id = $_REQUEST['id'];
    $preci = $_REQUEST['preci'];

    $cadena = "update cotizacion_insumos set
                    estado_cot='PO',
                    precio='" . $preci . "'
                            where id='" . $id . "'";
    echo $cadena;
    $resultado = mysqli_query($conetar, $cadena);
    $result = "ok";
}
