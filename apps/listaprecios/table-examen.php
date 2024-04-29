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
    // echo '..............................';

?>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <table class="table table-striped" id="table-examenes" style="
                    font-size: 15px;
                    text-align: center;
                ">
        <thead>
            <tr>
                <th>Código CUPS</th>
                <th>Nombre examen</th>
                <th><span><input type="checkbox" id="seleccionarTodos" /> Seleccionar todos</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php

            $sql = "";

            if(isset($_REQUEST['nombre'])){

                $nombre = $_REQUEST['nombre'];

                $sql = "SELECT codigo_cups, nombre_examen FROM examenes WHERE nombre_examen LIKE '%$nombre%'";
            }else {
                $sql = "SELECT codigo_cups, nombre_examen FROM examenes";
            }

            $rest = mysqli_query($conetar, $sql);

            while ($element = mysqli_fetch_array($rest)) {
            ?>

                <tr>
                    <td><?php echo $element['codigo_cups']; ?></td>
                    <td><?php echo $element['nombre_examen']; ?></td>
                    <td><input type="checkbox" name="seleccionar[]" id="" class="checkbox" data-id="<?php echo $element['codigo_cups']; ?>" data-nombre="<?php echo $element['nombre_examen']; ?>"></td>
                </tr>

            <?php

            }

            ?>
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

        $('#seleccionarTodos').on('change', function() {
            /*const checkboxes = document.querySelectorAll('input[name="seleccionar[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });*/

            if ($(this).prop('checked')) {
                $('input[name="seleccionar[]"]').prop('checked', true);
            } else {
                $('input[name="seleccionar[]"]').prop('checked', false);
            }

        });

        $('input[name="seleccionar[]"]').change(function() {
            if (!$(this).prop('checked')) {
                $('#seleccionarTodos').prop('checked', false);
            }
        });
        
    </script>

<?php
}
?>