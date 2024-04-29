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
} else {

    $cadena = "SELECT a.idbodegaentrapanio,a.idproducto,a.identrepanio,d.id as idstand,e.id as idbodega,c.nombre as entrepanio,d.nombre 
    as stand,e.nombre as bodega,a.fchvence, SUM(a.cant_recibida) as cant,b.nombre ,b.referencia,a.fecha_ingreso, cg.nombre 
    AS categoria, cd.valor_total FROM bodegaubcproducto a JOIN producto b ON a.idproducto = b.id_producto JOIN bodegaentrepanio c 
    ON a.identrepanio = c.id JOIN bodegastand d ON c.idstand = d.id JOIN bodegas e ON d.idbodega = e.id INNER JOIN categoria_producto cg 
    ON b.id_categoria_producto = cg.id_categoria_producto INNER JOIN orden_compradetalle cd ON a.id_orden = cd.id_ordencompra 
    WHERE a.identrepanio <> 0 AND a.cant_recibida <> 0 GROUP BY a.fchvence,a.identrepanio HAVING cant<>0 Order by a.fchvence ASC";

    /* */
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {

        $val = "";

        $fechaActual = date('Y-m-d');
        $fechaVence = $filaP2['fchvence'];

        $fecha_fabricacion_obj = new DateTime($fechaVence);
        $fecha_actual_obj = new DateTime($fechaActual);

        $diferencia = $fecha_fabricacion_obj->diff($fecha_actual_obj);

        $dias_vida = $diferencia->days;

        if($fechaVence <= $fechaActual){
            $val = '<span style="color:red;"> Días vencidos: '. $dias_vida .'</span>';
        }else{
            $val = $dias_vida;
        }

        $datos[] = array(

            'identrepanio' => $filaP2['identrepanio'],
            'idproducto' => $filaP2['idproducto'],
            'nombre' => $filaP2['nombre'],
            'bodega' => trim($filaP2['bodega']),
            'stand' => $filaP2['stand'],
            'entrepanio' => $filaP2['entrepanio'],
            'cant' => $filaP2['cant'],
            'fchvence' => $filaP2['fchvence'],
            'referencia' => $filaP2['referencia'],
            'fecha_ingreso' => date('Y-m-d', strtotime($filaP2['fecha_ingreso'])),
            'dias' => $val,
            'categoria' => $filaP2['categoria'],
            'valor_unitario' => $filaP2['valor_total'],
            'valor_total' => $filaP2['valor_total'] * $filaP2['cant'],
        );
    }
    echo json_encode($datos);
}
