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

if (isset($_GET['numero_orden'])) {
    $numero_orden =  $_GET['numero_orden'];
    if ($numero_orden == "-1") {
        $numero_orden =  "";
    }
} else {
    $numero_orden = "";
}

if (isset($_GET['id_paciente'])) {
    $id_paciente =  $_GET['id_paciente'];
    if ($id_paciente == "-1") {
        $id_paciente =  "";
    }
} else {
    $id_paciente = "";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {

    $cadena = "SELECT a.id, a.estado, b.nombre_examen, b.codigo_cups, b.tipo_examen, a.valor, a.observacion, 
    @row_number := @row_number + 1 as numero_file FROM examen_temp a 
    JOIN lista_precio b, (SELECT @row_number := 0) as init WHERE a.id_examen = b.id 
    and a.id_paciente = '$id_paciente' and a.numero_orden like '%" . $numero_orden . "%' ORDER BY a.id;";
    
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    $row_number = 0;

    while ($filaP2 = mysqli_fetch_array($resultadP2)) {

        $datos[] = array(
            'thefile' =>  ++$row_number,
            'estado' => trim($filaP2['estado']),
            'codigo' => $filaP2['id'],
            'codigo_cups' => $filaP2['codigo_cups'],
            'nombre_examen' => $filaP2['nombre_examen'],
            'tipo_examen' => $filaP2['tipo_examen'],
            'valor' => $filaP2['valor'],
            'observacion' => $filaP2['observacion']
        );
    }

    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
