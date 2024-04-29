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



    include('reglasdenavegacion.php');


    //genera elos procesos de crud al formulario del directorio dond eesoy ubicado
    $fchhora = date('m-d-Y h:i:s a', time());

    $modeeditstatus = $_REQUEST['modeeditstatus'];
    $id = $_REQUEST['id'];

    if ($modeeditstatus == "D") { //es de desahibilitar/habikitr
        //          si estadio es 1 pasa ra 0 o v iceversa
        $cadena = "select estado from u116753122_cw3completa.centros_medicos where id_centro='" . $id . "'";
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
        $cadena = "update u116753122_cw3completa.centros_medicos set estado='" . $estado . "' where id_centro='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    } else {

        $nombre = trim($_POST['nombre']);
        $direccion = trim($_POST['direccion']);
        $estado = trim($_POST['estado']);

        if ($modeeditstatus == "C") { ////CREACION

            $cadena2 = "select nombre_centro from u116753122_cw3completa.centros_medicos where id_centro='" . $id . "'";
            $resultadP2a2 = $conetar->query($cadena2);
            $numerfiles2a2 = mysqli_num_rows($resultadP2a2);
            if ($numerfiles2a2 >= 1) {
                $filaP2a2 = mysqli_fetch_array($resultadP2a2);
                $name = $filaP2a2['nombre_centro'];
            }

            if ($nombre == $name) {
                echo "N";
            } else {
                $cadena = "insert into u116753122_cw3completa.centros_medicos(nombre_centro,direccion_centro,estado)values('" . $nombre . "','" . $direccion . "',1)";
                $resultado = mysqli_query($conetar, $cadena);
                echo "O";
            }

        } else {
            if ($modeeditstatus == "E") { //acgualzucsion
                $cadena = "update u116753122_cw3completa.centros_medicos set
                                nombre_centro='" . $nombre . "',
                                direccion_centro='" . $direccion . "'
                            where id_centro='" . $id . "'";
                $resultado = mysqli_query($conetar, $cadena);
                $result = "ok";
            } //es acgtaliadar
            else {
                if ($modeeditstatus == "B") { //acgualzucsion
                    $cadena = "DELETE FROM u116753122_cw3completa.centros_medicos where id_centro='" . $id . "'";
                    $resultado = mysqli_query($conetar, $cadena);
                }
            }
        } //De es insetar


    } //es de desahibilitar
} //de hay cneion e bbd
