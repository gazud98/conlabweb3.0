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

?>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <table class="table table-striped" id="table-detalle-lista" style="
                    font-size: 15px;
                    text-align: center;
                ">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Seleccionar</th>
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
            miDataTableExa = $('#table-detalle-lista').DataTable({
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
                    url: 'https://cw3.tierramontemariana.org/apps/listaprecios/mostrar.php?aux=3', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '',
                    data: function(d) {

                        //d.fecha_f = $('#fecha_f').val();

                    }
                },
                "columns": [{
                        "data": "nombre"
                    },
                    {
                        "data": "descripcion"
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<input type="checkbox" name="seleccionar2" id="seleccionar2" class="checkbox2" data-id-2="' + full.id + '">';
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<button type="button" title="Ver examenes en lista" class="btn btn-primary btn-sm" id="btnMostrarExamenesLista" onclick="viewDetalleLista(' + full.id + ')"><i class="fa-solid fa-eye"></i></button>';
                        }
                    }
                ],
            });

            $.validator.setDefaults({
                submitHandler: function() {
                    $.ajax({
                        type: 'POST',
                        url: 'https://cw3.tierramontemariana.org/apps/planes/crud.php?aux=1',
                        data: $('#formcontrol').serialize(),
                        success: function(respuesta) {
                            if (respuesta == 'ok') {
                                //                     alert('Termiando');
                            }
                            $('.content-table-unidad_medida').load('https://cw3.tierramontemariana.org/apps/planes/thedatatable.php');

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

    </script>

<?php
}
?>