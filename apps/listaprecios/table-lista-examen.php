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

// echo __FILE__.'>dd.....<br>';

//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = "";
    }

    if (isset($_REQUEST['id'])) {
        $id_detalle = $_REQUEST['id'];
        if ($id_detalle == "-1") {
            $id_detalle = "";
        }
    } else {
        $id_detalle = "";
    }

?>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <table class="table table-striped" id="table-lista-examen" style="
                    font-size: 15px;
                    text-align: center;
                    margin-top: 50px;
                ">
        <thead>
            <tr>
                <th>Código CUPS</th>
                <th>Nombre examen</th>
                <th>Porcentaje %</th>
                <th>Valor</th>
                <th><span><input type="checkbox" id="seleccionarTodos4" /> Seleccionar todos</span></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <!-- jquery-validation -->
    <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>


    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            miDataTableListaExamen = $('#table-lista-examen').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "ajax": {
                    url: 'https://conlabweb3.tierramontemariana.org/apps/listaprecios/mostrar.php?aux=2&ide=<?php echo $id_detalle; ?>', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '',
                    data: function(d) {

                        //d.fecha_f = $('#fecha_f').val();

                    }
                },
                "columns": [{
                        "data": "codigo_cups"
                    },
                    {
                        "data": "nombre_examen"
                    },
                    {
                        "data": "id_porcentaje"
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<input type="text" name="precio' + full.id + '" id="precio' + full.id + '" value="' + full.valor_examen +
                                '" onchange="grabador(' + full.id + ')">';
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<input type="checkbox" name="seleccionar3[]" id="" class="checkbox3" data-id-3="'+full.id+'">';
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<button type="button" title="Eliminar" class="btn btn-danger btn-sm" onclick="deleteDetalleLista('+full.id+', '+full.id_detalle_lista+')"><i class="fa-solid fa-trash-can"></i></button>';
                        }
                    }
                ],
            });

            $.validator.setDefaults({
                submitHandler: function() {
                    $.ajax({
                        type: 'POST',
                        url: 'https://conlabweb3.tierramontemariana.org/apps/planes/crud.php?aux=1',
                        data: $('#formcontrol').serialize(),
                        success: function(respuesta) {
                            if (respuesta == 'ok') {
                                //                     alert('Termiando');
                            }
                            $('.content-table-unidad_medida').load('https://conlabweb3.tierramontemariana.org/apps/planes/thedatatable.php');

                            Swal.fire({
                                position: 'top',
                                icon: 'success',
                                title: '¡Registro Agregado con exito!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#addModal").modal("hide");
                            $('#nombre').val('');
                        }
                    });

                }
            });
            $('#formcontrol').validate({
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

        });

        $('#seleccionarTodos4').on('change', function() {
            /*const checkboxes = document.querySelectorAll('input[name="seleccionar[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });*/

            if ($(this).prop('checked')) {
                $('input[name="seleccionar3[]"]').prop('checked', true);
            } else {
                $('input[name="seleccionar3[]"]').prop('checked', false);
            }

        });

        $('input[name="seleccionar3[]"]').change(function() {
            if (!$(this).prop('checked')) {
                $('#seleccionarTodos4').prop('checked', false);
            }
        });

    </script>

<?php
}
?>