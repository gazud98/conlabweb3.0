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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <table class="table table-striped table-req-isumos" style="
                    font-size: 15px;
                    text-align: center;
                    margin-top: 150px;
                ">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad Asignada</th>
                <th>Estado</th>
                <th>Acciones</th>
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

            new DataTable('.table-req-isumos', {
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                "paging": true,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            })

            $.validator.setDefaults({
                submitHandler: function() {
                    $.ajax({
                        type: 'POST',
                        url: '/desarrolloV3/apps/pacientes/crud.php',
                        data: $('#formcontrol').serialize(),
                        success: function(respuesta) {
                            $('.content-table-sedes').load('/desarrolloV3/apps/pacientes/thedatatable.php');
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

    </script>

<?php
}
?>