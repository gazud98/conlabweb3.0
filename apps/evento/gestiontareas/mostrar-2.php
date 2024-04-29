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

    if(isset($_REQUEST['aux'])){
        $aux = $_REQUEST['aux'];
    }

    $datos = array();

    if ($aux == 1) {

        $cadena = "SELECT id_persona, CONCAT(nombre_1, ' ', nombre_2, ' ', apellido_1, ' ', apellido_2) as nombre FROM persona";

        $resultadP2 = $conetar->query($cadena);

        while ($filaP2 = mysqli_fetch_array($resultadP2)) {

            $datos[] = array(
                'id' => $filaP2['id_persona'],
                'nombre' => $filaP2['nombre']
            );

        }

        echo json_encode($datos);
    }
}
