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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

//echo '.......<br>'.'...'.hostname.','.db_login.','.cw3ctrlsrv.'???'.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    $cadena = "SELECT distinct id_proveedor 
            FROM u116753122_cw3completa.orden_compratemp ";

    // echo $cadena;

    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $id_proveedor = $filaP2['id_proveedor'];
            date_default_timezone_set('America/Bogota');
            $fechaActual = date("d/m/Y");
            $horaActual = date("h:i:s");


            $cadena21 = "insert into u116753122_cw3completa.orden_compra(fecha,hora,id_proveedor,estado_orden)values('" .
                $fechaActual .
                "','" . $horaActual .
                "','" . $id_proveedor .
                "','P')";

            //echo $cadena21;
            $resultado21 = mysqli_query($conetar, $cadena21);


            $cadena3 = "select id
                    from u116753122_cw3completa.orden_compra
                    where fecha='" . $fechaActual . "'
                        and hora='" . $horaActual . "'
                        and id_proveedor='" . $id_proveedor . "'";
            $resultadP22 = $conetar->query($cadena3);
            $numerfiles22 = mysqli_num_rows($resultadP22);
            if ($numerfiles22 >= 1) {
                $filaP22 = mysqli_fetch_array($resultadP22);
                $idordencompra = $filaP22['id'];
            }


            $cadena4 = "SELECT a.id,a.numcotiza,a.id_proveedor,b.nombre_comercial,a.id_producto,c.nombre,a.cantidad,a.valor 
        FROM u116753122_cw3completa.orden_compratemp a , u116753122_cw3completa.proveedores b,u116753122_cw3completa.producto c 
        where a.id_proveedor=b.id_proveedores and a.id_producto=c.id_producto 
            and a.id_proveedor='" . $id_proveedor . "'";
            $resultadP23 = $conetar->query($cadena4);
            $numerfiles23 = mysqli_num_rows($resultadP23);
            if ($numerfiles23 >= 1) {
                while ($filaP23 = mysqli_fetch_array($resultadP23)) {
                    $idx = $filaP23['id'];
                    $id_producto = $filaP23['id_producto'];
                    $id_proveedor = $filaP23['id_proveedor'];
                    $cantidad = $filaP23['cantidad'];
                    $valor = $filaP23['valor'];
                    $numcotiza = $filaP23['numcotiza'];
                    $cadena4 = "insert into u116753122_cw3completa.orden_compradetalle
                        (id_ordencompra,id_producto,cant_ordenada,valor_total)values('" .
                        $idordencompra .
                        "','" . $id_producto .
                        "','" . $cantidad .
                        "','" . $valor . "')";
                    $resultado4 = mysqli_query($conetar, $cadena4);

                    $cadena8 = "insert into u116753122_cw3completa.bodegaubcproducto
                    (idproducto,id_orden,valorunidad)values('" . $id_producto . "','" . $idordencompra . "','" . $valor . "')";
                    $resultado8 = mysqli_query($conetar, $cadena8);

                    $cadena4x = "update u116753122_cw3completa.cotizacion_insumos
                                set estado_cot='O',
                                   numorden='" . $idordencompra . "'
                                where id='" . $numcotiza . "'";
                    $resultado6 = mysqli_query($conetar, $cadena4x);
                    $cadena5x = "update u116753122_cw3completa.ordrequisicion
                                set estado_cot='F'
                                where id='" . $numcotiza . "'";
                    $resultado5 = mysqli_query($conetar, $cadena5x);
                    echo $cadena4x;
                }
            }
        } //del while de orden comra
    }



    $cadena = "DELETE  FROM u116753122_cw3completa.orden_compratemp";
    $resultado = mysqli_query($conetar, $cadena);
}
