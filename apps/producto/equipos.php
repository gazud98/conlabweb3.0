<?php
//     presntadio n par todos lod produtos tipo producro en genral
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

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    if (isset($_REQUEST['estado'])) {
        $estado = $_REQUEST['estado'];
        if ($estado == "-1") {
            $estado = "";
        }
    } else {
        $estado = 0;
    }

    if (isset($_REQUEST['status'])) {
        $status = $_REQUEST['status'];
    }

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = 0;
    }

    $GLOBALS['id'] = $id;

    //$id=1;
    // echo $caso.'----'.$id;
    /* */
    $id_categoria_producto = "3"; //es un PRODUCTO
    $referencia = "";
    $nombre = "";
    $id_departamento = "";
    $estado = "";
    $cantidad_presentacion = "";
    $id_presentacion = "";
    $cantidad_unidadmedida = "";
    $id_unidadmedida = "";
    $id_clasificacion_riesgo = "";
    $nombre_imagen = "";
    $id_bodegas = "";
    $id_departamento = "";
    $stckmin = "";
    $stckpntoreorden = "";
    $stckmax = "";
    $csmoprommes = "";
    $id_condicion_almacenaje = "";
    $cod_contable = "";
    $categoria = "";
    $principio_activo =  "";
    $forma_farmaceutica =  "";
    $vida_util =  "";
    $lote =  "";
    $marca = "";
    $serie =  "";
    $fecha_vencimiento =  "";
    $concentracion =  "";
    $reg_invima =  "";
    $iva =  "";

    if ($id != 0) {
        $cadena = "select P.id_producto,P.referencia,P.id_categoria_producto,P.nombre,id_departamento,P.estado,
                        P.cantidad_presentacion,P.id_presentacion,P.cantidad_unidadmedida,P.id_unidadmedida,
                        P.id_clasificacion_riesgo,P.nombre_imagen,P.id_bodegas,P.id_departamento,
                        P.stckmin,P.stckpntoreorden,P.stckmax,P.csmoprommes,P.id_condicion_almacenaje,P.cod_contable,P.categoria,P.principio_activo,P.forma_farmaceutica,
                        P.vida_util,P.lote,P.marca,P.serie,P.fecha_vencimiento,P.concentracion,P.reg_invima,P.iva
                    from producto P
                    where P.id_producto='" . $id . "'";
        //                 echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_producto']);
            $id_categoria_producto = "3"; //es un producto
            $referencia = trim($filaP2['referencia']);
            $nombre = trim($filaP2['nombre']);
            $id_departamento = trim($filaP2['id_departamento']);
            $estado = trim($filaP2['estado']);
            $cantidad_presentacion = trim($filaP2['cantidad_presentacion']);
            $id_presentacion = trim($filaP2['id_presentacion']);
            $cantidad_unidadmedida = trim($filaP2['cantidad_unidadmedida']);
            $id_unidadmedida = trim($filaP2['id_unidadmedida']);
            $id_clasificacion_riesgo = trim($filaP2['id_clasificacion_riesgo']);
            $nombre_imagen = trim($filaP2['nombre_imagen']);
            $id_bodegas = trim($filaP2['id_bodegas']);
            $id_departamento = trim($filaP2['id_departamento']);
            $stckmin = trim($filaP2['stckmin']);
            $stckpntoreorden = trim($filaP2['stckpntoreorden']);
            $stckmax = trim($filaP2['stckmax']);
            $csmoprommes = trim($filaP2['csmoprommes']);
            $id_condicion_almacenaje = trim($filaP2['id_condicion_almacenaje']);
            $cod_contable = trim($filaP2['cod_contable']);
            $categoria = trim($filaP2['categoria']);
            $principio_activo = trim($filaP2['principio_activo']);
            $forma_farmaceutica = trim($filaP2['forma_farmaceutica']);
            $vida_util = trim($filaP2['vida_util']);
            $lote = trim($filaP2['lote']);
            $marca = trim($filaP2['marca']);
            $serie = trim($filaP2['serie']);
            $fecha_vencimiento = trim($filaP2['fecha_vencimiento']);
            $concentracion = trim($filaP2['concentracion']);
            $reg_invima = trim($filaP2['reg_invima']);
            $iva = trim($filaP2['iva']);
        }
    }


