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

    if($aux == 1){
        
        $sql = "SELECT id, descripcion, estado FROM planes";

        $rest = mysqli_query($conetar, $sql);

        $datos = array();

        while ($element = mysqli_fetch_array($rest)) {
            $datos[] = array(
                'id' =>  trim($element['id']),
                'descripcion' =>  trim($element['descripcion']),
                'estado' =>  trim($element['estado']),
            );
        }

        header('Content-Type: application/json');
        $json_datos = json_encode($datos);

        echo $json_datos;

    }

} 
