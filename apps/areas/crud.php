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


 
    $modeeditstatus = $_REQUEST['modeeditstatus'];
    $id = $_REQUEST['id'];

    if ($modeeditstatus == "D") {
       
        $cadena = "select estado from u116753122_cw3completa.area_laboratorio where id='" . $id . "'";
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
        $cadena = "update u116753122_cw3completa.area_laboratorio set estado='" . $estado . "' where id='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    } else { 

        $nombre = trim($_POST['nombre']);
        $estado = trim($_POST['estado']);
        $departamento = trim($_POST['departamento']);
        date_default_timezone_set('America/Bogota');
        $fechaActual = date('d-m-Y');
        $fecha = $fechaActual;
        $hora = date("h:i:s");
        $fechafinal = $fecha . " " . $hora;

        if ($modeeditstatus == "C") { 
            $consulta = "SELECT nombre FROM u116753122_cw3completa.area_laboratorio WHERE nombre = '$nombre'";
            $resultado = mysqli_query($conetar, $consulta);
            if (mysqli_num_rows($resultado) > 0) {
                $respuesta = 1;
                echo $respuesta;
            } else {
                $cadena = "insert into u116753122_cw3completa.area_laboratorio(nombre,estado,id_departamento,fecha,hora)values('" . $nombre . "',1,'" . $departamento . "','" . $fecha . "','" . $hora . "')";
                $resultado = mysqli_query($conetar, $cadena);
            }
      
        } else {
            if ($modeeditstatus == "E") { 
                $cadena = "update u116753122_cw3completa.area_laboratorio set
                                nombre='" . $nombre . "',
                                id_departamento='" . $departamento . "'
                            where id='" . $id . "'";
                $resultado = mysqli_query($conetar, $cadena);


            } 
            else {
                if ($modeeditstatus == "B") { 
                    $cadena = "DELETE FROM u116753122_cw3completa.area_laboratorio where id='" . $id . "'";
                    $resultado = mysqli_query($conetar, $cadena);
                }
            }
        } 


    } 
} 