?>

    <style>
        .form-control {

            width: 100%;
            padding: 0;
            height: 1.5rem;
            font-size: 13px;
            line-height: 1.5;
        }

        .table-txt-order {
            width: 100%;
        }

        .table-txt-order tr,
        tr td {
            width: 80px;
            padding-left: 10px;
        }
    </style>

    <form name="formcontrol1" id="formcontrol1" action="" method="POST" enctype="multipart/form-data" style="padding: 0px 30px 10px 30px;">
        <input type="hidden" name="modeeditstatus1" id="modeeditstatus1" value="<?php echo $status; ?>">
        <input type="hidden" name="id_categoria_producto" id="id_categoria_producto" value="3">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
        <input type="hidden" name="tipprod" id="tipprod" value="E">
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">


        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="referencia" style="font-size: 12px;">Referencia:</label>
                <input type="text" class="form-control" name="referencia" id="referencia" required value="<?php echo $referencia; ?>">

            </div>
            <div class="form-group col-md-4">
                <label for="nombre" style="font-size: 12px;">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required value="<?php echo $nombre; ?>">

            </div>

            <div class="form-group col-md-4">
                <label for="id_departamento" style="font-size: 12px;">Departamento</label>
                <select class="form-control" name="id_departamento" id="id_departamento" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id, nombre FROM departamentos where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";
                            if (trim($filaP2a['id']) == $id_departamento) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>

            </div>

        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="cod_contable" style="font-size: 12px;">Codigo Contable:</label>
                <input type="text" class="form-control" name="cod_contable" id="cod_contable" value="<?php echo $cod_contable; ?>">

            </div>
            <div class="form-group col-md-1">
                <label for="iva" style="font-size: 12px;">IVA(%)</label>
                <input type="number" class="form-control" name="iva" id="iva" value="<?php echo $iva; ?>">

            </div>
            <div class="form-group col-md-3">
                <label for="cantidad_unidadmedida" style="font-size: 12px;">Unidad:</label>
                <input type="text" class="form-control" required name="cantidad_unidadmedida" id="cantidad_unidadmedida" value="<?php echo $cantidad_unidadmedida; ?>">

            </div>
            <div class="form-group col-md-4">
                <label style="font-size: 12px;color:white;">.</label>
                <select class="form-control" name="id_unidadmedida" id="id_unidadmedida" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT um.id, um.nombre, um.simbolo FROM unidad_medida um where um.estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";
                            if (trim($filaP2a['id']) == $id_unidadmedida) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>

            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="cantidad_presentacion" style="font-size: 12px;">Presentacion:</label>
                <input type="text" class="form-control" name="cantidad_presentacion" id="cantidad_presentacion" value="<?php echo $cantidad_presentacion; ?>">

            </div>
            <div class="form-group col-md-5">
                <label for="marca" style="font-size: 12px;">Marca:</label>
                <input type="text" class="form-control" name="marca" id="marca" value="<?php echo $marca; ?>">

            </div>
            <div class="form-group col-md-3">
                <label for="serie" style="font-size: 12px;">Serie:</label>
                <input type="text" class="form-control" name="serie" id="serie" value="<?php echo $serie; ?>">

            </div>
            <div class="form-group col-md-2">
                <label for="vida_util" style="font-size: 12px;">Vida Util:</label>
                <input type="text" class="form-control" name="vida_util" id="vida_util" value="<?php echo $vida_util; ?>">

            </div>
            <!--<div class="form-group col-md-2">
            <span>Número de registro invima:</span>
            <input type="text" name="numreg" id="numreg" class="formcontrol">
                <label for="lote" style="font-size: 12px;">Lote:</label>
                <input type="text" class="form-control" name="lote" id="lote" value="<?php echo $lote; ?>">
            </div>-->

        </div>
        

        <div class="mt-5 text-right">
            <button type="submit" class="btn btn-sm btn-success" style="font-size:12px;width:90px;">
                Grabar
            </button>
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="font-size:12px;width:90px;">
                Cancelar
            </button>
        </div>
    </form>



<?php
}
?>
<!-- jquery-validation -->
<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>


<script>
    $(document).ready(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                $.ajax({
                    type: 'POST',
                    url: 'https://conlabweb3.tierramontemariana.org/apps/producto/crud.php',
                    data: $('#formcontrol1').serialize(),
                    success: function(respuesta) {

                        cargarDatos();
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: '¡Registro Exitoso!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $("#iddatas").css("pointer-events", "none");
                        $("#iddatas").css("background-color", "#ededed");
                        $("#accionejec").css("display", "none");
                        $("#accionejec").html("");
                        $("#btones").css("display", "none");

                    }
                });

            }
        });
        $('#formcontrol1').validate({
            rules: {
                referencia: {
                    required: true
                },
                nombre: {
                    required: true
                },
                id_departamento: {
                    required: true
                },
                cantidad_unidadmedida: {
                    required: true
                },
                id_unidadmedida: {
                    required: true
                },

            },
            messages: {
                referencia: {
                    required: ""
                },
                nombre: {
                    required: ""
                },
                id_departamento: {
                    required: ""
                },
                cantidad_unidadmedida: {
                    required: ""
                },
                id_unidadmedida: {
                    required: ""
                },

            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });


    function cancelBTN() {
        $("#iddatas").css("pointer-events", "none");
        $("#iddatas").css("background-color", "#ededed");
        $("#accionejec").css("display", "none");
        $("#accionejec").html("");
        $("#btones").css("display", "none");
    }
</script>