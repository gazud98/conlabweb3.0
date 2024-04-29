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

    $id_tipo_identificacion = trim($_POST['id_tipo_identificacion']);
    $documento = trim($_POST['numero_ide']);
    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $id_tipo_genero = trim($_POST['id_tipo_genero']);
    $fecha_nacimiento = trim($_POST['fecha_nacimiento']);
    //$regmedico = trim($_POST['regmedico']);
    $especialidad = trim($_POST['especialidad']);
    $correo = trim($_POST['correo']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);
    $movil = trim($_POST['movil']);
    $ciudad = trim($_POST['ciudad']);
    //$entidades = trim($_POST['entidades']);
    $comentarios = trim($_POST['comentarios']);
    $dep = trim($_POST['dep']);
    $centro_medico = trim($_POST['centro_medico']);
    $catemedica = trim($_POST['catemedica']);
    $nombre_secre = trim($_POST['nombre_secre']);
    $cumple_secre = trim($_POST['cumple_secre']);
    $aficiones = trim($_POST['aficiones']);
    $subespecialidad = trim($_POST['subespecialidad']);
    $aficionesall = trim($_POST['tags2']);

    echo $aficionesall;

    if ($aux == '1') {
        $cadena = "INSERT INTO medicos(id_tipo_identificacion, documento, nombres, apellidos, id_tipo_genero, 
        fecha_nacimiento, especialidad, sub_especialidad, email, telefono, movil, comentarios, centro_medico, 
        direccion, ciudad, departamento, aficiones, categoria, secretaria, fecha_secretaria, estado) 
        VALUES ('$id_tipo_identificacion','$documento','$nombres','$apellidos','$id_tipo_genero','$fecha_nacimiento',
        '$especialidad','$subespecialidad','$correo','$telefono','$movil','$comentarios','$centro_medico','$direccion',
        '$ciudad','$dep','$aficionesall','$catemedica','$nombre_secre','$cumple_secre','1')";
        $resultado = mysqli_query($conetar, $cadena);
    } else if ($aux == '2') {

        $id = $_POST['id'];
        $aficionesalledit = trim($_POST['tags3']);

        $cadena = "UPDATE medicos SET 
                id_tipo_identificacion='$id_tipo_identificacion',
                documento='$documento',
                nombres='$nombres',
                apellidos='$apellidos',
                id_tipo_genero='$id_tipo_genero',
                fecha_nacimiento='$fecha_nacimiento',
                especialidad='$especialidad',
                sub_especialidad='$subespecialidad',
                email='$correo',
                telefono='$telefono',
                movil='$movil',
                comentarios='$comentarios',
                centro_medico='$centro_medico',
                direccion='$direccion',
                ciudad='$ciudad',
                departamento='$dep',
                aficiones='$aficionesalledit',
                categoria='$catemedica',
                secretaria='$nombre_secre',
                fecha_secretaria='$cumple_secre'
                WHERE id_medicos = '$id'";
        $resultado = mysqli_query($conetar, $cadena);
    }
}
