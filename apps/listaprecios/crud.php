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

        $desc = trim($_POST['descripcion']);
        $estado = trim($_POST['estado']);

        $sql = "INSERT INTO planes(descripcion, estado) VALUES ('$desc','$estado')";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 2) {

        $id = trim($_POST['id']);
        $desc = trim($_POST['descripcion']);
        $estado = trim($_POST['estado']);

        $sql = "UPDATE planes SET 
        descripcion='$desc',
        estado='$estado' WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 3) {

        $id = trim($_REQUEST['id']);

        $sql = "DELETE FROM planes WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 4) {

        $id = $_REQUEST['id'];
        $preci = $_REQUEST['preci'];

        $cadena = "UPDATE lista_precio SET valor_examen='$preci' WHERE id = '$id'";
        echo $cadena;
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    } else if ($aux == 5) {

        $frecuencia = $_REQUEST['frecuencia'];
        $procentaje = $_REQUEST['procentaje'];
        $valor = $_REQUEST['valor'];

        $sql = "UPDATE lista_precio SET frecuencia='$frecuencia', id_porcentaje='$procentaje', id_motivo_porcentaje='$valor'";
        
        echo $sql;

        $resultado = mysqli_query($conetar, $sql);

        $result = "ok";

    } else if ($aux == 6) {

        $frecuencia = $_REQUEST['frecuencia'];
        $procentaje = $_REQUEST['procentaje'];
        $id = $_REQUEST['id'];
        $valor = $_REQUEST['valor'];

        $cadena = "UPDATE lista_precio SET frecuencia='$frecuencia', id_porcentaje='$procentaje', id_motivo_porcentaje='$valor'
        WHERE id = '$id'";

        echo $cadena;

        $resultado = mysqli_query($conetar, $cadena);

        $result = "ok";
    } else if ($aux == 7) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['datos_b'])) {

                $datos = json_decode($_POST['datos_b'], true);

                foreach ($datos as $element) {
                    $frecuencia = $element['frecuencia2'];
                    $procentaje = $element['procentaje2'];
                    $valor = $element['valor_seleccionado2'];
                    $ide = $element['id'];

                    $sql = "UPDATE lista_precio SET frecuencia='$frecuencia', id_porcentaje='$procentaje', id_motivo_porcentaje='$valor'
                    WHERE id = '$ide'";
                    $result = $conetar->query($sql);

                    if (!$result) {
                        $error = "Error en la consulta SQL: " . $conetar->error;
                        echo $error;
                        break;
                    }
                }

                $conetar->close();

                $response = ['success' => true];
                echo json_encode($response);
            } else {
                echo "No se recibieron datos.";
            }
        } else {
            echo "Método no permitido.";
        }
    }else if($aux == 8){

        $nombrelista = trim($_POST['nombrelista']);
        $descripcionlista = trim($_POST['descripcionlista']);

        $sql = "INSERT INTO detalle_listas(nombre, descripcion) VALUES ('$nombrelista','$descripcionlista')";

        $rest = mysqli_query($conetar, $sql);

    }else if($aux == 9){

        if(isset($_REQUEST['ide'])){
            $id = $_REQUEST['ide'];
        }

        $sql = "DELETE FROM lista_precio WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);

    }
}
