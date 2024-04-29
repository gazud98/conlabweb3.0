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
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ")" . $conetar->connect_error;
} else {

    $tip = $_REQUEST['tip'];
    $id = $_REQUEST['id'];
    $daño = "";

    if ($tip == 'C') {
        $cadena = "SELECT p.id,p.fecha_final,p.daño,p.estado_mantenimiento,p.estado,p.aux,p.tecnico,
        p.valor_servicio,a.nombre,r.resultado_c,e.nombre_comercial FROM 
            correctivo p, producto a, resultado_correctivo r, 
            proveedores e
            WHERE a.id_producto = p.equipo AND p.id = r.idmantenimiento_c AND p.empresa = e.id_proveedores 
            AND p.id = '$id'";

        $thefile = 0;
        $resultadP2 = $conetar->query($cadena);
        $datos = array();
        $rows = mysqli_num_rows($resultadP2);
        
        if($rows == 0){
                $fecha = "";
                $aux = "";
                $resultado_c = "";
                $empresa = "";
                $tecnico = "";
                $equipo = "";
                $daño = "";
                $valor_servicio = "";
        }else{
            while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                $fecha = $filaP2['fecha_final'];
                $aux = $filaP2['aux'];
                $resultado_c = $filaP2['resultado_c'];
                $empresa = $filaP2['nombre_comercial'];
                $tecnico = $filaP2['tecnico'];
                $equipo = $filaP2['nombre'];
                $daño = $filaP2['daño'];
                $valor_servicio = $filaP2['valor_servicio'];
            }
        }
        
    } else if ($tip == 'P') {
        $cadena = "SELECT p.id,p.comienzo,p.desc_mantenimiento,p.estado,p.estado_mantenimiento,p.aux, CONCAT(c.nombre_1, ' ', c.apellido_1) AS resp,p.comienzo,p.fecha_final, p.resp_mantenimiento, a.nombre,r.resultado_p,s.nombre AS sede, po.nombre_comercial, pg.id_proveegarantia FROM u116753122_cw3completa.preventiva p, u116753122_cw3completa.persona c, u116753122_cw3completa.producto a, u116753122_cw3completa.resultado_preventivo r, u116753122_cw3completa.sedes s, u116753122_cw3completa.proveedores po, u116753122_cw3completa.producto_activofijo pg WHERE po.id_proveedores = p.responsable AND a.id_producto = p.equipo AND p.id = r.idmantenimiento_p AND p.id_sede = s.id_sedes AND p.id_proveedor = po.id_proveedores";
        //echo $cadena;
        /* */
        $thefile = 0;
        $resultadP2 = $conetar->query($cadena);
        $datos = array();
        $rows = mysqli_num_rows($resultadP2);
        if($rows == 0){
                $fecha = "";
                $aux = "";
                $resultado_c = "";
                $nombre_comercial = "";
                $tecnico = "";
                $empresa = "";
                $comienzo = "";
                $sede = "";
                $equipo = "";
        }else{
            while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                $fecha = $filaP2['fecha_final'];
                $aux = $filaP2['aux'];
                $resultado_c = $filaP2['desc_mantenimiento'];
                $nombre_comercial = $filaP2['nombre_comercial'];
                $tecnico = $filaP2['resp'];
                $empresa = $filaP2['resp_mantenimiento'];
                $comienzo = $filaP2['comienzo'];
                $sede = $filaP2['sede'];
                $equipo = $filaP2['nombre'];
            }
        }
    }

