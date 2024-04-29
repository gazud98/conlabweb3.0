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
}

?>
<form name="formNewCita" id="formNewCita" action="" method="POST" enctype="multipart/form-data">
    <div class="modal-header">
        <h4 class="modal-title">Nueva Cita</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">

        <div class="row">
            <div class="col-md-4 p-3">
                <label for="">Categoría:<span style="color: red;">*</span></label>
                <select class="form-control" name="negociacion" id="negociacion" required>
                    <option value="" selected disabled>SELECCIONA:</option>
                    <option value="1">Médico</option>
                    <option value="2">Empresa</option>
                </select>
            </div>
            <!--<div class="col-md-4 p-3">
                                        <label for="">Tipo de Negociación:</label>
                                        <select class="form-control" name="negociacion" id="negociacion">
                                            <option value="" selected disabled></option>
                                            <?php
                                            $sql = "SELECT n.id, e.nombre_comercial FROM negociaciones n, empresas e WHERE n.empresa = e.id_empresas";
                                            $rest = mysqli_query($conetar, $sql);
                                            while ($data = mysqli_fetch_array($rest)) {
                                            ?>
                                                <option value="<?php echo $data['id']; ?>"><?php echo '#' . $data['id'] . ' - ' . $data['nombre_comercial']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>-->
            <div class="col-md-4 p-3">
                <label for="">Empresa:<span style="color: red;">*</span></label>
                <select class="form-control" name="empresa" id="empresa" disabled>
                    <option value="" selected disabled></option>
                    <?php
                    $sql = "SELECT id_empresas, nombre_comercial FROM empresas ";
                    $rest = mysqli_query($conetar, $sql);
                    while ($data = mysqli_fetch_array($rest)) {
                    ?>
                        <option value="<?php echo $data['id_empresas']; ?>"><?php echo $data['nombre_comercial']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 p-3">
                <label for="">Médico:<span style="color: red;">*</span></label>
                <select class="form-control" name="medico" id="medico" disabled>
                    <option value="" selected disabled></option>
                    <?php
                    $sql = "SELECT id_medicos, CONCAT(nombres,' ',apellidos) AS medico FROM medicos";
                    $rest = mysqli_query($conetar, $sql);
                    while ($data = mysqli_fetch_array($rest)) {
                    ?>
                        <option value="<?php echo $data['id_medicos']; ?>"><?php echo $data['medico']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 p-3">
                <label for="">Fecha:<span style="color: red;">*</span></label>
                <input class="form-control" type="date" name="fecha" id="fecha" required>
            </div>
            <div class="col-md-2 p-3">
                <label for="">Hora:<span style="color: red;">*</span></label>
                <input class="form-control" type="time" name="hora" id="hora" required>
            </div>
            <div class="col-md-4 p-3">

                <label for="">Vendedor:<span style="color: red;">*</span></label>
                <select name="vendedor" id="vendedor" class="form-control" required>
                    <option value="" selected disabled></option>
                    <?php
                    $sql = "SELECT id_persona, CONCAT(nombre_1,' ',apellido_1) AS nombre FROM persona";
                    $rest = mysqli_query($conetar, $sql);
                    while ($data = mysqli_fetch_array($rest)) {
                    ?>
                        <option value="<?php echo $data['id_persona']; ?>"><?php echo $data['nombre']; ?></option>
                    <?php
                    }
                    ?>
                </select>

            </div>

        </div>

        <hr>
        <label for="" class="p-2">Persona de contacto:</label>

        <div class="row">
            <div class="col-md-4 p-3">
                <label for="">Nombre:</label>
                <input class="form-control" type="text" name="nombrecontacto" id="nombrecontacto">
            </div>
            <div class="col-md-4 p-3">
                <label for="">Celular:</label>
                <input class="form-control" type="text" name="celularcontacto" id="celularcontacto">
            </div>
            <div class="col-md-4 p-3">
                <label for="">Email:</label>
                <input class="form-control" type="text" name="emailcontacto" id="emailcontacto">
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12 p-3">
                <label for="">Comentario:</label>
                <textarea class="form-control" name="comentario" id="comentario" cols="30" rows="3"></textarea>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <input type="button" class="btn btn-danger btn-close-modal" data-dismiss="modal" value="Cancelar">
        <input type="submit" class="btn btn-success" value="Aceptar">
    </div>
</form>

<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {

        $('#negociacion').change(function() {
            id = $('#negociacion').val();

            if (id == 1) {
                $('#medico').prop('disabled', false);
                $('#empresa').prop('disabled', true);
            } else if (id == 2) {
                $('#empresa').prop('disabled', false);
                $('#medico').prop('disabled', true);
            }
        })

        $.validator.setDefaults({
            submitHandler: function() {

                guardarDatos();
                console.log('Datos guardados con éxito:', response);
                calendar.gotoDate();
                $('#addCitaModal').modal('hide');
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "¡Cita registrada con éxito!",
                    showConfirmButton: false,
                    timer: 1500
                });

            }
        });
        $('#formNewCita').validate({
            rules: {
                id_examen: {
                    required: true
                },
                prioridad: {
                    required: true
                }
            },
            messages: {
                id_examen: {
                    required: ""
                },
                prioridad: {
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



    function guardarDatos() {
        $.ajax({
            method: 'POST',
            url: 'https://conlabweb3.tierramontemariana.org/apps/citas/agregar.php',
            data: $('#formNewCita').serialize(),
            success: function(response) {
                
            },
            error: function(error) {
                console.error('Error al guardar datos:', error);
            }
        });
    }
</script>