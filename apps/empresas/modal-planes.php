<?php
//     presntadio n par todos lod produtos tipo ACTVOS FIJOS

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

<div class="row">

    <div class="col-md-4">
        <label for="">Nombre del Plan:</label>
        <input type="text" class="form-control" name="nombreplan" id="nombreplan" required>
    </div>

    <div class="col-md-4">
        <label for="">Lista Base:</label>
        <select name="listabaseplan" id="listabaseplan" class="form-control" required>
            <option value="" selected disabled>SELECCIONA:</option>
            <?php
            $sql = "SELECT id, nombre, descripcion, descuento_minimo, estado FROM detalle_listas ORDER BY id DESC";

            $rest = mysqli_query($conetar, $sql);

            $datos = array();

            while ($element = mysqli_fetch_array($rest)) {
            ?>

                <option value="<?php echo $element['id']; ?>"><?php echo $element['nombre']; ?></option>

            <?php
            }
            ?>
        </select>
    </div>

    <div class="col-md-2">
        <label for="">Estado:</label>
        <select name="estadoplan" id="estadoplan" class="form-control" required>
            <option value="1" selected>Activo</option>
            <option value="2">Inactivo</option>
        </select>
    </div>

    <div class="col-md-2">
        <label for="">Tipo de plan:</label>
        <select name="tipoplan" id="tipoplan" class="form-control">
            <option value="" selected disabled>SELECCIONA:</option>
            <?php

            $sql = "SELECT id, descripcion, estado FROM tipo_planes";

            $rest = mysqli_query($conetar, $sql);

            while ($element = mysqli_fetch_array($rest)) {

            ?>

                <option value="<?php echo $element['id']; ?>"><?php echo $element['descripcion']; ?></option>

            <?php } ?>
        </select>
    </div>

</div>

<div class="row mt-3">
    <div class="col-md-4">
        <label for="">Descripcion:</label>
        <textarea name="descripcionplan" id="descripcionplan" cols="30" rows="2" class="form-control" required></textarea>
    </div>
    <div class="col-md-4">
        <label for="">Conceptos a pagar:</label>
        <select name="conectopagar" id="conectopagar" class="form-control">
            <option value="" selected disabled>SELECCIONA:</option>
            <?php

            $sql = "SELECT id, descripcion, estado FROM concepto_pagar";

            $rest = mysqli_query($conetar, $sql);

            while ($element = mysqli_fetch_array($rest)) {

            ?>

                <option value="<?php echo $element['id']; ?>"><?php echo $element['descripcion']; ?></option>

            <?php } ?>

        </select>
    </div>
    <div class="col-md-4">
        <label for="">Requisitos facturación:</label>
        <select name="reqfacturacion" id="reqfacturacion" class="form-control">
            <option value="" selected disabled>SELECCIONA:</option>
            <?php

            $sql = "SELECT id, descripcion, estado FROM req_facturacion";

            $rest = mysqli_query($conetar, $sql);

            while ($element = mysqli_fetch_array($rest)) {

            ?>

                <option value="<?php echo $element['id']; ?>"><?php echo $element['descripcion']; ?></option>

            <?php } ?>
        </select>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-4">
        <label for="">Frecuencia:</label>
        <select name="frecuenciaplan" id="frecuenciaplan" class="form-control" required>
            <option value="" selected disabled>SELECCIONA:</option>
            <?php

            $sql = "SELECT id, descripcion, estado FROM frecuencia";

            $rest = mysqli_query($conetar, $sql);

            while ($element = mysqli_fetch_array($rest)) {

            ?>

                <option value="<?php echo $element['id']; ?>"><?php echo $element['descripcion']; ?></option>

            <?php } ?>
        </select>
    </div>
    <div class="col-md-4">
        <label for="">Descuento/Incremento:</label>
        <select name="descuentoplan" id="descuentoplan" class="form-control">
            <option value="" selected disabled>SELECCIONA:</option>
            <option value="1">Descuento</option>
            <option value="2">Incremento</option>
        </select>
    </div>
    <div class="col-md-4">
        <label for="">Porcentaje:</label>
        <input type="text" name="porcentajeplan" id="porcentajeplan" class="form-control" required>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12 text-right">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
        </div>
    </div>
</div>
</form>

<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {
        $.validator.setDefaults({
            submitHandler: function() {

                ide = $('#idempresafact').val();

                if (ide == 0 || ide == '') {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No has seleccionado una empresa!",
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/cw3/apps/empresas/crud.php?aux=7',
                        data: $('#formCrearPlan').serialize(),
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

            }
        });
        $('#formCrearPlan').validate({
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