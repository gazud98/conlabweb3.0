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
    
    <style>
        .content-table {
            width: 100%;
            height: auto;
            background-color: #fff;
        }
        
        .table-medicos-2 {
            border: 1px solid #d2d2d2;
            border-radius: 10px;
            font-size: 14px;
            text-align: center;
        }
        
        .table-wrapper {
            background: #fff;
            padding: 10px;
            margin: 0;
            border-radius: 5px;
            height: 580px;
            border: 1px solid #E3E3E3;
            height: auto;
        }
        
        .table-title .table-sedes {
            width: 800px;
        }
        
        .table-title {
            padding-bottom: 15px;
            color: #0045A5;
            padding: 16px 30px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }
        
        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }
        
        .table-title .btn-group {
            float: right;
        }
        
        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }
        
        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }
        
        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }
        
        table.table tr th,
        table.table tr td {
            vertical-align: middle;
            word-wrap: break-word;
            padding: 5px;
        }
        
        table.table tr td {
            border-top: 1px solid #d2d2d2;
        }
        
        table.table tr th:first-child {
            width: 60px;
        }
        
        table.table tr th:last-child {
            width: 100px;
        }
        
        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        
        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }
        
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }
        
        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }
        
        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }
        
        table.table td a:hover {
            color: #2196F3;
        }
        
        table.table td a.edit {
            color: #FFC107;
        }
        
        table.table td a.delete {
            color: #F44336;
        }
        
        table.table td i {
            font-size: 19px;
        }
        
        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

    </style>


    <table class="table table-borderless table-medicos-2" style="
                    font-size: 13px;
                    text-align: center;
                    margin-top: 150px;
                ">
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

            <?php

            $filtro = "";

            if (isset($_REQUEST['doc'])) {
                $id = $_REQUEST['doc'];
                if ($id == '-1') {
                    $id = '';
                }
            } else {
                $id = '';
            }

            if (isset($_REQUEST['fecha'])) {
                $fecha = $_REQUEST['fecha'];
                if ($fecha == '-1') {
                    $fecha = '';
                }
            } else {
                $fecha = '';
            }

            if (isset($_REQUEST['categoria'])) {
                $categoria = $_REQUEST['categoria'];
                if ($categoria == '-1') {
                    $categoria = '';
                }
            } else {
                $categoria = '';
            }

            if (isset($_REQUEST['centro_medico'])) {
                $centro_medico = $_REQUEST['centro_medico'];
                if ($centro_medico == '-1') {
                    $centro_medico = '';
                }
            } else {
                $centro_medico = '';
            }

            if (isset($_REQUEST['estado'])) {
                $estado = $_REQUEST['estado'];
                if ($estado == '-1') {
                    $estado = '';
                }
            } else {
                $estado = '';
            }

            if ($categoria != "") {
                $filtro .= " AND m.categoria LIKE '%" . $categoria . "%'";
            }

            if ($fecha != "") {
                $filtro .= " AND m.fecha_nacimiento LIKE '%" . $fecha . "%'";
            }

            if ($centro_medico != "") {
                $filtro .= " AND m.centro_medico LIKE '%" . $centro_medico . "%'";
            }

            if ($estado != "") {
                $filtro .= " AND m.estado LIKE '%" . $estado . "%'";
            }

            $cadena = "SELECT m.id_medicos, m.id_tipo_identificacion, m.documento, m.nombres, m.apellidos, m.id_tipo_genero, 
            m.fecha_nacimiento, m.registro_medico, m.especialidad, m.email, m.telefono, m.movil, m.entidades_ads, m.comentarios, m.centro_medico, 
            m.direccion, m.ciudad, m.departamento, m.aficiones, m.categoria, m.secretaria, m.fecha_secretaria, m.estado, c.nombre_centro
                    FROM medicos m, centros_medicos c WHERE c.id_centro = m.centro_medico 
                    AND m.documento LIKE '%".$id."%'" . $filtro;

            $resultadP2 = $conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);
            if ($numerfiles2 >= 1) {
                $thefile = 0;
                while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                    $id_medicos = trim($filaP2['id_medicos']);
                    $id_tipo_identificacion = trim($filaP2['id_tipo_identificacion']);
                    $documento = trim($filaP2['documento']);
                    $nombres = trim($filaP2['nombres']);
                    $apellidos = trim($filaP2['apellidos']);
                    $id_tipo_genero = trim($filaP2['id_tipo_genero']);
                    $fecha_nacimiento = trim($filaP2['fecha_nacimiento']);
                    $registro_medico = trim($filaP2['registro_medico']);
                    $especialidad = trim($filaP2['especialidad']);
                    $email = trim($filaP2['email']);
                    $telefono = trim($filaP2['telefono']);
                    $movil = trim($filaP2['movil']);
                    $entidades_ads = trim($filaP2['entidades_ads']);
                    $comentarios = trim($filaP2['comentarios']);
                    $centro_medico = trim($filaP2['centro_medico']);
                    $direccion = trim($filaP2['direccion']);
                    $ciudad = trim($filaP2['ciudad']);
                    $departamento = trim($filaP2['departamento']);
                    $aficiones = trim($filaP2['aficiones']);
                    $categoria = trim($filaP2['categoria']);
                    $secretaria = trim($filaP2['secretaria']);
                    $fecha_secretaria = trim($filaP2['fecha_secretaria']);
                    $estado = trim($filaP2['estado']);
                    $nombre_centro = trim($filaP2['nombre_centro']);

                    $thefile = $thefile + 1;

            ?>

                    <tr>
                        <td>
                            <?php echo $documento; ?>
                        </td>
                        <td>
                            <?php echo $nombres . ' ' . $apellidos; ?>
                        </td>
                        <td>
                            <?php echo $fecha_nacimiento; ?>
                        </td>
                        <td>
                            <?php

                            if ($especialidad == '1') {
                                echo 'Cardiología';
                            }

                            ?>
                        </td>
                        <td>
                            <?php echo $nombre_centro; ?>
                        </td>

                        <td>
                            <?php echo $direccion; ?>
                        </td>

                        <td>
                            <?php
                            if ($estado == "0") {
                                echo '<span class="badge badge-danger">Inactivo</span>';
                            } else {
                                echo '<span class="badge badge-success">Activo</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button title="Ver y editar registro" type="button" class="btn btn-warning btn-xs" onclick="editar(<?php echo $id_medicos; ?>)" data-target="#editsedeModal" data-toggle="modal"><i class="fa-solid fa-eye" style="font-size:14px;"></i></button>
                                <button title="Eliminar registro" type="button" class="btn btn-danger btn-xs" onclick="deleteMedico(<?php echo $id_medicos; ?>)"><i class="fa-solid fa-trash-can" style="font-size:14px;"></i></button>
                            </div>
                            <!--<a href="#" onclick="editar(<?php echo $id_medicos; ?>);" data-target="#editsedeModal" data-toggle="modal" style="color: #E8A200;" title="Editar"><i style="font-size:18px;" id="icon" class="fa-solid fa-pen-to-square"></i><span></span></a>
                            <a href="#" onclick="borrar(<?php echo $id_medicos; ?>);" data-toggle="modal" style="color: #CE2222;" title="Eliminar"><i id="icon" style="font-size:18px;" class="fa-solid fa-trash-can"></i><span></span></a>
                            <a href="#" onclick="desactivar(<?php echo $id_medicos; ?>,<?php echo $estado ?>);" style="color: #061078;" title="Desactivar"><i id="icon" style="font-size:18px;" class="fa-solid fa-power-off"></i><span></span></a>-->
                        </td>
                    </tr>

            <?php
                }
            }
            ?>

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

            new DataTable('.table-medicos-2', {
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
                        url: '/ce3uix/apps/medicos/crud.php',
                        data: $('#formcontrol').serialize(),
                        success: function(respuesta) {
                            $('.content-table-sedes').load('https://conlabweb3.tierramontemariana.org/apps/medicos/thedatatable.php');
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

        function borrar(id) {
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
                        url: '/ce3uix/apps/medicos/crud.php',
                        data: {
                            id: id,
                            modeeditstatus: 'B'
                        },
                        success: function(respuesta) {

                            $('.content-table-sedes').load('https://conlabweb3.tierramontemariana.org/apps/medicos/thedatatable.php');
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

            $('#editMedicos').load('https://conlabweb3.tierramontemariana.org/apps/medicos/modal-editar.php', {
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

        function desactivar(id, estado) {

            if (estado == 1) {
                Swal.fire({
                    text: "¿Desea desactivar el registro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, desactivar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: 'https://conlabweb3.tierramontemariana.org/apps/medicos/crud.php',
                            data: {
                                id: id,
                                modeeditstatus: 'D'
                            },
                            success: function(respuesta) {

                                $('.content-table-sedes').load('https://conlabweb3.tierramontemariana.org/apps/medicos/thedatatable.php');
                                Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: '¡Registro desactivado con exito!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })


                            }
                        });
                    }
                })

            } else {
                Swal.fire({
                    text: "¿Desea activar el registro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, activar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    $.ajax({
                        type: 'POST',
                        url: '/ce3uix/apps/medicos/crud.php',
                        data: {
                            id: id,
                            modeeditstatus: 'D'
                        },
                        success: function(respuesta) {

                            $('.content-table-sedes').load('https://conlabweb3.tierramontemariana.org/apps/medicos/thedatatable.php');
                            Swal.fire({
                                position: 'top',
                                icon: 'success',
                                title: '¡Registro activado con exito!',
                                showConfirmButton: false,
                                timer: 1500
                            })


                        }
                    });
                })
            }
        }
    </script>

<?php
}
?>