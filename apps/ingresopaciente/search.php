<?php
$user = $_REQUEST['user'];

?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="row">
    <div class="col-md-2">
        <label style="font-size: 12px;">N° Identificación:</label>
        <input type="input" class="form-control" name="numid" id="numid" value="" onkeydown="handleEnter(event)"></input>
    </div>
    <div class="col-md-2" style="margin-top: 27px;">
        <button type="button" class="btn btn-info btn-sm" onclick="searchPatient()" id="btnsearch"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
    </div>
</div>
<script>
    function handleEnter(event) {
        if (event.key === 'Enter') {
            // Evitar que el formulario se envíe si está dentro de un formulario
            event.preventDefault();

            // Ejecutar la función searchPatient()
            searchPatient();
        }
    }

    function searchPatient() {
        var id_num = $('#numid').val();

        $('select').val(null).trigger('change');
        //$("input").val("");

        $.ajax({
            type: 'POST',
            url: 'https://cw3.tierramontemariana.org/apps/ingresopaciente/consult-patient.php',
            data: {
                id_num: id_num

            },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    console.error('Error en la petición AJAX: ', response.error);
                } else {
                    if (response.length > 0) {
                        
                        var id_pacientes = response[0].id_pacientes;
                        $("#divappshow").load("https://cw3.tierramontemariana.org/apps/ingresopaciente/datacase1.php", {
                            id: id_pacientes,
                            user: <?php echo $user ?>
                        });
                        $("#patient-examen").load("https://cw3.tierramontemariana.org/apps/ingresopaciente/tabla.php");
                        /*$("#patient-admission").load("https://cw3.tierramontemariana.org/apps/ingresopaciente/ingreso.php", {
                            id_pacientes: <?php echo $id_pacientes; ?>
                        });*/
                        //document.getElementById('btnpago').disabled = false;
                    } else {
                        Swal.fire({
                            title: "Paciente no encontrado",
                            text: "¿Desea crear un paciente?",
                            icon: "error",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Crear",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Mostrar y habilitar los campos del formulario
                                $('#form-paciente :input, #form-paciente select').delay(600).fadeIn('slow', function() {
                                    // Este código se ejecuta después de que los campos se hayan mostrado
                                    $(this).prop('disabled', false);

                                    // Vaciar todos los campos después de la transición
                                    $('#form-paciente :input').val('');
                                    $('#form-paciente select').val(null).trigger('change');
                                    $("#documento").val(id_num);

                                    // Establecer el atributo autofocus en true para el campo 'documento'
                                    var documento = $('#nombres');
                                    documento.prop('autofocus', true);

                                    // Cerrar el mensaje de SweetAlert2
                                    setTimeout(function() {
                                        Swal.close();
                                        // Enfocar el campo documento después de cerrar SweetAlert2
                                        documento.focus();
                                    }, 100);
                                });
                                $("#patient-examen").load("https://cw3.tierramontemariana.org/apps/ingresopaciente/tabla.php");

                            }
                        });


                    }
                }
            },
            error: function(error) {
                console.log('Error en la petición AJAX: ', error);
            }
        });

    }
</script>