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

    if (isset($_REQUEST['status'])) {
        $status = $_REQUEST['status'];
        if ($status == "-1") {
            $status = "";
        }
    } else {
        $status = "";
    }

    $cadena = "SELECT id_medicos, id_tipo_identificacion, documento, nombres, apellidos, id_tipo_genero, 
        fecha_nacimiento, registro_medico, especialidad, email, telefono, movil, entidades_ads, comentarios, centro_medico, 
        direccion, ciudad, departamento, aficiones, categoria, secretaria, fecha_secretaria, estado
                FROM medicos
                WHERE id_medicos='" . $id . "'";

    $resultadP2 = $conetar->query($cadena);
    $numerfiles2 = mysqli_num_rows($resultadP2);
    if ($numerfiles2 >= 1) {
        $filaP2 = mysqli_fetch_array($resultadP2);
        $id = trim($filaP2['id_medicos']);
        $id_tipo_identificacion = trim($filaP2['id_tipo_identificacion']);
        $documento = trim($filaP2['documento']);
        $nombres = trim($filaP2['nombres']);
        $apellidos = trim($filaP2['apellidos']);
        $id_tipo_genero = trim($filaP2['id_tipo_genero']);
        $fecha_nacimiento = trim($filaP2['fecha_nacimiento']);
        $registro_medico = trim($filaP2['registro_medico']);
        $especialidad = trim($filaP2['especialidad']);
        $email = trim($filaP2['email']);
        $telefono = trim($filaP2['telefono']);
        $movil = trim($filaP2['movil']);
        $entidades_ads = trim($filaP2['entidades_ads']);
        $comentarios = trim($filaP2['comentarios']);
        $centro_medico = trim($filaP2['centro_medico']);
        $direccion = trim($filaP2['direccion']);
        $ciudad = trim($filaP2['ciudad']);
        $departamento = trim($filaP2['departamento']);
        $aficiones = trim($filaP2['aficiones']);
        $categoria = trim($filaP2['categoria']);
        $secretaria = trim($filaP2['secretaria']);
        $fecha_secretaria = trim($filaP2['fecha_secretaria']);
        $estado = trim($filaP2['estado']);
    }
