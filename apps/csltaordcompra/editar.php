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
} else {

    $id = $_REQUEST['id'];
    $id_prodc = $_REQUEST['idpr'];
    $vtotal = $_REQUEST['vtotal'];




    ?>
    <style>
        .modal-responsive .modal-content {
            width: 800px;
            margin-left: -190px;
        }
    </style>

    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editmodal">
        &nbsp;&nbsp;Recibir Producto
    </button>

    <div id="editmodal" class="modal modal-responsive
    ">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Detalle Orden de Compra </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <?php

                $cadena = "SELECT a.id_ordencompra,a.id_producto,a.cant_ordenada,b.nombre,c.no_lote,a.valor_total,b.cantidad_presentacion, SUM(c.cant_recibida) as cant_recibida,b.referencia 
                FROM u116753122_cw3completa.orden_compradetalle a, u116753122_cw3completa.producto b, u116753122_cw3completa.bodegaubcproducto c 
                where b.id_producto=a.id_producto and a.id_ordencompra = c.id_orden and a.id_producto = c.idproducto and a.id_ordencompra =" . $id . " and c.idproducto = " . $id_prodc;
                
                $resultadP2 = $conetar->query($cadena);
                $numerfiles2 = mysqli_num_rows($resultadP2);
                $sum = 0;



                $filaP2 = mysqli_fetch_array($resultadP2);



                if (!($filaP2)) {
                    $id_pro = "";
                    $cant_ordenada = "";
                    $cantidad_presentacion = "";
                    $nombre_unidad = "";
                    $no_lote = "";
                    $cant_recibida = 0;
                    $valor_total = "";
                    $referencia = "";
                } else {

                    $cadena = "SELECT SUM(c.cant_recibida) as cant_recibida 
                    FROM u116753122_cw3completa.bodegaubcproducto c where c.id_orden =" . $id . " and idproducto = " . $id_prodc;
                    $resultadP2 = $conetar->query($cadena);
                    $numerfiles2 = mysqli_num_rows($resultadP2);
                    $thefile = 0;
                    if ($numerfiles2 >= 1) {
                        while ($filaP2x = mysqli_fetch_array($resultadP2)) {
                            $cant_recibida = trim($filaP2x['cant_recibida']);
                        }
                    }

                    $id_pro = trim($filaP2['id_producto']);
                    $cant_ordenada = $filaP2['cant_ordenada'];
                    //$cantidad_presentacion = $filaP2['cantidad_presentacion'];
                    //    $nombre_unidad = $filaP2['cantidad_presentacion'] . " " . $filaP2['nombre_unidad'];
                    //      $cant_recibida = $filaP2['cant_recibida'];
                    $valor_total = $filaP2['valor_total'];
                    $referencia = $filaP2['referencia'];
                    $no_lote = $filaP2['no_lote'];
                }



                ?>
                <!-- Modal body -->
                <div class="modal-body" id="modalshow" name="modalshow">
                    <div>

                        <div class="row" style="text-align: left;display:none;">


                            <div class="col-md-6 col-lg-6">
                                <label>Referencia</label><br>
                                <input type="input" class="form-control" readonly id="refe" name="refe"
                                    value="<?php echo $referencia ?>" id_prod="<?php echo $id_prodc ?>"
                                    id_ord="<?php echo $id ?>" cant_ord="<?php echo $cant_ordenada ?>">
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <label>Presentacion</label><br>
                                <input type="input" class="form-control" readonly id="presentacion"
                                    value="<?php echo $nombre_unidad ?>">
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <label>Reg Invima</label><br>
                                <input type="input" class="form-control" readonly id="reginvima" value="">
                            </div>
                        </div>
                        <div class="row mt-2" style="text-align: left;">
                            <div class="col-md-3 col-lg-3">
                                <label style="font-size: 13px;">No. Factura</label><br>
                                <input type="input" class="form-control" id="nofactura" value="">
                                <div id="nofacturax">
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3">
                                <label style="font-size: 13px;">No. Lote</label><br>
                                <input type="number" class="form-control" id="nolote" value="">
                                <div id="nolotex">
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-4">
                                <label style="font-size: 13px;">Fecha Vencimiento</label><br>
                                <input type="date" class="form-control" id="fvence" name="fvence" value=""
                                    placeholder="yyyy-mm-dd"></input>
                                <div id="fvencex">
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2">
                                <label style="font-size: 13px;">Cantidad Recibida</label><br>
                                <input type="number" class="form-control" id="canreci" name="canreci" value=""
                                    cant_reci="<?php echo $cant_recibida ?>">
                                <div id="canrecix">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="text-align: left;">
                            <div class="col-md-5 col-lg-5">
                                <label style="font-size: 13px;">Bodega</label>
                                <select class="form-control" name="bodega" id="bodega" onclick='agregar(this);'>
                                    <option value="0" disabled selected></option>
                                    <?php
                                    $cadena = "SELECT id, nombre,id_empleado,predeterminada
                                                    FROM u116753122_cw3completa.bodegas
                                                    where estado='1'";
                                    $resultadP2a = $conetar->query($cadena);
                                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                                    if ($numerfiles2a >= 1) {
                                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {

                                            echo "<option value='" . trim($filaP2a['id']) . "'";
                                            if (trim($filaP2a['predeterminada']) == '1') {
                                                echo ' selected';
                                            }
                                            echo '>' . $filaP2a['nombre'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <div id="bodegax">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4" id="stand1">
                                <label style="font-size: 13px;">Estante</label>
                                <select class="form-control" id="stand">
                                    <option disabled selected></option>
                                </select>
                                <div id="standx">
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3" id="entrepanio">
                                <label style="font-size: 13px;">Entrepaño</label>
                                <select class="form-control" id="entrepanio2">
                                    <option disabled selected></option>
                                </select>
                                <div id="entrepanio2x">
                                </div>
                            </div>

                        </div>
                        <div class="row mt-2" style="text-align: left;display:none">


                            <div class="col-md-3 col-lg-3">
                                <label style="font-size: 14px;">Unidad Entrada</label><br>
                                <input type="number" class="form-control" id="uentrada" value="">
                                <div id="uentradax">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <label style="font-size: 14px;">Unidad Detalle</label><br>
                                <select class="form-control" onchange='agregar4(this);' id="udetalle1">
                                    <option selected="true" disabled="disabled"></option>
                                    <?php
                                    $cadena = "SELECT id, nombre
                                                    FROM u116753122_cw3completa.unidad_medida
                                                    where estado='1'";
                                    $resultadP2a = $conetar->query($cadena);
                                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                                    if ($numerfiles2a >= 1) {
                                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {

                                            echo "<option value='" . trim($filaP2a['id']) . "'";

                                            echo '>' . $filaP2a['nombre'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <div id="udetalle1x">
                                </div>
                            </div>


                        </div>


                        <div class="col-md-6 col-lg-6" style="display: none;">
                            <input type="input" class="form-control" name="identre" id="identre" value="1">
                        </div>
                        <div class="col-md-6 col-lg-6" style="display: none;">
                            <input type="input" class="form-control" name="vtotal" id="vtotal" value="">
                        </div>
                        <div class="col-md-6 col-lg-6" style="display: none;">
                            <input type="input" class="form-control" name="udetalle" id="udetalle" value="">
                        </div>

                    </div>

                </div>
                <?php
                ?>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="enviarbod">Guardar</button>
                </div>

            </div>
        </div>
    </div>

<?php } ?>
<script>
    $(document).ready(function () {
        $('#enviarbod').click(function () {
            var fvence = $("#fvence").val();
            var canreci = $("#canreci").val();
            var bodega = $("#bodega").val();
            var stand = $("#stand").val();
            var entrepanio2 = $("#entrepanio2").val();
            var udetalle1 = 0;
            var uentrada = 0;
            var nofactura = $("#nofactura").val();
            var nolote = $("#nolote").val();


            if (bodega == null) {
                bodega = '';
            }
            if (stand == null) {
                stand = '';
            }
            if (entrepanio2 == null) {
                entrepanio2 = '';
            }
            if (udetalle1 == null) {
                udetalle1 = '';
            }
            if (nofactura.trim() === '') {
                $("#nofactura").css("border", "thin solid red");
                $("#nofacturax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#nofactura").css("border", "thin solid rgb(233,236,239)");
                $("#nofacturax").empty();
            }
            if (nolote.trim() === '') {
                $("#nolote").css("border", "thin solid red");
                $("#nolotex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#nolote").css("border", "thin solid rgb(233,236,239)");
                $("#nolotex").empty();
            }
            if (fvence.trim() === '') {
                $("#fvence").css("border", "thin solid red");
                $("#fvencex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#fvence").css("border", "thin solid rgb(233,236,239)");
                $("#fvencex").empty();
            }
            if (canreci.trim() === '') {
                $("#canreci").css("border", "thin solid red");
                $("#canrecix").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#canreci").css("border", "thin solid rgb(233,236,239)");
                $("#canrecix").empty();
            }
            if (bodega.trim() === '') {
                $("#bodega").css("border", "thin solid red");
                $("#bodegax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#bodega").css("border", "thin solid rgb(233,236,239)");
                $("#bodegax").empty();
            }
            if (stand.trim() === '') {
                $("#stand").css("border", "thin solid red");
                $("#standx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#stand").css("border", "thin solid rgb(233,236,239)");
                $("#standx").empty();
            }
            if (entrepanio2.trim() === '') {
                $("#entrepanio2").css("border", "thin solid red");
                $("#entrepanio2x").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#entrepanio2").css("border", "thin solid rgb(233,236,239)");
                $("#entrepanio2x").empty();
            }

            guardar();
            canti = $('#canreci').val();
            printTags(<?php echo $id_prodc; ?>, canti);

        });

    });

    $(document).ready(function () {
        $.ajax({
            type: 'POST',
            url: '/cw3/conlabweb3.0/apps/csltaordcompra/impuestos.php',
            data: {
                id_ord: <?php echo $id ?>,
            },
            success: function (data) {


            }
        });
    });

    function cerrarModal() {
        // Ocultar el modal utilizando la función .modal('hide')
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    }

    function guardar() {



        var cantreci = $('input[name="canreci"]').attr('cant_reci');

        var canreci = $("#canreci").val();


        if (canreci <= 0) {


            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Digite una cantidad mayor o igual a 0!',
                footer: '<a href=""></a>'
            })
        } else {
            var cant_ordenada = $('input[name="refe"]').attr('cant_ord');

            var total = parseFloat(cant_ordenada) - parseFloat(cantreci);

            if (canreci > total) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Cantidad Maxima!',
                    footer: '<a href="">Digite una cantidad menor o igual a la cantidad ordenada.</a>'
                })

            } else if (canreci <= total) {

                var id_prod = $('input[name="refe"]').attr('id_prod');
                var id_ord = $('input[name="refe"]').attr('id_ord');
                var cant_ordenada = $('input[name="refe"]').attr('cant_ord');
                var fvence = $("#fvence").val();
                var canreci = $("#canreci").val();
                var identre = $("#identre").val();
                var vtotal = $("#vtotal").val();
                var udetalle = $("#udetalle").val();
                var uentrada = $("#uentrada").val();
                var nofactura = $("#nofactura").val();
                var nolote = $("#nolote").val();

                $.ajax({
                    type: 'POST',
                    url: '/cw3/conlabweb3.0/apps/csltaordcompra/productobodega.php',
                    data: {
                        id_prod: id_prod,
                        id_ord: id_ord,
                        cant_ordenada: cant_ordenada,
                        fvence: fvence,
                        canreci: canreci,
                        identre: identre,
                        vtotal: vtotal,
                        udetalle: udetalle,
                        uentrada: uentrada,
                        nolote: nolote,
                        nofactura: nofactura
                    },
                    success: function (data) {


                        $("#data1").load("/cw3/conlabweb3.0/apps/csltaordcompra/data.php", {
                            id: id_ord
                        });
                        $("#btnedt").load("/cw3/conlabweb3.0/apps/csltaordcompra/editar.php", {
                            idpr: id_prod,
                            id: id_ord,
                            vtotal: vtotal

                        });
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: '¡Producto Agregado en Bodega!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        cerrarModal();

                    },
                    error: function (xhr, status, error) {
                        // Manejo de errores
                        console.error(xhr.responseText); // Imprime el mensaje de error en la consola
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ha ocurrido un error al procesar la solicitud. Por favor, inténtalo de nuevo.'
                        });
                    }
                });
            }
        }
    }




    function agregar(sel) {
        var id = $('option:selected', sel).attr('value');

        $("#stand1").load("/cw3/conlabweb3.0/apps/csltaordcompra/stands.php", {
            id: id
        });
    };

    function agregar2(sel) {
        var id = $('option:selected', sel).attr('value');

        $("#entrepanio").load("/cw3/conlabweb3.0/apps/csltaordcompra/entrepanio.php", {
            id: id
        });

    };

    function agregar3(sel) {
        var valor = $('option:selected', sel).attr('value');
        $("#identre").val(valor);

    };

    function agregar4(sel) {
        var id = $('option:selected', sel).attr('value');
        $("#udetalle").val(id);
    }

    function printTags(idpr, cant) {

        var bd = $('#bodega').val();
        var std = $('#stand').val();
        var et = $('#entrepanio2').val();
        var fv = $('#fvence').val();
        var nlo = $('#nolote').val();

        window.open('/cw3/conlabweb3.0/apps/csltaordcompra/print-barcode.php?id=' + idpr + '&cant=' + cant + '&bd=' + bd + '&std=' + std + '&et=' + et + '&fv=' + fv + '&nlo=' + nlo)
    }


</script>