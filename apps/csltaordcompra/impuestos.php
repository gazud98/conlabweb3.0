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



    function calcularIVA($monto, $tasaIVA)
    {
        // Verificamos si la tasa de IVA es un porcentaje (por ejemplo, 19 para 19%)
        if ($tasaIVA < 0 || $tasaIVA > 100) {
            return 0;
        }

        // Calculamos el IVA
        $iva = ($monto * $tasaIVA) / 100;

        // Devolvemos el resultado
        return $iva;
    }

    $id_ord = $_POST['id_ord'];

    $cadena = "SELECT  b.id_proveedor
    FROM  u116753122_cw3completa.orden_compra b 
    where   b.id =" . $id_ord;
    $resultadP = $conetar->query($cadena);
    $numerfiles = mysqli_num_rows($resultadP);
    $thefile = 0;
    if ($numerfiles >= 1) {
        $thefile = 0;
        while ($fila = mysqli_fetch_array($resultadP)) {

            $id_proveedor = $fila['id_proveedor'];
        }
    }

    $gran_contribuyente = "";
    $regimen_comun = "";
    $autorretenedor = "";
    $regimen_simple = "";
    $cadena2 = "SELECT a.id_regimen, a.ciudad
    FROM  u116753122_cw3completa.proveedores a 
    where id_proveedores = " . $id_proveedor;
    $resultadP2 = $conetar->query($cadena2);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    $thefile = 0;
    if ($numerfiles2 >= 1) {
        $thefile = 0;
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $id_regimen = $filaP2['id_regimen'];
            $ciudad = $filaP2['ciudad'];
        }
    }


    $array = explode(",", preg_replace('/,+/', ',', $id_regimen));
    $length = count($array);
    foreach ($array as $valor) {
        // Dentro de este bucle, $valor contendrá cada elemento del array uno por uno
        if ($valor == "2") {
            $gran_contribuyente = "GC";
        } else if ($valor == "3") {
            $regimen_comun = "RG";
        } else if ($valor == "7") {
            $regimen_simple = "RS";
        } else if ($valor == "9") {
            $autorretenedor = "AU";
        }
    }


    if (isset($regimen_comun) ||  $ciudad == 4 || $regimen_comun == "RG") {

        $cadena = "SELECT  a.id_proveedor, b.cant_ordenada,b.valor_total,c.referencia, c.cod_contable, c.iva
        FROM  u116753122_cw3completa.orden_compra a, u116753122_cw3completa.orden_compradetalle b, u116753122_cw3completa.producto c
        where a.id = b.id_ordencompra and c.id_producto =b.id_producto and a.id =" . $id_ord;
        $resultadP = $conetar->query($cadena);
        $numerfiles = mysqli_num_rows($resultadP);
        $debito = 0;
        $ivatotal = 0;
        if ($numerfiles >= 1) {

            while ($fila = mysqli_fetch_array($resultadP)) {
                if (($fila['iva']) != 0) {
                    $iva = $fila['iva'];
                }

                $id_proveedor = $fila['id_proveedor'];
                $cant_ordenada = $fila['cant_ordenada'];
                $valor_total = $fila['valor_total'];
                $valorreci = $valor_total *  $cant_ordenada;
                $debito = $debito +  $valorreci;
            }
        }

        $ivatotal =  calcularIVA($debito, $iva);

        $totaldebito = $debito +  $ivatotal;

        $cadena = "SELECT porcentaje_uvt, codigo_cuenta
        FROM   u116753122_cw3completa.config_impuestos 
        where id_config_imp =1 ";
        $resultadP = $conetar->query($cadena);
        $numerfiles = mysqli_num_rows($resultadP);
        $thefile = 0;
        if ($numerfiles >= 1) {
            $thefile = 0;
            while ($fila = mysqli_fetch_array($resultadP)) {

                $porcentaje_uvt = $fila['porcentaje_uvt'];
                $codigo_cuenta = $fila['codigo_cuenta'];
            }
        }
        $porcentaje_uvt;

        $retefuente = $debito * ($porcentaje_uvt / 100);
        $reteica = $debito * (10 / 1000);

        $total = $totaldebito - ($retefuente + $reteica);
    } else if (isset($regimen_comun) ||  $ciudad == 4 || $regimen_comun == "GC") {
        $cadena = "SELECT  a.id_proveedor, b.cant_ordenada,b.valor_total,c.referencia, c.cod_contable, c.iva
        FROM  u116753122_cw3completa.orden_compra a, u116753122_cw3completa.orden_compradetalle b, u116753122_cw3completa.producto c
        where a.id = b.id_ordencompra and c.id_producto =b.id_producto and a.id =" . $id_ord;
        $resultadP = $conetar->query($cadena);
        $numerfiles = mysqli_num_rows($resultadP);
        $debito = 0;
        $ivatotal = 0;
        if ($numerfiles >= 1) {

            while ($fila = mysqli_fetch_array($resultadP)) {
                if (($fila['iva']) != 0) {
                    $iva = $fila['iva'];
                }

                $id_proveedor = $fila['id_proveedor'];
                $cant_ordenada = $fila['cant_ordenada'];
                $valor_total = $fila['valor_total'];
                $valorreci = $valor_total *  $cant_ordenada;
                $debito = $debito +  $valorreci;
            }
        }

        $ivatotal =  calcularIVA($debito, $iva);

        $totaldebito = $debito +  $ivatotal;

        $cadena = "SELECT porcentaje_uvt, codigo_cuenta
        FROM   u116753122_cw3completa.config_impuestos 
        where id_config_imp =1 ";
        $resultadP = $conetar->query($cadena);
        $numerfiles = mysqli_num_rows($resultadP);
        $thefile = 0;
        if ($numerfiles >= 1) {
            $thefile = 0;
            while ($fila = mysqli_fetch_array($resultadP)) {

                $porcentaje_uvt = $fila['porcentaje_uvt'];
                $codigo_cuenta = $fila['codigo_cuenta'];
            }
        }
        $porcentaje_uvt;

        $retefuente = $debito * ($porcentaje_uvt / 100);
     

        $total = $totaldebito - $retefuente;

        echo $total;
    }
}
