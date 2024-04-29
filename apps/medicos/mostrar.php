<?php

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

    $id_medicos = "";
    $id_tipo_identificacion = "";
    $documento = "";
    $nombres = "";
    $apellidos = "";
    $id_tipo_genero = "";
    $fecha_nacimiento = "";
    $registro_medico = "";
    $especialidad = "";
    $email = "";
    $telefono = "";
    $movil = "";
    $entidades_ads = "";
    $comentarios = "";
    $centro_medico = "";
    $direccion = "";
    $ciudad = "";
    $departamento = "";
    //$aficiones = "";
    $categoria = "";
    $secretaria = "";
    $fecha_secretaria = "";
    $estado = "";
    $nombre_centro = "";
    $descripcion = "";

    if (isset($_REQUEST['aux'])) {
        $aux = $_REQUEST['aux'];
    }

    if ($aux == 1) {
        $cadena = "SELECT m.id_medicos, m.id_tipo_identificacion, m.documento, m.nombres, m.apellidos, 
            m.id_tipo_genero, m.fecha_nacimiento, m.registro_medico, m.especialidad, m.email, m.telefono, 
            m.movil, m.entidades_ads, m.comentarios, m.centro_medico, m.direccion, m.ciudad, m.departamento,
            m.categoria, m.secretaria, m.fecha_secretaria, m.estado, c.nombre_centro, e.descripcion
            FROM medicos m, centros_medicos c, especialidades e WHERE c.id_centro = m.centro_medico
            AND m.especialidad = e.id";

        $rest = mysqli_query($conetar, $cadena);

        $data = array();

        while ($filaP2 = mysqli_fetch_array($rest)) {

            $id_medicos = trim($filaP2['id_medicos']);
            $id_tipo_identificacion = trim($filaP2['id_tipo_identificacion']);
            $documento = trim($filaP2['documento']);
            $nombres = trim($filaP2['nombres']);
            $apellidos = trim($filaP2['apellidos']);
            $id_tipo_genero = trim($filaP2['id_tipo_genero']);
            $fecha_nacimiento = trim($filaP2['fecha_nacimiento']);
            $registro_medico = trim($filaP2['registro_medico']);
            $especialidad = trim($filaP2['especialidad']);
            $email = trim($filaP2['email']);
            $telefono = trim($filaP2['telefono']);
            $movil = trim($filaP2['movil']);
            $entidades_ads = trim($filaP2['entidades_ads']);
            $comentarios = trim($filaP2['comentarios']);
            $centro_medico = trim($filaP2['centro_medico']);
            $direccion = trim($filaP2['direccion']);
            $ciudad = trim($filaP2['ciudad']);
            $departamento = trim($filaP2['departamento']);
            //$aficiones = trim($filaP2['af']);
            $categoria = trim($filaP2['categoria']);
            $secretaria = trim($filaP2['secretaria']);
            $fecha_secretaria = trim($filaP2['fecha_secretaria']);
            $estado = trim($filaP2['estado']);
            $nombre_centro = trim($filaP2['nombre_centro']);
            $descripcion = trim($filaP2['descripcion']);

            $data[] = array(
                'id_medicos' => $id_medicos,
                'id_tipo_identificacion' => $id_tipo_identificacion,
                'documento' => $documento,
                'nombres' => $nombres . ' ' . $apellidos,
                'apellidos' => $apellidos,
                'id_tipo_genero' => $id_tipo_genero,
                'fecha_nacimiento' => $fecha_nacimiento,
                'registro_medico' => $registro_medico,
                'especialidad' => $especialidad,
                'email' => $email,
                'telefono' => $telefono,
                'movil' => $movil,
                'entidades_ads' => $entidades_ads,
                'comentarios' => $comentarios,
                'centro_medico' => $centro_medico,
                'direccion' => $direccion,
                'ciudad' => $filaP2['ciudad'],
                'departamento' => $departamento,
                'categoria' => $categoria,
                'secretaria' => $secretaria,
                'fecha_secretaria' => $fecha_secretaria,
                'estado' => $estado,
                'nombre_centro' => $nombre_centro,
                'descripcion' => $descripcion,

            );
        }

        echo json_encode($data);
    }
}
