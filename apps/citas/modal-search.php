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
    echo $error;
} else {
    $nombre = "";
    $fecha = "";
    $filtro = "";

    if (isset($_REQUEST['nombre']) || isset($_REQUEST['fecha'])) {
        $nombre = $_REQUEST['nombre'];
        $fecha = date('Y-m-d', strtotime($_REQUEST['fecha']));
    }

    if ($nombre != "") {
        $filtro .= " AND CONCAT(m.nombres,' ',m.apellidos) LIKE '%$nombre%'";
    } else if ($fecha != "") {
        $filtro .= " AND c.fecha = '$fecha'";
    } else if($nombre != "" && $fecha != ""){
        $filtro .= " AND CONCAT(m.nombres,' ',m.apellidos) LIKE '%$nombre%' AND c.fecha = '$fecha'";
    }

    $query = "SELECT c.id, c.fecha, c.hora, c.vendedor, c.empresa, c.nombre_contacto, c.celular_contacto, c.email_contacto, m.id_medicos, 
    CONCAT(m.nombres,' ',m.apellidos) AS medico FROM citas c, medicos m WHERE c.medico = m.id_medicos " . $filtro;

    $result = mysqli_query($conetar, $query);

    $nombre_contacto = "";
    $start = "";
    $hora = "";
    $vendedor = "";
    $celular_contacto = "";
    $email_contacto = "";
    $empresa = 0;
    $medico = 0;
    $nombre_medico = "";
}

?>

<div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-borderless table-hover" id="tableCitasSearching">
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                        $start_date = date('Y-m-d', strtotime($row['fecha']));
                        $nombre_contacto = $row['nombre_contacto'];
                        $start = $row['fecha'];
                        $hora = $row['hora'];
                        $vendedor = $row['vendedor'];
                        $celular_contacto = $row['celular_contacto'];
                        $email_contacto = $row['email_contacto'];
                        $empresa = $row['empresa'];
                        $medico = $row['id_medicos'];
                        $nombre_medico = $row['medico'];
                    ?>
                        <tr>
                            <td style="font-size: 15px !important;width: 150px !important;border-left: 1px solid #EEEEEE; border-top: 1px solid #EEEEEE;border-bottom: 1px solid #EEEEEE;"><?= $start . ' T' . $hora ?></td>
                            <td style="font-size: 15px !important;border-right: 1px solid #EEEEEE; border-top: 1px solid #EEEEEE;border-bottom: 1px solid #EEEEEE;"><strong><?= 'Médico: ' . $nombre_medico ?></strong> &nbsp; &nbsp; &nbsp; <a href="#" style="color: green;" onclick="loadFormsEditCitaForSearch(<?= $id ?>)">Ver Cita <i class="fa-solid fa-arrow-right"></i></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>