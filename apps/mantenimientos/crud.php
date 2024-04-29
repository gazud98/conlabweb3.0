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

    $aux = 0;

    if (isset($_REQUEST['aux'])) {
        $aux = $_REQUEST['aux'];
    }

    if ($aux == 1) {

        $periodicidad = trim($_POST['periodicidad']);
        $responsable = trim($_POST['responsable']);
        $diassemana = trim($_POST['diassemana']);
        $equipo = trim($_POST['equipo']);
        $localizacion = trim($_POST['localizacion']);
        $id_proveedor = trim($_POST['id_proveedor']);
        $meses_garantia = trim($_POST['meses_garantia']);
        $id_tipo_mantenimiento = trim($_POST['id_tipo_mantenimiento']);
        $desc_mantenimiento = trim($_POST['desc_mantenimiento']);
        $comenzar = date('Y-m-d', strtotime(trim($_POST['comenzar'])));
        $resp_mantenimiento = trim($_POST['resp_mantenimiento']);
        $dir_resp = trim($_POST['dir_resp']);
        $tef_resp = trim($_POST['tef_resp']);
        $mesoption1 = trim($_POST['mesoption1']);
        $fechafinal = date('Y-m-d', strtotime(trim($_POST['fechafinal'])));


        $cadena = "INSERT into preventiva(
            equipo,id_sede, id_proveedor, meses_garantia,
            tipo_mantenimiento,desc_mantenimiento,period_semanal,
            periodicidad,mesoption,resp_mantenimiento,responsable,
            comienzo,fecha_final,tef_resp,direccion_resp,estado,aux
          )values('" .
            $equipo . "','" . $localizacion . "','" .
            $id_proveedor . "','" . $meses_garantia . "','" .
            $id_tipo_mantenimiento . "','" . $desc_mantenimiento . "','" . $diassemana . "','" . $periodicidad . "','" . $mesoption1 . "','" . $resp_mantenimiento . "','" . $responsable . "','" .
            $comenzar . "','" . $fechafinal . "','" . $tef_resp . "','" . $dir_resp . "','1', 'P')";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    } else if ($aux == 2) {
        
        $id = trim($_POST['id']);
        $periodicidad = trim($_POST['periodicidad']);
        $responsable = trim($_POST['responsable']);
        $diassemana = trim($_POST['diassemana']);
        $equipo = trim($_POST['equipo']);
        $localizacion = trim($_POST['localizacion']);
        $id_proveedor = trim($_POST['id_proveedor']);
        $meses_garantia = trim($_POST['meses_garantia']);
        $id_tipo_mantenimiento = trim($_POST['id_tipo_mantenimiento']);
        $desc_mantenimiento = trim($_POST['desc_mantenimiento']);
        $comenzar = date('Y-m-d', strtotime(trim($_POST['comenzar'])));
        $resp_mantenimiento = trim($_POST['resp_mantenimiento']);
        $dir_resp = trim($_POST['dir_resp']);
        $tef_resp = trim($_POST['tef_resp']);
        $mesoption1 = trim($_POST['mesoption1']);
        $fechafinal = date('Y-m-d', strtotime(trim($_POST['fechafinal'])));

        $cadena = "UPDATE preventiva SET
                                    equipo = '" . $equipo . "',
                                    id_sede = '" . $localizacion . "',
                                    id_proveedor = '" . $id_proveedor . "',
                                    meses_garantia = '" . $meses_garantia . "',
                                    tipo_mantenimiento = '" . $id_tipo_mantenimiento . "',
                                    desc_mantenimiento = '" . $desc_mantenimiento . "',
                                    period_semanal = '" . $diassemana . "',
                                    responsable = '" . $responsable . "',
                                    periodicidad = '" . $periodicidad . "',
                                    resp_mantenimiento = '" . $resp_mantenimiento . "',
                                    tef_resp = '" . $tef_resp . "',
                                    mesoption = '" . $mesoption1 . "',
                                    comienzo = '" . $comenzar . "',
                                    fecha_final = '" . $fechafinal . "',
                                    direccion_resp = '" . $dir_resp . "'
                                WHERE id = '" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    }else if($aux == 3){
        $id = "";

        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }

        $sql = "DELETE FROM preventiva WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);
    }

}
