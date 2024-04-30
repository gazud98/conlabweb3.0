<form name="formcontrol1" id="formcontrol1" action="#" class="card p-3" method="POST" enctype="multipart/form-data"
    style="width:100%;">

    <input type="hidden" name="id" id="id" value="">

    <div class="row pb-2 mt-3">
        <div class="col-md-4 col-sm-6">
            <label><strong>No. Identificación Legal:</strong></label>
            <input type="text" class="form-control" name="identificacion_legal" id="identificacion_legal" required>
        </div>
        <div class="col-md-8 col-sm-6">
            <label><strong>Nombre de la Empresa:</strong></label>
            <input type="input" class="form-control" name="nombre_empresa" id="nombre_empresa" required>
        </div>
    </div>

    <div class="row pb-2">
        <div class="col-md-4 col-sm-6">
            <label><strong>País:</strong></label>
            <input type="input" class="form-control" name="pais" id="pais" required>
        </div>
        <div class="col-md-4 col-sm-6">
            <label><strong>Ciudad:</strong></label>
            <input type="text" class="form-control" name="ciudad" id="ciudad">
        </div>
        <div class="col-md-4 col-sm-12">
            <label><strong>Dirección:</strong></label>
            <input type="input" class="form-control" name="direccion" id="direccion" required>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4 col-sm-6">
            <label><strong>Teléfono:</strong></label>
            <input type="input" class="form-control" name="telefono" id="telefono" required>
        </div>
        <div class="col-md-4 col-sm-6">
            <label><strong>Email:</strong></label>
            <input type="input" class="form-control" name="email" id="email">
        </div>
        <div class="col-md-4 col-sm-12">
            <label><strong>Página Web:</strong></label>
            <input type="input" class="form-control" name="direccion_electronica" id="direccion_electronica" required>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 col-xs-12" style="text-align:center;">
            <button type="submit" class="btn btn-success btn-xs">
                <i class="fa-solid fa-floppy-disk"></i>&nbsp;&nbsp;Guardar Cambios
            </button>
        </div>
    </div>
</form>

<script src="/assets/plugins/jquery/jquery.min.js"></script>

<!-- jQuery Validate -->
<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script>
    $(document).ready(function () {
        // Realizar una solicitud AJAX para obtener los datos
        $.ajax({
            type: 'GET',
            url: '/cw3/conlabweb3.0/apps/idtfofc/controller/process_data.php',
            dataType: 'json',
            success: function (response) {

                // Llenar los campos del formulario con los datos obtenidos
                $('#id').val(response.id);
                $('#identificacion_legal').val(response.identificacion_legal);
                $('#nombre_empresa').val(response.nombre_empresa);
                $('#pais').val(response.pais);
                $('#ciudad').val(response.ciudad);
                $('#direccion').val(response.direccion);
                $('#telefono').val(response.telefono);
                $('#email').val(response.email);
                $('#direccion_electronica').val(response.direccion_electronica);
            }, error: function (xhr, status, error) {
                console.error(xhr.responseText);
                console.error(status);
                console.error(error);
            }

        });

        $.validator.setDefaults({
            submitHandler: function () {
                $.ajax({
                    type: 'POST',
                    url: '/cw3/conlabweb3.0/apps/idtfofc/model/crud.php',
                    data: $('#formcontrol1').serialize(),
                    success: function (respuesta) {


                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: '¡Registro Exitoso!',
                            showConfirmButton: false,
                            timer: 1500
                        });


                    }
                });

            }
        });
        $('#formcontrol1').validate({
            rules: {
                identificacion_legal: {
                    required: true
                },
                nombre_empresa: {
                    required: true
                },
                pais: {
                    required: true
                },
                ciudad: {
                    required: true
                },
                direccion: {
                    required: true
                },
                telefono: {
                    required: true
                },
                email: {
                    required: true
                },
                direccion_electronica: {
                    required: true
                }

            },
            messages: {
                identificacion_legal: {
                    required: ""
                },
                nombre_empresa: {
                    required: ""
                },
                pais: {
                    required: ""
                },
                ciudad: {
                    required: ""
                },
                direccion: {
                    required: ""
                },
                telefono: {
                    required: ""
                },
                email: {
                    required: ""
                },
                direccion_electronica: {
                    required: ""
                }

            },

            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>