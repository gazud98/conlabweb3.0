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

        if (isset($_REQUEST['tipmant'])) {
            $tipmant = $_REQUEST['tipmant'];
        }

        if ($tipmant == 1) {

            $periodicidad = trim($_POST['periodicidad']);
            $area = trim($_POST['area']);
            $localizacion = trim($_POST['localizacion']);
            $departamento = trim($_POST['departamento']);
            $equipo = trim($_POST['equipo']);
            $id_proveedor = trim($_POST['id_proveedor']);
            $meses_garantia = trim($_POST['meses_garantia']);
            $responsable = trim($_POST['responsable']);
            $comenzar = date('Y-m-d', strtotime(trim($_POST['comenzar'])));
            $fechafinal = date('Y-m-d', strtotime(trim($_POST['fecha_final'])));
            $descripcion = trim($_POST['descripcion']);


            $sqlp = "INSERT INTO mantenimientos(
            id_equipo,id_sede,id_departamento, fecha_inicio, fecha_final,
            id_proveedor,responsable,descripcion,
            garantia_dias,
            frecuencia,id_area,tipo_mantenimiento,estado
          )VALUES('$equipo', '$localizacion', '$departamento', '$comenzar', '$fechafinal', '$id_proveedor', 
          '$responsable', '$descripcion','$meses_garantia','$periodicidad','$area','P', '1')";
            $rest = mysqli_query($conetar, $sqlp);
        } else if ($tipmant == 2) {


            $localizacion = trim($_POST['localizacion']);
            $departamento = trim($_POST['departamento']);
            $equipo = trim($_POST['equipo']);
            $id_proveedor = trim($_POST['id_proveedor']);
            $meses_garantia = trim($_POST['meses_garantia']);
            $responsable = trim($_POST['responsable']);
            $comenzar = date('Y-m-d', strtotime(trim($_POST['comenzar'])));
            $fechafinal = date('Y-m-d', strtotime(trim($_POST['fecha_final'])));
            $descripcion = trim($_POST['descripcion']);
            $email = trim($_POST['emailcontacto']);
            $danio = trim($_POST['danio']);
            $accion = trim($_POST['accion']);
            $repuestos = trim($_POST['repuestos']);
            $reqrep = trim($_POST['reqrep']);
            $area = trim($_POST['area']);
            $sqlc = "INSERT INTO mantenimientos(
                id_equipo,id_sede,id_departamento, fecha_inicio, fecha_final,
                id_proveedor,responsable,descripcion,
                garantia_dias,
                danio,accion,cod_repuesto,respuestos,id_area,tipo_mantenimiento,estado
              )VALUES('$equipo', '$localizacion', '$departamento', '$comenzar', '$fechafinal', '$id_proveedor', 
              '$responsable','$descripcion','$meses_garantia','$danio','$accion','$reqrep','$repuestos','$area','C', '1')";

            echo $sql;

            $rest = mysqli_query($conetar, $sqlc);
        }
    } else if ($aux == 2) {

        $tipmant = "";


        if (isset($_REQUEST['tipmant'])) {
            $tipmant = $_REQUEST['tipmant'];
        }


        if ($tipmant == "P") {
            $id = trim($_POST['id']);

            $periodicidad = trim($_POST['periodicidad']);
            $area = trim($_POST['area']);
            $localizacion = trim($_POST['localizacion']);
            $departamento = trim($_POST['departamento']);
            $equipo = trim($_POST['equipo']);
            $id_proveedor = trim($_POST['id_proveedor']);
            $meses_garantia = trim($_POST['meses_garantia']);
            $responsable = trim($_POST['responsable']);
            $comenzar = date('Y-m-d', strtotime(trim($_POST['comenzar'])));
            $fechafinal = date('Y-m-d', strtotime(trim($_POST['fecha_final'])));
            $descripcion = trim($_POST['descripcion']);
            if ($comenzar != $fecha_actual_inicio || $fechafinal != $fecha_actual_final) {

                $queryInsert = "INSERT INTO mantenimientos (id_equipo, id_sede, id_departamento, id_area, fecha_inicio, fecha_final, id_proveedor, responsable, descripcion, garantia_dias, id_area, frecuencia, tipo_mantenimiento, estado) 
                                SELECT id_equipo, id_sede, id_departamento, id_area, fecha_inicio, fecha_final, id_proveedor, responsable, descripcion, garantia_dias, id_area, frecuencia, tipo_mantenimiento, 3 
                                FROM mantenimientos WHERE id = '$id'";
                mysqli_query($conetar, $queryInsert);
            }
            $cadena = "UPDATE mantenimientos SET
                                    id_equipo = '$equipo',
                                    id_sede = '$localizacion',
                                    id_departamento = '$departamento',
                                    fecha_inicio = '$comenzar',
                                    fecha_final = '$fechafinal',
                                    id_proveedor = '$id_proveedor',
                                    responsable = '$responsable',
                                    descripcion = '$descripcion',
                                    garantia_dias = '$meses_garantia',
                                    id_area = '$area',
                                    frecuencia = '$periodicidad'
                                    WHERE id = '$id'";
            $resultado = mysqli_query($conetar, $cadena);

            echo $cadena;

            $result = "ok";
        } else if ($tipmant == "C") {

            $id = trim($_POST['id']);
            $localizacion = trim($_POST['localizacion']);
            $departamento = trim($_POST['departamento']);
            $equipo = trim($_POST['equipo']);
            $id_proveedor = trim($_POST['id_proveedor']);
            $meses_garantia = trim($_POST['meses_garantia']);
            $responsable = trim($_POST['responsable']);
            $comenzar = date('Y-m-d', strtotime(trim($_POST['comenzar'])));
            $fechafinal = date('Y-m-d', strtotime(trim($_POST['fecha_final'])));
            $descripcion = trim($_POST['descripcion']);
            $danio = trim($_POST['danio']);
            $accion = trim($_POST['accion']);
            $area = trim($_POST['area']);
            $reqrep = trim($_POST['reqrep']);
            $repuestos = trim($_POST['repuestos']);
          
            if ($comenzar != $fecha_actual_inicio || $fechafinal != $fecha_actual_final) {
              
                $queryInsert = "INSERT INTO mantenimientos (id_equipo, id_sede, id_departamento, id_area, fecha_inicio, fecha_final, id_proveedor, responsable, descripcion, garantia_dias, id_area, cod_repuesto, danio, accion, respuestos, tipo_mantenimiento, estado) 
                        SELECT id_equipo, id_sede, id_departamento, id_area, fecha_inicio, fecha_final, id_proveedor, responsable, descripcion, garantia_dias, id_area, cod_repuesto, danio, accion, respuestos, tipo_mantenimiento, 3 
                        FROM mantenimientos WHERE id = '$id'";
                mysqli_query($conetar, $queryInsert);
            }

            $cadena = "UPDATE mantenimientos SET
                                    id_equipo = '$equipo',
                                    id_sede = '$localizacion',
                                    id_departamento = '$departamento',
                                    fecha_inicio = '$comenzar',
                                    fecha_final = '$fechafinal',
                                    id_proveedor = '$id_proveedor',
                                    responsable = '$responsable',
                                    descripcion = '$descripcion',
                                    cod_repuesto = '$reqrep',
                                    danio = '$danio',
                                    accion = '$accion',
                                    id_area = '$area',
                                    respuestos = '$repuestos',
                                    garantia_dias = '$meses_garantia'
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
