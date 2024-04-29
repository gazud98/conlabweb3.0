<?php
//Si bahy consulta

// echo __FILE__.'>dd.....<br>';
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


//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $empresa = $_REQUEST['empresa'];
    $fechainicio = $_REQUEST['fechainicio'];
    $fechafinal = $_REQUEST['fechafinal'];
    $comentario_neg = $_REQUEST['comentario_neg'];
    $estadoneg = $_REQUEST['estadoneg'];

    $cadena = "insert into negociaciones(empresa, fechainicio, fechafinal, comentario, estado) values(
        '" . $empresa . "','" . $fechainicio . "','" . $fechafinal. "','" . $comentario_neg . "', '" . $estadoneg . "')";
    $resultado = mysqli_query($conetar, $cadena);
    
}

?>