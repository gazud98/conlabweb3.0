<?php
if (file_exists("config/accesosystems.php")) {
    include ("config/accesosystems.php");
} else {
    if (file_exists("../config/accesosystems.php")) {
        include ("../config/accesosystems.php");
    } else {
        if (file_exists("../../config/accesosystems.php")) {
            include ("../../config/accesosystems.php");
        }
    }
}
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    if (isset($_REQUEST['id'])) {
        $ide = $_REQUEST['id'];
        if ($ide == "-1") {
            $ide = "";
        }
    } else {
        $ide = 0;
    }

    $id = 0;
    $fecha = "";
    $hora = "";
    $id_proveedor = "";
    $nombre_comercial = "";
    $numero_identificacion = "";
    //   $fechaActual = date("d/m/Y");
    //  echo  $fechaActual;
    $cadena = "SELECT a.consec_cot, a.fecha, a.hora, a.id_proveedor, b.nombre_comercial,b.numero_identificacion
    FROM  cotizacion_insumos a, proveedores b
    where a.id_proveedor=b.id_proveedores
    and a.consec_cot =" . $ide;
    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $thefile = 0;
        while ($filaP2 = mysqli_fetch_array($resultadP2)) {
            $id = trim($filaP2['consec_cot']);
            $fecha = $filaP2['fecha'];
            $hora = $filaP2['hora'];
            $id_proveedor = $filaP2['id_proveedor'];
            $nombre_comercial = $filaP2['nombre_comercial'];
            $numero_identificacion = $filaP2['numero_identificacion'];
        }
    } else {
        $id = 0;
    }
    ?>

    <div class="row">
        <div class="col-md-12 col-lg-12" style="background-color:rgb(1,103,183);color:white;">
            <label style="margin-top: 4px;">Información Cotizacion</label>
        </div>
    </div>

    <div class="row mt-2">

        <div class="col-md-3 col-lg-3" id="tbd">
            <label>NIT Proveedor</label>
            <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $numero_identificacion ?>"
                disabled>
        </div>
        <div class="col-md-9 col-lg-9" id="tbd">
            <label>Proveedor</label>
            <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre_comercial ?>"
                disabled>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 col-lg-12 mt-2" style="background-color:rgb(1,103,183);color:white; text-align:center;">
            <label style="margin-top: 4px;">DETALLE DE COTIZACION</label>
        </div>
        <p style="font-size: 14px;">Ingresa el precio en el campo de valor y luego haz clic en el botón 'Generar' para crear la orden de compra.</p>
    </div>
    </div>
    <div style="overflow-y: auto;  height:400px; width:100%;">
        <table class="table-sm table-bordered" id="result" style="margin-top: 2%;width:100%;">
            <thead>
                <tr style="text-align:center;">
                    <th>No. Cot</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php $cadena = "SELECT a.id,a.consec_cot,a.id_producto,a.cantidad,a.fecha,a.hora,a.precio,b.nombre
            FROM  cotizacion_insumos a, producto b
            where b.id_producto=a.id_producto
            and  a.consec_cot =" . $id;
                $resultadP2 = $conetar->query($cadena);
                $numerfiles2 = mysqli_num_rows($resultadP2);

                while ($filaP2 = mysqli_fetch_array($resultadP2)) {


                    $cadena1 = "
                SELECT precio FROM cotizacion_insumos a WHERE a.id_producto = " . $filaP2['id_producto'] . " ORDER BY STR_TO_DATE(CONCAT(a.fecha, ' ', a.hora), '%d-%m-%Y %H:%i:%s') DESC LIMIT 1;";

                    $resultadP21 = $conetar->query($cadena1);
                    $numerfiles21 = mysqli_num_rows($resultadP21);
                    while ($filaP21 = mysqli_fetch_array($resultadP21)) {

                        if ($filaP21['precio'] == 0) {
                            $precio = null;
                        } else {
                            $precio = $numeroFormateado = number_format($filaP21['precio'], 2, ',', '.');
                        }

                        ?>

                        <?php
                        ?>
                        <tr style=" background-color: rgb(249,249,249);text-align:center; font-size:13px;">
                            <td>
                                <?php echo $filaP2['consec_cot']; ?>
                            </td>
                            <td>
                                <?php echo $filaP2['nombre']; ?>
                            </td>
                            <td>
                                <?php echo $filaP2['cantidad']; ?>
                            </td>
                            <td> <input type="input" class="form-control" id="price-format<?php echo $filaP2['id']; ?>"
                                    name="price-format<?php echo $filaP2['id']; ?>" required value="<?php echo $precio; ?>"
                                    onchange='grabador(<?php echo $filaP2['id']; ?>)'><input type="hidden"
                                    name="prec<?php echo $filaP2['id']; ?>" id="prec<?php echo $filaP2['id']; ?>"
                                    value="<?php echo $filaP21['precio'] ?>">
                            </td>

                        </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
    </div>


    <script>
        function grabador(id) {
            var objeto = "#prec" + id;
            var preci2 = $(objeto).val();

            var preci = $("#price-format" + id).val();
           

            // Eliminar comas y puntos del valor actualizado
            var valorDesformateado = preci.replace(/[,.]/g, '');
            // Formatear el nuevo valor con dos decimales y separadores de miles
            var nuevoValorFormateado = number_format(parseFloat(valorDesformateado), 2, ',', '.');

            $("#price-format" + id).val(nuevoValorFormateado); // Establecer el valor formateado en el input
            $("#price-format" + id).css("border", "1px solid green");

            $.ajax({
                type: 'POST',
                url: '/cw3/conlabweb3.0/apps/consulcotizacion/crud.php',
                data: {
                    id: id,
                    preci: preci // Enviar el valor sin formato
                },
                success: function (data) {

                }
            });
        }




        function number_format(number, decimals, decimalSeparator, thousandsSeparator) {
            // Esta función es similar a la función number_format mencionada anteriormente
            // Puedes utilizarla para formatear el número según tus necesidades
            // Aquí tienes un ejemplo simple:
            return number.toFixed(decimals).replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator);
        }

        function generarOrden() {

            $.ajax({
                type: 'POST',
                url: '/cw3/conlabweb3.0/apps/consulcotizacion/creaorden.php',
                data: {
                    id: <?php echo $ide ?>
                },
                success: function (datax) {

                    if ($.trim(datax) == 'N') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '¡Debe tener al menos un producto con precio para generar la orden!'

                        });

                        $("#ordcompra").modal("hide");
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: '/cw3/conlabweb3.0/apps/consulcotizacion/mostrarorden.php',
                            data: {},
                            success: function (respuesta) {
                                if (respuesta === null || respuesta.trim() === '') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: '¡Debe tener al menos un producto con precio para generar la orden!'

                                    });
                                    $("#ordcompra").modal("hide");
                                } else {
                                    cargarDatos();
                                    $("#data1").load("/cw3/conlabweb3.0/apps/consulcotizacion/data.php");
                                    $("#modalshow").load("/cw3/conlabweb3.0/apps/consulcotizacion/modal.php", {
                                        id: respuesta
                                    });

                                    $("#ordcompra").modal("show");
                                }
                            }
                        })

                    }
                }
            });
        }
    </script>
<?php } ?>