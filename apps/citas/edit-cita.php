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

    $id = "";

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $query = "SELECT c.id, c.fecha, c.hora, c.vendedor, c.empresa, c.nombre_contacto, c.celular_contacto, c.email_contacto, m.id_medicos, 
    CONCAT(m.nombres,' ',m.apellidos) AS medico FROM citas c, medicos m WHERE c.medico = m.id_medicos AND c.id = '$id'";

    $result = $conetar->query($query);

    $events = array();

    $nombre_contacto = "";
    $start = "";
    $hora = "";
    $vendedor = "";
    $celular_contacto = "";
    $email_contacto = "";
    $empresa = 0;
    $medico = 0;
    $nombre_medico = "";

    while ($row = $result->fetch_assoc()) {
        $start_date = date('Y-m-d', strtotime($row['fecha']));
        $nombre_contacto = $row['nombre_contacto'];
        $start = $row['fecha'];
        $hora = $row['hora'];
        $vendedor = $row['vendedor'];
        $celular_contacto = $row['celular_contacto'];
        $email_contacto = $row['email_contacto'];
        $empresa = $row['empresa'];
        $medico = $row['id_medicos'];
        $nombre_medico = $row['medico'];
    }
}

?>
<form name="formEditCita" id="formEditCita" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="modal-body">

        <div class="row">
            <div class="col-md-6 p-1">

                <?php

                if ($empresa != 0) {


                ?>
                    <label for="">Empresa:<span style="color: red;">*</span></label>
                    <select class="form-control" name="empresa" id="empresa" disabled>
                        <option value="" disabled></option>
                        <?php
                        $sql = "SELECT id_empresas, nombre_comercial FROM empresas ";
                        $rest = mysqli_query($conetar, $sql);
                        while ($data = mysqli_fetch_array($rest)) {
                            if ($empresa == $data['id_empresas']) {
                        ?>
                                <option value="<?php echo $data['id_empresas']; ?>" selected><?php echo $data['nombre_comercial']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                <?php
                } else if ($medico != 0) {
                ?>
                    <label for="">Médico:<span style="color: red;">*</span></label>
                    <select class="form-control" name="medico" id="medico" disabled>
                        <option value="" disabled></option>
                        <?php
                        $sql = "SELECT id_medicos, CONCAT(nombres,' ',apellidos) AS medico FROM medicos";
                        $rest = mysqli_query($conetar, $sql);
                        while ($data = mysqli_fetch_array($rest)) {
                            if ($medico == $data['id_medicos']) {
                        ?>
                                <option value="<?php echo $data['id_medicos']; ?>" selected><?php echo $data['medico']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                <?php
                }
                ?>

            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4">
                <label for="">Fecha:<span style="color: red;">*</span></label>
                <input class="form-control" type="date" name="fecha" id="fecha" value="<?php echo $start_date; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="">Hora:<span style="color: red;">*</span></label>
                <input class="form-control" type="time" name="hora" id="hora" value="<?php echo $hora; ?>" required>
            </div>
            <div class="col-md-4">

                <label for="">Vendedor:<span style="color: red;">*</span></label>
                <select name="vendedor" id="vendedor" class="form-control" required>
                    <option value="" selected disabled></option>
                    <?php
                    $sql = "SELECT id_persona, CONCAT(nombre_1,' ',apellido_1) AS nombre FROM persona";
                    $rest = mysqli_query($conetar, $sql);
                    while ($data = mysqli_fetch_array($rest)) {
                        if($vendedor == $data['id_persona']){
                    ?>
                        <option value="<?php echo $data['id_persona']; ?>" selected><?php echo $data['nombre']; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>

            </div>

        </div>

        <hr class="mt-4">

        <label for="">Persona de contacto:</label>

        <div class="row">
            <div class="col-md-6">
                <label for="">Nombre:</label>
                <input class="form-control" type="text" name="nombrecontacto" id="nombrecontacto" value="<?= $nombre_contacto ?>">
            </div>
            <div class="col-md-6">
                <label for="">Celular:</label>
                <input class="form-control" type="text" name="celularcontacto" id="celularcontacto" value="<?= $celular_contacto ?>">
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label for="">Email:</label>
                <input class="form-control" type="text" name="emailcontacto" id="emailcontacto" value="<?= $email_contacto ?>">
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
        $('#formEditCita').validate({
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
            url: 'https://cw3.tierramontemariana.org/apps/citas/crud.php',
            data: $('#formEditCita').serialize(),
            success: function(response) {

            },
            error: function(error) {
                console.error('Error al guardar datos:', error);
            }
        });
    }
</script>