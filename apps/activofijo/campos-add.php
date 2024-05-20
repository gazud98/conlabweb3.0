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


?>
    <input type="hidden" name="id_categoria_producto" id="id_categoria_producto" value="1">
    <input type="hidden" name="modeeditstatus" id="modeeditstatus" value=" ">

    <div class="container ">
        <!-- Sección 1 -->
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nombre" style="font-size: 11px;">Nombre:</label>
                    <input type="input" class="form-control" name="nombre" id="nombre" value="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="modelo" style="font-size: 11px;">Modelo:</label>
                    <input type="input" class="form-control" name="modelo" id="modelo" value="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="serie" style="font-size: 11px;">Serie:</label>
                    <input type="input" class="form-control" name="serie" id="serie" value="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="descp" style="font-size: 11px;">Descripción:</label>
                    <input type="input" class="form-control" name="descp" id="descp" value="" required>
                </div>
            </div>
        </div>

        <!-- Sección 2 -->
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="id_tipo_activo" style="font-size: 11px;">Tipo de Activo Fijo</label>
                    <select class="select1" name="id_tipo_activo" id="id_tipo_activo" style="width: 100%;">
                        <option selected disabled>Selecciona:</option>
                        <?php
                        $cadena = "SELECT id, nombre FROM  u116753122_cw3completa.tipo_activo_fijos where estado='1'";
                        $resultadP2a = $conetar->query($cadena);
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";

                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="id_sedes" style="font-size: 11px;">Sede</label>
                    <select class="select1" name="id_sedes" id="id_sedes" required style="width: 100%;">
                        <option selected disabled>Selecciona:</option>
                        <?php
                        $cadena = "SELECT id_sedes, nombre FROM  u116753122_cw3completa.sedes where estado='1'";
                        $resultadP2a = $conetar->query($cadena);
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_sedes']) . "'";

                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="id_departamento" style="font-size: 11px;">Departamento</label>
                    <select class="select1" name="id_departamento" id="id_departamento" style="width: 100%;" onchange='areaFunc(this);'>
                        <option selected disabled>Selecciona:</option>
                        <?php
                        $cadena = "SELECT id, nombre FROM  u116753122_cw3completa.departamentos where estado='1'";
                        $resultadP2a = $conetar->query($cadena);
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";

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
                        <select class="select1" name="area" id="area" style="width: 100%;">

                            <?php
                            $cadena = "SELECT id, nombre FROM  u116753122_cw3completa.area_laboratorio where estado='1' ";
                            $resultadP2a = $conetar->query($cadena);
                            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                echo "<option value='" . trim($filaP2a['id']) . "'";

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
                    <select class="select1" name="responsablemant" id="responsablemant" style="width: 100%;" onchange="changeResp(this)">
                        <option selected disabled>Selecciona:</option>
                        <?php
                        $cadena = "SELECT trim(P.id_persona) as id_persona,trim(CONCAT( P.nombre_1,' ',P.nombre_2,' ',P.apellido_1,' ',P.apellido_2)) as nombre 
                    FROM  u116753122_cw3completa.persona P,  u116753122_cw3completa.persona_empleados PE where P.id_persona=PE.id_persona and p.estado = 1;";
                        $resultadP2a = $conetar->query($cadena);
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_persona']) . "'";

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
                        <select class="select1" name="responsable" id="responsable" style="width: 100%;">
                            <option selected disabled>Selecciona:</option>
                            <?php
                            $cadena = "SELECT trim(P.id_persona) as id_persona,trim(CONCAT( P.nombre_1,' ',P.nombre_2,' ',P.apellido_1,' ',P.apellido_2)) as nombre 
                    FROM  u116753122_cw3completa.persona P,  u116753122_cw3completa.persona_empleados PE where P.id_persona=PE.id_persona and p.estado = 1;";
                            $resultadP2a = $conetar->query($cadena);
                            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                echo "<option value='" . trim($filaP2a['id_persona']) . "'";

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
                    <input type="date" class="form-control" name="fchinstalacion" id="fchinstalacion" value="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="valor" style="font-size: 11px;">Valor:</label>
                    <input type="number" class="form-control" name="valor" id="valor" value="">
                </div>
            </div>

        </div>

        <!-- Sección 4 -->
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="seguro" style="font-size: 11px;">Seguro:</label>
                    <select class="select1" aria-label="Default select example" name="seguro" id="seguro" required style="width: 100%;">
                        <option selected disabled>Selecciona:</option>
                        <option value="S">SI</option>
                        <option value="N">NO</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="aseguradora" style="font-size: 11px;">Aseguradora:</label>
                    <input type="text" class="form-control" name="aseguradora" id="aseguradora" value="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="fchiniciogarantia" style="font-size: 11px;">Fecha inicio Seguro:</label>
                    <input type="date" class="form-control" name="fchinicioseguro" id="fchinicioseguro" value="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="fchexpgarantia" style="font-size: 11px;">Fecha fin Seguro:</label>
                    <input type="date" class="form-control" name="fchexpseguro" id="fchexpseguro" value="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="valor_seguro" style="font-size: 11px;">Valor Asegurado:</label>
                    <input type="number" class="form-control" name="valor_seguro" id="valor_seguro" value="">
                </div>
            </div>


        </div>

        <!-- Sección 5 -->
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="garantia" style="font-size: 11px;">Garantia:</label>
                    <select class="select1" aria-label="Default select example" name="garantia" id="garantia" required style="width: 100%;">
                        <option selected disabled>Selecciona:</option>
                        <option value="S">SI</option>
                        <option value="N">NO</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="proveegarantia" style="font-size: 11px;">Proveedor Responsable Garantia:</label>
                    <select class="select1" name="proveegarantia" id="proveegarantia" style="width: 100%;">
                        <option selected disabled required>Selecciona:</option>
                        <?php
                        $cadena = "SELECT id_proveedores, nombre_comercial FROM  u116753122_cw3completa.proveedores where estado='1'";
                        $resultadP2a = $conetar->query($cadena);
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_proveedores']) . "'";

                            echo '>' . $filaP2a['nombre_comercial'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="fchiniciogarantia" style="font-size: 11px;">Fecha Inicio Garantia:</label>
                    <input type="date" class="form-control" name="fchiniciogarantia" id="fchiniciogarantia" value="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="fchexpgarantia" style="font-size: 11px;">Fecha expiracion Garantia:</label>
                    <input type="date" class="form-control" name="fchexpgarantia" id="fchexpgarantia" value="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="optmante" style="font-size: 11px;">¿Necesita mantenimiento?</label>
                    <select class="select1" name="optmante" id="optmante" required style="width: 100%;">
                        <option></option>
                        <option value="1">SI</option>
                        <option value="2">NO</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="metdepreciacion" style="font-size: 11px;">Metodo de Depreciación:</label>
                    <select class="select1" name="metdepreciacion" id="metdepreciacion" style="width: 100%;">
                        <option disabled>Selecciona:</option>
                        <option value='1' selected>Metodo de la Linea Recta</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="vidautilmes" style="font-size: 11px;">Vida útil en años:</label>
                    <input type="number" class="form-control" name="vidautilmes" id="vidautilmes" value="">
                </div>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/select1@4.1.0-rc.0/dist/css/select1.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select1@4.1.0-rc.0/dist/js/select1.min.js"></script>
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


            // Inicializar Select2 en los elementos select
            $('.select1').select2({
                minimumResultsForSearch: 0
            });
            // Configuración de validación del formulario
            $.validator.setDefaults({
                submitHandler: function() {
                    $.ajax({
                        type: 'POST',
                        url: 'https://conlabweb3.tierramontemariana.org/apps/activofijo/crud-2.php?aux=1',
                        data: $('#formAddActivos').serialize(),
                        success: function(respuesta) {
                            Swal.fire({
                                position: "top-center",
                                icon: "success",
                                title: "Registro Exitoso",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            cargarDatos();
                            $('#modalAddActivoFijo').modal('hide');
                            $('body').removeClass('modal-open'); // Eliminar la clase modal-open del body
                            $('.modal-backdrop').remove(); // Eliminar el backdrop del modal

                        }
                    });
                }
            });

            // Reglas de validación
            $('#formAddActivos').validate({
                rules: {
                    nombre: {
                        required: true
                    },
                    modelo: {
                        required: true
                    },
                    serie: {
                        required: true
                    },
                    descp: {
                        required: true
                    },
                    id_sedes: {
                        required: true
                    },
                    id_departamento: {
                        required: true
                    },
                    id_tipo_activo: {
                        required: true
                    },
                    responsable: {
                        required: true
                    },
                    fchinstalacion: {
                        required: true
                    },
                    valor: {
                        required: true
                    },
                    metdepreciacion: {
                        required: true
                    },
                    vidautilmes: {
                        required: true
                    },
                    optmante: {
                        required: true
                    }
                },
                messages: {
                    nombre: {
                        required: "Este campo es obligatorio."
                    },
                    modelo: {
                        required: "Este campo es obligatorio."
                    },
                    serie: {
                        required: "Este campo es obligatorio."
                    },
                    descp: {
                        required: "Este campo es obligatorio."
                    },
                    id_sedes: {
                        required: "Este campo es obligatorio."
                    },
                    id_departamento: {
                        required: "Este campo es obligatorio."
                    },
                    id_tipo_activo: {
                        required: "Este campo es obligatorio."
                    },
                    responsable: {
                        required: "Este campo es obligatorio."
                    },
                    fchinstalacion: {
                        required: "Este campo es obligatorio."
                    },
                    valor: {
                        required: "Este campo es obligatorio."
                    },
                    metdepreciacion: {
                        required: "Este campo es obligatorio."
                    },
                    vidautilmes: {
                        required: "Este campo es obligatorio."
                    },
                    optmante: {
                        required: "Este campo es obligatorio."
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
        });
    </script>

<?php }  ?>