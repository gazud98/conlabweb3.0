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

    $id_tipo_identificacion = trim($_POST['id_tipo_identificacion']);
    $documento = trim($_POST['documento']);
    $nombre_1 = trim($_POST['nombre_1']);
    $nombre_2 = trim($_POST['nombre_2']);
    $apellido_1 = trim($_POST['apellido_1']);
    $apellido_2 = trim($_POST['apellido_2']);
    $id_tipo_genero = trim($_POST['id_tipo_genero']);
    $estado = trim($_POST['estado']);
    $fecha_nacimiento = trim($_POST['fecha_nacimiento']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);
    $movil = trim($_POST['movil']);
    $ciudad = trim($_POST['ciudad']);
    $dep = trim($_POST['dep']);
    $direccion_alterna = trim($_POST['direccion_alterna']);
    $telefono_alterno = trim($_POST['telefono_alterno']);
    $fecha_ingreso = trim($_POST['fecha_ingreso']);
    $fecha_retiro = trim($_POST['fecha_retiro']);
    $email = trim($_POST['email']);
    $id_sede = trim($_POST['id_sede']);
    $id_cargos = trim($_POST['id_cargos']);
    $id_departamentos = trim($_POST['id_departamentos']);
    $detalle_cargo = trim($_POST['detalle_cargo']);
    $tarjeta_profesional = trim($_POST['tarjeta_profesional']);
    $empresa_temporal = trim($_POST['empresa_temporal']);

    if ($aux == 1) {

        $sql = "insert into persona(
            id_tipo_identificacion, documento,
            nombre_1, nombre_2, apellido_1, apellido_2,
            id_tipo_genero, fecha_nacimiento, direccion, telefono,
            movil, ciudad,departamento, direccion_alterna, telefono_alterno, estado
           )values('" .
            $id_tipo_identificacion . "','" . $documento . "','" .
            $nombre_1 . "','" . $nombre_2 . "','" . $apellido_1 . "','" . $apellido_2 . "','" .
            $id_tipo_genero . "','" . $fecha_nacimiento . "','" . $direccion . "','" . $telefono . "','" .
            $movil . "','" . $ciudad . "','" . $dep . "','" . $direccion_alterna . "','" . $telefono_alterno . "','1')";

        $rest = mysqli_query($conetar, $sql);

        $cadena = "select id_persona
                            from persona
                            where id_tipo_identificacion='" . $id_tipo_identificacion . "'
                                and documento='" . $documento . "'
                                and nombre_1='" . $nombre_1 . "'
                                and nombre_2='" . $nombre_2 . "'
                                and apellido_1='" . $apellido_1 . "'
                                and apellido_2='" . $apellido_2 . "'";
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_persona']);
        }
        $cadena = "insert into persona_empleados(
                            id_persona,fecha_ingreso, fecha_retiro, email,
                            id_sede, id_cargos, detalle_cargo, empresa_temporal,id_departamento
                        )values('" . $id . "','" . $fecha_ingreso . "','" . $fecha_retiro . "','" . $email . "','" .
            $id_sede . "','" . $id_cargos . "','" . $detalle_cargo . "','" . $empresa_temporal . "','" . $id_departamentos . "')";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    } else if ($aux == 2) {

        $cadena = "UPDATE persona SET
                                id_tipo_identificacion = '" . $id_tipo_identificacion . "',
                                documento = '" . $documento . "',
                                nombre_1 = '" . $nombre_1 . "',
                                nombre_2 = '" . $nombre_2 . "',
                                apellido_1 = '" . $apellido_1 . "',
                                apellido_2 = '" . $apellido_2 . "',
                                id_tipo_genero = '" . $id_tipo_genero . "',
                                fecha_nacimiento = '" . $fecha_nacimiento . "',
                                direccion = '" . $direccion . "',
                                telefono = '" . $telefono . "',
                                movil = '" . $movil . "',
                                ciudad = '" . $ciudad . "',
                                departamento = '" . $dep . "'
                            WHERE id_persona = '" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);

        $cadena = "UPDATE persona_empleados SET
                            fecha_ingreso = '" . $fecha_ingreso . "',
                            fecha_retiro = '" . $fecha_retiro . "',
                            id_sede = '" . $id_sede . "',
                            id_cargos = '" . $id_cargos . "',
                            id_departamento = '" . $id_departamentos . "'
                        WHERE id_persona = '" . $id . "'";

        echo $cadena;
        $resultado = mysqli_query($conetar, $cadena);

        $result = "ok";
    }else if($aux == 3){
        $id = "";

        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }

        $cadena = "select estado from persona where id_persona='" . $id . "'";
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
        $cadena = "update persona set estado='" . $estado . "' where id_persona='" . $id . "'";
        $resultado = mysqli_query($conetar, $cadena);
        $result = "ok";
    }else if($aux == 4){
        
        $id = "";

        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }

        $sql =  "DELETE FROM persona WHERE id_persona = '$id'";
        $rest = mysqli_query($conetar, $sql);
    }

}
