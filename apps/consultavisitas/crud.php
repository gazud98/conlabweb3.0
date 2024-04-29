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

    date_default_timezone_set('America/Bogota');
    $fechaActual = date("m-d-Y");
    $horaActual = date("h:i:s");
    $fechaFinal = $fechaActual . " " . $horaActual;

    if ($aux == 1) {

        if (
            isset($_POST['coments']) || isset($_POST['id_tarea']) || isset($_POST['user'])
            || isset($_REQUEST['lat']) || isset($_REQUEST['long']) || isset($_REQUEST['aux'])
        ) {
            $com = $_POST['coments'];
            $id = $_POST['id_tarea'];
            $id2 = $_POST['id_tarea2'];
            $user = $_POST['user'];
            $lat = $_REQUEST['lat'];
            $long = $_REQUEST['long'];
            $aux = $_REQUEST['aux'];
        }

        $sql = "INSERT INTO comments_visitas(negociacion, descripcion, usuario, fecha, latitud, longitud)
        VALUES ('$id', '$com', '$user','$fechaFinal','$lat','$long')";

        echo $sql;

        $rest = mysqli_query($conetar, $sql);

        if (isset($_POST['estado_act'])) {

            $estado_act = $_POST['estado_act'];

            $sql2 = "UPDATE citas SET estado ='$estado_act' WHERE id = '$id'";

            $rest2 = mysqli_query($conetar, $sql2);
        }
    } else if ($aux == 2) {

        if (
            isset($_POST['coments2']) || isset($_POST['id_tarea2']) || isset($_POST['user2'])
            || isset($_REQUEST['lat']) || isset($_REQUEST['long'])
        ) {
            $com = $_POST['coments2'];
            $id = $_POST['id_tarea2'];
            $id2 = $_POST['id_tarea2'];
            $user = $_POST['user2'];
            $lat = $_REQUEST['lat'];
            $long = $_REQUEST['long'];
        }


        $sql = "INSERT INTO comments_neg(negociacion, descripcion, usuario, fecha, latitud, longitud)
        VALUES ('$id2', '$com', '$user','$fechaFinal','$lat','$long')";

        echo $sql;

        $rest = mysqli_query($conetar, $sql);

        if (isset($_POST['estado_act2'])) {

            $estado_act = $_POST['estado_act2'];

            $sql2 = "UPDATE negociaciones SET estado ='$estado_act' WHERE id = '$id'";

            $rest2 = mysqli_query($conetar, $sql2);
        }
    } else if ($aux == 3) {

        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }

        $cadena = "SELECT t.id, t.descripcion, t.fecha, t.negociacion, t.latitud, t.longitud, a.username, 
        CONCAT(p.nombre_1, ' ', p.apellido_1) AS vendedor
        FROM comments_visitas t, citas tk, users a, persona p
        WHERE t.usuario = a.id_users AND t.negociacion = tk.id AND tk.vendedor = p.id_persona AND t.id = '$id'";

        $resultadP2 = $conetar->query($cadena);

        while ($filaP2 = mysqli_fetch_array($resultadP2)) {

            $datos[] = array(
                'id' => $filaP2['id'],
                'tarea' => $filaP2['negociacion'],
                'descripcion' => $filaP2['descripcion'],
                'usuario' => $filaP2['username'],
                'fecha' => $filaP2['fecha'],
                'lat' => $filaP2['latitud'],
                'long' => $filaP2['longitud'],
                'vendedor' => $filaP2['vendedor'],
            );
        }

        echo json_encode($datos);
    }
}
