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

    $cadena = "SELECT distinct a.consec_cot,a.id_proveedor,a.fecha,b.nombre_comercial,a.estado_cot,a.numorden,a.norequisicion
    FROM  cotizacion_insumos a, proveedores b 
    where b.id_proveedores=a.id_proveedor
    and a.consec_cot <> 0 and a.numorden=0 order by a.consec_cot";

    //echo $cadena;
    /* */

    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    $thefile = 0;
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {

        $thefile = $thefile + 1;
        $datos[] = array(
            'thefile' =>    $thefile,
            'fecha' => trim($filaP2['fecha']),
            'codigo' => trim($filaP2['consec_cot']),
            'nombre' => trim($filaP2['nombre_comercial']),
            'id_proveedor' => trim($filaP2['id_proveedor']),
            'estado_cot' => trim($filaP2['numorden']),
            'norequisicion' => trim($filaP2['norequisicion'])
        );

    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
