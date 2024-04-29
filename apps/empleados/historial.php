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

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }
    
}

?>
<table class="table table-h-m">
    <thead>
        <tr>
            <th>Mantenimiento</th>
            <th>Responsable</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>

        <?php

        $cadena = "SELECT p.id,p.fecha_final,p.daño,p.estado_mantenimiento,p.respuestos,p.tecnico, a.nombre FROM correctivo p, 
                                        producto a WHERE a.id_producto = p.equipo AND a.id_producto = '$id' AND estado_mantenimiento ='P' 
                                        UNION SELECT p.id,p.fecha_final,p.desc_mantenimiento,p.estado_mantenimiento,p.desc_mantenimiento, p.resp_mantenimiento, a.nombre 
                                        FROM preventiva p, producto a WHERE a.id_producto = p.equipo 
                                        AND a.id_producto = '$id' AND estado_mantenimiento = 'P'";
        /* */
        $thefile = 0;
        $resultadP2 = $conetar->query($cadena);
        $datos = array();
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {

        ?>

            <tr>
                <td><?php echo $filaP2['respuestos']; ?></td>
                <td><?php echo $filaP2['tecnico']; ?></td>
                <td><?php echo $filaP2['fecha_final']; ?></td>
                <td><?php

                    if ($filaP2['estado_mantenimiento'] == 'P') {
                        echo '<span class="badge badge-danger">PENDIENTE</span>';
                    } else {
                        echo '<span class="badge badge-success">REALIZADO</span>';
                    }

                    ?></td>
            </tr>

        <?php

        }

        ?>

    </tbody>
</table>