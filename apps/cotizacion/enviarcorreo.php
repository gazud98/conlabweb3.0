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
if (isset($_REQUEST['idreq'])) {
    $idr = $_REQUEST['idreq'];
} else {
    $idr = 0;
}
require 'send-and-create.php';


$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
?>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@500&display=swap');

        * {
            font-family: 'IBM Plex Mono', monospace !important;
        }
        hr{
            color: #CFDEF3;
        }
    </style>


    <?php


    $cadena = "SELECT distinct a.id_proveedor,a.norequisicion,a.fecha,b.email
           FROM  u116753122_cw3completa.cotizacion_insumos a, u116753122_cw3completa.proveedores b
            where a.estado_cot='PP' and a.norequisicion = '$idr' and b.id_proveedores = a.id_proveedor";

    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $id_proveedor = $filaP2['id_proveedor'];
            $email_prov = $filaP2['email'];
            $norequisicion = $filaP2['norequisicion'];
            $fecha = $filaP2['fecha'];
    ?>
            <div class="row content-header">
                <div class="col-md-6" style="width: 30%;">
                    <!--<h2><img src="../assets/image/logopequenio.png" alt=""></h2>-->
                    <span for="" style="color: #9B0023; font-size: 12px;">PASTEUR LABORATORIOS</span>
                </div>
                <div class="col-md-6" style="width: 30%;">
                    <span style=""><strong style="color:#164085; font-size: 10px;">Fecha: &nbsp;<?php echo $fecha; ?></strong></span>
                </div>
                <div class="col-md-6" style="width: 40%;">
                    <p style="font-size: 10px;">
                        El siguiente número debe aparecer en todas las facturas, conocimientos de embarque,
                        y reconocimientos relacionados con este:
                    </p>
                    <div class="alert alert-default-primary" role="alert" style="
                    font-size: 10px;
                    border: 1px solid #DFB9B9;">
                        <span style=""><strong style="color:#164085;">Solicitud de insumos: &nbsp;#<?php echo $norequisicion ?></strong></span>
                    </div>
                </div>
            </div>
            <table style="font-size: 10px;">

                <thead>
                    <tr>
                        <th style="border: 1px solid #CFDEF3;">ID PRODUCTO</th>
                        <th style="border: 1px solid #CFDEF3;">FECHA</th>
                        <th style="border: 1px solid #CFDEF3;">CANTIDAD</th>
                        <th style="border: 1px solid #CFDEF3;">NOMBRE</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $cadena23 = "SELECT p.id_proveedor, p.id_producto, p.cantidad, p.fecha, pv.nombre_comercial, 
                                 pv.email, a.id, a.id_req, c.nombre as pp FROM u116753122_cw3completa.cotizacion_insumos p 
                                 INNER JOIN u116753122_cw3completa.ordrequisicion_detalle a ON p.norequisicion = a.id_req 
                                 INNER JOIN u116753122_cw3completa.proveedores pv ON p.id_proveedor = pv.id_proveedores 
                                 INNER JOIN u116753122_cw3completa.producto c ON a.id_producto = c.id_producto 
                                 WHERE p.id_proveedor = '$id_proveedor' and a.id_producto = p.id_producto and p.norequisicion='$idr';";

                    $resultadP23 = $conetar->query($cadena23);
                    $numerfiles23 = mysqli_num_rows($resultadP23);
                    if ($numerfiles23 >= 1) {
                        while ($filaP23 = mysqli_fetch_array($resultadP23)) {
                            $id_producto = $filaP23['id_producto'];
                            $fecha = $filaP23['fecha'];
                            $cantidad = $filaP23['cantidad'];
                            $pp = $filaP23['pp'];
                    ?>

                            <tr>
                                <td style="border: 1px solid #CFDEF3;"><?php echo $id_producto; ?></td>
                                <td style="border: 1px solid #CFDEF3;"><?php echo $fecha; ?></td>
                                <td style="border: 1px solid #CFDEF3;"><?php echo $cantidad; ?></td>
                                <td style="border: 1px solid #CFDEF3;"><?php echo $pp; ?></td>
                            </tr>

                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table><br><br>

            <hr>
    <?php
            createFile($email_prov);
        }
    }
    ?>

<?php } ?>