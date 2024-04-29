<?php
  $result="err";
//     presntadio n par todos lod produtos tipo ACTVOS FIJOS

if( file_exists("config/accesosystems.php")) {
    include("config/accesosystems.php");
}else{
    if( file_exists("../config/accesosystems.php")) {
        include("../config/accesosystems.php");
    }else{
        if( file_exists("../../config/accesosystems.php")) {
            include("../../config/accesosystems.php");
        }
    }
}

// echo __FILE__.'>dd.....<br>';

 //echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
     $error= "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
     echo $error;
}else{

    $fchhora = date('m-d-Y h:i:s a', time());
    $tarea = $_REQUEST['tarea'];
    $fechaini = $_REQUEST['fechaini'];
    $fechafin = $_REQUEST['fechafin'];
    $prioridad = $_REQUEST['prioridad'];
    $responsable = $_REQUEST['responsable'];
    $coments = $_REQUEST['coments'];

    $sql = "INSERT INTO tareas(tarea, fecha_inicio, fecha_fin, fecha_creacion, prioridad, responsable, coments, estado) 
    VALUES('$tarea', '$fechaini', '$fechafin', '$fchhora', '$prioridad', '$responsable', '$coments', '1')";

    $rest = mysqli_query($conetar, $sql);
    
}

?>
