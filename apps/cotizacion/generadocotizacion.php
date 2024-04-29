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
if (isset($_REQUEST['id_req'])) {
    $id_req = $_REQUEST['id_req'];
    if ($id_req == "-1") {
        $id_req = "";
    }
} else {
    $id_req = 0;
}

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    $cadena = "SELECT distinct id_proveedor
            FROM  u116753122_cw3completa.cotizacion_insumos
            where estado_cot='P'
                and consec_cot=0";

    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $id_proveedor = $filaP2['id_proveedor'];

            $cadenax = "select max(consec_cot)+1 as consecutivo
                from u116753122_cw3completa.cotizacion_insumos";
            $resultadP2x = $conetar->query($cadenax);
            $numerfiles2x = mysqli_num_rows($resultadP2x);
            if ($numerfiles2x >= 1) {
                $filaP2x = mysqli_fetch_array($resultadP2x);
                $consecutivo = $filaP2x['consecutivo'];
            }


            $cadenau = "update u116753122_cw3completa.cotizacion_insumos
                    set consec_cot='" . $consecutivo . "',
                    estado_cot = 'PP'
                    where id_proveedor='" . $id_proveedor . "'
                   
                        and estado_cot='P'
                        and consec_cot=0";

            $resultado = mysqli_query($conetar, $cadenau);
        }
    }
/*   $cadenat = "SELECT b.nombre,a.cantidad,a.id_req,a.id_producto
    FROM  u116753122_cw3completa.ordrequisicion_detalle a ,u116753122_cw3completa.producto b 
    where a.id_producto = b.id_producto
    and a.id_producto not in (select id_producto from  u116753122_cw3completa.cotizacion_insumos where    id_proveedor <>0 and norequisicion = '" . $id_req . "')
    and a.id_req = '" . $id_req . "' order by 1";

    $resultadP2t = $conetar->query($cadenat);
    $numerfiles2t = mysqli_num_rows($resultadP2t);
    echo $numerfiles2t;
    if ($numerfiles2t >= 1) {
   
            echo "Realizado";

    } else {
        $cadenaa = "update u116753122_cw3completa.ordrequisicion set estado='F' where id='" . $id_req . "'";
        echo $cadenaa;
        $resultadoa = mysqli_query($conetar, $cadenaa);
    }*/
}

