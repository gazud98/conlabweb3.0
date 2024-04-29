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

if (isset($_GET['id_prodc'])) {
    $id_prodc = $_GET['id_prodc'];
    if ($id_prodc == "-1") {
        $id_prodc =  "";
    }
} else {
    $id_prodc = "";
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
} else {

    $cadena = "SELECT a.idbodegaentrapanio,a.idproducto,a.identrepanio,d.id as idstand,e.id as idbodega,c.nombre as entrepanio,d.nombre as stand,e.nombre as bodega,a.fchvence, SUM(a.cant_recibida) as cant,b.nombre ,@row_number := @row_number + 1 as numero_file
    FROM u116753122_cw3completa.bodegaubcproducto a join (select @row_number := 0) as init  JOIN u116753122_cw3completa.producto b ON a.idproducto = b.id_producto JOIN u116753122_cw3completa.bodegaentrepanio c
    ON a.identrepanio = c.id JOIN u116753122_cw3completa.bodegastand d ON c.idstand = d.id JOIN u116753122_cw3completa.bodegas e ON d.idbodega = e.id 
    WHERE a.identrepanio <> 0 AND a.cant_recibida <> 0 AND a.idproducto like '%".$id_prodc."%' GROUP BY a.fchvence,a.identrepanio HAVING cant <> 0 ORDER BY  numero_file ASC";
  
    /* */
    $resultadP2 = $conetar->query($cadena);
    $datos = array();
    while ($filaP2 = mysqli_fetch_array($resultadP2)) {
      
        $datos[] = array(
            'thefile' =>   $filaP2['numero_file'],
            'identrepanio' => $filaP2['identrepanio'],
            'idproducto' => $filaP2['idproducto'],
            'nombre' =>$filaP2['nombre'],
            'bodega' => trim($filaP2['bodega']),
            'stand' => $filaP2['stand'],
            'entrepanio' => $filaP2['entrepanio'],
            'cant' => $filaP2['cant'],
            'fchvence' => $filaP2['fchvence'],
        );
    }
    echo json_encode($datos);
}
