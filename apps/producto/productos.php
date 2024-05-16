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


    if (isset($_REQUEST['status'])) {
        $status = $_REQUEST['status'];
    }

    if (isset($_REQUEST['estado'])) {
        $estado = $_REQUEST['estado'];
        if ($estado == "-1") {
            $estado = "";
        }
    } else {
        $estado = 0;
    }
    //echo '..............................'.$_REQUEST['id'].'...';
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
    $id_categoria_producto = ""; //es un PRODUCTO
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
    $tipo_prod =  "";
    $iva =  "";
    if ($id != 0) {
        $cadena = "select P.id_producto,P.referencia,P.id_categoria_producto,P.nombre,id_departamento,P.estado,
                        P.cantidad_presentacion,P.id_presentacion,P.cantidad_unidadmedida,P.id_unidadmedida,
                        P.id_clasificacion_riesgo,P.nombre_imagen,P.id_bodegas,P.id_departamento,
                        P.stckmin,P.stckpntoreorden,P.stckmax,P.csmoprommes,P.id_condicion_almacenaje,P.cod_contable,P.categoria,P.principio_activo,P.forma_farmaceutica,
                        P.vida_util,P.lote,P.marca,P.serie,P.fecha_vencimiento,P.concentracion,P.reg_invima,P.tipo_prod,P.iva
                        
                    from producto P
                    where P.id_producto='" . $id . "'";
        //                 echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_producto']);
            $id_categoria_producto = trim($filaP2['id_categoria_producto']);; //es un producto
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
            $tipo_prod = trim($filaP2['tipo_prod']);
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
            width: 100px;
            padding-left: 10px;
        }
    </style>
    
    <form name="formcontrol2" id="formcontrol2" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="modeeditstatus1" id="modeeditstatus1" value="<?php echo $status; ?>">
        <input type="hidden" name="id_categoria_producto" id="id_categoria_producto" value="3">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
        <input type="hidden" name="tipprod" id="tipprod" value="I">
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
        <div class="row mb-2">

            <div class="col-md-2">
                <label style="font-size: 12px;">Referencia:</label>
                <input type="input" class="form-control" name="referencia" id="referencia" required value="<?php echo $referencia; ?>">
                <div id="referenciax"></div>
            </div>

            <div class="col-md-6">
                <label style="font-size: 12px;">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required value="<?php echo $nombre; ?>">
                <div id="nombrex"></div>
            </div>
            <div class="col-md-4">
                <label style="font-size: 12px;">Departamento</label>
                <select class="form-control" name="id_departamento" id="id_departamento" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id, nombre
                                    FROM departamentos
                                    where estado='1'";
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
                <div id="id_departamentox"></div>
            </div>
        </div>


        <div class="row pb-2">
            <div class="col-md-4">
                <label style="font-size: 12px;">Categoría:</label>
                <select class="form-control" name="categoria" id="categoria" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id_categoria_producto, nombre FROM categoria_producto";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_categoria_producto']) . "'";
                            if (trim($filaP2a['id_categoria_producto']) == $id_categoria_producto) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label style="font-size: 12px;">Unidad:</label>
                <input type="input" class="form-control" required name="cantidad_unidadmedida" id="cantidad_unidadmedida" value="<?php echo $cantidad_unidadmedida; ?>">
                <div id="cantidad_unidadmedidax"></div>
            </div>
            <div class="col-md-2">
                <label style="font-size: 12px;color:white;">.</label>
                <select class="form-control" name="id_unidadmedida" id="id_unidadmedida" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT um.id,um.nombre, um.simbolo
                                                            FROM unidad_medida um
                                                            where um.estado='1'";
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
                <div id="id_unidadmedidax"></div>
            </div>
            <div class="col-md-2">
                <label style="font-size: 12px;">Presentacion:</label>
                <input type="input" class="form-control" required name="cantidad_presentacion" id="cantidad_presentacion" value="<?php echo $cantidad_presentacion; ?>">
                <div id="cantidad_presentacionx"></div>
            </div>
            <div class="col-md-2">
                <label style="font-size: 12px;color:white;">.</label>
                <select class="form-control" name="id_presentacion" id="id_presentacion" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT UM.id,UM.nombre
                                                        FROM unidad_medida UM
                                                        where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";
                            if (trim($filaP2a['id']) == $id_presentacion) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <div id="id_presentacionx"></div>
            </div>
        </div>

        <div class="row alert alert-light mt-2" role="alert" style="padding: 5px;">

            <div class="col-md-3">
                <label style="font-size: 12px;">Stock Minimo:</label>
                <input type="input" class="form-control" name="stckmin" id="stckmin" value="<?php echo $stckmin; ?>">
                <div id="stckminx"></div>
            </div>
            <div class="col-md-3">
                <label style="font-size: 12px;">Punto de Reorden:</label>
                <input type="input" class="form-control" name="stckpntoreorden" id="stckpntoreorden" value="<?php echo $stckpntoreorden; ?>">
                <div id="stckpntoreordenx"></div>
            </div>
            <div class="col-md-3">
                <label style="font-size: 12px;">Stock Maximo:</label>
                <input type="input" class="form-control" name="stckmax" id="stckmax" value="<?php echo $stckmax; ?>">
                <div id="stckmaxx"></div>
            </div>
            <?php
            $cadenax =  "SELECT MIN(fchvence) as fchvence 
            FROM bodegaubcproducto 
            where idproducto = '" . $id . "' and identrepanio <>0";
            $resultadP2ax = $conetar->query($cadenax);
            $numerfiles2ax = mysqli_num_rows($resultadP2ax);
            if ($numerfiles2ax >= 1) {
                while ($filaP2ax = mysqli_fetch_array($resultadP2ax)) {
                    $fchvence = trim($filaP2ax['fchvence']);
                }
            } else {
                $fchvence = "";
            }
            ?>

        </div>

        <div class="row">

            <div class="col-md-3">
                <label style="font-size: 12px;">Codigo Contable:</label>
                <input type="input" class="form-control" name="cod_contable" id="cod_contable" value="<?php echo $cod_contable; ?>">
                <div id="cod_contablex"></div>
            </div>

            <div class="col-md-2">
                <label style="font-size: 12px;">IVA:</label>
                <input type="number" class="form-control" name="iva" id="iva" value="<?php echo $iva; ?>">

            </div>
            <div class="col-md-3">
                <label style="font-size: 12px;">Reg Invima:</label>
                <input type="input" class="form-control" name="reg_invima" id="reg_invima" value="<?php echo $reg_invima; ?>">
            </div>
            <div class="col-md-4">
                <label style="font-size: 12px;">Nivel de Riesgo:</label>
                <select class="form-control" aria-label="Default select example" name="id_clasificacion_riesgo" id="id_clasificacion_riesgo">
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id_clasificacion_riesgo, descripcion
                                                    FROM clasificacion_riesgo
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_clasificacion_riesgo']) . "'";
                            if (trim($filaP2a['id_clasificacion_riesgo']) == $id_clasificacion_riesgo) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['descripcion'];
                            echo "</option>";
                        }
                    }
                    ?>
                </select>
                <div id="id_clasificacion_riesgox"></div>
            </div>


        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label style="font-size: 12px;">Condiciones de Almacenamiento:</label>
                <select class="form-control" aria-label="Default select example" name="id_condicion_almacenaje" id="id_condicion_almacenaje">
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id_condicion_almacenaje, descripcion
                                                    FROM condicion_almacenaje
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_condicion_almacenaje']) . "'";
                            if (trim($filaP2a['id_condicion_almacenaje']) == $id_condicion_almacenaje) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['descripcion'];
                            echo "</option>";
                        }
                    }
                    ?>
                </select>
                <div id="id_condicion_almacenajex"></div>
            </div>
            <div class="col-md-6">
                <label style="font-size: 12px;">Concentracion:</label>
                <input type="input" class="form-control" name="concentracion" id="concentracion" value="<?php echo $concentracion; ?>">
                <div id="concentracionx"></div>
            </div>
        </div>
        
        <div class="row mt-2">
            <div class="form-group col-md-4">
                <label for="vida_util" style="font-size: 12px;">Número de registro invima:</label>
                <input type="text" class="form-control" name="numreg" id="numreg" value="">
            </div>
        </div>
        
        <iframe id="form-up" style="width: 100%;border:none;overflow:hidden;margin-top:20px;" height="120" src="https://conlabweb3.tierramontemariana.org/producto/form-files.php?id=<?php echo $id ?>">
        </iframe>

        <div class="mt-5 text-right" style="border-radius: 5px">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                $.ajax({
                    type: 'POST',
                    url: 'https://conlabweb3.tierramontemariana.org/producto/crud-2.php?aux=1',
                    data: $('#formcontrol2').serialize(),
                    success: function(respuesta) {

                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: '¡Registro Exitoso!',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $('#contentTableProdcutos').load('https://conlabweb3.tierramontemariana.org/producto/table.php');

                        $('#modaEditEquipo').modal('hide');
                        $('#modalAddProducto').modal('hide');

                    }
                });

            }
        });
        $('#formcontrol2').validate({
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
                cantidad_presentacion: {
                    required: true
                },
                id_presentacion: {
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
                cantidad_presentacion: {
                    required: ""
                },
                id_presentacion: {
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



</script>