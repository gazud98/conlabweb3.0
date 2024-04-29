<?php
if (file_exists("config/accesosystems.php")) {
    include ("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include ("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include ("../../config/accesosystems.php");
        }
    }
}
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    if (isset ($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = 0;
    }
    $cadena = "SELECT id_examenes, codigo_cups, nombre_examen, nombre_alterno, abreviatura, estado, referencia, costo
    FROM u116753122_cw3completa.examenes WHERE id_examenes='$id'";
    //                     echo $cadena;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id = trim($filaP2['id_examenes']);
        $codigo_cups = trim($filaP2['codigo_cups']);
        $nombre_examen = trim($filaP2['nombre_examen']);
        $nombre_alterno = trim($filaP2['nombre_alterno']);
        $abreviatura = trim($filaP2['abreviatura']);
        $estado = trim($filaP2['estado']);
        $referencia = trim($filaP2['referencia']);
        $costo = trim($filaP2['costo']);
    }
    $response = array(
        'id' => $id,
        'codigo_cups' => $codigo_cups,
        'nombre_examen' => $nombre_examen,
        'nombre_alterno' => $nombre_alterno,
        'abreviatura' => $abreviatura,
        'estado' => $estado,
        'referencia' => $referencia,
        'costo' => $costo
    );
    echo json_encode($response);
}