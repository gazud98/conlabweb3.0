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

if (isset($_GET['dep'])) {
    $dep = $_GET['dep'];
    if ($dep == "-1") {
        $dep = "";
    }
} else {
    $dep = "";
}

if (isset($_GET['cat'])) {
    $cat = $_GET['cat'];
    if ($cat == "-1") {
        $cat = "";
    }
} else {
    $cat = "";
}


$filtro = " and 1=1"; 

if ($dep != '') {
    $filtro .= " AND d.id = '$dep'";
}

if ($cat != '') {
    $filtro .= " AND c.id_categoria_producto = '$cat'";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    $cadena = "SELECT p.id_proveedores, p.direccion, p.telefono, p.razon_social, p.nombre_comercial, p.email, p.descripcion, p.pais, 
    p.ciudad, p.fecha_creacion, p.estado, p.nombrec, p.telefonoc, p.emailc, d.nombre AS nombre_dep, c.nombre AS nombre_cat 
    FROM proveedores p, departamentos d, categoria_producto c WHERE p.id_departamento = d.id AND p.categoria = c.id_categoria_producto " . $filtro;

    $resultadP2 = $conetar->query($cadena);

    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {

        $datos[] = array(
            'id_proveedores' => trim($filaP2['id_proveedores']),                      
            'direccion' => $filaP2['direccion'],                         
            'telefono' => $filaP2['telefono'],
            'razon_social' => $filaP2['razon_social'],
            'nombre_comercial' => $filaP2['nombre_comercial'],
            'email' => $filaP2['email'],
            'descripcion' => $filaP2['descripcion'],
            'pais' => $filaP2['pais'],
            'ciudad' => $filaP2['ciudad'],
            'fecha_creacion' => $filaP2['fecha_creacion'],
            'estado' => $filaP2['estado'],
            'nombrec' => $filaP2['nombrec'],
            'telefonoc' => $filaP2['telefonoc'],
            'emailc' => $filaP2['emailc'],
            'nombre_dep' => $filaP2['nombre_dep'],
            'nombre_cat' => $filaP2['nombre_cat'],
        );
    }

    header('Content-Type: application/json');
    $json_datos = json_encode($datos);
    echo $json_datos;


}


    
