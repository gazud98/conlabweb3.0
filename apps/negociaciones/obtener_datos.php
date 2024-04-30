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
    echo json_encode(array("error" => $error));
} else {

    $sql = "SELECT empresa, medico FROM negociaciones";

    $exc = mysqli_query($conetar, $sql);

    while ($el = mysqli_fetch_array($exc)) {
        if ($el['empresa'] == 0) {
            $query = "SELECT n.id, n.fechainicio, n.fechafinal, n.comentario, n.estado, CONCAT(m.nombres,' ',m.apellidos) 
            AS medico, m.id_medicos FROM negociaciones n INNER JOIN medicos m ON n.medico = m.id_medicos";

            $rest = mysqli_query($conetar, $query);

            $datos = array();

            while ($row = mysqli_fetch_array($rest)) {
                $datos[] = array(
                    'id' => $row['id'],
                    'objeto' => $row['medico'],
                    'fechainicio' => $row['fechainicio'],
                    'fechafinal' => $row['fechafinal'],
                    'comentario' => $row['comentario'],
                    'estado' => $row['estado'],
                );

                // Contar eventos por día

            }
            echo $datos;
        } else if ($el['medico'] == 0) {
            $query = "SELECT n.id, e.nombre_comercial, n.fechainicio, n.fechafinal, n.comentario, n.estado 
            FROM negociaciones n INNER JOIN empresas e ON n.empresa = e.id_empresas";

            $rest = mysqli_query($conetar, $query);

            $datos = array();

            while ($row = mysqli_fetch_array($rest)) {
                $datos[] = array(
                    'id' => $row['id'],
                    'objeto' => $row['nombre_comercial'],
                    'fechainicio' => $row['fechainicio'],
                    'fechafinal' => $row['fechafinal'],
                    'comentario' => $row['comentario'],
                    'estado' => $row['estado'],
                );

                // Contar eventos por día

            }
            echo $datos;
        }
    }

    echo json_encode($datos);

    mysqli_close($conetar);
}