?>

    <div style="background-color: #EDF4F5; padding:5px; border-radius:5px; margin-bottom:10px; font-size:13px;">
        <strong>Datos Básicos:</strong>
    </div>

    <input type="hidden" name="id">

    <div class="row">
        <div class="col-md-4">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label style="font-size: 12px;">Tipo Identificacion:</label>
            <select class="form-control" name="id_tipo_identificacion" id="id_tipo_identificacion">
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena = "SELECT id, nombre
                                                                FROM tipo_identificacion
                                                                where estado='1'";
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
            <div id="id_tipo_identificacionx"></div>
        </div>
        <div class="col-md-2">
            <label style="font-size: 12px;">No. Identificación:</label>
            <input type="text" class="form-control" name="numero_ide" id="numero_ide" value="<?php echo $documento; ?>" required>
        </div>
        <div class="col-md-3">
            <label style="font-size: 12px;">Nombres:</label>
            <input type="text" class="form-control" name="nombres" id="nombres" value="<?php echo $nombres; ?>" required>
        </div>

        <div class="col-md-3">
            <label style="font-size: 12px;">Apellidos:</label>
            <input type="text" class="form-control" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>" required>
        </div>

    </div>

    <div class="row mt-2 mb-4">
        <div class="col-md-2">
            <label style="font-size: 12px;">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>"></input>
            <div id="fecha_nacimientox"></div>
        </div>
        <div class="col-md-2">
            <label style="font-size: 12px;">Sexo:</label>
            <select class="form-control" name="id_tipo_genero" id="id_tipo_genero">
                <option selected="true" disabled="disabled"></option>
                <option value="1" <?php if ($id_tipo_genero == "1") {
                                        echo " selected";
                                    } ?>>Masculino</option>
                <option value="2" <?php if ($id_tipo_genero == "2") {
                                        echo " selected";
                                    } ?>>Femenino</option>
                <option value="3" <?php if ($id_tipo_genero == "3") {
                                        echo " selected";
                                    } ?>>Otro</option>
            </select>
            <div id="id_tipo_generox"></div>
        </div>

        <div class="col-md-2">
            <label style="font-size: 12px;">Teléfono Consultorio:</label>
            <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>"></input>
            <div id="telefonox"></div>
        </div>

        <div class="col-md-2">
            <label style="font-size: 12px;">Celular:</label>
            <input type="text" class="form-control" name="movil" id="movil" value="<?php echo $movil; ?>" required></input>
            <div id="movilx"></div>
        </div>

        <div class="col-md-4">
            <label style="font-size: 12px;">Correo:</label>
            <input type="text" class="form-control" name="correo" id="correo" value="<?php echo $email; ?>">
        </div>

    </div>

    <hr>

    <div class="row mt-2">

        <!--<div class="col-md-3">
            <label style="font-size: 12px;">Registro Médico:</label>
            <input type="text" class="form-control" name="regmedico" id="regmedico" value="<?php echo $registro_medico; ?>">
        </div>-->

        <div class="col-md-3">
            <label style="font-size: 12px;">Especialidad:</label>
            <select name="especialidad" id="especialidad" class="form-control" required>
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena = "SELECT id, descripcion, estado FROM especialidades
                                                                            where estado='1'";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id']) . "'";
                        if (trim($filaP2a['id']) == $especialidad) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a['descripcion'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="col-md-3">
            <label style="font-size: 12px;">Sub - Especialidad:</label>
            <select name="subespecialidad" id="subespecialidad" class="form-control" required>
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena = "SELECT id, nombre, estado FROM sub_especialidades
                                                                            where estado='1'";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id']) . "'";
                        if (trim($filaP2a['id']) == $especialidad) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="col-md-6">
            <label style="font-size: 12px;">Comentarios:</label>
            <textarea class="form-control" name="comentarios" id="comentarios" cols="30" rows="1"><?php echo $comentarios; ?></textarea>
        </div>

    </div>

    <!--<div class="row mt-2">

                        <div class="col-md-3">
                            <label style="font-size: 12px;">Entidades Adscritas:</label>
                            <textarea class="form-control" name="entidades" id="entidades" cols="30" rows="1" required><?php echo $entidades_ads; ?></textarea>
                        </div>

                    </div>-->

    <div style="background-color: #EDF4F5; padding:5px; border-radius:5px; margin-top:20px; margin-bottom:10px; font-size:13px;">
        <strong>Información de Dirección:</strong>
    </div>

    <div class="row mt-2">

        <div class="col-md-5">
            <label style="font-size: 12px;">Centro Médico:</label>
            <select class="form-control" name="centro_medico" id="centro_medico" required>
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena = "SELECT id_centro, nombre_centro FROM centros_medicos
                                                                            where estado='1'";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id_centro']) . "'";
                        if (trim($filaP2a['id_centro']) == $centro_medico) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a['nombre_centro'] . "</option>";
                    }
                }
                ?>
            </select>
            <div id="centro_medicox"></div>
        </div>

        <div class="col-md-4">
            <label style="font-size: 12px;">Dirección - Cosultorio:</label>
            <!--<input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>"></input>-->
            <textarea class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>" cols="30" rows="1"></textarea>
            <div id="direccionx"></div>
        </div>

        <div class="col-md-3">
            <label style="font-size: 12px;">Ciudad:</label>
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

    <div class="row mt-2">
        <div class="col-md-3">
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
    </div>

    <div style="background-color: #EDF4F5; padding:5px; border-radius:5px; margin-top:20px; margin-bottom:10px; font-size:13px;">
        <strong>Información Adicional:</strong>
    </div>

    <div class="row">
        <div class="col-md-3">
            <label style="font-size: 12px;">Categoría:</label>
            <select class="form-control" name="catemedica" id="catemedica">
                <option disabled="disabled"></option>
                <option value="A">A > 8M</option>
                <option value="B">B 5-8M</option>
                <option value="C">C 1-5M</option>
                <option value="NA" selected="true">No Aplica</option>
            </select>
        </div>

        <div class="col-md-3">
            <label style="font-size: 12px;" for="">Aficiones:</label>
            <textarea name='tags3' cols="30" rows="5" placeholder='Escribe o elige las aficiones'>
            <?php

            echo $aficiones;

            ?>
            </textarea>
        </div>

        <div class="col-md-3">
            <label style="font-size: 12px;">Nombres - Secreataria:</label>
            <input type="text" class="form-control" name="nombre_secre" id="nombre_secre" value="<?php echo $secretaria; ?>"></input>
            <div id="depx"></div>
        </div>

        <div class="col-md-3">
            <label style="font-size: 12px;">Fecha cumpleaños - Secreataria:</label>
            <input type="date" class="form-control" name="cumple_secre" id="cumple_secre" value="<?php echo $fecha_secretaria; ?>"></input>
            <div id="depx"></div>
        </div>

    </div>

<?php } ?>

<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {

        var input = document.querySelector('textarea[name=tags3]'),
            tagify = new Tagify(input, {
                enforceWhitelist: true,
                whitelist: [
                    <?php
                    $cadena = "SELECT id, nombre, estado FROM aficiones WHERE estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                    ?> "<?= $filaP2a['nombre'] ?>",
                    <?php
                        }
                    }
                    ?>
                ],
                callbacks: {
                    add: console.log, // callback when adding a tag
                    remove: console.log // callback when removing a tag
                }
            });

        $('input[type="input"],input[type="text"] ').on('keyup', function() {
            var texto = $(this).val();
            var palabras = texto.split(' ');

            for (var i = 0; i < palabras.length; i++) {
                var primeraLetra = palabras[i].charAt(0).toUpperCase();
                var restoPalabra = palabras[i].slice(1).toLowerCase();
                palabras[i] = primeraLetra + restoPalabra;
            }

            var textoFormateado = palabras.join(' ');
            $(this).val(textoFormateado);
        });

        $.validator.setDefaults({
            submitHandler: function() {
                $.ajax({
                    type: 'POST',
                    url: 'https://cw3.tierramontemariana.org/apps/medicos/crud.php?aux=2',
                    data: $('#formeditar').serialize(),
                    success: function(respuesta) {
                        $(".content-table-sedes").load('https://cw3.tierramontemariana.org/apps/medicos/thedatatable.php');

                        //alert("¡Registro actualizado con exito!");
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: '¡Registro actualizado con exito!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                });
                $("#editsedeModal").modal("hide");
            }
        });
        $('#formeditar').validate({
            rules: {
                nombre: {
                    required: true
                },
            },
            messages: {
                nombre: {
                    required: "Este campo no puede estar vacío"
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

    function loadAficionesSelectEdit() {
        $('#contentAficionesEdit').load('https://cw3.tierramontemariana.org/apps/medicos/aficiones.php');
    }
</script>