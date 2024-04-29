<?php

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

// Crea una variable para el filtro SQL
$filtro = " and 1=1"; // Filtro base

if ($fecha1 != '' && $fecha2 != '') {
    $filtro .= " AND c.fecha BETWEEN '" . date('d/m/Y', strtotime($fecha1)) . "' AND '" . date('d/m/Y', strtotime($fecha2)) . "'";
}


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
} else {

    $cadena = "select DISTINCT c.id, c.fecha,f.nofactura, d.cant_ordenada,d.valor_total,b.nombre_comercial as proveedor, p.nombre as nombre_producto from u116753122_cw3completa.proveedores b , u116753122_cw3completa.orden_compra c , u116753122_cw3completa.orden_compradetalle d, u116753122_cw3completa.producto p, u116753122_cw3completa.bodegaubcproducto f where c.id_proveedor = b.id_proveedores and c.id = d.id_ordencompra and p.id_producto = d.id_producto and f.id_orden = c.id and f.nofactura <>0 ". $filtro;
    //echo $cadena;
    /* */
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
       $vt =  $filaP2['cant_ordenada']* $filaP2['valor_total'];
        $thefile = $thefile + 1;
        $datos[] = array(
            
            'id' => $filaP2['id'],
            'fecha' => $filaP2['fecha'],
            'nofactura' => $filaP2['nofactura'],
            'cant_ordenada' => $filaP2['cant_ordenada'],
            'proveedor' => $filaP2['proveedor'],
            'nombre_producto' =>  $filaP2['nombre_producto'],
            'valor_total' =>  $vt,
            'valor_unitario' =>  $filaP2['valor_total']
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
