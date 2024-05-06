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

    $status = $_REQUEST['status'];

    if ($status == 'MP') {
        $valore = $_REQUEST['valore'];
        $desc = $_REQUEST['desc'];
        $valor_pruebas = $_REQUEST['valor_pruebas'];
        $n_examenes = $_REQUEST['n_examenes'];
        $n_examenes_totales = $_REQUEST['n_examenes_totales'];
        $sede = $_REQUEST['sede'];
        $examen = $_REQUEST['examen'];
        $date = $_REQUEST['date'];
        $rendimiento = $_REQUEST['rendimiento'];






        $cadena = "insert into u116753122_cw3completa.materia_prima(descripcion,valor,id_examen)values('" . $desc .
            "','" . $valore . "','" . $examen . "')";
           
        $resultado = mysqli_query($conetar, $cadena);
    } else if ($status == 'C') {
        $valorcosto = $_REQUEST['valorcosto'];
        $motivo = $_REQUEST['motivo'];
        $n_examenes_totales = $_REQUEST['n_examenes_totales'];
        $sede = $_REQUEST['sede'];
        $examen = $_REQUEST['examen'];
        $date = $_REQUEST['date'];
        $totalcostos = $_REQUEST['totalcostos'];






        $cadena = "insert into u116753122_cw3completa.costo_indirecto(motivo_costo,valor,id_examen)values('" . $motivo .
            "','" . $valorcosto . "','" . $examen . "')";
        $resultado = mysqli_query($conetar, $cadena);

    } else if ($status == 'MO') {
        $cargo = $_REQUEST['cargo'];
        $tiempo = $_REQUEST['tiempo'];
        $salario = $_REQUEST['salario'];
        $sede = $_REQUEST['sede'];
        $examen = $_REQUEST['examen'];
        $date = $_REQUEST['date'];
        $totalmanobra = $_REQUEST['totalmanobra'];





        $cadena = "insert into u116753122_cw3completa.mano_obra(cargo,tiempo,salario,id_examen)values('" . $cargo .
            "','" . $tiempo . "','" . $salario . "','" . $examen . "')";
        $resultado = mysqli_query($conetar, $cadena);
    }
}
