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
} else {
    $cadena23 = "SELECT SUM(cnt) AS max FROM ( SELECT COUNT(id) AS cnt FROM preventiva P INNER JOIN producto E ON P.equipo = E.id_producto 
    UNION ALL SELECT COUNT(id) AS cnt FROM correctivo P INNER JOIN producto E ON P.equipo = E.id_producto ) AS subquery;";

    $resultadP23 = $conetar->query($cadena23);
    $numerfiles23 = mysqli_num_rows($resultadP23);
    if ($numerfiles23 >= 1) {
        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
            $max = trim($filaP23['max']);
        }
    }
    $cadena = "(SELECT P.fecha_final, P.aux,P.id as id_preventiva, P.equipo as equipo_preventiva,P.estado_mantenimiento,E.nombre as producto_preventiva, 'P' tip_m FROM preventiva P,producto E where P.equipo=E.id_producto) UNION ALL (SELECT P.fecha_final,P.aux,P.id, P.equipo,P.estado_mantenimiento,E.nombre,'C' tip_m FROM correctivo P,producto E where P.equipo=E.id_producto ) ORDER BY fecha_final DESC;";
    //echo $cadena;
    /* */
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $thefile = $thefile + 1;
        $datos[] = array(
            'thefile' =>  $thefile,
            'id' =>  trim($filaP2['id_preventiva']),
            'tip_m' =>  trim($filaP2['tip_m']),
            'codigo' => trim($filaP2['equipo_preventiva']),
            'nombre' => trim($filaP2['producto_preventiva']),
            'estado' => $filaP2['estado_mantenimiento'],
            'fecha' => $filaP2['fecha_final'],
            'max' => $max,

        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
