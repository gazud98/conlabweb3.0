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

    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = "";
    }

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }

    //$id=1;
    //    echo $caso.'----'.$id;
    /* */
    $id_categoria_producto = "1"; //esa ctivo fijo
    $nombre = "";
    //$referencia = "";
    $id_departamento = "";
    $estado = "";
    $valor = "";
    $modelo = "";
    $serie = "";
    $fchinstalacion = "";
    $seguro = "";
    $seguroprima = "";
    $garantia = "";
    $fchexpgarantia = "";
    $vidautilmes = "";
    $metdepreciacion = "";
    $id_sede = "";
    $id_tipo_activo = "";
    $id_responsable = "";
    $id_proveegarantia = "";
    $aseguradora = "";
    $valor_asegurado = "";
    $fchiniciogarantia = "";
    $op_mantenimiento = "";
    $descp = "";
    $id_area = "";
    $fchinicioseguro = "";
    $fchexpseguro = "";
    $id_respmantemiento = "";
    if ($id != "") {
        $cadena = "select P.id_producto,P.id_categoria_producto,P.nombre,P.id_departamento,P.estado,PA.descripcion,
                        PA.valor,PA.modelo,PA.serie,PA.fchinstalacion,
                        PA.seguro,PA.seguroprima,PA.garantia,PA.fchexpgarantia,
                        PA.vidautilmes,PA.metdepreciacion,P.id_sede,P.id_tipo_activo, PA.id_proveegarantia,PA.id_responsable,PA.aseguradora,PA.valor_asegurado,PA.op_mantenimiento,PA.fchiniciogarantia,PA.id_area,PA.fchinicioseguro,PA.fchexpseguro,PA.id_respmantemiento
                    from  u116753122_cw3completa.producto P,
                    u116753122_cw3completa.producto_activofijo PA
                    where P.id_producto=PA.id_producto
                        and P.id_producto='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_producto']);
            $id_categoria_producto = "1"; //esa ctivo fijo
            $nombre = trim($filaP2['nombre']);
            //$referencia = trim($filaP2['referencia']);
            $id_departamento = trim($filaP2['id_departamento']);
            $id_sede = trim($filaP2['id_sede']);
            $id_tipo_activo = trim($filaP2['id_tipo_activo']);
            $estado = trim($filaP2['estado']);
            $valor = trim($filaP2['valor']);;
            $modelo = trim($filaP2['modelo']);
            $serie = trim($filaP2['serie']);
            $fchinstalacion = trim($filaP2['fchinstalacion']);
            $seguro = trim($filaP2['seguro']);
            $seguroprima = trim($filaP2['seguroprima']);
            $garantia = trim($filaP2['garantia']);
            $id_proveegarantia = trim($filaP2['id_proveegarantia']);
            $id_responsable = trim($filaP2['id_responsable']);
            $fchexpgarantia = trim($filaP2['fchexpgarantia']);
            $fchiniciogarantia = trim($filaP2['fchiniciogarantia']);
            $vidautilmes = trim($filaP2['vidautilmes']);
            $metdepreciacion = trim($filaP2['metdepreciacion']);
            $aseguradora = trim($filaP2['aseguradora']);
            $valor_asegurado = trim($filaP2['valor_asegurado']);
            $descp = trim($filaP2['descripcion']);
            $op_mantenimiento = trim($filaP2['op_mantenimiento']);
            $id_area = trim($filaP2['id_area']);
            $fchinicioseguro = trim($filaP2['fchinicioseguro']);
            $fchexpseguro = trim($filaP2['fchexpseguro']);
            $id_respmantemiento = trim($filaP2['id_respmantemiento']);
        }
    }
}

