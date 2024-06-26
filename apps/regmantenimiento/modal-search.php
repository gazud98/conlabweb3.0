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
        $filtro .= " AND responsable LIKE '%$nombre%'";
    } else if ($fecha != "") {
        $filtro .= " AND fecha_inicio = '$fecha'";
    } else if ($nombre != "" && $fecha != "") {
        $filtro .= " AND responsable LIKE '%$nombre%' AND fecha_inicio = '$fecha'";
    }

    $query = "SELECT id,id_equipo,id_sede,id_departamento, fecha_inicio, fecha_final, id_proveedor,responsable,descripcion, garantia_dias, danio,accion,respuestos,frecuencia,tipo_mantenimiento,estado 
    FROM mantenimientos where 1=1" . $filtro;
    
    $result = mysqli_query($conetar, $query);

    $descripcion = "";
    $start = "";
    $end = "";
    $responsable = "";
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
                        $start = date('Y-m-d', strtotime($row['fecha_inicio']));
                        $end = date('Y-m-d', strtotime($row['fecha_final']));
                        $responsable = $row['responsable'];
                    ?>
                        <tr>
                            <td style="font-size: 15px !important;width: 150px !important;border-left: 1px solid #EEEEEE; border-top: 1px solid #EEEEEE;border-bottom: 1px solid #EEEEEE;"><?= $start  ?></td>
                            <td style="font-size: 15px !important;border-right: 1px solid #EEEEEE; border-top: 1px solid #EEEEEE;border-bottom: 1px solid #EEEEEE;"><strong><?= 'Responsable: ' . $responsable ?></strong> &nbsp; &nbsp; &nbsp; <a href="#" style="color: green;" onclick="loadFormsEditMantenimientoForSearch(<?= $id ?>)">Ver Mantenimiento <i class="fa-solid fa-arrow-right"></i></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>