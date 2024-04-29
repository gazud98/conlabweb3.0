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

    if (isset($_REQUEST['aux'])) {
        $aux = $_REQUEST['aux'];
    }

    if ($aux == '1') {
        $fchhora = date('m-d-Y', time());
        $tarea = $_REQUEST['tarea'];
        $fechaini = $_REQUEST['fechaini'];
        $fechafin = $_REQUEST['fechafin'];
        $prioridad = $_REQUEST['prioridad'];
        $responsable = $_REQUEST['responsable'];
        //$coments = $_REQUEST['coments'];
        $user = $_REQUEST['id_users'];
        $estado = $_REQUEST['estado'];


        $sql = "INSERT INTO tareas(tarea, fecha_inicio, fecha_fin, fecha_creacion, prioridad, responsable, coments, usuario, estado) 
    VALUES('$tarea', '$fechaini', '$fechafin', '$fchhora', '$prioridad', '$responsable', '$coments', '$user', '$estado')";

        $rest = mysqli_query($conetar, $sql);
    }else if($aux == '2'){

        if (isset($_POST['estado']) || isset($_POST['ide'])) {
            $estado = $_POST['estado'];
            $id = $_POST['ide'];
        }

        $sql = "UPDATE tareas SET estado = '$estado' WHERE id_tarea = '$id'";

        $rest = mysqli_query($conetar, $sql);

    }else if($aux == '3'){
        
        if (isset($_POST['coments']) || isset($_POST['id_tarea']) || isset($_POST['user'])) {
            $com = $_POST['coments'];
            $id = $_POST['id_tarea'];
            $user = $_POST['user'];
        }
        date_default_timezone_set('America/Bogota');
        $fechaActual = date("m-d-Y");
        $horaActual = date("h:i:s");
        $fechaFinal = $fechaActual." ".$horaActual;
      
        $sql = "INSERT INTO comments_task(tarea, descripcion, usuario,fecha)
        VALUES ('$id', '$com', '$user','$fechaFinal')";

        echo $sql;

        $rest = mysqli_query($conetar, $sql);

    }

}
