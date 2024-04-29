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
    $query = "SELECT c.id, c.fecha, c.hora, c.vendedor, c.empresa, c.nombre_contacto, c.celular_contacto, c.email_contacto, m.id_medicos, 
    CONCAT(m.nombres,' ',m.apellidos) AS medico FROM citas c, medicos m WHERE c.medico = m.id_medicos";
    $result = $conetar->query($query);

    $events = array();

    while ($row = $result->fetch_assoc()) {
        $start_date = date('Y-m-d', strtotime($row['fecha']));
        $events[] = array(
            'title' => 'Cita con: '.$row['medico'],
            'start' => $start_date.'T'.$row['hora'],
            'color' => '#008A15',
            'textColor' => '#fff',
            'hora' => $row['hora'],
            'nombre_contacto' => $row['nombre_contacto'],
            'vendedor' => $row['vendedor'],
            'id' => $row['id'],
            'celular_contacto' => $row['celular_contacto'],
            'email_contacto' => $row['email_contacto'],
            'medico'=> $row['medico']
        );
    }

    echo json_encode($events);
}
?>