?>
<input type="hidden" name="id_categoria_producto" id="id_categoria_producto" value="1">
<input type="hidden" name="id_producto" id="id_producto" value="<?php echo $id; ?>">
<input type="hidden" name="modeeditstatus" id="modeeditstatus" value="C">
<div class="container ">
    <!-- Sección 1 -->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="nombre" style="font-size: 11px;">Nombre:</label>
                <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="modelo" style="font-size: 11px;">Modelo:</label>
                <input type="input" class="form-control" name="modelo" id="modelo" value="<?php echo $modelo ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="serie" style="font-size: 11px;">Serie:</label>
                <input type="input" class="form-control" name="serie" id="serie" value="<?php echo $serie ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="descp" style="font-size: 11px;">Descripción:</label>
                <input type="input" class="form-control" name="descp" id="descp" value="<?php echo $descp ?>" required>
            </div>
        </div>
    </div>

    <!-- Sección 2 -->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="id_tipo_activo" style="font-size: 11px;">Tipo de Activo Fijo</label>
                <select class="select2" name="id_tipo_activo" id="id_tipo_activo" style="width: 100%;">
                    <option selected disabled>Selecciona:</option>
                    <?php
                    $cadena = "SELECT id, nombre FROM  u116753122_cw3completa.tipo_activo_fijos where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id']) . "'";
                        if (trim($filaP2a['id']) == $id_tipo_activo) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="id_sedes" style="font-size: 11px;">Sede</label>
                <select class="select2" name="id_sedes" id="id_sedes" required style="width: 100%;">
                    <option selected disabled>Selecciona:</option>
                    <?php
                    $cadena = "SELECT id_sedes, nombre FROM  u116753122_cw3completa.sedes where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id_sedes']) . "'";
                        if (trim($filaP2a['id_sedes']) == $id_sede) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="id_departamento" style="font-size: 11px;">Departamento</label>
                <select class="select2" name="id_departamento" id="id_departamento" style="width: 100%;" onchange='areaFunc(this);'>
                    <option selected disabled>Selecciona:</option>
                    <?php
                    $cadena = "SELECT id, nombre FROM  u116753122_cw3completa.departamentos where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id']) . "'";
                        if (trim($filaP2a['id']) == $id_departamento) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>


        <div class="col-md-3">
            <div class="form-group">
                <div id="area-id">
                    <label for="nuevo_campo" style="font-size: 11px;">Area</label>
                    <select class="select2" name="area" id="area" style="width: 100%;">

                        <?php
                        $cadena = "SELECT id, nombre FROM  u116753122_cw3completa.area_laboratorio where estado='1'  and id_departamento=" . $id_departamento . " ";
                        $resultadP2a = $conetar->query($cadena);
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";
                            if (trim($filaP2a['id']) == $id_area) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>


    </div>

    <!-- Sección 3 -->
    <div class="row mb-2">
        <div class="col-md-4">
            <div class="form-group">
                <label for="responsable" style="font-size: 11px;">Responsable Mantenimiento</label>
                <select class="select2" name="responsablemant" id="responsablemant" style="width: 100%;" onchange="changeResp(this)">
                    <option selected disabled>Selecciona:</option>
                    <?php
                    $cadena = "SELECT trim(P.id_persona) as id_persona,trim(CONCAT( P.nombre_1,' ',P.nombre_2,' ',P.apellido_1,' ',P.apellido_2)) as nombre 
                    FROM  u116753122_cw3completa.persona P,  u116753122_cw3completa.persona_empleados PE where P.id_persona=PE.id_persona and P.estado = 1;";
                    $resultadP2a = $conetar->query($cadena);
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id_persona']) . "'";
                        if (trim($filaP2a['id_persona']) == $id_respmantemiento) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div id="resp-tenencia">
                    <label for="responsable" style="font-size: 11px;">Responsable Tenencia</label>
                    <select class="select2" name="responsable" id="responsable" style="width: 100%;">
                        <option selected disabled>Selecciona:</option>
                        <?php
                        $cadena = "SELECT trim(P.id_persona) as id_persona,trim(CONCAT( P.nombre_1,' ',P.nombre_2,' ',P.apellido_1,' ',P.apellido_2)) as nombre 
                    FROM  u116753122_cw3completa.persona P,  u116753122_cw3completa.persona_empleados PE where P.id_persona=PE.id_persona and p.estado = 1;";
                        $resultadP2a = $conetar->query($cadena);
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_persona']) . "'";
                            if (trim($filaP2a['id_persona']) == $id_responsable) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label for="fchinstalacion" style="font-size: 11px;">Fecha de Compra:</label>
                <input type="date" class="form-control" name="fchinstalacion" id="fchinstalacion" value="<?php echo $fchinstalacion; ?>">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="valor" style="font-size: 11px;">Valor:</label>
                <input type="number" class="form-control" name="valor" id="valor" value="<?php echo $valor; ?>">
            </div>
        </div>

    </div>

    <!-- Sección 4 -->
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="seguro" style="font-size: 11px;">Seguro:</label>
                <select class="select2" aria-label="Default select example" name="seguro" id="seguro" required style="width: 100%;">
                    <option selected disabled>Selecciona:</option>
                    <option value="S" <?= ($seguro == "S") ? "selected" : "" ?>>SI</option>
                    <option value="N" <?= ($seguro == "N") ? "selected" : "" ?>>NO</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="aseguradora" style="font-size: 11px;">Aseguradora:</label>
                <input type="text" class="form-control" name="aseguradora" id="aseguradora" value="<?php echo $aseguradora; ?>">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="fchiniciogarantia" style="font-size: 11px;">Fecha inicio Seguro:</label>
                <input type="date" class="form-control" name="fchinicioseguro" id="fchinicioseguro" value="<?php echo $fchinicioseguro; ?>">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="fchexpgarantia" style="font-size: 11px;">Fecha fin Seguro:</label>
                <input type="date" class="form-control" name="fchexpseguro" id="fchexpseguro" value="<?php echo $fchexpseguro; ?>">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="valor_seguro" style="font-size: 11px;">Valor Asegurado:</label>
                <input type="number" class="form-control" name="valor_seguro" id="valor_seguro" value="<?php echo $valor_asegurado; ?>">
            </div>
        </div>


    </div>

    <!-- Sección 5 -->
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="garantia" style="font-size: 11px;">Garantia:</label>
                <select class="select2" aria-label="Default select example" name="garantia" id="garantia" required style="width: 100%;">
                    <option selected disabled>Selecciona:</option>
                    <option value="S" <?= ($garantia == "S") ? "selected" : "" ?>>SI</option>
                    <option value="N" <?= ($garantia == "N") ? "selected" : "" ?>>NO</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="proveegarantia" style="font-size: 11px;">Proveedor Responsable Garantia:</label>
                <select class="select2" name="proveegarantia" id="proveegarantia" style="width: 100%;">
                    <option selected disabled required>Selecciona:</option>
                    <?php
                    $cadena = "SELECT id_proveedores, nombre_comercial FROM  u116753122_cw3completa.proveedores where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id_proveedores']) . "'";
                        if (trim($filaP2a['id_proveedores']) == $id_proveegarantia) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a['nombre_comercial'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="fchiniciogarantia" style="font-size: 11px;">Fecha Inicio Garantia:</label>
                <input type="date" class="form-control" name="fchiniciogarantia" id="fchiniciogarantia" value="<?php echo $fchiniciogarantia; ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="fchexpgarantia" style="font-size: 11px;">Fecha expiracion Garantia:</label>
                <input type="date" class="form-control" name="fchexpgarantia" id="fchexpgarantia" value="<?php echo $fchexpgarantia; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="optmante" style="font-size: 11px;">¿Necesita mantenimiento?</label>
                <select class="select2" name="optmante" id="optmante" required style="width: 100%;">
                    <option></option>
                    <option value="1" <?= ($op_mantenimiento == "1") ? "selected" : "" ?>>SI</option>
                    <option value="2" <?= ($op_mantenimiento == "2") ? "selected" : "" ?>>NO</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="metdepreciacion" style="font-size: 11px;">Metodo de Depreciación:</label>
                <select class="select2" name="metdepreciacion" id="metdepreciacion" style="width: 100%;">
                    <option disabled>Selecciona:</option>
                    <option value='1' selected>Metodo de la Linea Recta</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="vidautilmes" style="font-size: 11px;">Vida útil en años:</label>
                <input type="number" class="form-control" name="vidautilmes" id="vidautilmes" value="<?php echo $vidautilmes; ?>">
            </div>
        </div>
    </div>
</div>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

<script>
    function areaFunc(sel) {
        var id = $('option:selected', sel).attr('value');
        $("#area-id").load("https://conlabweb3.tierramontemariana.org/apps/activofijo/area.php", {
            id: id
        });
    }

    function changeResp(sel) {
        var id = $('option:selected', sel).attr('value');
        $("#resp-tenencia").load("https://conlabweb3.tierramontemariana.org/apps/activofijo/responsable-tenencia.php", {
            id: id
        });
    }

    $(document).ready(function() {

        $('#seguro').change(function() {
            if ($(this).val() == 'S') {
                $('#aseguradora').prop('disabled', false);
                $('#valor_seguro').prop('disabled', false);
                $('#fchinicioseguro').prop('disabled', false);
                $('#fchexpseguro').prop('disabled', false);

            } else {
                $('#aseguradora').prop('disabled', true).val('');
                $('#valor_seguro').prop('disabled', true).val('');
                $('#fchinicioseguro').prop('disabled', true).val('');
                $('#fchexpseguro').prop('disabled', true).val('');
            }
        });

        $('#garantia').change(function() {
            if ($(this).val() == 'S') {
                $('#fchexpgarantia').prop('disabled', false);
                $('#proveegarantia').prop('disabled', false);
                $('#fchiniciogarantia').prop('disabled', false);
            } else {
                $('#fchexpgarantia').prop('disabled', true).val('');
                $('#proveegarantia').prop('disabled', true).val('');
                $('#fchiniciogarantia').prop('disabled', true).val('');
            }
        });

        $('.select2').select2({
            minimumResultsForSearch: 0
        });

    });
    $(document).ready(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                $.ajax({
                    type: 'POST',
                    url: 'https://conlabweb3.tierramontemariana.org/apps/activofijo/crud-2.php?aux=2',
                    data: $('#formEditActivos').serialize(),
                    success: function(respuesta) {
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "Registro Exitoso",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        cargarDatos();
                        $('#modalEditActivoFijo').modal('hide');
                        $('body').removeClass('modal-open'); // Eliminar la clase modal-open del body
                        $('.modal-backdrop').remove(); // Eliminar el backdrop del modal
                    }
                });
            }
        });
        $('#formEditActivos').validate({
            rules: {
                optmante: {
                    required: true
                },
                id_sedes: {
                    required: true
                },
                descp: {
                    required: true
                }
            },
            messages: {
                optmante: {
                    required: ""
                },
                id_sedes: {
                    required: ""
                },
                descp: {
                    required: ""
                }
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

    })
</script>