?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        .tr {
            text-align: center;
            color: #164085;
            font-size: 13px;
        }

        .table-head {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .table-head tr td {
            border: 1px dashed #C4C4C4;
            text-align: left;
            font-size: 13px;
            padding: 3px;
        }

        .title-orden {
            text-align: center;
            margin-top: 10px;
        }

        .content-head {
            border: 1px solid #96B8CF;
        }

        .table-contenido {
            width: 100%;
            margin-bottom: 10px;
        }

        .table-contenido tr td {
            border: 1px solid #C4C4C4;
            text-align: left;
            font-size: 13px;
            padding: 3px;
        }

        .table-retes tr td {
            border: 1px solid #C4C4C4;
            text-align: right;
        }
    </style>

    <div class="content-all container-fluid p-5">
        <div class="row content-head">
            <div class="col-md-4 col-lg-4">
                <div style="text-align: left;">
                    <img style="width: 250px;" src="../../assets/image/logo.png" alt="">
                </div>
            </div>
            <div class="col-md-4 col-lg-4" style="text-align: center;margin-top:30px;">

                <h4>
                    Reporte de mantenimiento
                </h4>

            </div>
            <div class="col-md-4 col-lg-4" style="text-align: left;">

                <p>
                    Código: GIN-FOR-003 <br>
                    Versión: 1 <br>
                    Fecha: 2023/07/21 <br>
                    Página:1 de 1 <br>
                </p>

            </div>
            <!--<div class="col-md-4">
            <div class="col-md-12 col-lg-12 alert" role="alert" style="text-align:left;font-size: 12px;background:#E1F8FA;">
                <p>El siguiente número debe aparecer en todas las facturas, conocimientos de embarque y reconocimientos relacionados con esta orden de compra: PO:<br><strong style="color:#500450;">&nbsp;&nbsp;&nbsp; PURCHASE ORDER:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $id ?></strong></p>
            </div>
        </div>-->
        </div>

        <br>
        <div class="row">

            <table class="col-md-12 table-info-mant">
                <thead>
                    <tr style="text-align: center;border:1px solid #96B8CF;">
                        <th>Información del Solicitante</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border:1px solid #96B8CF;">
                        <td class="p-3">
                            <table>
                                <tr>
                                    <?php
                                    if ($aux == 'P') {

                                    ?>

                                        <td>&nbsp;&nbsp;<strong>Fecha</strong>:</td>
                                        <td><?php echo $fecha; ?></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td><strong>Solicitante</strong>:</td>
                                        <td>Yorcelys Varela</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Sede</strong>:</td>
                                        <td><?php echo $sede; ?></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Equipo</strong>:</td>
                                        <td><?php echo $equipo; ?></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Proveedor</strong>:</td>
                                        <td><?php echo $nombre_comercial; ?></td>

                                    <?php
                                    } else {

                                    ?>

                                        <td>&nbsp;&nbsp;<strong>Fecha</strong>:</td>
                                        <td><?php echo $fecha; ?></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td><strong>Solicitante</strong>:</td>
                                        <td>Yorcelys Varela</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Equipo</strong>:</td>
                                        <td><?php echo $equipo; ?></td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Daño</strong>:</td>
                                        <td><?php echo $daño; ?></td>

                                        <?php
                                    }
                                        ?>
                        </td>

                    </tr>
            </table>
            </td>
            </tr>
            </tbody>
            </table>

            <table class="col-md-12 table-info-mant" style="margin-top: 10px;">
                <thead>
                    <tr style="text-align: center;border:1px solid #96B8CF;">
                        <th>Información y Tipo de Mantenimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border:1px solid #96B8CF;">
                        <td class="p-3">
                            <table>
                                <tr>
                                    <td>Preventivo</td>
                                    <td style="border:1px solid #000;"><?php
                                                                        if ($aux == 'P') {
                                                                            echo 'X';
                                                                        } else {
                                                                            echo '&nbsp;&nbsp;&nbsp;';
                                                                        }
                                                                        ?>&nbsp;&nbsp;</td>
                                    <td>Correctivo</td>
                                    <td style="border:1px solid #000;"><?php
                                                                        if ($aux == 'C') {
                                                                            echo 'X';
                                                                        } else {
                                                                            echo '&nbsp;&nbsp;&nbsp;';
                                                                        }
                                                                        ?>&nbsp;&nbsp;</td>

                                </tr>
                            </table>
                        </td>
                        <td><strong>Descripción</strong>:</td>
                        <td>
                            <textarea name="" id="" cols="50" rows="3" style="text-align: left;">
                            <?php 
                            
                            echo $resultado_c; 
                            
                            ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="margin-top: 10px;">
                                <tr>
                                    <th>Atendido por:</th>
                                </tr>
                                <tr>
                                    <?php
                                    
                                        if($tip == 'P'){

                                    ?>
                                    <td><strong>Nombre</strong>:</td>
                                    <td><?php echo $tecnico; ?></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td><strong>Empresa</strong>:</td>
                                    <td><?php echo $empresa; ?></td>
                                    <?php
                                    } else {
                                    ?>
                                    <td><strong>Nombre</strong>:</td>
                                    <td><?php echo $tecnico; ?></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td><strong>Empresa</strong>:</td>
                                    <td><?php echo $empresa; ?></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td><strong>Valor del servicio</strong>:</td>
                                    <td>$<?php echo $valor_servicio; ?></td>
                                    <?php } ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="content-ob" style="margin-top: 20px;">
            <label for="">Observaciones:</label><br>
            <textarea name="" id="" cols="100" rows="5"></textarea>
        </div>

        <div class="content-btn-print mt-5">
            <button class="btn btn-primary btn-sm" onclick="printReport2()"><i class="fa-solid fa-print"></i>&nbsp;Imprimir</button>
        </div>

    </div>

    <!-- jQuery -->
    <script src="./assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="./assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="./assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="./assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./assets/dist/js/demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        function printReport2() {
            $('.content-btn-print').css("display", "none");
            window.print();
        }
    </script>

<?php

}

?>