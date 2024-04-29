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
    $status = $_REQUEST['status'];





    if ($status == "D") { //es de desahibilitar/habikitr
        //          si estadio es 1 pasa ra 0 o v iceversa
        $id = $_REQUEST['id'];
        $cadena = "delete  from u116753122_cw3completa.ordrequisicion_temp where id='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
    } elseif ($status == "A") { //es de desahibilitar/habikitr
        //          si estadio es 1 pasa ra 0 o v iceversa
        $id_prod = trim(htmlspecialchars($_REQUEST['id_prod']));
        $valor = $_REQUEST['valor'];
        $cadena = "update u116753122_cw3completa.ordrequisicion_temp set cantidad  ='" . $valor . "' where id_producto='" . $id_prod . "'";
        $resultado = mysqli_query($conetar, $cadena);
    } else {

        date_default_timezone_set('America/Bogota');
        $fechaActual = date('d-m-Y');

        //$rep = trim(htmlspecialchars($_REQUEST['rep']));
        $periodicidad = trim(htmlspecialchars($_REQUEST['periodicidad']));
        $finicio = trim(htmlspecialchars($_REQUEST['finicio']));
        $desc = trim(htmlspecialchars($_REQUEST['desc']));
        $evento = trim(htmlspecialchars($_REQUEST['evento']));
        $diassemana = trim(htmlspecialchars($_REQUEST['diassemana']));
        $mesoption = trim(htmlspecialchars($_REQUEST['mesoption']));
        $id_producto = trim(htmlspecialchars($_REQUEST['id_producto']));
        $grupo = trim(htmlspecialchars($_REQUEST['grupo']));
        $idgra = trim(htmlspecialchars($_REQUEST['idgra']));
        $responsable = trim(htmlspecialchars($_REQUEST['responsable']));
        $proveegarantia1 = trim(htmlspecialchars($_REQUEST['proveegarantia1']));

        $fecha = $fechaActual;
        $hora = date("h:i:s");


        if ($periodicidad == "S") {
            $estru_periord = $diassemana;
        } elseif ($periodicidad == "M") {
            $estru_periord = $mesoption;
        } else {
            $estru_periord = "";
        }

        ////CREACION
        if ($grupo == "N") {
            $cadena = "insert into u116753122_cw3completa.eventos(f_inicio,hora,periodicidad,estru_periord,evento,descripcion,id_proveedor,id_responsable)values(
            '" . $finicio .
                "','" . $hora .
                "','" . $periodicidad .
                "','" . $estru_periord .
                "','" . $evento .
                "','" . $desc .
                "','" . $proveegarantia1 .
                "','" . $responsable .
                "')";
            $resultado = mysqli_query($conetar, $cadena);
            $cadena = "select id from  u116753122_cw3completa.eventos where
            f_inicio='" . $finicio . "'
            and periodicidad='" . $periodicidad . "'
            and estru_periord='" . $estru_periord . "'
            and evento='" . $evento . "'
            and hora='" . $hora . "'
            and id_proveedor='" . $proveegarantia1 . "'
            and id_responsable ='" . $responsable . "'
            and descripcion='" . $desc . "'";
            $resultadP2a = $conetar->query($cadena);
            $numerfiles2a = mysqli_num_rows($resultadP2a);
            if ($numerfiles2a >= 1) {
                $filaP2a = mysqli_fetch_array($resultadP2a);
                $id_evento = $filaP2a['id'];
            }
            $result = "ok";
            $cadena = "insert into u116753122_cw3completa.evento_detalle_actfijo(id_evento,id_actfijo)values(
                '" . $id_evento .
                "','" . $id_producto .
                "')";
            $resultado = mysqli_query($conetar, $cadena);
        } else {
            $cadena = "select id from  u116753122_cw3completa.eventos where
            f_inicio='" . $finicio . "'
            and periodicidad='" . $periodicidad . "'
            and estru_periord='" . $estru_periord . "'
            and evento='" . $evento . "'
            and hora='" . $hora . "'
            and id_proveedor='" . $proveegarantia1 . "'
            and id_responsable ='" . $responsable . "'
            and descripcion='" . $desc . "'";
            $resultadP2a = $conetar->query($cadena);
            $numerfiles2a = mysqli_num_rows($resultadP2a);
            if ($numerfiles2a >= 1) {
                $filaP2a = mysqli_fetch_array($resultadP2a);
                $id_evento = $filaP2a['id'];
                
                $cadenac = "insert into u116753122_cw3completa.evento_detalle_actfijo(id_evento,id_actfijo,id_grupo)values(
                    '" . $id_evento .
                    "','" . $id_producto .
                    "','" . $idgra .
                    "')";
                $resultadoc = mysqli_query($conetar, $cadenac);
            } else {
                $cadenaz = "insert into u116753122_cw3completa.eventos(f_inicio,hora,periodicidad,estru_periord,evento,descripcion,id_proveedor,id_responsable)values(
                    '" . $finicio .
                    "','" . $hora .
                    "','" . $periodicidad .
                    "','" . $estru_periord .
                    "','" . $evento .
                    "','" . $desc .
                    "','" . $proveegarantia1 .
                    "','" . $responsable .
                    "')";
                $resultadoz = mysqli_query($conetar, $cadenaz);
                $cadenaxy = "select id from  u116753122_cw3completa.eventos where
                f_inicio='" . $finicio . "'
                and periodicidad='" . $periodicidad . "'
                and estru_periord='" . $estru_periord . "'
                and evento='" . $evento . "'
                and hora='" . $hora . "'
                and id_proveedor='" . $proveegarantia1 . "'
                and id_responsable ='" . $responsable . "'
                and descripcion='" . $desc . "'";
                $resultadP2axy = $conetar->query($cadenaxy);
                $numerfiles2axy = mysqli_num_rows($resultadP2axy);
                if ($numerfiles2axy >= 1) {
                    $filaP2a = mysqli_fetch_array($resultadP2axy);
                    $id_eventoxy = $filaP2a['id'];
                   
                }
                $cadenay = "insert into u116753122_cw3completa.evento_detalle_actfijo(id_evento,id_actfijo,id_grupo)values(
                    '" . $id_eventoxy .
                    "','" . $id_producto .
                    "','" . $idgra .
                    "')";
                $resultadoy = mysqli_query($conetar, $cadenay);
            }
        }
    }
}//de hay cneion e bbd
