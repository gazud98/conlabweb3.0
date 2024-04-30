<?php
$result = "err";

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

    $aux = "";

    if (isset($_REQUEST['aux'])) {
        $aux = $_REQUEST['aux'];
    }

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
            $idcita = $_REQUEST['idcita'];
        }

        $sql = "INSERT INTO comments_visitas(negociacion, cita, descripcion, usuario, latitud, longitud)
        VALUES ('$id', '$idcita', '$com', '$user', '$lat','$long')";

        echo $sql;

        $rest = mysqli_query($conetar, $sql);

        if (isset($_POST['estado_act'])) {

            $estado_act = $_POST['estado_act'];

            $sql2 = "UPDATE citas SET estado ='$estado_act' WHERE id = '$id'";

            $rest2 = mysqli_query($conetar, $sql2);
        }
    } else if ($aux == 2) {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }

        $cadena = "SELECT t.id, t.descripcion, t.fecha, t.negociacion, a.username FROM comments_visitas t, citas tk, users a 
        WHERE t.usuario = a.id_users AND t.negociacion = tk.id AND t.negociacion = '$id'";

        $resultadP2 = $conetar->query($cadena);

        $rows = mysqli_num_rows($resultadP2);

        while ($filaP2 = mysqli_fetch_array($resultadP2)) {

            $datos[] = array(
                'id' => $filaP2['id'],
                'tarea' => $filaP2['negociacion'],
                'descripcion' => $filaP2['descripcion'],
                'usuario' => $filaP2['username'],
                'fecha' => $filaP2['fecha'],
                'rows' => $rows,
            );
        }

        echo json_encode($datos);
    } else if ($aux == 3) {
        if (isset($_GET['fecha1'])) {
            $fecha1 = $_GET['fecha1'];
            if ($fecha1 == "-1") {
                $fecha1 = "";
            }
        } else {
            $fecha1 = "";
        }
        if (isset($_GET['fecha2'])) {
            $fecha2 = $_GET['fecha2'];
            if ($fecha2 == "-1") {
                $fecha2 = "";
            }
        } else {
            $fecha2 = "";
        }
        if (isset($_GET['estado'])) {
            $estado = $_GET['estado'];
            if ($estado == "-1") {
                $estado = "";
            }
        } else {
            $estado = "";
        }

        $filtro = " and 1=1"; // Filtro base

        if ($fecha1 != '' && $fecha2 != '') {
            $filtro .= " AND n.fechafinal BETWEEN '" . date('d/m/Y', strtotime($fecha1)) . "' AND '" . date('d/m/Y', strtotime($fecha2)) . "'";
        }
        if ($estado != '') {
            $filtro .= " AND n.estado LIKE '%" . $estado . "%'";
        }

        $query = "SELECT n.id, n.fechainicio, n.fechafinal, n.comentario, n.estado, CONCAT('<strong>Médico:</strong> ',m.nombres,' ',m.apellidos) 
        AS medico FROM negociaciones n INNER JOIN medicos m ON n.medico = m.id_medicos UNION SELECT n.id, n.fechainicio, n.fechafinal, n.comentario, 
        n.estado, CONCAT('<strong>Empresa:</strong> ', e.nombre_comercial) AS empresa FROM negociaciones n INNER JOIN empresas e 
        ON n.empresa = e.id_empresas WHERE 1 " . $filtro;

        $rest = mysqli_query($conetar, $query);

        $datos = array();

        while ($row = mysqli_fetch_array($rest)) {
            $datos[] = array(
                'id' => $row['id'],
                'objeto' => $row['medico'],
                'fechainicio' => $row['fechainicio'],
                'fechafinal' => $row['fechafinal'],
                'comentario' => $row['comentario'],
                'estado' => $row['estado'],
            );
        }

        echo json_encode($datos);
    }else if($aux == 4){
        $id = "";

        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }

        $sql = "UPDATE negociaciones SET estado='2' WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);
    }
}
