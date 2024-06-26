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
    $query = "SELECT id,id_equipo,id_sede,id_departamento, fecha_inicio, fecha_final, id_proveedor,responsable,descripcion, garantia_dias, danio,accion,respuestos,frecuencia,tipo_mantenimiento,estado FROM mantenimientos where estado =1;";
    $result = $conetar->query($query);

    $events = array();

    while ($row = $result->fetch_assoc()) {
        $start_date = date('Y-m-d', strtotime($row['fecha_inicio']));
        $end_date = date('Y-m-d', strtotime($row['fecha_final']));
        $events[] = array(
            'title' => $row['descripcion'],
            'start' => $start_date,
            'end' => $end_date,
            'color' => '#008A15',
            'textColor' => '#fff',
            'extendedProps' => array(
                'responsable' => $row['responsable']
            ),
            'id' => $row['id']
        );
    }

    echo json_encode($events);
}
