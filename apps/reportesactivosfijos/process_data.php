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
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }

    // Consulta a la base de datos
    $cadena = "select P.id_producto,P.id_categoria_producto,P.nombre,P.id_departamento,P.estado,P.descripcion,
    PA.valor,PA.modelo,PA.serie,PA.fchinstalacion,
    PA.seguro,PA.seguroprima,PA.garantia,PA.fchexpgarantia,
    PA.vidautilmes,PA.metdepreciacion,P.id_sede,P.id_tipo_activo, PA.id_proveegarantia,PA.id_responsable,PA.aseguradora,
    PA.valor_asegurado, PA.op_mantenimiento, s.nombre AS sede, d.nombre AS departamento, tp.nombre AS tipo_activo, pr.nombre_comercial
from producto P,
     producto_activofijo PA, sedes s, departamentos d, tipo_activo_fijos tp, proveedores pr
where P.id_producto=PA.id_producto and P.id_sede = s.id_sedes and P.id_departamento = d.id and P.id_tipo_activo = tp.id 
and P.id_producto='" . $id . "'";

    $result = $conetar->query($cadena);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $row['seguro'] = ($row['seguro'] == 'S') ? 'SI' : 'NO';
        $row['garantia'] = ($row['garantia'] == 'S') ? 'SI' : 'NO';
        $row['op_mantenimiento'] = ($row['op_mantenimiento'] == '1') ? 'SI' : 'NO';
        $data[] = $row;
    }

    echo json_encode($data);

    $conetar->close();
}
