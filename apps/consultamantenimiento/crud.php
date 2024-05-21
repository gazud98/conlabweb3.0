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

        $motivo = "";

        if (isset($_POST['motivo'])) {
            $motivo = $_POST['motivo'];
        }

        $sql = "INSERT INTO motivos_reprogramar(descripcion) VALUES ('$motivo')";

        $rest = mysqli_query($conetar, $sql);
    } else if ($aux == 2) {
        $tipmant = "";

        if (isset($_POST['tipmant'])) {
            $tipmant = $_POST['tipmant'];
        }

        if ($tipmant == 'P') {
            $id = trim($_POST['id']);
            $equipo = trim($_POST['equipo']);
            $desc_mantenimiento = trim($_POST['descmant']);
            $comenzar = date('Y-m-d', strtotime(trim($_POST['fechacon'])));
            $descdanio = trim($_POST['descdanio']);
            $repuestos = trim($_POST['repuestos']);
            $avance = trim($_POST['avance']);
            
            $cadena = "UPDATE preventiva SET
                                    desc_mantenimiento = '$desc_mantenimiento',
                                    comienzo = '$comenzar',
                                    danio = '$descdanio',
                                    repuestos = '$repuestos',
                                    avance = '$avance' WHERE id = '$id'";
            $resultado = mysqli_query($conetar, $cadena);

            echo $cadena;

            $result = "ok";
        } else if ($tipmant == 'C') {

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
    }
}
