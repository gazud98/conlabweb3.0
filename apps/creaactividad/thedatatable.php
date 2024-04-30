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

    <style>
        .content-table {
            width: 100%;
            height: auto;
            background-color: #fff;
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

        .table-title .table-dptos {
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
            border: 1px solid #DCDCDC;
            word-wrap: break-word;
            padding: 2px;
            text-align: center;
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

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }


        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }

        .breadcrumbs {
            border: 1px solid #cbd2d9;
            border-radius: 0.3rem;
            display: inline-flex;
            overflow: hidden;
        }

        .breadcrumbs__item {
            background: #fff;
            color: #333;
            outline: none;
            padding: 0.55em 0.55em 0.55em 1.15em;
            position: relative;
            text-decoration: none;
            transition: background 0.2s linear;
            font-size: 13px;
        }

        .breadcrumbs__item:hover:after,
        .breadcrumbs__item:hover {
            background: #edf1f5;
        }

        .breadcrumbs__item:focus:after,
        .breadcrumbs__item:focus,
        .breadcrumbs__item.is-active:focus {
            background: #0045A5;
            color: #fff;
        }

        .breadcrumbs__item:after,
        .breadcrumbs__item:before {
            background: white;
            bottom: 0;
            clip-path: polygon(50% 50%, -50% -50%, 0 100%);
            content: "";
            left: 100%;
            position: absolute;
            top: 0;
            transition: background 0.2s linear;
            width: 1em;
            z-index: 1;
        }

        .breadcrumbs__item:before {
            background: #cbd2d9;
            margin-left: 1px;
        }

        .breadcrumbs__item:last-child {
            border-right: none;
        }

        .breadcrumbs__item.is-active {
            background: #edf1f5;
        }

        .page-item .page-link {
            position: relative;
            display: block;
            padding: 0.2rem 0.2rem;
            margin-left: 0;
            line-height: 1.25;
            background-color: #fff;
            border: 1px solid #dee2e6;
            font-size: 14px;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #0045A5;
            border-color: #0045A5;
        }

        #icon:hover {
            background-color: rgb(242, 242, 242);
            color: black;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button a {
            padding: 0.8em;
        }

        .dataTables_info {
            font-size: 14px;
        }
    </style>

    <table class="table table-striped " id="table-creaactividad" style="
                    font-size: 15px;
                    text-align: center;
                    margin-top: 150px;
                ">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?php
            /* */
            //******************************************************************************
            //ahora a mostarr los rgistro de la pagina en cuestion                        CAMBIAR CONSULTA
            $cadena = "SELECT id, nombre,estado
                    FROM  u116753122_cw3completa.actividad_seguimiento order by 1 ";
            //                      echo $cadena;
            /* */
            $resultadP2 = $conetar->query($cadena);
            $numerfiles2 = mysqli_num_rows($resultadP2);
            if ($numerfiles2 >= 1) {
                $thefile = 0;
                while ($filaP2 = mysqli_fetch_array($resultadP2)) {
                    $id = trim($filaP2['id']);                      //RESPETAR EL $ID QES LA QUE CARGA LA LLAVE PRIMARIA
                    $nombre = $filaP2['nombre'];                         //RESPETAR EL $NOMBRE ES PARA MOSAR CUAL ESL EL NOMBRE UNICO
                    $estado = $filaP2['estado'];

                    $thefile = $thefile + 1;

            ?>

                    <tr>
                        <td name="thefileselected<?php echo trim($thefile); ?>" id="thefileselected<?php echo trim($thefile); ?>"><?php echo $id; ?></td>
                        <td>
                            <?php echo $nombre; ?>
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
                            <a href="#" onclick="editar(<?php echo $id; ?>);" data-target="#editModal" data-toggle="modal" style="color: #E8A200;" title="Editar"><i style="font-size:18px;" id="icon" class="fa-solid fa-pen-to-square"></i><span></span></a>
                            <a href="#" onclick="borrar(<?php echo $id; ?>);" data-toggle="modal" style="color: #CE2222;" title="Eliminar"><i id="icon" style="font-size:18px;" class="fa-solid fa-trash-can"></i><span></span></a>
                            <a href="#" onclick="desactivar(<?php echo $id; ?>,<?php echo $estado ?>);" style="color: #061078;" title="Desactivar"><i id="icon" style="font-size:18px;" class="fa-solid fa-power-off"></i><span></span></a>
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


    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#table-creaactividad').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                },
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true
            });

            $.validator.setDefaults({
                submitHandler: function() {
                    $.ajax({
                        type: 'POST',
                        url: '/cw3/conlabweb3.0/apps/creaactividad/crud.php',
                        data: $('#formcontrol').serialize(),
                        success: function(respuesta) {
                            if (respuesta == 'ok') {
                                //                     alert('Termiando');
                            }
                            $('.content-table-creaactividad').load('/cw3/conlabweb3.0/apps/creaactividad/thedatatable.php');

                            alert("¡Registro añadido con exito!");
                        }
                    });
                    $("#addModal").modal("hide");
                }
            });
            $('#formcontrol').validate({
                rules: {
                    nombre: {
                        required: true
                    },
                },
                messages: {
                    nombre: {
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

        function borrar(id) {
            var opcion = confirm("¿Desea borrar el registro?");
            if (opcion == true) {
                $.ajax({
                    type: 'POST',
                    url: '/cw3/conlabweb3.0/apps/creaactividad/crud.php',
                    data: {
                        id: id,
                        modeeditstatus: 'B'
                    },
                    success: function(respuesta) {

                        $('.content-table-creaactividad').load('/cw3/conlabweb3.0/apps/creaactividad/thedatatable.php');
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
        }


        function editar(id) {




            $('#editModal').load('/cw3/conlabweb3.0/apps/creaactividad/modal-editar.php', {
                id: id
            });




        }

        function desactivar(id, estado) {

            if (estado == 1) {
                var opcion = confirm("¿Desea desactivar el registro?");
                if (opcion == true) {
                    $.ajax({
                        type: 'POST',
                        url: '/cw3/conlabweb3.0/apps/creaactividad/crud.php',
                        data: {
                            id: id,
                            modeeditstatus: 'D'
                        },
                        success: function(respuesta) {

                            $('.content-table-creaactividad').load('/cw3/conlabweb3.0/apps/creaactividad/thedatatable.php');
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
            } else {
                var opcion = confirm("¿Desea activar el registro?");
                if (opcion == true) {
                    $.ajax({
                        type: 'POST',
                        url: '/cw3/conlabweb3.0/apps/creaactividad/crud.php',
                        data: {
                            id: id,
                            modeeditstatus: 'D'
                        },
                        success: function(respuesta) {

                            $('.content-table-creaactividad').load('/cw3/conlabweb3.0/apps/creaactividad/thedatatable.php');
                            Swal.fire({
                                position: 'top',
                                icon: 'success',
                                title: '¡Registro activado con exito!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                         
                        }
                    });
                }
            }
        }
    </script>

<?php
}
?>