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
    $nombre;
    $cadena = "SELECT c.descripcion, '' tiempo,c.valor 
    FROM u116753122_cw3completa.materia_prima c where 1=1 UNION SELECT a.motivo_costo,'' tiempo, a.valor 
    FROM u116753122_cw3completa.costo_indirecto a where 1=1 UNION SELECT cargo, tiempo, salario 
    FROM u116753122_cw3completa.mano_obra where 1=1 order by 1 asc" . $filtro ;

    $thefile = 0;

    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $thefile = $thefile + 1;

        $datos[] = array(

          
            'descripcion' => trim($filaP2['descripcion']),
            'valor' => $filaP2['valor'],
            'tiempo' => $filaP2['tiempo'],
          

        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
