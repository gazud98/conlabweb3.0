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
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ")" . $conetar->connect_error;
} else {

    $sql = "SELECT id, fecha_final FROM correctivo";

    $rest = $conetar->query($sql);

    $rows = mysqli_num_rows($rest);
    echo 'hola';

    while ($data = mysqli_fetch_array($rest)) {
        $fechaFin2 = $data['fecha_final'];
        $id_tarea2 = $data['id'];
        echo 'hola';

        if (strtotime($fechaFin2) < strtotime(date("Y-m-d"))) {
            echo 'hola cv cvxc';

            $sql2 = "UPDATE correctivo SET estado_mantenimiento = 'V' WHERE id = '$id_tarea2'";
            echo $sql2;

            $rest2 = mysqli_query($conetar, $sql2);
            echo 'OK';
        }else{
            echo 'hola';
        }
    }
    $cadena = "SELECT id, fecha_final FROM preventiva";

    $res = $conetar->query($cadena);

    $rows = mysqli_num_rows($res);
    echo 'hola';

    while ($data2 = mysqli_fetch_array($res)) {
        $fechaFin2 = $data2['fecha_final'];
        $id_tarea2 = $data2['id'];
        echo 'hola';

        if (strtotime($fechaFin2) < strtotime(date("Y-m-d"))) {
            echo 'hola cv cvxc';

            $sql2 = "UPDATE preventiva SET estado_mantenimiento = 'V' WHERE id = '$id_tarea2'";
            echo $sql2;

            $rest2 = mysqli_query($conetar, $sql2);
            echo 'OK';
        }else{
            echo 'hola';
        }
    }

}
