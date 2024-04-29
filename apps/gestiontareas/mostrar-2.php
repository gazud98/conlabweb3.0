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

    if(isset($_REQUEST['aux'])){
        $aux = $_REQUEST['aux'];
    }

    $datos = array();

    if ($aux == 1) {

        $cadena = "SELECT id_persona, CONCAT(nombre_1, ' ', nombre_2, ' ', apellido_1, ' ', apellido_2) as nombre FROM persona";

        $resultadP2 = $conetar->query($cadena);

        while ($filaP2 = mysqli_fetch_array($resultadP2)) {

            $datos[] = array(
                'id' => $filaP2['id_persona'],
                'nombre' => $filaP2['nombre']
            );

        }

        echo json_encode($datos);
    }else if($aux == 2){

        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }

        $cadena = "SELECT id_tarea FROM tareas WHERE id_tarea = '$id'";

        $resultadP2 = $conetar->query($cadena);

        while ($filaP2 = mysqli_fetch_array($resultadP2)) {

            $datos[] = array(
                'id' => $filaP2['id_tarea'],
            );

        }

        echo json_encode($datos);

    }else if($aux == 3){

        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }

        $cadena = "SELECT t.id, t.descripcion, t.fecha, t.tarea, a.username FROM comments_task t, tareas tk, users a 
        WHERE t.usuario = a.id_users AND t.tarea = tk.id_tarea AND t.tarea = '$id'";

        $resultadP2 = $conetar->query($cadena);

        $rows = mysqli_num_rows($resultadP2);

        while ($filaP2 = mysqli_fetch_array($resultadP2)) {

            $datos[] = array(
                'id' => $filaP2['id'],
                'tarea' => $filaP2['tarea'],
                'descripcion' => $filaP2['descripcion'],
                'usuario' => $filaP2['username'],
                'fecha' => $filaP2['fecha'],
                'rows' => $rows,
            );

        }

        echo json_encode($datos);
        
    }else if($aux == 4){

        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }

        $cadena = "SELECT t.id, t.descripcion, t.fecha, t.tarea, a.username FROM comments_task t, tareas tk, users a 
        WHERE t.usuario = a.id_users AND t.tarea = tk.id_tarea AND t.tarea = '$id'";

        $resultadP2 = $conetar->query($cadena);

        $rows = mysqli_num_rows($resultadP2);

        echo $rows;
        
    }else if($aux == 5){

        if(isset($_REQUEST['user'])){
            $user = $_REQUEST['user'];
        }

        $cadena = "SELECT t.id_tarea, t.tarea, t.fecha_inicio, t.fecha_fin, t.fecha_creacion, t.prioridad, t.responsable, 
        CONCAT(p.nombre_1, ' ', p.apellido_1) as nombre, t.coments, t.usuario, t.estado, u.username 
        FROM tareas t, persona p, users u WHERE t.responsable = p.id_persona AND t.usuario = u.id_users 
        AND t.estado in(2) AND fecha_fin < CURRENT_DATE() AND t.usuario = '$user'";

        $resultadP2 = $conetar->query($cadena);

        $rows = mysqli_num_rows($resultadP2);

        echo $rows;
        
    }

}

