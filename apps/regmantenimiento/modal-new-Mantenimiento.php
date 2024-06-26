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

    <div class="row">
        <div class="col-md-3">
            <label for="" style="font-size: 12px;">Tipo de Mantenimiento:</label>
            <select name="tipmant" id="tipmant" class="form-control">
                <option value="" selected disabled>SELECCIONAR:</option>
                <option value="1">Preventivo</option>
                <option value="2">Correctivo</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="" style="font-size: 12px;color:white;">.</label>
            <p style="font-size:13px;">Por favor, selecciona el tipo de mantenimiento para continuar.</p>
        </div>
    </div>

    <form name="formMant" id="formMant" action="" method="POST" enctype="multipart/form-data">
        <div class="row mt-2">
            <div class="col-12 col-md-3">
                <label style="font-size: 12px;">Sede:</label>
                <select class="select2" name="localizacion" id="localizacion" required style="width:100%;" disabled>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena33 = "SELECT id_sedes, nombre FROM sedes WHERE estado='1'";
                    $resultadP2a33 = $conetar->query($cadena33);
                    if ($resultadP2a33->num_rows >= 1) {
                        while ($filaP2a33 = $resultadP2a33->fetch_assoc()) {
                            echo "<option value='" . trim($filaP2a33['id_sedes']) . "'>" . $filaP2a33['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-3">
                <label style="font-size: 12px;">Departamento:</label>
                <select class="select2" name="departamento" id="departamento" required style="width:100%;" onchange='areaFunc(this);' disabled>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena33 = "SELECT id, nombre FROM departamentos WHERE estado='1'";
                    $resultadP2a33 = $conetar->query($cadena33);
                    if ($resultadP2a33->num_rows >= 1) {
                        while ($filaP2a33 = $resultadP2a33->fetch_assoc()) {
                            echo "<option value='" . trim($filaP2a33['id']) . "'>" . $filaP2a33['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-12 col-md-3">

                <div id="area-id">
                    <label for="area" style="font-size: 11px;">Area</label>
                    <select class="select2" name="area" id="area" style="width: 100%;" required disabled>
                        <option selected="true" disabled="disabled"></option>
                        <?php
                        $cadena = "SELECT id, nombre FROM  u116753122_cw3completa.area_laboratorio where estado='1'  ";
                        $resultadP2a = $conetar->query($cadena);
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";

                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

            </div>

            <div class="col-12 col-md-3">
                <label style="font-size: 12px;">Equipo:</label>
                <select class="select2" name="equipo" id="equipo" required style="width:100%;" disabled>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena33 = "SELECT id_producto, nombre, referencia FROM producto WHERE estado='1' AND id_categoria_producto ='1' AND op_mantenimiento = '1'";
                    $resultadP2a33 = $conetar->query($cadena33);
                    if ($resultadP2a33->num_rows >= 1) {
                        while ($filaP2a33 = $resultadP2a33->fetch_assoc()) {
                            echo "<option value='" . trim($filaP2a33['id_producto']) . "'>" . $filaP2a33['nombre'] . ' - ' . $filaP2a33['referencia'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4">
                <label style="font-size: 12px;">Proveedor:</label>
                <select class="select2" name="id_proveedor" id="id_proveedor" required style="width:100%;" disabled>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena33 = "SELECT id_proveedores, nombre_comercial FROM proveedores WHERE estado='1'";
                    $resultadP2a33 = $conetar->query($cadena33);
                    if ($resultadP2a33->num_rows >= 1) {
                        while ($filaP2a33 = $resultadP2a33->fetch_assoc()) {
                            echo "<option value='" . trim($filaP2a33['id_proveedores']) . "'>" . $filaP2a33['nombre_comercial'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <div id="id_proveedorx"></div>
            </div>
            <div class="col-md-2">
                <label style="font-size: 12px;">Garantia en días:</label>
                <input type="text" class="form-control " name="meses_garantia" id="meses_garantia" required disabled>
            </div>
            <div class="col-md-6">
                <label style="font-size: 12px;">Responsable:</label>
                <input type="text" class="form-control" name="responsable" id="responsable" required disabled>
            </div>
        </div>

        <div id="contentCorrectivo" class="mt-2">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Daño:</label>
                    <input type="text" name="danio" id="danio" class="form-control" required disabled>
                </div>
                <div class="col-md-3">
                    <label for="">Acción tomada:</label>
                    <input type="text" name="accion" id="accion" class="form-control" required disabled>
                </div>
                <div class="col-md-2">
                    <label for="">¿Repuestos?</label>
                    <select name="reqrep" id="reqrep" class="form-control" required disabled>
                        <option value="" disabled selected></option>
                        <option value="1">SI</option>
                        <option value="2">NO</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="">Añadir repuestos:</label>
                    <textarea class="form-control" name="repuestos" id="repuestos" rows="1" cols="30" disabled></textarea>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-3">
                <label style="font-size: 12px;">Fecha Inicio:</label>
                <input type="date" class="form-control" name="comenzar" id="comenzar" value="" required disabled>
                <div id="comenzarx"></div>
            </div>
            <div class="col-md-3" id="contentPreventivo">
                <label style="font-size: 12px;">Frecuencia:</label>
                <select class="form-control" name="periodicidad" id="periodicidad" required disabled>
                    <option selected="true" disabled="disabled" id="optionSelected"></option>
                    <option value="D">Diario</option>
                    <option value="S">Semanal</option>
                    <option value="Q">Quincenal</option>
                    <option value="M">Mensual</option>
                    <option value="A">Anual</option>
                </select>
            </div>
            <div class="col-md-3" id="fechaFinal">
                <label style="font-size: 12px;">Fecha de finalización:</label>
                <input type="date" class="form-control" name="fecha_final" id="fecha_final" value="" required disabled>
                <div id="fecha_comienzox"></div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <label style="font-size: 12px;">Descripción:</label>
                <textarea class="form-control" name="descripcion" id="descripcion" rows="4" cols="50" required disabled></textarea>
                <div id="descripcionx"></div>
            </div>
        </div>

        <input type="hidden" id="hiddenInput" name="hiddenInput" value="0">

        <div class="row mt-3">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary btn-sm" id="btn-save" disabled>Guardar</button>
            </div>
        </div>
    </form>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <script>
        function areaFunc(sel) {
            var id = $('option:selected', sel).attr('value');
            $("#area-id").load("https://conlabweb3.tierramontemariana.org/apps/regmantenimiento/area.php", {
                id: id
            });
        }
        $(document).ready(function() {
            // Inicializar select2
            $(".select2").select2();

            // Manejar cambios en el tipo de mantenimiento
            $('#tipmant').change(function() {


                var value = $(this).val();
                var camposCorrectivo = ['#danio', '#accion', '#reqrep', '#repuestos'];
                var camposPreventivo = ['#periodicidad'];
                var camposComunes = ['#localizacion', '#departamento', '#equipo', '#id_proveedor', '#meses_garantia', '#responsable', '#comenzar', '#descripcion', '#fecha_final'];

                // Ocultar todos los campos específicos de mantenimiento
                $('#contentCorrectivo').hide();
                $('#contentPreventivo').hide();
                camposCorrectivo.forEach(function(campo) {
                    $(campo).prop('required', false);
                });
                camposPreventivo.forEach(function(campo) {
                    $(campo).prop('required', false);
                });

                if (value == '1') { // Preventivo
                    $('#contentPreventivo').show();
                    camposPreventivo.forEach(function(campo) {
                        $(campo).prop('required', true);
                    });
                    $(".select2").attr("disabled", false);
                    $(".form-control").attr("disabled", false);
                    $('#btn-save').prop('disabled', false);
                } else if (value == '2') { // Correctivo
                    $('#contentCorrectivo').show();
                    camposCorrectivo.forEach(function(campo) {
                        $(campo).prop('required', true);
                    });
                    $(".select2").attr("disabled", false);
                    $(".form-control").attr("disabled", false);
                    $('#btn-save').prop('disabled', false);
                }

                // Mostrar siempre los campos comunes y marcarlos como requeridos
                camposComunes.forEach(function(campo) {
                    $(campo).prop('required', true);
                });
            });

            // Validación del formulario
            $.validator.setDefaults({
                submitHandler: function() {
                    var tipmant = $('#tipmant').val();
                    $.ajax({
                        method: 'POST',
                        url: 'https://conlabweb3.tierramontemariana.org/apps/regmantenimiento/crud.php?aux=1&tipmant=' + tipmant,
                        data: $('#formMant').serialize(),
                        success: function(response) {
                            console.log(response); // Verifica la respuesta del servidor
                            Swal.fire({
                                position: "top-center",
                                icon: "success",
                                title: "Registro guardado correctamente!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#addMantenimientoModal').modal('hide');
                            window.calendar.refetchEvents();
                        },
                        error: function(error) {
                            Swal.fire({
                                position: "top-center",
                                icon: "error",
                                title: "Error al guardar el registro!",
                                showConfirmButton: true
                            });
                            console.error("Error al agregar el registro:", error);
                        }
                    });
                }
            });

            $('#formMant').validate({
                rules: {
                    localizacion: {
                        required: true
                    },
                    departamento: {
                        required: true
                    },
                    area: {
                        required: true
                    },
                    equipo: {
                        required: true
                    },
                    id_proveedor: {
                        required: true
                    },
                    meses_garantia: {
                        required: true
                    },
                    responsable: {
                        required: true
                    },
                    danio: {
                        required: function() {
                            return $('#tipmant').val() == '2';
                        }
                    },
                    accion: {
                        required: function() {
                            return $('#tipmant').val() == '2';
                        }
                    },
                    reqrep: {
                        required: function() {
                            return $('#tipmant').val() == '2';
                        }
                    },
                    repuestos: {
                        required: function() {
                            return $('#tipmant').val() == '2';
                        }
                    },
                    comenzar: {
                        required: true
                    },
                    periodicidad: {
                        required: function() {
                            return $('#tipmant').val() == '1';
                        }
                    },
                    fecha_final: {
                        required: true
                    },
                    descripcion: {
                        required: true
                    }
                },
                messages: {
                    localizacion: {
                        required: "Por favor, ingrese la localización"
                    },
                    departamento: {
                        required: "Por favor, ingrese el departamento"
                    },
                    area: {
                        required: "Por favor, ingrese el departamento"
                    },
                    equipo: {
                        required: "Por favor, ingrese el equipo"
                    },
                    id_proveedor: {
                        required: "Por favor, ingrese el ID del proveedor"
                    },
                    meses_garantia: {
                        required: "Por favor, ingrese los meses de garantía"
                    },
                    responsable: {
                        required: "Por favor, ingrese el responsable"
                    },
                    danio: {
                        required: "Por favor, ingrese el daño"
                    },
                    accion: {
                        required: "Por favor, ingrese la acción"
                    },
                    reqrep: {
                        required: "Por favor, seleccione si requiere repuestos"
                    },
                    comenzar: {
                        required: "Por favor, ingrese la fecha de comienzo"
                    },
                    periodicidad: {
                        required: "Por favor, ingrese la periodicidad"
                    },
                    fecha_final: {
                        required: "Por favor, ingrese la fecha final"
                    },
                    descripcion: {
                        required: "Por favor, ingrese la descripción"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    error.addClass('error-message');
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });


            $('#tipmant').trigger('change');
        });
    </script>

<?php
}
?>