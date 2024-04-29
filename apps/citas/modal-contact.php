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

<form name="formAddContact" id="formAddContact" action="" method="POST" enctype="multipart/form-data">

    <div class="row" style="padding: 40px;">

        <div class="col-md-12">
            <label for="">Nombres y Apellidos:<span style="color: red;">*</span></label>
            <input type="text" name="names" id="names" class="form-control">
        </div>

        <br><div class="col-md-12 mt-2">
            <label for="">Email:<span style="color: red;">*</span></label>
            <input type="email" name="email" id="email" class="form-control">
        </div>

        <br><div class="col-md-12 mt-2">
            <label for="">Celular:<span style="color: red;">*</span></label>
            <input type="number" name="phone" id="phone" class="form-control">
        </div>

        <br><div class="col-md-12 mt-2">
            <label for="">Empresa:<span style="color: red;">*</span></label>
            <select class="form-control" name="empresa" id="empresa">
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

    </div>

    <div class="content-button text-right" style="margin-top:10px;">
        <input type="button" class="btn btn-danger btn-close-modal" data-dismiss="modal" value="Cancelar">
        <input type="submit" class="btn btn-success" value="Aceptar">
    </div>

</form>

<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {
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
        $('#formAddContact').validate({
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
    })
</script>