<?php

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
} else {

    $aux = 0;

    if (isset($_REQUEST['aux'])) {
        $aux = $_REQUEST['aux'];
    }

    if ($aux == 1) {
        $commet = "";
        $id = "";

        if (isset($_POST['comentario']) || isset($_POST['id'])) {

            $commet = $_POST['comentario'];
            $id = $_POST['id'];

            $sql = "UPDATE bodegaubcproducto SET cant_fisicas='$commet' WHERE idbodegaentrapanio = '$id'";

            $rest = mysqli_query($conetar, $sql);

            echo 'Registro exitoso.';
        } else {
            echo 'No se ha podido cuardar el comentario.';
        }
    } else if ($aux == 2) {

        $id = "";

        if (isset($_POST['id'])) {

            $id = $_POST['id'];

            $sql = "UPDATE bodegaubcproducto SET ok='1' WHERE idbodegaentrapanio = '$id'";

            $rest = mysqli_query($conetar, $sql);

            echo '1';
        }else{
            echo '2';
        }
    }
}
