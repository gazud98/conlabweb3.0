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

    $id = $_POST['ide'];
    $tip = trim($_POST['tip']);
    $ob =  trim($_POST['observacion']);

    if ($tip == 'C') {
        $sql = "INSERT INTO u116753122_cw3completa.resultado_correctivo(idmantenimiento_c, resultado_c) 
    VALUES ('".$id."','".$ob."')";
        $result = $conetar->query($sql);
        $data[] = array(
            'id'=>$id,
            'tip'=>$tip
        );
        echo json_encode($data);
    } else if ($tip == 'P') {
        $sql = "INSERT INTO u116753122_cw3completa.resultado_preventivo(idmantenimiento_p, resultado_p) 
    VALUES ('".$id."','".$ob."')";
        $result = $conetar->query($sql);
        $data[] = array(
            'id'=>$id,
            'tip'=>$tip
        );
        echo json_encode($data);
    }
}
