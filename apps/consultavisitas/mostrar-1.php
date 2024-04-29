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

if(isset($_REQUEST['user'])){
    $user = $_REQUEST['user'];
}

if (isset($_GET['fecha1'])) {
    $fecha1 = $_GET['fecha1'];
    if ($fecha1 == "-1") {
        $fecha1 = "";
    }
} else {
    $fecha1 = "";
}
if (isset($_GET['fecha2'])) {
    $fecha2 = $_GET['fecha2'];
    if ($fecha2 == "-1") {
        $fecha2 = "";
    }
} else {
    $fecha2 = "";
}

if (isset($_GET['fecha_f'])) {
    $fecha_f = $_GET['fecha_f'];
    if ($fecha_f == "-1") {
        $fecha_f = "";
    }
} else {
    $fecha_f = "";
}

if (isset($_GET['aseco'])) {
    $aseco = $_GET['aseco'];
    if ($aseco == "-1") {
        $aseco = "";
    }
} else {
    $aseco = "";
}

$filtro = ""; 

if ($fecha_f != '') {
    $filtro .= "WHERE fecha LIKE '%$fecha_f%'";
}

if ($aseco != '') {
    $filtro .= "AND vendedor = '$aseco'";
}

if ($fecha1 != '' && $fecha2 != '') {
    $filtro .= " AND fecha BETWEEN '" . date('Y-m-d', strtotime($fecha1)) . "' AND '" . date('Y-m-d', strtotime($fecha2)) . "'";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ")" . $conetar->connect_error;
} else {
    
    $sql = "SELECT id_cargo FROM users WHERE id_users = '$user'";
    
    $rest = mysqli_query($conetar, $sql);
    
    $data = mysqli_fetch_array($rest);
    
    if($data['id_cargo'] != 3){
        
        $cadena = "SELECT id, CONCAT(fecha,'-',hora) fecha_hora, nombre_contacto, celular_contacto, email_contacto, 
        estado FROM citas WHERE id_user = '$user' ".$filtro;
        //echo $cadena;
        //echo $fecha1;
        $thefile = 0; 
        $resultadP2 = $conetar->query($cadena);
        $datos = array();
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $datos[] = array(
                'id' =>  trim($filaP2['id']),
                'fecha_hora' =>  trim($filaP2['fecha_hora']),
                'nombre_contacto' => trim($filaP2['nombre_contacto']),
                'celular_contacto' => trim($filaP2['celular_contacto']),
                'email_contacto' => $filaP2['email_contacto'],
                'estado' => $filaP2['estado'],
            );
        }
        header('Content-Type: application/json');
        $json_datos = json_encode($datos);
    
        echo $json_datos;
        
    }else if($data['id_cargo'] == 3){
        
        $cadena = "SELECT id, CONCAT(fecha,'-',hora) fecha_hora, nombre_contacto, celular_contacto, email_contacto, 
        estado FROM citas WHERE 1 ".$filtro;
        //echo $cadena;
        //echo $fecha1;
        $thefile = 0; 
        $resultadP2 = $conetar->query($cadena);
        $datos = array();
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $datos[] = array(
                'id' =>  trim($filaP2['id']),
                'fecha_hora' =>  trim($filaP2['fecha_hora']),
                'nombre_contacto' => trim($filaP2['nombre_contacto']),
                'celular_contacto' => trim($filaP2['celular_contacto']),
                'email_contacto' => $filaP2['email_contacto'],
                'estado' => $filaP2['estado'],
            );
        }
        header('Content-Type: application/json');
        $json_datos = json_encode($datos);
    
        echo $json_datos;
        
    }
        

}
