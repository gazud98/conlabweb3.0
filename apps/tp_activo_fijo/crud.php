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
    //genera elos procesos de crud al formulario del directorio dond eesoy ubicado
    $fchhora = date('m-d-Y h:i:s a', time());

    $modeeditstatus = $_REQUEST['modeeditstatus'];
    $id = $_REQUEST['id'];

    if ($modeeditstatus == "D") { //es de desahibilitar/habikitr
        //          si estadio es 1 pasa ra 0 o v iceversa
        $cadena = "select estado from u116753122_cw3completa.tipo_activo_fijos where id='" . $id . "'";


        $resultadP2a = $conetar->query($cadena);
        $numerfiles2a = mysqli_num_rows($resultadP2a);
        if ($numerfiles2a >= 1) {
            $filaP2a = mysqli_fetch_array($resultadP2a);
            $estado = trim($filaP2a['estado']);
        } else {
            $estado = '1';
        }
        if ($estado == '1') {
            $estado = '0';
        } else {
            $estado = '1';
        }
        $cadena = "update u116753122_cw3completa.tipo_activo_fijos set estado='" . $estado . "' where id='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    } else { //es crea o moifica

        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);
        $estado = trim($_POST['estado']);
        date_default_timezone_set('America/Bogota');
        $fechaActual = date('d-m-Y');
        $fecha = $fechaActual;
        $hora = date("h:i:s");
        $fechafinal = $fecha . " " . $hora;

        if ($modeeditstatus == "C") { ////CREACION
            $consulta = "SELECT nombre FROM u116753122_cw3completa.tipo_activo_fijos WHERE nombre = '$nombre'";
            $resultado = mysqli_query($conetar, $consulta);
            if (mysqli_num_rows($resultado) > 0) {
                $respuesta = 1;
                echo $respuesta;
            } else {
                $cadena = "insert into u116753122_cw3completa.tipo_activo_fijos(nombre,descripcion,estado)values('" . $nombre . "','" . $descripcion . "','1')";
                $resultado = mysqli_query($conetar, $cadena);
                $result = "ok";
            }
        } else {
            if ($modeeditstatus == "E") { //acgualzucsion
                $cadena = "update u116753122_cw3completa.tipo_activo_fijos set
                                nombre='" . $nombre . "',
                                descripcion='" . $descripcion . "'
                            where id='" . $id . "'";
                $resultado = mysqli_query($conetar, $cadena);



                $result = "ok";
            } //es acgtaliadar
            else {
                if ($modeeditstatus == "B") { //acgualzucsion
                    $cadena = "DELETE FROM u116753122_cw3completa.tipo_activo_fijos where id='" . $id . "'";
                    $resultado = mysqli_query($conetar, $cadena);
                }
            }
        } //De es insetar


    } //es de desahibilitar
} //de hay cneion e bbd
