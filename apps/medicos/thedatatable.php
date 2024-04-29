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

    include('reglasdenavegacion.php');

    // echo '..............................';

?>

    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <table class="table table-borderless table-medicos">
        <thead>
            <tr>
                <th style="text-align: center;">No. Identificación</th>
                <th style="text-align: center;">Nombres</th>
                <th style="width: 150px; text-align: center;">Fecha - Nacimiento</th>
                <th style="text-align: center;">Especialidad</th>
                <th style="text-align: center;">Centro Médico</th>
                <th style="text-align: center;">Dirección - Consultorio</th>
                <th style="text-align: center; width: 100px;">Estado</th>
                <th style="text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>



        </tbody>
    </table>
    <!-- jquery-validation -->
    <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <!--<script src="assets/plugins/jquery/jquery.min.js"></script>-->

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            new DataTable('.table-medicos', {
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                "paging": true,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": {
                    url: 'https://cw3.tierramontemariana.org/apps/medicos/mostrar.php?aux=1', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    dataSrc: '',
                    data: function(d) {

                    },
                },
                "columns": [{
                        "data": "documento"
                    },
                    {
                        "data": "nombres"
                    },
                    {
                        "data": "fecha_nacimiento"
                    },
                    {
                        "data": "descripcion"
                    },
                    {
                        "data": "nombre_centro"
                    },
                    {
                        "data": "direccion"
                    },
                    {
                        "data": "estado",
                        "render": function(data, type, full, meta) {
                            if (full.estado == 1) {
                                return '<span class="badge badge-success">Activo</span>';
                            } else if (full.estado == 2) {
                                return '<span class="badge badge-danger">Inactivo</span>';
                            }
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '<div class="btn-group" role="group" aria-label="Basic example">' +
                                '<button title="Ver y editar registro" type="button" class="btn btn-warning btn-xs"  onclick="editar(' + full.id_medicos + ');" data-target="#editsedeModal" data-toggle="modal"><i class="fa-solid fa-eye" style="font-size:14px;"></i></button>' +
                                '<button title="Eliminar registro" type="button" class="btn btn-danger btn-xs" onclick="deleteMedico(' + full.id_medicos + ');"><i class="fa-solid fa-trash-can" style="font-size:14px;"></i></button></div>';
                        }
                    }

                ],

            })

            $.validator.setDefaults({
                submitHandler: function() {
                    $.ajax({
                        type: 'POST',
                        url: 'https://cw3.tierramontemariana.org/apps/medicos/crud.php?aux=1',
                        data: $('#formcontrol').serialize(),
                        success: function(respuesta) {
                            $('.content-table-sedes').load('https://cw3.tierramontemariana.org/apps/medicos/thedatatable.php');
                            Swal.fire({
                                position: 'top',
                                icon: 'success',
                                title: '¡Registro Agregado con exito!',
                                showConfirmButton: false,
                                timer: 1500
                            })

                        }
                    });
                    $("#addEmployeeModal").modal("hide");
                }
            });
            $('#formcontrol').validate({
                rules: {
                    nombre: {
                        required: true
                    }
                },
                messages: {
                    nombre: {
                        required: "Este campo no puede estar vacío"
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

        function deleteMedico(id) {
            Swal.fire({
                text: "¿Desea borrar el registro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: 'https://cw3.tierramontemariana.org/apps/medicos/crud.php',
                        data: {
                            id: id,
                            modeeditstatus: 'B'
                        },
                        success: function(respuesta) {

                            $('.content-table-sedes').load('https://cw3.tierramontemariana.org/apps/medicos/thedatatable.php');
                            Swal.fire({
                                position: 'top',
                                icon: 'success',
                                title: '¡Registro borrado con exito!',
                                showConfirmButton: false,
                                timer: 1500
                            })

                        }
                    });
                }
            })
            //var opcion = confirm("¿Desea borrar el registro?");
            /*if (opcion == true) {
                
            }*/
        }


        function editar(id) {

            $('#editMedicos').load('https://cw3.tierramontemariana.org/apps/medicos/modal-editar.php', {
                id: id,
                status: 'E'
            });

            var opcionesSeleccionadas = [];

            // Escucha el evento change de los checkboxes
            $('input[type="checkbox"]').change(function() {
                opcionesSeleccionadas = [];

                // Recorre los checkboxes marcados y agrega sus valores al array
                $('input[type="checkbox"]:checked').each(function() {
                    opcionesSeleccionadas.push($(this).val());
                });

                // Puedes usar el array opcionesSeleccionadas según tus necesidades
                $('#aficionesalledit').val(opcionesSeleccionadas);

            });

        }
    </script>

<?php
}
?>