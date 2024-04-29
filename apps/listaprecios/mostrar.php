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

    if (isset($_REQUEST['aux'])) {
        $aux = $_REQUEST['aux'];
    }

    if ($aux == 1) {

        $sql = "SELECT codigo_cups, nombre_examen FROM examenes";

        $rest = mysqli_query($conetar, $sql);

        $datos = array();

        while ($element = mysqli_fetch_array($rest)) {
            $datos[] = array(
                'codigo_cups' =>  trim($element['codigo_cups']),
                'nombre_examen' =>  trim($element['nombre_examen']),
            );
        }

        header('Content-Type: application/json');
        $json_datos = json_encode($datos);

        echo $json_datos;
    } else if ($aux == 2) {

        if(isset($_REQUEST['ide'])){
            $id_detalle = $_REQUEST['ide'];
        }

        $sql = "SELECT id, codigo_cups, nombre_examen, valor_examen, id_detalle_lista, id_porcentaje FROM lista_precio WHERE id_detalle_lista = '$id_detalle' ORDER BY id DESC";

        $rest = mysqli_query($conetar, $sql);

        $datos = array();

        while ($element = mysqli_fetch_array($rest)) {
            $datos[] = array(
                'id' =>  trim($element['id']),
                'codigo_cups' =>  trim($element['codigo_cups']),
                'nombre_examen' =>  trim($element['nombre_examen']),
                'valor_examen' =>  trim($element['valor_examen']),
                'id_detalle_lista' =>  trim($element['id_detalle_lista']),
                'id_porcentaje' =>  trim($element['id_porcentaje']),
            );
        }

        header('Content-Type: application/json');
        $json_datos = json_encode($datos);

        echo $json_datos;
    } else if ($aux == 3) {

        $sql = "SELECT id, nombre, descripcion, descuento_minimo, estado FROM detalle_listas ORDER BY id DESC";

        $rest = mysqli_query($conetar, $sql);

        $datos = array();

        while ($element = mysqli_fetch_array($rest)) {
            $datos[] = array(
                'id' =>  trim($element['id']),
                'nombre' =>  trim($element['nombre']),
                'descripcion' =>  trim($element['descripcion']),
            );
        }

        header('Content-Type: application/json');
        $json_datos = json_encode($datos);

        echo $json_datos;
    }else if($aux == 4){
        $sql = "SELECT codigo_cups FROM examenes";

        $rest = mysqli_query($conetar, $sql);

        $rows = mysqli_num_rows($rest);

        echo $rows;
    }else if($aux == 5){
        if(isset($_REQUEST['id'])){
            $id_detalle = $_REQUEST['id'];
        }

        $sql = "SELECT id FROM lista_precio WHERE id_detalle_lista = '$id_detalle'";

        $rest = mysqli_query($conetar, $sql);

        $rows = mysqli_num_rows($rest);

        echo $rows;
    }
}
