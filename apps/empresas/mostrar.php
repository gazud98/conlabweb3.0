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

if (isset($_GET['fecha_f'])) {
    $fecha_f = $_GET['fecha_f'];
    if ($fecha_f == "-1") {
        $fecha_f = "";
    }
} else {
    $fecha_f = "";
}

$filtro = "";

if ($fecha_f != '') {
    $filtro .= "WHERE fecha LIKE '%$fecha_f%'";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ")" . $conetar->connect_error;
} else {

    if (isset($_REQUEST['aux'])) {
        $aux = $_REQUEST['aux'];
    }

    if ($aux == 1) {

        $cadena = "SELECT id_empresas, razon_social, nombre_comercial, documento, estado FROM empresas";
        //echo $cadena;
        //echo $fecha1;
        $resultadP2 = $conetar->query($cadena);
        $datos = array();
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $datos[] = array(
                'id_empresas' =>  trim($filaP2['id_empresas']),
                'razon_social' =>  trim($filaP2['razon_social']),
                'nombre_comercial' => trim($filaP2['nombre_comercial']),
                'documento' => trim($filaP2['documento']),
                'estado' => $filaP2['estado'],
            );
        }
        header('Content-Type: application/json');
        $json_datos = json_encode($datos);

        echo $json_datos;
    }else if($aux == 2){

        $sql = "SELECT id, descripcion, estado FROM motivo_glosas";

        $rest = mysqli_query($conetar, $sql);

        $datos = array();

        while ($element = mysqli_fetch_array($rest)) {
            $datos[] = array(
                'id' =>  trim($element['id']),
                'descripcion' =>  trim($element['descripcion']),
                'estado' =>  trim($element['estado'])
            );
        }

        header('Content-Type: application/json');
        $json_datos = json_encode($datos);

        echo $json_datos;

    }else if($aux == 3){

        $sql = "SELECT dia_rad_1, dia_rad_2, tipo_factura, formato_factura, cant_pacientes_mes, formato_anexo, numero_copias, requiere_rips, 
        cant_pacientes_factura, numero_ria, tipo_usuario, notas_empresa, otras_notas FROM info_facturacion";

        $rest = mysqli_query($conetar, $sql);

        $datos = array();

        while ($element = mysqli_fetch_array($rest)) {
            $datos[] = array(
                'dia_rad_1' =>  trim($element['dia_rad_1']),
                'dia_rad_2' =>  trim($element['dia_rad_2']),
                'tipo_factura' =>  trim($element['tipo_factura']),
                'formato_factura' =>  trim($element['formato_factura']),
                'cant_pacientes_mes' =>  trim($element['cant_pacientes_mes']),
                'formato_anexo' =>  trim($element['formato_anexo']),
                'numero_copias' =>  trim($element['numero_copias']),
                'requiere_rips' =>  trim($element['requiere_rips']),
                'cant_pacientes_factura' =>  trim($element['cant_pacientes_factura']),
                'numero_ria' =>  trim($element['numero_ria']),
                'tipo_usuario' =>  trim($element['tipo_usuario']),
                'notas_empresa' =>  trim($element['notas_empresa']),
                'otras_notas' =>  trim($element['otras_notas']),
            );
        }

        header('Content-Type: application/json');
        $json_datos = json_encode($datos);

        echo $json_datos;

    }else if($aux == 4){

        $sql = "SELECT id_entidades_bancarias, descripcion, puc, estado FROM entidades_bancarias";

        $rest = mysqli_query($conetar, $sql);

        $datos = array();

        while ($element = mysqli_fetch_array($rest)) {
            $datos[] = array(
                'id_entidades_bancarias' =>  trim($element['id_entidades_bancarias']),
                'descripcion' =>  trim($element['descripcion']),
                'puc' =>  trim($element['puc']),
                'estado' =>  trim($element['estado']),
            );
        }

        header('Content-Type: application/json');
        $json_datos = json_encode($datos);

        echo $json_datos;

    }else if($aux == 5){

        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }

        $sql = "SELECT p.id, e.nombre_comercial, p.nombre_plan, d.nombre, p.estado, p.descripcion_plan, p.frecuencia_plan, 
        p.porcentaje_plan FROM planes_empresa p, empresas e, detalle_listas d WHERE p.id_empresa = e.id_empresas 
        AND p.id_lista_base = d.id AND e.id_empresas = '$id'";

        $rest = mysqli_query($conetar, $sql);

        $datos = array();

        while ($element = mysqli_fetch_array($rest)) {
            $datos[] = array(
                'id' =>  trim($element['id']),
                'nombre_comercial' =>  trim($element['nombre_comercial']),
                'nombre_plan' =>  trim($element['nombre_plan']),
                'nombre' =>  trim($element['nombre']),
                'estado' =>  trim($element['estado']),
                'porcentaje_plan' =>  trim($element['porcentaje_plan']),
            );
        }

        header('Content-Type: application/json');
        $json_datos = json_encode($datos);

        echo $json_datos;

    }
}