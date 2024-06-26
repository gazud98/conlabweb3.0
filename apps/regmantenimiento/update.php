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

    if (isset($_REQUEST['newDate'])) {
        $newDate = $_REQUEST['newDate'];
    } else {
        $newDate = 0;
    }

    if (isset($_REQUEST['eventId'])) {
        $eventId = $_REQUEST['eventId'];
    } else {
        $eventId = 0;
    }

    // Formatear la fecha usando DateTime::createFromFormat
    $date = DateTime::createFromFormat('D M d Y H:i:s e+', $newDate);

    if ($date) {
        $start_date = $date->format('Y-m-d');
    } else {
        echo "Error al formatear la fecha<br>";
        $start_date = '0000-00-00'; // Fecha por defecto en caso de error
    }

    // Seleccionar el registro original
    $query = "SELECT id_equipo,id_sede,id_departamento,id_area,fecha_inicio,fecha_final,id_proveedor,responsable,descripcion,garantia_dias,danio,accion,respuestos,frecuencia,tipo_mantenimiento,estado FROM mantenimientos WHERE id = '$eventId'";
    $resultOriginal = mysqli_query($conetar, $query);

    if ($resultOriginal && mysqli_num_rows($resultOriginal) > 0) {
        $originalData = mysqli_fetch_assoc($resultOriginal);

        // Insertar el registro duplicado
        $queryInsert = "INSERT INTO mantenimientos (id_equipo, id_sede, id_departamento,id_area, fecha_inicio, fecha_final, id_proveedor, responsable, descripcion, garantia_dias, danio, accion, respuestos, frecuencia, tipo_mantenimiento, estado) VALUES ('" . 
            $originalData['id_equipo'] . "', '" . 
            $originalData['id_sede'] . "', '" . 
            $originalData['id_departamento'] . "', '" . 
            $originalData['id_area'] . "', '" . 
            $originalData['fecha_inicio'] . "', '" . 
            $originalData['fecha_final'] . "', '" . 
            $originalData['id_proveedor'] . "', '" . 
            $originalData['responsable'] . "', '" . 
            $originalData['descripcion'] . "', '" . 
            $originalData['garantia_dias'] . "', '" . 
            $originalData['danio'] . "', '" . 
            $originalData['accion'] . "', '" . 
            $originalData['respuestos'] . "', '" . 
            $originalData['frecuencia'] . "', '" . 
            $originalData['tipo_mantenimiento'] . "', '3')";

        $resultInsert = mysqli_query($conetar, $queryInsert);

        if ($resultInsert) {
            // Actualizar el registro original
            $queryUpdate = "UPDATE mantenimientos SET
            fecha_inicio = '$start_date'
            WHERE id = '$eventId'";
            $resultadoUpdate = mysqli_query($conetar, $queryUpdate);

            if ($resultadoUpdate) {
                $result = "ok";
            } else {
                $result = "err";
            }
        } else {
            $result = "err";
        }
    } else {
        $result = "err";
    }

    echo $result;
}
?>
