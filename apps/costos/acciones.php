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

    $caso = $_REQUEST['caso'];

    if ($caso == 'E') {
        $pant = $_REQUEST['pant'];
        if ($pant == 'MP') {
            $idmat = $_REQUEST['idmat'];
            $descripcion = $_REQUEST['descripcion'];
            $valormat = $_REQUEST['valormat'];

            $cadenam = "update u116753122_cw3completa.materia_prima set descripcion='" . $descripcion . "', valor=" . $valormat . " where id =" . $idmat;
            $resultadom = mysqli_query($conetar, $cadenam);
        } else if ($pant == 'C') {

            $id = $_REQUEST['id'];
            $valor = $_REQUEST['valor'];
            $motivo = $_REQUEST['motivo'];
            $totalcostos = $_REQUEST['totalcostos'];


            $cadena = "update u116753122_cw3completa.costo_indirecto set motivo_costo='" . $motivo . "', valor=" . $valor . ", costo_examen=" . $totalcostos . " where id =" . $id;
            $resultado = mysqli_query($conetar, $cadena);
        } else if ($pant == 'MO') {

            $idmano = $_REQUEST['idmano'];
            $cargo = $_REQUEST['cargo'];
            $tiempo = $_REQUEST['tiempo'];
            $salario = $_REQUEST['salario'];


            $cadena = "update u116753122_cw3completa.mano_obra set cargo='" . $cargo . "', tiempo='" . $tiempo . "', salario=" . $salario . " where id =" . $idmano;
            echo $cadena;
            $resultado = mysqli_query($conetar, $cadena);
        }
    } else if ($caso == 'B') {
        $pant = $_REQUEST['pant'];
        if ($pant == 'MP') {

            $idmat = $_REQUEST['idmat'];
            $cadenam = "DELETE FROM u116753122_cw3completa.materia_prima
            WHERE id =" . $idmat;
            $resultado = mysqli_query($conetar, $cadenam);
        } else if ($pant == 'C') {

            $id = $_REQUEST['id'];

            $cadena = "DELETE FROM u116753122_cw3completa.costo_indirecto
             WHERE id =" . $id;
            $resultado = mysqli_query($conetar, $cadena);
        }
        else if ($pant == 'MO') {

            $idmano = $_REQUEST['idmano'];

            $cadena = "DELETE FROM u116753122_cw3completa.mano_obra
             WHERE id =" . $idmano;
            $resultado = mysqli_query($conetar, $cadena);
        }
    }
}
