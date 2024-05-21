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

        $tipmant = "";
        $fechas = "";

        if (isset($_REQUEST['tipmant']) || isset($_REQUEST['fechas'])) {
            $tipmant = $_REQUEST['tipmant'];
            $fechas = $_REQUEST['fechas'];
        }

        if ($tipmant == 1) {

            $periodicidad = trim($_POST['periodicidad']);
            $responsable = trim($_POST['responsable']);
            //$diassemana = trim($_POST['diassemana']);
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
            $fechafinal = date('Y-m-d', strtotime(trim($_POST['fecha_final'])));
            $departamento = trim($_POST['departamento']);
            $email = trim($_POST['emailcontacto']);
            $reqRecord = trim($_POST['reqRecord']);
            $frecuenciarecord = trim($_POST['frecuenciarecord']);

            $cadena = "INSERT INTO preventiva(
            equipo,id_sede,departamento, id_proveedor, meses_garantia,
            desc_mantenimiento,resp_mantenimiento,
            periodicidad,responsable,
            comienzo,fecha_final,tef_resp,direccion_resp,email,estado_mantenimiento,estado,aux,prox_fechas,req_record,frecuecnia_record
          )VALUES('$equipo', '$localizacion', '$departamento', '$id_proveedor', '$meses_garantia', '$desc_mantenimiento', 
          '$resp_mantenimiento','$periodicidad',
          '$responsable', '$fechas', '$fechafinal', '$tef_resp', '$dir_resp', '$email', 'P', '1', 'P', '$fechas','$reqRecord','$frecuenciarecord')";
            $resultado = mysqli_query($conetar, $cadena);

            $result = "ok";
        } else if ($tipmant == 2) {
            $responsable = trim($_POST['responsable']);
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
            $fechafinal = date('Y-m-d', strtotime(trim($_POST['fecha_final_cor'])));
            $departamento = trim($_POST['departamento']);
            $email = trim($_POST['emailcontacto']);
            $danio = trim($_POST['danio']);
            $accion = trim($_POST['accion']);
            $repuestos = trim($_POST['repuestos']);

            $sql = "INSERT INTO correctivo(equipo, id_sede, departamento, id_proveedor, meses_garantia, desc_mantenimiento, resp_mantenimiento,
            responsable, comienzo, fecha_final, tef_resp, direccion_resp, email, danio, accion, repuestos, estado_mantenimiento, aux) 
            VALUES ('$equipo','$localizacion','$departamento','$id_proveedor','$meses_garantia','$desc_mantenimiento', '$resp_mantenimiento', '$responsable','$comenzar',
            '$fechafinal','$tef_resp','$dir_resp','$email','$danio','$accion','$repuestos','P','C')";

            echo $sql;

            $rest = mysqli_query($conetar, $sql);
        }
    } else if ($aux == 2) {

        $tipmant = "";

        if (isset($_POST['tipmant'])) {
            $tipmant = $_POST['tipmant'];
        }

        if ($tipmant == 1) {
            $id = trim($_POST['id']);
            $periodicidad = trim($_POST['periodicidad']);
            $responsable = trim($_POST['responsable']);
            //$diassemana = trim($_POST['diassemana']);
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
            $fechafinal = date('Y-m-d', strtotime(trim($_POST['fecha_final'])));
            $departamento = trim($_POST['departamento']);
            $email = trim($_POST['emailcontacto']);
            $reqRecord = trim($_POST['reqRecord']);
            $frecuenciarecord = trim($_POST['frecuenciarecord']);

            $cadena = "UPDATE preventiva SET
                                    equipo = '$equipo',
                                    id_sede = '$localizacion',
                                    departamento = '$departamento',
                                    id_proveedor = '$id_proveedor',
                                    meses_garantia = '$meses_garantia',
                                    desc_mantenimiento = '$desc_mantenimiento',
                                    resp_mantenimiento = '$resp_mantenimiento',
                                    responsable = '$responsable',
                                    periodicidad = '$periodicidad',
                                    tef_resp = '$tef_resp',
                                    comienzo = '$comenzar',
                                    fecha_final = '$fechafinal',
                                    direccion_resp = '$dir_resp',
                                    email = '$email' WHERE id = '$id'";
            $resultado = mysqli_query($conetar, $cadena);

            echo $cadena;

            $result = "ok";
        } else if ($tipmant == 2) {

            $id = trim($_POST['id']);
            $responsable = trim($_POST['responsable']);
            $equipo = trim($_POST['equipo']);
            $localizacion = trim($_POST['localizacion']);
            $id_proveedor = trim($_POST['id_proveedor']);
            $meses_garantia = trim($_POST['meses_garantia']);
            $desc_mantenimiento = trim($_POST['desc_mantenimiento']);
            $comenzar = date('Y-m-d', strtotime(trim($_POST['comenzar'])));
            $dir_resp = trim($_POST['dir_resp']);
            $tef_resp = trim($_POST['tef_resp']);
            $fechafinal = date('Y-m-d', strtotime(trim($_POST['fecha_final'])));
            $departamento = trim($_POST['departamento']);
            $email = trim($_POST['emailcontacto']);
            $danio = trim($_POST['danio']);
            $accion = trim($_POST['accion']);
            $repuestos = trim($_POST['repuestos']);
            $resp_mantenimiento = trim($_POST['resp_mantenimiento']);

            $cadena = "UPDATE correctivo SET
                                    equipo = '$equipo',
                                    id_sede = '$localizacion',
                                    departamento = '$departamento',
                                    id_proveedor = '$id_proveedor',
                                    meses_garantia = '$meses_garantia',
                                    desc_mantenimiento = '$desc_mantenimiento',
                                    resp_mantenimiento = '$resp_mantenimiento',
                                    responsable = '$responsable',
                                    tef_resp = '$tef_resp',
                                    comienzo = '$comenzar',
                                    fecha_final = '$fechafinal',
                                    direccion_resp = '$dir_resp',
                                    email = '$email',
                                    danio = '$danio',
                                    accion = '$accion',
                                    repuestos = '$repuestos'
                                WHERE id = '$id'";
            $resultado = mysqli_query($conetar, $cadena);
            $result = "ok";
        }
    } else if ($aux == 3) {
        $id = "";

        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }

        $sql = "DELETE FROM preventiva WHERE id = '$id'";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 4) {
        $motivo = "";

        if (isset($_POST['motivo'])) {
            $motivo = $_POST['motivo'];
        }

        $sql = "INSERT INTO motivos_reprogramar(descripcion) VALUES ('$motivo')";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 5) {
        $fecha = "";
        $id_activo = "";

        if (isset($_POST['fecha']) || isset($_REQUEST['id_activo'])) {
            $fecha = $_POST['fecha'];
            $id_activo = $_POST['id_activo'];
        }

        $sql = "SELECT id FROM prox_fechas_mant_prev WHERE id_activo = '$id_activo'";

        $rest = mysqli_query($conetar, $sql);

        $row = mysqli_num_rows($rest);

        if ($row != 0) {
            $sql = "UPDATE prox_fechas_mant_prev SET prox_fecha = '$fecha', id_activo='$id_activo'";

            $rest = mysqli_query($conetar, $sql);
        } else {
            $sql = "INSERT INTO prox_fechas_mant_prev(prox_fecha, id_activo) VALUES ('$fecha', '$id_activo')";

            $rest = mysqli_query($conetar, $sql);
        }
    }
}
