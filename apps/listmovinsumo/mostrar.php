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
    $filtro .= " AND a.fecha_entrega BETWEEN '" . date('d/m/Y', strtotime($fecha1)) . "' AND '" . date('d/m/Y', strtotime($fecha2)) . "'";
}


if (file_exists("config/accesosystems.php")) {
    include ("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include ("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include ("../../config/accesosystems.php");
        }
    }
}


$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {

    $cadena = "SELECT a.num_salida,a.idproducto,a.id_orden, p.nombre as nombre_producto, d.nombre as nombre_departamento, a.fecha_entrega, ABS(a.cant_recibida) as cant_recibida, a.valorunidad,f.nombre as entrepanio,bs.nombre as stand,e.nombre as bodega 
    FROM movi_insumos a, producto p, departamentos d , u116753122_cw3completa.bodegaentrepanio f,u116753122_cw3completa.bodegastand bs,u116753122_cw3completa.bodegas e 
    where a.idproducto = p.id_producto and d.id = a.depdestino and f.idstand= bs.id and a.identrepanio=f.id and bs.idbodega=e.id" . $filtro;
    //echo $cadena;
    /* */
    
    $v = 0;
    $c = 0;
    
    $thefile = 0;
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        $cadenax = "select valor_total
        from u116753122_cw3completa.orden_compradetalle where id_producto = '" . $filaP2['idproducto'] . "' and id_ordencompra = '" . $filaP2['id_orden'] . "'";
        $resultadP2x = $conetar->query($cadenax);
        $numerfiles2x = mysqli_num_rows($resultadP2x);
        if ($numerfiles2x >= 1) {
            $filaP2x = mysqli_fetch_array($resultadP2x);
            $valor_total = $filaP2x['valor_total'];
        }
        $valorxcant = $filaP2['cant_recibida'] * $valor_total;
        $valortotal = $filaP2['cant_recibida'] * $filaP2['valorunidad'];
        $thefile = $thefile + 1;
        
        $sql = "SELECT SUM(cd.valor_total) as valor, SUM(cd.cant_ordenada) AS cantidad, cd.id_ordencompra FROM orden_compra o, 
        orden_compradetalle cd WHERE o.id = cd.id_ordencompra AND cd.id_producto = '" . $filaP2['idproducto'] . "'";

        $rest = mysqli_query($conetar, $sql);

        while ($d = mysqli_fetch_array($rest)) {
            $v = $d['valor'];
            $c = $d['cantidad'];
        }
        
        $datos[] = array(
            'idproducto' => $filaP2['idproducto'],
            'num_salida' => $filaP2['num_salida'],
            'nombre_producto' => $filaP2['nombre_producto'],
            'nombre_departamento' => $filaP2['nombre_departamento'],
            'fecha_entrega' => $filaP2['fecha_entrega'],
            'cant_recibida' => $filaP2['cant_recibida'],
            'entrepanio' => $filaP2['entrepanio'],
            'stand' => $filaP2['stand'],
            'bodega' => $filaP2['bodega'],
            'valorunidad' => $valor_total,
            'valortotal' => $valorxcant,
            'valor_h' =>  $v / $c
        );
    }
    header('Content-Type: application/json');
    $json_datos = json_encode($datos);

    echo $json_datos;
}
?>