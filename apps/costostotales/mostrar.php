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

    $cadena = "SELECT nombre_examen, SUM(valor) AS total_valor, fecha, hora,valord_admin FROM ( SELECT ex.nombre_examen, a.valor, b.fecha, b.hora,b.valord_admin FROM costo_indirecto a JOIN calculo_costos b ON b.id_calculo = a.id AND b.tipo_calculo = 'CI' JOIN examenes ex ON ex.id_examenes = b.id_examen GROUP BY ex.nombre_examen, b.fecha, b.hora UNION SELECT ex.nombre_examen, am.valor AS valor, b.fecha, b.hora,b.valord_admin FROM materia_prima am JOIN calculo_costos b ON b.id_calculo = am.id AND b.tipo_calculo = 'MT' JOIN examenes ex ON ex.id_examenes = b.id_examen GROUP BY ex.nombre_examen, b.fecha, b.hora UNION SELECT ex.nombre_examen, mo.salario AS valor, b.fecha, b.hora,b.valord_admin FROM mano_obra mo JOIN calculo_costos b ON b.id_calculo = mo.id AND b.tipo_calculo = 'MO' JOIN examenes ex ON ex.id_examenes = b.id_examen GROUP BY ex.nombre_examen, b.fecha, b.hora ) AS subconsulta GROUP BY nombre_examen, fecha, hora;
    ";

    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {

        $cadena2 = "SELECT DISTINCT valord_admin FROM calculo_costos WHERE fecha = '" . $filaP2['fecha'] . "' AND hora = '" . $filaP2['hora'] . "'";
        $resultadP3 = $conetar->query($cadena2);

        while ($fila3 = mysqli_fetch_array($resultadP3)) {
            $valor_admin = $fila3['valord_admin'];
        }

        $tvalor = trim($filaP2['total_valor']) + $valor_admin;
        $datos[] = array(
            'nombre_examen' =>  trim($filaP2['nombre_examen']),
            'total_valor' => $tvalor,
            'fecha' => trim($filaP2['fecha']),
            'hora' => trim($filaP2['hora']),
            'valor_admin' => trim($filaP2['valord_admin'])
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
