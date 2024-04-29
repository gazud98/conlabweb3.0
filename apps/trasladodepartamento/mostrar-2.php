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

$filter = "";

if (isset($_GET['id_prodc'])) {
    $id_prodc = $_GET['id_prodc'];
    if ($id_prodc == "-1") {
        $id_prodc =  "";
    }
} else {
    $id_prodc = "";
}

if (isset($_GET['dep'])) {
    $dep = $_GET['dep'];
    if ($dep == "-1") {
        $dep =  "";
    }
} else {
    $dep = "";
}

if($dep = ""){
    $filter .= "AND d.id = '" . $dep . "'";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {

    $cadena = "SELECT p.nombre as producto, e.nombre as entrepanio, ord.id_ordencompra, ord.valor_total, CONCAT(em.nombre_1,' ',em.apellido_1) as empleado, d.nombre as departamento, m.idproducto, m.cant_recibida, m.unidadentrada, m.valorunidad, 
    m.unidaddetalle, m.fecha_entrega, 
    m.nofactura FROM movi_insumos m, producto p, bodegaentrepanio e, orden_compradetalle ord, persona em, departamentos d WHERE m.idproducto = p.id_producto AND m.identrepanio = e.id AND m.id_orden = ord.id_ordencompra AND m.idempleado = em.id_persona 
    AND m.depdestino = d.id " . $filter;
   
    /* */
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        
        $total = $filaP2['valor_total'] * $filaP2['cant_recibida'];
      
        $datos[] = array(
            'idproducto' => $filaP2['idproducto'],
            'producto' =>$filaP2['producto'],
            'departamento' => $filaP2['departamento'],
            'fecha_entrega' => $filaP2['fecha_entrega'],
            'cantidad' => $filaP2['cant_recibida'],
            'valor_total' => '$' . number_format($filaP2['valor_total']),
            'total' => '$' . number_format($total)
        );
    }
    echo json_encode($datos);
}
