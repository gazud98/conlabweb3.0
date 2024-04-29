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


    $id = "";

    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];
    }

    $sql = "SELECT c.id, c.nombre FROM ciudades c WHERE c.id_departamento = '$id'";

    $rest = mysqli_query($conetar, $sql);

    while($data = mysqli_fetch_array($rest)){
        echo '<option value="'.$data['id'].'">'.$data['nombre'].'</option>';
    }

}


