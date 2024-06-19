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

<form id="formDatosBasicos" method="POST" enctype="multipart/form-data">

    <div class="text-center" style="width: 100%;background:#F0F8F4;padding:5px;border-radius:5px;font-weight: 800;">
        Datos básicos
    </div>

    <div class="row mt-4">

        <div class="col-md-4" id="contentTpId">
            
        </div>
        <div class="col-md-2">
            <label for="">N° Identificación:</label>
            <input type="text" class="form-control" name="numide" id="numide" required>
        </div>

        <div class="col-md-1">
            <label for="">DV:</label>
            <input type="text" class="form-control" name="digverificacion" id="digverificacion" required>
        </div>

        <div class="col-md-5">
            <label for="">Razón Social:</label>
            <input type="text" class="form-control" name="razon" id="razon" required>
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
            <input type="text" class="form-control" name="nombrecomercial" id="nombrecomercial" required>
        </div>

        <div class="col-md-2">
            <label for="">Teléfono Fijo:</label>
            <input type="text" class="form-control" name="tel" id="tel" required>
        </div>
        <div class="col-md-2">
            <label for="">Celular:</label>
            <input type="text" class="form-control" name="cel" id="cel" required>
        </div>
        <div class="col-md-4">
            <label for="">Correo:</label>
            <input type="text" class="form-control" name="email" id="email" required>
        </div>

    </div>

    <div class="text-center mt-4" style="width: 100%;background:#F0F8F4;padding:5px;border-radius:5px;font-weight: 800;">
        Datos de Ubicación
    </div>

    <div class="row mt-4">
        <div class="col-md-4" id="contentDep">
            
        </div>
        <div class="col-md-4" id="contentCiudad">

        </div>
        <div class="col-md-2">
            <label for="">Tipo de Vía:</label>
            <select class="form-control" name="tipovia" id="tipovia" required>
                <option value="" selected disabled></option>
                <option value="Calle">Calle</option>
                <option value="Carrera">Carrera</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="">No. Vía:</label>
            <input type="text" class="form-control" name="novia" id="novia" required>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-2">
            <label for="">No. Vivienda:</label>
            <input type="text" class="form-control" name="novivienda" id="novivienda" required>
        </div>
    </div>

    <div class="text-center mt-4" style="width: 100%;background:#F0F8F4;padding:5px;border-radius:5px;font-weight: 800;">
        Representante Legal
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <label for="">Nombres:</label>
            <input type="text" class="form-control" name="replegal" id="replegal" required>
        </div>
        <div class="col-md-3">
            <label for="">No. Documento:</label>
            <input type="text" class="form-control" name="numiderep" id="numiderep" required>
        </div>
        <!--<div class="col-md-4">
            <label for="">Ejecutivo Comercial:</label>
            <select class="form-control" name="tipoide" id="tipoide">
                <option value="" selected disabled></option>
            </select>
        </div>-->

    </div>

    <div class="row mt-4">
        <div class="col-md-12 text-right">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            </div>
        </div>
    </div>

</form>

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
                        url: '/cw3/conlabweb3.0/apps/empresas/crud.php?aux=1',
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
                            $('#modalAddEmpresa').modal('hide');
                            $('.content-table-empresa').load('/cw3/conlabweb3.0/apps/empresas/table-empresas.php');
                        }
                    });
                }

            }
        });
        $('#formDatosBasicos').validate({
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

    $(document).ready(function() {
        $('#dep').change(function() {
            loadCities();
        })

        $('#contentDep').load('/cw3/conlabweb3.0/apps/empresas/dep.php')
        $('#contentCiudad').load('/cw3/conlabweb3.0/apps/empresas/ciudad.php')
        $('#contentTpId').load('/cw3/conlabweb3.0/apps/empresas/tp-iden.php')

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