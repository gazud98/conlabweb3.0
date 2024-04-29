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
    $filtro .= " AND a.fecha_ingreso BETWEEN '" . date('Y-d-m', strtotime($fecha1)) . "' AND '" . date('Y-d-m', strtotime($fecha2)) . "'";
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

    $cadena = "SELECT b.referencia,a.identrepanio,a.idproducto,a.identrepanio,d.id as idstand,e.id as idbodega,c.nombre as entrepanio,d.nombre 
    as stand,e.nombre as bodega,a.fchvence,a.fecha_ingreso, SUM(a.cant_recibida) as cant,b.nombre ,@row_number := @row_number + 1 as numero_file, 
    oc.valor_total, oc.id_ordencompra,a.id_origen
     FROM traslado a join (select @row_number := 0) as init JOIN producto b ON a.idproducto = b.id_producto 
    INNER JOIN orden_compradetalle oc ON
    oc.id_ordencompra = a.id_orden JOIN bodegaentrepanio c ON a.identrepanio = c.id JOIN bodegastand d ON c.idstand = d.id JOIN bodegas e 
    ON d.idbodega = e.id WHERE a.identrepanio <> 0 AND a.cant_recibida <> 0 " . $filtro . " GROUP BY a.fchvence,a.identrepanio HAVING 
    cant <> 0 ORDER BY numero_file ASC";
    //echo $cadena;
    /* */
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {

        $cadenax = "select f.nombre as entrepanio,bs.nombre as stand,e.nombre as bodega 
        from u116753122_cw3completa.bodegaubcproducto a, u116753122_cw3completa.bodegaentrepanio f,u116753122_cw3completa.bodegastand bs,u116753122_cw3completa.bodegas e 
        where a.idbodegaentrapanio = '".$filaP2['id_origen']."' and f.idstand= bs.id and a.identrepanio=f.id and bs.idbodega=e.id";
        $resultadP2x = $conetar->query($cadenax);
        $numerfiles2x = mysqli_num_rows($resultadP2x);
       
        if ($numerfiles2x >= 1) {
            $filaP2x = mysqli_fetch_array($resultadP2x);
            $entrepanio = $filaP2x['entrepanio'];
            $stand = $filaP2x['stand'];
            $bodega = $filaP2x['bodega'];
        }
        $thefile = $thefile + 1;
        $datos[] = array(
            
            'fecha_ingreso' => $filaP2['fecha_ingreso'],
            'cant' => $filaP2['cant'],
            'nombre' =>  $filaP2['nombre'],
            'bodega' =>  $filaP2['bodega'],
            'stand' =>  $filaP2['stand'],
            'entrepanio' =>  $filaP2['entrepanio'],
            'bodegaorg' =>  $bodega,
            'standorg' =>  $stand,
            'entrepanioorg' =>  $entrepanio,
            'valor_total' => $filaP2['valor_total'] * $filaP2['cant'],
            'valor_unitario' => $filaP2['valor_total'],
            'id_ordencompra' => $filaP2['id_ordencompra'] ,
            'referencia' => $filaP2['referencia'] 
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
