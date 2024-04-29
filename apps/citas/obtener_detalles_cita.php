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
    // Obtén la fecha de la solicitud AJAX
    $fecha = $_GET['fecha'];

    // Realiza una consulta para obtener los detalles de la cita para la fecha dada
    $query = "SELECT a.fecha, CONCAT(b.nombre_1, ' ', b.nombre_2, ' ', b.apellido_1, ' ', b.apellido_2) AS nombre_completo, vendedor
              FROM citas a JOIN persona b ON a.vendedor = b.id_persona WHERE a.fecha = '" . $fecha . "'";
    $result = $conetar->query($query);

    $jsonData = array();

    while ($row = $result->fetch_assoc()) {
        $header = array(
            "asesor" => array(
                "vendedor" => $row['nombre_completo'],
                "fecha" => $row['fecha']
            ),
            "detalleasesor" => array()
        );

        $cadena2 = "SELECT a.fecha, a.hora, nombre_contacto, celular_contacto, email_contacto
                    FROM citas a JOIN persona b ON a.vendedor = b.id_persona WHERE a.fecha = '" . $row['fecha']  . "' and a.vendedor ='" . $row['vendedor'] . "'";
        $result1 = $conetar->query($cadena2);

        while ($row2 = $result1->fetch_assoc()) {
            $detail = array(
                "hora" => $row2['hora'],
                "nombre_contacto" => $row2['nombre_contacto'],
                "celular_contacto" => $row2['celular_contacto'],
                "email_contacto" => $row2['email_contacto']
            );

            // Agregar detalles al array del asesor actual
            $header["detalleasesor"][] = $detail;
        }

        // Agregar el encabezado y detalles al JSON principal
        $jsonData[] = $header;
    }

    // Devuelve los detalles de la cita en formato JSON
    echo json_encode($jsonData);

    mysqli_close($conetar);
}
