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


    echo 'xxxxxx';

    //genera elos procesos de crud al formulario del directorio dond eesoy ubicado
    $fchhora = date('m-d-Y h:i:s a', time());

    $modeeditstatus = $_REQUEST['modeeditstatus'];
    $id = $_REQUEST['id'];

    if ($modeeditstatus == "D") { //es de desahibilitar/habikitr
        //          si estadio es 1 pasa ra 0 o v iceversa
        $cadena = "select estado from u116753122_cw3completa.preventiva where id='" . $id . "'";
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
        $cadena = "update u116753122_cw3completa.preventiva set estado='" . $estado . "' where id='" . $id . "'";

        echo $cadena;

        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    } else { //es crea o moifica

        $periodicidad = trim($_POST['periodicidad']);
        $responsable = trim($_POST['responsable']);
        $diassemana = trim($_POST['diassemana']);
        $equipo = trim($_POST['equipo']);
        $localizacion = trim($_POST['localizacion']);
        $id_proveedor = trim($_POST['id_proveedor']);
        $meses_garantia = trim($_POST['meses_garantia']);
        $meses_garantia_ext = trim($_POST['meses_garantia_ext']);
        $id_tipo_mantenimiento = trim($_POST['id_tipo_mantenimiento']);
        $desc_mantenimiento = trim($_POST['desc_mantenimiento']);
        $comenzar = trim($_POST['comenzar']);
        $rve = trim($_POST['rve']);
        $resp_mantenimiento = trim($_POST['resp_mantenimiento']);
        $dir_resp = trim($_POST['dir_resp']);
        $tef_resp = trim($_POST['tef_resp']);
        $mesoption1 = trim($_POST['mesoption1']);
        $fecha_comienzo = trim($_POST['fecha_comienzo']);

        if ($modeeditstatus == "C") { ////CREACION
            $cadena = "INSERT into u116753122_cw3completa.preventiva(
                              equipo,localizacion, fecha_comienzo, id_proveedor, meses_garantia,
                              meses_garantia_ext,tipo_mantenimiento,desc_mantenimiento,period_semanal,periodicidad,mesoption,resp_mantenimiento,responsable,comienzo ,rve,tef_resp,direccion_resp,estado
                            )values('" .
                $equipo . "','" . $localizacion . "','" .
                $fecha_comienzo . "','" . $id_proveedor . "','" . $meses_garantia . "','" . $meses_garantia_ext . "','" .
                $id_tipo_mantenimiento . "','" . $desc_mantenimiento . "','" . $diassemana . "','" . $periodicidad . "','" . $mesoption1 . "','" . $resp_mantenimiento . "','" . $responsable . "','" .
                $comenzar . "','" . $rve . "','" . $tef_resp . "','" . $dir_resp . "','1')";
            $resultado = mysqli_query($conetar, $cadena);
            $result = "ok";
        } else {
            if ($modeeditstatus == "E") { //acgualzucsion
                $cadena = "UPDATE u116753122_cw3completa.preventiva SET
                                equipo = '" . $equipo . "',
                                localizacion = '" . $localizacion . "',
                                fecha_comienzo = '" . $fecha_comienzo . "',
                                id_proveedor = '" . $id_proveedor . "',
                                meses_garantia = '" . $meses_garantia . "',
                                meses_garantia_ext = '" . $meses_garantia_ext . "',
                                tipo_mantenimiento = '" . $id_tipo_mantenimiento . "',
                                desc_mantenimiento = '" . $desc_mantenimiento . "',
                                period_semanal = '" . $diassemana . "',
                                responsable = '" . $responsable . "',
                                periodicidad = '" . $periodicidad . "',
                                resp_mantenimiento = '" . $resp_mantenimiento . "',
                                rve = '" . $rve . "',
                                tef_resp = '" . $tef_resp . "',
                                mesoption = '" . $mesoption1 . "',
                                comienzo = '" . $comenzar . "',
                                direccion_resp = '" . $dir_resp . "'
                            WHERE id = '" . $id . "'";
                $resultado = mysqli_query($conetar, $cadena);

                $result = "ok";
            } //es acgtaliadar
        } //De es insetar
    } //es de desahibilitar
}//de hay cneion e bbd
