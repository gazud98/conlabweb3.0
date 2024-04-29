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
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = 0;
    }

    $cadena = "SELECT nombre_empresa, ciudad, direccion,telefono,direccion_electronica
FROM  u116753122_cw3completa.identificacion_empresa
where 1=1";
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    date_default_timezone_set('America/Bogota');
    $fechaActual = date("d/m/Y");

    function calcularIVA($monto, $tasaIVA)
    {
        if ($tasaIVA < 0 || $tasaIVA > 100) {
            return 0;
        }
        // Calcula el monto del IVA
        $iva = ($monto * $tasaIVA) / 100;

        // Retorna el monto del IVA
        return $iva;
    }



?>

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
            border: 1px solid #DAE8EF;
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

    <div>
        <div class="row content-head">
            <div class="col-md-6 col-lg-6">
                <div style="text-align: left;">
                    <img style="width: 250px;" src="./assets/image/logo.png" alt="">
                </div>
            </div>
            <div class="col-md-6 col-lg-6" style="text-align: right;">
                <?php while ($filaP2 = mysqli_fetch_array($resultadP2)) { ?>
                    <!-- Modal body -->
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <span><?php echo $filaP2['direccion']; ?>&nbsp;<i class="fa-solid fa-location-dot"></i></span><br>
                            <span><?php echo $filaP2['ciudad']; ?></span><br>
                            <span><?php echo $filaP2['telefono']; ?>&nbsp;<i class="fa-solid fa-phone"></i></span><br>
                            <label></label><?php echo $filaP2['direccion_electronica']; ?>&nbsp;<i class="fa-solid fa-envelope"></i>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!--<div class="col-md-4">
            <div class="col-md-12 col-lg-12 alert" role="alert" style="text-align:left;font-size: 12px;background:#E1F8FA;">
                <p>El siguiente número debe aparecer en todas las facturas, conocimientos de embarque y reconocimientos relacionados con esta orden de compra: PO:<br><strong style="color:#500450;">&nbsp;&nbsp;&nbsp; PURCHASE ORDER:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $id ?></strong></p>
            </div>
        </div>-->
        </div>

        <div class="title-orden container">
            <h4>ORDEN DE COMPRA Y/O SERVICIO N° <?php echo $id ?></h4>
        </div>

        <table class="table-head">
            <?php $cadena = "SELECT p.id_proveedores, p.nombre_comercial, p.direccion, p.ciudad, p.telefono,
            p.email, p.plazo_dias,p.numero_identificacion
            FROM u116753122_cw3completa.orden_compra a, u116753122_cw3completa.proveedores p where a.id_proveedor = 
            p.id_proveedores and a.id = " . $id;
            
            $resultadP2 = $conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);
            $sum = 0;
            while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            ?>
                <tr>
                    <td style="width:500px;">PROVEEDOR: <strong><?php echo $filaP2['nombre_comercial']; ?></strong></td>
                    <td style="width:400px;">NIT: <strong><?php echo $filaP2['numero_identificacion']; ?></strong></td>
                    <td style="width:400px;">FECHA: <strong>2023-08-11</strong></td>
                </tr>
                <tr>
                    <td style="width:500px;">CONTACTO: <strong></strong></td>
                    <td style="width:450px;">CIUDAD: <strong><?php echo $filaP2['ciudad']; ?></strong></td>
                    <td style="width:450px;">TELÉFONO: <strong><?php echo $filaP2['telefono']; ?></strong></td>
                </tr>
                <tr>
                    <td style="width:500px;">EMAIL: <strong><?php echo $filaP2['email']; ?> </strong></td>
                    <td style="width:450px;">MONEDA: <strong>Peso colombiano</strong></td>
                    <td style="width:450px;">BODEGA: <strong>ALMACEN PRINCIPAL</strong></td>
                </tr>
                <tr>
                    <td style="width:500px;" colspan="2">DIRECCIÓN: <strong><?php echo $filaP2['direccion']; ?> </strong></td>
                    <td style="width:450px;">FACTURA: <strong>TE200265</strong></td>
                </tr>
                <tr>
                    <td style="width:500px;" colspan="2">DESCRIPCIÓN: <strong>PEDIDO AGOSTO REACTIVOS</strong></td>
                    <td style="width:450px;">FORMA DE PAGO: <strong><?php echo $filaP2['plazo_dias']; ?></strong></td>
                </tr>
            <?php } ?>
        </table>

        <table class="table-contenido" style="border: 1px solid #F8F8F8;">
            <thead>
                <tr class="tr" style="background-color: #386BBF; color:#fff;">
                    <th style="border: 1px solid #F8F8F8;">REFERENCIA</th>
                    <th style="border: 1px solid #F8F8F8;">PRODUCTO</th>
                    <th style="border: 1px solid #F8F8F8;">CANTIDAD</th>
                    <th style="border: 1px solid #F8F8F8;">PRECIO UNITARIO</th>
                    <th style="border: 1px solid #F8F8F8;">SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php $cadena = "SELECT a.id,c.cant_ordenada,c.valor_total,b.nombre,
                (c.cant_ordenada)*(c.valor_total) as total,c.id_producto,IFNULL(b.iva, 0) AS iva,b.referencia
            FROM u116753122_cw3completa.orden_compra a, u116753122_cw3completa.producto b,u116753122_cw3completa.orden_compradetalle c
            where b.id_producto=c.id_producto and a.id = c.id_ordencompra  and a.id =" . $id;

                $resultadP2 = $conetar->query($cadena);
                $numerfiles2 = mysqli_num_rows($resultadP2);
                $sum = 0;
                $totaliva = 0;
                $ivat = 0;
                while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                    $iva =  $filaP2['iva'];
                    //echo $iva;
                    $subtotal =  $filaP2['valor_total'] * $filaP2['cant_ordenada'];
                    $sum =  $sum + $subtotal;
                    $civa = calcularIVA($sum, $iva);


                    $totaliva =  $totaliva + $civa;
                    //echo $totaliva;
                ?>

                    <tr>
                        <td><?php echo $filaP2['referencia']; ?></td>
                        <td><?php echo $filaP2['nombre']; ?></td>
                        <td><?php echo $filaP2['cant_ordenada']; ?></td>
                        <td><?php echo  number_format($filaP2['valor_total']) ?></td>
                        <td><?php echo   number_format($subtotal)  ?></td>

                    </tr>
            </tbody>
        <?php }      ?>
        </table>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <table style="font-size: 13px; width: 100%;display:none;">
                    <tr style="background-color: #F0F0F0;">
                        <th style="border: 1px solid #C4C4C4; text-align: center; color:#444444;">IMPUESTO</th>
                        <th style="border: 1px solid #C4C4C4; text-align: center; color:#444444;">BASE</th>
                        <th style="border: 1px solid #C4C4C4; text-align: center; color:#444444;">VALOR</th>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #C4C4C4; text-align: left;">RET. COMPRAS EN GENERAL 2,5% (DEC)</td>
                        <td style="border: 1px solid #C4C4C4; text-align: right;">1.423.708,00</td>
                        <td style="border: 1px solid #C4C4C4; text-align: right;">-35.592,70</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 col-lg-6" style="text-align: left;">
                <table class="table-retes" style="font-size: 13px; width: 100%;">
                    <tr>
                        <td>SUBTOTAL(BASE)</td>
                        <td id="subtotal"><?php echo number_format(intval($sum)) ?></td>
                        <input type="hidden" id="st" value="<?php echo intval($sum); ?>">
                    </tr>
                    <tr>
                        <td>IVA</td>
                        <td id="tdiva"><?php echo number_format(intval($totaliva)); ?></td>
                        <input type="hidden" id="iv" value="<?php echo intval($totaliva); ?>">
                    </tr>
                    <tr style="background-color: #DAE8EF;">
                        <td><strong>TOTAL</strong></td>
                        <td id="totalord"></td>
                    </tr>

                </table>
            </div>
        </div>
        <?php
        $cadena = "SELECT nombre_empresa, ciudad, direccion,telefono,direccion_electronica
                  FROM  u116753122_cw3completa.identificacion_empresa
                  where 1=1";
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        date_default_timezone_set('America/Bogota');
        $fechaActual = date("d/m/Y");
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
        ?>
            <!--<div class="row mb-4">
            <div class="col-md-6 col-lg-6" style="text-align:left;">
                <label style="font-size:16px;color:#500450;"><strong>ENVIADO A:</strong></label><br>
                <?php echo $filaP2['nombre_empresa']; ?><br>
                <?php echo $filaP2['direccion']; ?><br>
                <?php echo $filaP2['ciudad']; ?><br>
            </div>
        </div>-->
        <?php } ?>

        <!--<div style="margin-top: 20px; margin-bottom:50px;">
            <table style="width: 100%; font-size:13px; ">
                <tr>
                    <th style="text-align: left;">ELABORÓ</th>
                    <th style="text-align: center;">APROBÓ</th>
                </tr>  
                <tr>
                    <td style="text-align: left;">Enerys Gutierrez</td>
                    <td style="text-align: center;">Enerys Gutierrez</td>
                </tr>
            </table>
        </div>-->


    <?php } ?>
    </div>

    <script src="https://cw3.tierramontemariana.org/apps/dig_verificacion/dig_verificacion.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var subtotal = parseInt($("#st").val());
            var tiva = parseInt($("#iv").val());
            var total = parseInt(subtotal) + parseInt(tiva);
            var totalFormateado = number_format(total, 0, '.', ',');
            $("#totalord").text(totalFormateado);
        });

        function number_format(number, decimals, decimalSeparator, thousandsSeparator) {
            return number.toFixed(decimals).replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator);
        }

        function ejecutar() {
            Swal.fire({
                title: '¿Como desea generar la Orden de Compra?',
                icon: 'info',

                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: '<i class="fa-solid fa-print"></i> Imprimir',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText: '<i class="fa-solid fa-envelope"></i> Enviar Por Corrreo',
                cancelButtonAriaLabel: 'Thumbs down'
            })
        }
    </script>