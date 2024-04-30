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

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $sql = "SELECT id_empresas, razon_social, nombre_comercial, id_tipo_identificacion, departamento, ciudad, 
    documento, dv, email, tel_fijo, celular, nombre_representante, id_representate_legal, id_ejecutivo_comercial, 
    direccion, estado FROM empresas WHERE id_empresas = '$id'";

    $rest = mysqli_query($conetar, $sql);

    while ($data = mysqli_fetch_array($rest)) {
        $id_empresas = $data['id_empresas'];
        $razon_social = $data['razon_social'];
        $nombre_comercial = $data['nombre_comercial'];
        $id_tipo_identificacion = $data['id_tipo_identificacion'];
        $departamento = $data['departamento'];
        $ciudad = $data['ciudad'];
        $documento = $data['documento'];
        $dv = $data['dv'];
        $email = $data['email'];
        $tel_fijo = $data['tel_fijo'];
        $celular = $data['celular'];
        $nombre_representante = $data['nombre_representante'];
        $id_representate_legal = $data['id_representate_legal'];
        $id_ejecutivo_comercial = $data['id_ejecutivo_comercial'];
        $direccion = $data['direccion'];
        $estado = $data['estado'];
    }
}

?>

<br>
<div>
    <div class="text-center" style="width: 50%;background:#F6EDF9;padding:5px;border-radius:5px;font-weight: 800;margin:auto;">
        Empresa: <?= $nombre_comercial ?></h5>
    </div>
</div>

<br>
<form id="formEditEmpresa" method="POST" enctype="multipart/form-data">
    <div class="text-center" style="width: 100%;background:#F0F8F4;padding:5px;border-radius:5px;font-weight: 800;">
        Datos Básicos</h5>
    </div>
    <div class="row mt-4">
        <div class="col-md-4">
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
            <label for="">Tipo Identificación:</label>
            <select name="id_tipo_identificacion" id="id_tipo_identificacion" class="form-control" required>
                <?php

                $sql = "SELECT id, nombre, abreviatura FROM tipo_identificacion";

                $rest = mysqli_query($conetar, $sql);

                while ($data = mysqli_fetch_array($rest)) {
                    echo "<option value='" . trim($data['id']) . "'";
                    if (trim($data['id']) == $id_tipo_identificacion) {
                        echo ' selected';
                    }
                    echo '>' . $data['abreviatura'] . ' - ' . $data['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-md-2">
            <label for="">N° Identificación:</label>
            <input type="text" class="form-control" name="numide" id="numide" value="<?php echo $documento; ?>" required>
        </div>

        <div class="col-md-1">
            <label for="">DV:</label>
            <input type="text" class="form-control" name="digverificacion" id="digverificacion" value="<?php echo $dv; ?>">
        </div>

        <div class="col-md-5">
            <label for="">Razón Social:</label>
            <input type="text" class="form-control" name="razon" id="razon" value="<?php echo $razon_social; ?>">
        </div>
        <!--<div class="col-md-2">
                        <label for="">Estado:</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="" selected disabled></option>
                        </select>
                    </div>-->
    </div>

    <div class="row mt-3">

        <div class="col-md-4">
            <label for="">Nombre Comercial:</label>
            <input type="text" class="form-control" name="nombrecomercial" id="nombrecomercial" value="<?php echo $nombre_comercial; ?>" required>
        </div>

        <div class="col-md-2">
            <label for="">Teléfono Fijo:</label>
            <input type="text" class="form-control" name="tel" id="tel" value="<?php echo $tel_fijo; ?>">
        </div>
        <div class="col-md-2">
            <label for="">Celular:</label>
            <input type="text" class="form-control" name="cel" id="cel" value="<?php echo $celular; ?>" required>
        </div>
        <div class="col-md-4">
            <label for="">Correo:</label>
            <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
        </div>

    </div>

    <div class="text-center mt-4" style="width: 100%;background:#F0F8F4;padding:5px;border-radius:5px;font-weight: 800;">
        Datos de Ubicación</h5>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <label for="">Departamento:</label>
            <select class="form-control" name="dep" id="dep" required>
                <option value="" selected disabled></option>
                <?php
                $sql = "SELECT id, nombre FROM departamento";
                $rest = mysqli_query($conetar, $sql);
                while ($data = mysqli_fetch_array($rest)) {
                    echo "<option value='" . trim($data['id']) . "'";
                    if (trim($data['id']) == $departamento) {
                        echo ' selected';
                    }
                    echo '>' . $data['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="">Ciudad:</label>
            <select class="form-control" name="ciudad" id="ciudad" required>
                <option value="" selected disabled></option>
                <?php
                $sql = "SELECT id, nombre FROM ciudades";
                $rest = mysqli_query($conetar, $sql);
                while ($data = mysqli_fetch_array($rest)) {
                    echo "<option value='" . trim($data['id']) . "'";
                    if (trim($data['id']) == $departamento) {
                        echo ' selected';
                    }
                    echo '>' . $data['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="">Dirección:</label>
            <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $direccion; ?>" required>
        </div>
    </div>

    <div class="text-center mt-4" style="width: 100%;background:#F0F8F4;padding:5px;border-radius:5px;font-weight: 800;">
        Representante Legal</h5>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <label for="">Nombres:</label>
            <input type="text" class="form-control" name="replegal" id="replegal" value="<?php echo $nombre_representante; ?>">
        </div>
        <div class="col-md-4">
            <label for="">No. Documento:</label>
            <input type="text" class="form-control" name="numiderep" id="numiderep" value="<?php echo $id_representate_legal; ?>">
        </div>
    </div>
    <div class="col-md-12 mt-5 text-right">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
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
                        url: '/cw3/conlabweb3.0/apps/empresas/crud.php?aux=2',
                        data: $('#formEditEmpresa').serialize(),
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
        $('#formEditEmpresa').validate({
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

        $('#dep').change(function() {
            loadCities();
        })
    })

    function loadCities() {

        id = $('#dep').val();

        $.ajax({
            url: '/cw3/conlabweb3.0/apps/empresas/ciudades.php',
            data: {
                id: id
            },
            success: function(res) {
                $('#ciudad').html(res);
            }
        })

    }
</script>