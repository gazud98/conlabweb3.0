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


    include('reglasdenavegacion.php');


    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }

    $id_categoria_producto = "1"; 
    $id_tipo_identificacion = "";
    $documento = "";
    $nombre_1 = "";
    $nombre_2 = "";
    $apellido_1 = "";
    $apellido_2 = "";
    $id_tipo_genero = "";
    $estado = "";
    $fecha_nacimiento = "";
    $direccion = "";
    $telefono = "";
    $movil = "";
    $ciudad = "";
    $departamento = "";
    $direccion_alterna = "";
    $telefono_alterno = "";
    $fecha_ingreso = "";
    $fecha_retiro = "";
    $email = "";
    $id_sede = "";
    $id_cargos = "";
    $id_departamento = "";
    $detalle_cargo = "";
    $tarjeta_profesional = "";
    $empresa_temporal = "";
    $estado = "1";


    if ($id != "") {
        $cadena = "select P.id_persona,P.id_tipo_identificacion, P.documento, P.nombre_1, P.nombre_2, P.apellido_1, P.apellido_2, P.id_tipo_genero, P.estado,
                    P.fecha_nacimiento,P.direccion, P.telefono, P.movil, P.ciudad, P.direccion_alterna, P.telefono_alterno,
                    PE.fecha_ingreso, PE.fecha_retiro,
                    PE.email, PE.id_sede,PE.id_cargos, PE.detalle_cargo, PE.tarjeta_profesional, PE.empresa_temporal,PE.id_departamento,P.departamento
                from persona P,
                    persona_empleados PE
                where  P.id_persona=PE.id_persona
                    and P.id_persona='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_persona']);
            $id_tipo_identificacion = trim($filaP2['id_tipo_identificacion']);
            $documento = trim($filaP2['documento']);
            $nombre_1 = trim($filaP2['nombre_1']);
            $nombre_2 = trim($filaP2['nombre_2']);
            $apellido_1 = trim($filaP2['apellido_1']);
            $apellido_2 = trim($filaP2['apellido_2']);
            $id_tipo_genero = trim($filaP2['id_tipo_genero']);
            $estado = trim($filaP2['estado']);
            $fecha_nacimiento = trim($filaP2['fecha_nacimiento']);
            $direccion = trim($filaP2['direccion']);
            $telefono = trim($filaP2['telefono']);
            $movil = trim($filaP2['movil']);
            $ciudad = trim($filaP2['ciudad']);
            $departamento = trim($filaP2['departamento']);
            $direccion_alterna = trim($filaP2['direccion_alterna']);
            $telefono_alterno = trim($filaP2['telefono_alterno']);
            $fecha_ingreso = trim($filaP2['fecha_ingreso']);
            $fecha_retiro = trim($filaP2['fecha_retiro']);
            $email = trim($filaP2['email']);
            $id_sede = trim($filaP2['id_sede']);
            $id_departamento = trim($filaP2['id_departamento']);
            $id_cargos = trim($filaP2['id_cargos']);
            $detalle_cargo = trim($filaP2['detalle_cargo']);
            $tarjeta_profesional = trim($filaP2['tarjeta_profesional']);
            $empresa_temporal = trim($filaP2['empresa_temporal']);
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


    <form name="formEditEmployee" id="formEditEmployee" action="" method="POST" enctype="multipart/form-data" style="width: 100%;">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="<?php echo $status ?>">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

        <div class="row mb-2">
            <div class="col-md-6">
                <label style="font-size: 12px;">Tipo Identificación:</label>
                <select class="form-control" name="id_tipo_identificacion" id="id_tipo_identificacion" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id, nombre FROM tipo_identificacion WHERE estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";
                            if (trim($filaP2a['id']) == $id_tipo_identificacion) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>

            </div>
            <div class="col-md-6">
                <label style="font-size: 12px;">Numero:</label>
                <input type="number" class="form-control" name="documento" required id="documento" value="<?php echo $documento; ?>"></input>
                <div id="documentox"></div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-3">
                <label style="font-size: 12px;">Primer Nombre:</label>
                <input type="text" class="form-control" name="nombre_1" required id="nombre_1" value="<?php echo $nombre_1; ?>"></input>

            </div>
            <div class="col-md-3">
                <label style="font-size: 12px;">Segundo Nombre:</label>
                <input type="text" class="form-control" name="nombre_2" id="nombre_2" value="<?php echo $nombre_2; ?>"></input>

            </div>

            <div class="col-md-3">
                <label style="font-size: 12px;">Primer Apellido:</label>
                <input type="text" class="form-control" name="apellido_1" required id="apellido_1" value="<?php echo $apellido_1; ?>"></input>

            </div>
            <div class="col-md-3">
                <label style="font-size: 12px;">Segundo Apellido:</label>
                <input type="text" class="form-control" name="apellido_2" id="apellido_2" value="<?php echo $apellido_2; ?>"></input>

            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label style="font-size: 12px;">Sexo:</label>
                <select class="form-control" name="id_tipo_genero" id="id_tipo_genero" required>
                    <option selected="true" disabled="disabled"></option>
                    <option value="1" <?php if ($id_tipo_genero == "1") {
                                            echo " selected";
                                        } ?>>Masculino</option>
                    <option value="2" <?php if ($id_tipo_genero == "2") {
                                            echo " selected";
                                        } ?>>Femenino</option>
                </select>
                <div id="id_tipo_generox"></div>
            </div>
            <div class="col-md-6">
                <label style="font-size: 12px;">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" name="fecha_nacimiento" required id="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>"></input>
                <div id="fecha_nacimientox"></div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label style="font-size: 12px;">Departamento:</label>

                <select class="form-control" name="dep" id="dep" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena33 = "SELECT id, nombre FROM departamento";
                    $resultadP2a33 = $conetar->query($cadena33);

                    if ($resultadP2a33->num_rows > 0) {
                        while ($row = $resultadP2a33->fetch_assoc()) {
                            $value = $row['id'];
                            $dep_nombre = $row['nombre'];
                            $selected = ($departamento == $value) ? 'selected' : '';
                            echo "<option value='$value' $selected>$dep_nombre</option>";
                        }
                    }
                    ?>
                </select>
                <div id="depx"></div>
            </div>

            <div class="col-md-6">
                <label style="font-size: 12px;">Ciudad</label>
                <select class="form-control" name="ciudad" id="ciudad" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena33 = "SELECT id, nombre FROM ciudades";
                    $resultadP2a33 = $conetar->query($cadena33);

                    if ($resultadP2a33->num_rows > 0) {
                        while ($row = $resultadP2a33->fetch_assoc()) {
                            $value = $row['id'];
                            $ciudad_nombre = $row['nombre'];
                            $selected = ($ciudad == $value) ? 'selected' : '';
                            echo "<option value='$value' $selected>$ciudad_nombre</option>";
                        }
                    }
                    ?>
                </select>
                <div id="ciudadx"></div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label style="font-size: 12px;">Direccion:</label>
                <input type="text" class="form-control" name="direccion" required id="direccion" value="<?php echo $direccion; ?>"></input>
                <div id="direccionx"></div>
            </div>
            <div class="col-md-6">
                <label style="font-size: 12px;">Telefono:</label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>"></input>
                <div id="telefonox"></div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label style="font-size: 12px;">Movil:</label>
                <input type="text" class="form-control" name="movil" required id="movil" value="<?php echo $movil; ?>"></input>
                <div id="movilx"></div>
            </div>
            <div class="col-md-6">
                <label style="font-size: 12px;">Fecha de Ingreso:</label>
                <input type="date" class="form-control" name="fecha_ingreso" id="fecha_ingreso" value="<?php echo $fecha_ingreso; ?>"></input>
                <div id="fecha_ingresox"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label style="font-size: 12px;">Fecha de Retiro:</label>
                <input type="date" class="form-control" name="fecha_retiro" id="fecha_retiro" value="<?php echo $fecha_retiro; ?>"></input>
                <div id="fecha_retirox"></div>
            </div>
            <div class="col-md-6">
                <label style="font-size: 12px;">Sede:</label>
                <select name="id_sede" id="id_sede" class="form-control" required>
                    <option value=""></option>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id_sedes, nombre FROM sedes WHERE estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_sedes']) . "'";
                            if (trim($filaP2a['id_sedes']) == $id_sede) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <div id="id_sedex"></div>
            </div>
        </div>

        <div class="row mt-2 mb-2">
            <div class="col-md-6">
                <label style="font-size: 12px;">Cargo:</label>
                <select class="form-control" name="id_cargos" id="id_cargos" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id, nombre FROM cargos WHERE estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";
                            if (trim($filaP2a['id']) == $id_cargos) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <div id="id_cargosx"></div>
            </div>
            <div class="col-md-6">
                <label style="font-size: 12px;">Departamento:</label>
                <select class="form-control" name="id_departamentos" id="id_departamentos" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id, nombre FROM departamentos WHERE estado='1'";
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
                <div id="id_departamentosx"></div>
            </div>
        </div>
        <div class="card-footer mt-5 text-center">
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
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- jquery-validation -->
<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                updateEmployee()
                $('#modalEditActivoFijo').modal('hide');
            }
        });
        $('#formEditEmployee').validate({
            rules: {
                id_tipo_identificacion: {
                    required: true
                },
                documento: {
                    required: true
                },
                nombre_1: {
                    required: true
                },
                apellido_1: {
                    required: true
                },
                id_tipo_genero: {
                    required: true
                },
                fecha_nacimiento: {
                    required: true
                },
                dep: {
                    required: true
                },
                ciudad: {
                    required: true
                },
                direccion: {
                    required: true
                },
                movil: {
                    required: true
                },
                fecha_ingreso: {
                    required: true
                },
                id_sede: {
                    required: true
                },
                id_cargos: {
                    required: true
                },
                id_departamentos: {
                    required: true
                }

            },
            messages: {
                id_tipo_identificacion: {
                    required: ""
                },
                documento: {
                    required: ""
                },
                nombre_1: {
                    required: ""
                },
                apellido_1: {
                    required: ""
                },
                id_tipo_genero: {
                    required: ""
                },
                fecha_nacimiento: {
                    required: ""
                },
                dep: {
                    required: ""
                },
                ciudad: {
                    required: ""
                },
                direccion: {
                    required: ""
                },
                movil: {
                    required: ""
                },
                id_sede: {
                    required: ""
                },
                id_cargos: {
                    required: ""
                },
                id_departamentos: {
                    required: ""
                },
                fecha_ingreso: {
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
    });

    $(document).ready(function() {
        $('#dep').change(function() {
            loadCities();
        })
    })

    function loadCities() {

        id = $('#dep').val();

        $.ajax({
            url: 'https://cw3.tierramontemariana.org/apps/empleados/ciudades.php',
            data: {
                id: id
            },
            success: function(res) {
                $('#ciudad').html(res);
            }
        })

    }
</script>