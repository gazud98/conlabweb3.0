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

        $desc = trim($_POST['descripcion']);
        $estado = trim($_POST['estado']);
        
        $sql = "INSERT INTO planes(descripcion, estado) VALUES ('$desc','$estado')";

        $rest = mysqli_query($conetar, $sql);

    }else if($aux == 2){
  
        $id = trim($_POST['id']);
        $desc = trim($_POST['descripcion']);
        $estado = trim($_POST['estado']);
        
        $sql = "UPDATE planes SET 
        descripcion='$desc',
        estado='$estado' WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);

    }else if($aux == 3){
        $id = trim($_REQUEST['id']);

        $sql = "DELETE FROM planes WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);
    }

} 
