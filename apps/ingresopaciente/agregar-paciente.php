<?php
$result = "err";
//     presntadio n par todos lod produtos tipo ACTVOS FIJOS

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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $aux = trim(htmlspecialchars($_REQUEST['aux']));

    if ($aux == 1) {

        $id_examen = trim(htmlspecialchars($_REQUEST['id_examen']));
        $prioridad = trim(htmlspecialchars($_REQUEST['prioridad']));
        //$observacion = trim(htmlspecialchars($_REQUEST['observacion']));
        $numero_orden = trim(htmlspecialchars($_REQUEST['numero_orden']));
        $id_paciente = trim(htmlspecialchars($_REQUEST['id_paciente']));


        $sql = "SELECT id_examen FROM examen_temp WHERE id_examen = '$id_examen'";

        $rest = mysqli_query($conetar, $sql);

        $rows = mysqli_num_rows($rest);

        $num = 0;

        if ($rows != 0) {
            $num = 1;
            echo $num;
        } else {
            $cadena = "SELECT valor_examen FROM lista_precio WHERE id =" . $id_examen;

            $resultadP2 = $conetar->query($cadena);

            while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                $valor =  trim($filaP2['valor_examen']);
            }

            $cadena = "insert into examen_temp( id_examen,id_paciente,estado,valor,numero_orden)values(
            '" . $id_examen .
                "','" . $id_paciente .
                "','" . $prioridad .
                "','" . $valor .
                "','" . $numero_orden .
                "')";
            $resultado = mysqli_query($conetar, $cadena);
            echo $num;
        }
    } else if ($aux == 2) {
        $id = trim(htmlspecialchars($_REQUEST['id']));
        $cadena = "DELETE FROM examen_temp where id='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
    }
}//de hay cneion e bbd
