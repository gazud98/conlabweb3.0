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
    <div class="modal-dialog">
        <div class="modal-content" style="width: 1000px; margin-left:-280px;">
            <form id="formeditar" action="#" method="POST">
                <input type="hidden" name="id" value="">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Paciente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-3">
                            <label style="font-size: 12px;">Tipo Identificacion:</label>
                            <select class="form-control" name="id_tipo_identificacion" id="id_tipo_identificacion" style="width: 50px;">
                                <option selected="true" disabled="disabled"></option>

                            </select>
                            <div id="id_tipo_identificacionx"></div>
                        </div>
                    </div>

                    <table class="table-input">
                        <tr>
                            <td>

                            </td>
                            <td>
                                <label style="font-size: 12px;">No. Identificación:</label>
                                <input type="text" class="form-control" name="numero_ide" id="numero_ide" value="" required>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <label style="font-size: 12px;">Primer Nombre:</label>
                                <input type="text" class="form-control" name="nombre_1" id="nombre_1" value="" required>
                            </td>
                            <td>
                                <label style="font-size: 12px;">Segundo Nombre:</label>
                                <input type="text" class="form-control" name="nombre_2" id="nombre_2" value="">
                            </td>
                            <td>
                                <label style="font-size: 12px;">Primer Apellido:</label>
                                <input type="text" class="form-control" name="apellido_1" id="apellido_1" value="" required>
                            </td>
                            <td>
                                <label style="font-size: 12px;">Segundo Nombre:</label>
                                <input type="text" class="form-control" name="apellido_2" id="apellido_2" value="">
                            </td>
                        </tr>

                        <tr>

                            <td>
                                <label style="font-size: 12px;">Sexo:</label>
                                <select class="form-control" name="id_tipo_genero" id="id_tipo_genero">
                                    <option selected="true" disabled="disabled"></option>
                                    <option value="1" <?php if ($id_tipo_genero == "1") {
                                                            echo " selected";
                                                        } ?>>Masculino</option>
                                    <option value="2" <?php if ($id_tipo_genero == "2") {
                                                            echo " selected";
                                                        } ?>>Femenino</option>
                                </select>
                                <div id="id_tipo_generox"></div>
                            </td>

                            <td>
                                <label style="font-size: 12px;">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value=""></input>
                                <div id="fecha_nacimientox"></div>
                            </td>
                            <td>
                                <label style="font-size: 12px;">Telefono:</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" value=""></input>
                                <div id="telefonox"></div>
                            </td>
                            <td>
                                <label style="font-size: 12px;">Movil:</label>
                                <input type="text" class="form-control" name="movil" id="movil" value=""></input>
                                <div id="movilx"></div>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <label style="font-size: 12px;">Tipo de Sangre:</label>
                                <!--<input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>"></input>-->
                                <select name="tiposangre" id="tiposangre" class="form-control" required>
                                    <option selected="true" disabled="disabled"></option>
                                    <option value="A+">A positivo (A +)</option>
                                    <option value="A-">A negativo (A-)</option>
                                    <option value="B+"> positivo (B+)</option>
                                    <option value="B-">B negativo (B-)</option>
                                    <option value="AB+">AB positivo (AB+)</option>
                                    <option value="AB-">AB negativo (AB-)</option>
                                    <option value="O+">O positivo (O+)</option>
                                    <option value="O-">O negativo (O-)</option>
                                </select>
                                <div id="tipodesangex"></div>
                            </td>
                        </tr>

                    </table>

                    <div style="background-color: #EDF4F5; padding:5px; border-radius:5px; margin-top:20px; margin-bottom:10px; font-size:13px;">
                        <strong>Información de Dirección:</strong>
                    </div>

                    <table class="table-input">
                        <tr>
                            <td>
                                <label style="font-size: 12px;">Direccion de Residencia:</label>
                                <!--<input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>"></input>-->
                                <textarea class="form-control" name="direccion" id="direccion" value="" cols="30" rows="1"></textarea>
                                <div id="direccionx"></div>
                            </td>
                            <td>
                                <label style="font-size: 12px;">Ciudad de Residencia:</label>
                                <input type="text" class="form-control" name="ciudad" id="ciudad" value=""></input>
                                <div id="ciudadx"></div>
                            </td>
                            <td>
                                <label style="font-size: 12px;">Departamento de Residencia:</label>
                                <input type="text" class="form-control" name="dep" id="dep" value=""></input>
                                <div id="depx"></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="E">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">Cancelar</button>
                    <button type="submit" class="btn btn-success" value="Aceptar">Aceptar</button>
                </div>
            </form>
        </div>
    </div>

<?php } ?>

<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
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
                    url: '/desarrolloV3/apps/pacientes/crud.php',
                    data: $('#formeditar').serialize(),
                    success: function(respuesta) {
                        $(".content-table-sedes").load('/desarrolloV3/apps/pacientes/thedatatable.php');

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
</script>