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
    }

    $sql = "SELECT id, descripcion, estado FROM motivo_glosas WHERE id = '$id'";

    $rest = mysqli_query($conetar, $sql);

    while ($element = mysqli_fetch_array($rest)) {
        $id = trim($element['id']);
        $desc = trim($element['descripcion']);
        $estado = trim($element['estado']);
    }
}
?>

<label for="">Descripcion:</label>
<input type="text" class="form-control" name="descglosa" id="descglosa" value="<?php echo $desc; ?>">
<br><label for="">Estado:</label>
<select class="form-control" name="estadoglosas" id="estadoglosas">
    <option value="" selected disabled></option>
    <?php

    if ($estado == 1) {

    ?>
        <option value="1" selected>Activo</option>
        <option value="2">Inactivo</option>
    <?php
    } else {
    ?>
        <option value="1">Activo</option>
        <option value="2" selected>Inactivo</option>
    <?php
    }
    ?>
</select>

<script>
    $(document).ready(function() {
        $.validator.setDefaults({
            submitHandler: function() {

                $.ajax({
                    type: 'POST',
                    url: '/cw3/apps/empresas/crud.php?aux=1',
                    data: $('#formDatosBasicos').serialize(),
                    success: function(respuesta) {
                        if (respuesta == 'ok') {
                            //                     alert('Termiando');
                        }
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "¡Registro Exitoso!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        //alert("¡Registro Exitoso!");
                    }
                });
            }
        });
        $('#formEditMotivoGlosas').validate({
            rules: {
                nombre: {
                    required: true
                },
                simbolo: {
                    required: true
                },
                decimal: {
                    required: true
                },
            },
            messages: {
                nombre: {
                    required: "Este campo no puede estar vacío"
                },
                simbolo: {
                    required: "Este campo no puede estar vacío"
                },
                decimal: {
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
    })
</script>