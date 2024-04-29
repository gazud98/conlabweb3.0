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
    echo $error;
} else {
    $datosJSON = $_REQUEST['datos'];

    $datos = json_decode($datosJSON);

?>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../../assets/dist/css/style.css">
    <link rel="stylesheet" href="../../assets/dist/css/tables-v1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@500&display=swap');

        * {}

        hr {
            color: #CFDEF3;
        }
    </style>


    <?php
    foreach ($datos as $objeto) {

        $id_proveedor = $objeto->id_proveedor;
    }


    ?>
    <div class="content-all" style="padding: 15px;">
        <div class="row" style="margin:auto;margin-bottom:40px;">

            <div class="col-md-6 container content-info-head" style="float:left;">

                <?php

                $cadena = "SELECT nombre_empresa, ciudad, direccion,telefono,direccion_electronica
FROM  u116753122_cw3completa.identificacion_empresa
where 1=1";
                $resultadP2 = $conetar->query($cadena);
                $numerfiles2 = mysqli_num_rows($resultadP2);
                date_default_timezone_set('America/Bogota');
                $fechaActual = date("d/m/Y");

                while ($filaP2 = mysqli_fetch_array($resultadP2)) { ?>
                    <!-- Modal body -->


                    <div class="col-md-12 col-lg-12" style="line-height: 1;font-size:20px;margin-bottom:40px;">
                        <strong>DIRECCIÓN:</strong>&nbsp;&nbsp;<?php echo $filaP2['direccion']; ?><br>
                        <strong>CIUDAD:</strong>&nbsp;&nbsp;<?php echo $filaP2['ciudad']; ?><br>
                        <strong>TEL:</strong>&nbsp;&nbsp;<?php echo $filaP2['telefono']; ?><br>
                        <strong>EMAIL:</strong>&nbsp;&nbsp;<?php echo $filaP2['direccion_electronica']; ?>
                    </div>


                <?php } ?>

            </div>
            <div class="col-md-6">
                <span for="" style="color: #9B0023; font-size: 18px;float:right;">
                    <img src="https://cw3.tierramontemariana.org/assets/image/logo.png" alt="" style="width: 250px;">
                </span>
            </div>




        </div>
    </div>
    <?php
    //createFile($email_prov);

    ?>
    <table class="table table-striped table-hover  text-nowrap table-sm" style="
    
     text-align:center;margin: 0px 20px 0px 0px">
        <thead>
            <tr>
                <th style="border: 1px solid #CFDEF3;">REFERENCIA</th>
                <th style="border: 1px solid #CFDEF3;">NOMBRE</th>
                <th style="border: 1px solid #CFDEF3;">CANTIDAD</th>
                <th style="border: 1px solid #CFDEF3;">PROVEEDOR</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($datos as $objeto) {
                $id_producto = $objeto->id_producto;
                $idreq = $objeto->idreq;
                $id_proveedor = $objeto->id_proveedor;

                $cadena23 = "SELECT pv.id_proveedores, p.id_producto, p.cantidad, pv.nombre_comercial, pv.email,p.id, p.id_req, c.nombre as pp, c.referencia 
                            FROM u116753122_cw3completa.ordrequisicion_detalle p, u116753122_cw3completa.proveedores pv, u116753122_cw3completa.producto c WHERE p.id_producto = '" . $id_producto . "' and p.id_req= '" . $idreq . "' and pv.id_proveedores = '" . $id_proveedor . "' and p.id_producto = c.id_producto;";

                $resultadP23 = $conetar->query($cadena23);
                $numerfiles23 = mysqli_num_rows($resultadP23);
                if ($numerfiles23 >= 1) {
                    while ($filaP23 = mysqli_fetch_array($resultadP23)) {
                        $referencia = $filaP23['referencia'];
                        $pp = $filaP23['pp'];
                        $cantidad = $filaP23['cantidad'];
                        $prove = $filaP23['nombre_comercial'];

                        echo "<tr>";
                        echo "<td>" . $referencia . "</td>";
                        echo "<td>" . $pp . "</td>";
                        echo "<td>" . $cantidad . "</td>";
                        echo "<td>" . $prove . "</td>";
                        echo "</tr>";
                    }
                }
            }
            ?>
        </tbody>
    </table><br><br>
<?php } ?>

<script>
    <?php
    if (isset($_REQUEST['aux'])) {
    ?>
        window.print()

    <?php } else {
    } ?>

    function printModal() {

        window.open('https://cw3.tierramontemariana.org/apps/cotizacion/modal-2.php?aux=1&datos=<?php echo $datosJSON?>');
    }
</script>