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

    include('reglasdenavegacion.php');

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }
    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = 0;
    }

    $id_categoria_producto = "1";
    $nombre = "";
    $id_user_mod = 0;
    $fecha_mod = "";
    $motivo_mod = "";
    $estado = "1";

?>


    <!--<div class="card">
        <div class="card-header bg-gradient-light">
            <strong>Buscar Facturas</strong>
        </div>
        <div class="card-body">
            <form action="">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Número de Factura:</label>
                        <input type="text" class="form-control" name="numfact" id="numfact">
                    </div>
                    <div class="col-md-2">
                        <label for="">Número de Orden:</label>
                        <input type="text" class="form-control" name="numorden" id="numorden">
                    </div>
                    <div class="col-md-2">
                        <label for="">Grupo de Clientes:</label>
                        <select class="form-control" name="grupoclientes" id="grupoclientes">
                            <option value="" selected disabled></option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Nit Empresa:</label>
                        <input type="text" class="form-control" name="numide" id="numide">
                    </div>
                    <div class="col-md-2">
                        <label for="">Empresa:</label>
                        <select class="form-control" name="empresa" id="empresa">
                            <option value="" selected disabled></option>
                        </select>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="">Fecha de Inicio:</label>
                        <input type="date" class="form-control" name="fechainicio" id="fechainicio">
                    </div>
                    <div class="col-md-2">
                        <label for="">Fecha de Final:</label>
                        <input type="date" class="form-control" name="fechafinal" id="fechafinal">
                    </div>
                    <div class="col-md-4" style="margin-top: 31px;">
                        <button type="button" class="btn btn-info btn-sm">Buscar</button>
                        <button type="button" class="btn btn-secondary btn-sm">Limpiar</button>
                    </div>
                </div>
            </form>
            <div class="content-table-glosas mt-4" style="overflow-x: scroll;">

            </div>
        </div>
    </div>-->

    <div class="card">
        <div class="card-header bg-gradient-light">
            <strong>Motivos de Glosas</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Descripción:</label>
                    <input type="text" class="form-control" name="descglosa" id="descglosa">
                </div>
                <div class="col-md-2">
                    <label for="">Estado:</label>
                    <select class="form-control" name="estadoglosas" id="estadoglosas">
                        <option value="" selected disabled></option>
                    </select>
                </div>
                <div class="col-md-4" style="margin-top: 31px;">
                    <button type="button" class="btn btn-info btn-sm">Buscar</button>
                    <button type="button" class="btn btn-secondary btn-sm">Limpiar</button>
                </div>
            </div>

            <div class="mt-4">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalMotivoGlosas">Crear Motivo de Glosas</button>
            </div>

            <div class="content-motivo-glosa mt-2" style="overflow-x: scroll;">

            </div>
        </div>
    </div>

    <!--<div class="card">
        <div class="card-header bg-gradient-light">
            <strong>Notas Contables</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Descripción:</label>
                    <input type="text" class="form-control" name="descglosa" id="descglosa">
                </div>
                <div class="col-md-2">
                    <label for="">Tipo:</label>
                    <select class="form-control" name="tiponotas" id="tiponotas">
                        <option value="" selected disabled></option>
                    </select>
                </div>
                <div class="col-md-4" style="margin-top: 31px;">
                    <button type="button" class="btn btn-info btn-sm">Buscar</button>
                    <button type="button" class="btn btn-secondary btn-sm">Limpiar</button>
                </div>
            </div>

            <div class="mt-4">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalNotasContables">Crear Nota</button>
            </div>

            <div class="content-notas mt-2" style="overflow-x: scroll;">

            </div>
        </div>
    </div>-->

    <div class="card">

        <div class="card-header bg-gradient-light">
            <strong>Otras Opciones</strong>
        </div>
        <div class="card-body">

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active btn" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa-solid fa-building-columns"></i> Entidades Bancarias</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa-solid fa-list"></i> Actividad de Seguimiento</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa-solid fa-bookmark"></i> Motivo de Seguimiento</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                    <div class="row mt-4">
                        <div class="col-md-3">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalEntidadesBanc"><i class="fa-solid fa-plus"></i> Crear</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="content-table-end-banc col-md-12">

                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
            </div>

        </div>

        <!--<div class="row mt-3">
            <div class="col-md-2">
                <label for="">Plazo Pago (Días):</label>
                <input type="date" class="form-control" name="plazopago" id="plazopago">
            </div>
            <div class="col-md-2">
                <label for="">Obligaciones Fiscales:</label>
                <input type="text" class="form-control" name="obligaciones" id="obligaciones">
            </div>
            <div class="col-md-2">
                <label for="">Régimen Tax:</label>
                <input type="text" class="form-control" name="regtax" id="regtax">
            </div>
            <div class="col-md-2">
                <label for="">Régimen Fiscal:</label>
                <input type="text" class="form-control" name="regfiscal" id="regfiscal">
            </div>
        </div>-->

        <!-- Modal Motivo Glosas -->
        <div class="modal fade" id="modalMotivoGlosas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Motivo de Glosas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formMotivoGlosas" method="POST" enctype="multipart/form-data">
                            <label for="">Descripcion:</label>
                            <input type="text" class="form-control" name="descglosa" id="descglosa" required>
                            <br><label for="">Estado:</label>
                            <select class="form-control" name="estadoglosas" id="estadoglosas" required>
                                <option value="" selected disabled></option>
                                <option value="1" selected>Activo</option>
                                <option value="2">Desactivado</option>
                            </select>
                            <br><button type="submit" class="btn btn-success" onclick="">Guardar</button>
                        </form>
                        <div class="row">
                            <div class="content-table-docs col-md-12 mt-4">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Notas Contables -->
        <div class="modal fade" id="modalNotasContables" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Notas Contables</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <label for="">Descripcion:</label>
                            <input type="text" class="form-control is-invalid" name="descnotas" id="descnotas">
                            <br><label for="">Tipo:</label>
                            <select class="form-control" name="tiponotas" id="tiponotas">
                                <option value="" selected disabled></option>
                            </select>
                            <br><button type="button" class="btn btn-success">Guardar</button>
                        </form>
                        <div class="row">
                            <div class="content-table-docs col-md-12 mt-4">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Entidades Bancarias-->
        <div class="modal fade" id="modalEntidadesBanc" tabindex="-1" aria-labelledby="modalEntidadesBancLabel" aria-hidden="true">

        </div>

        <!-- Modal Editar Entidades Bancarias-->
        <div class="modal fade" id="modalEditEntidadesBanc" tabindex="-1" aria-labelledby="modalEntidadesBancLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEntidadesBancLabel">Editar Entidad Bancaria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" id="formDatosEndBancEdit" method="POST" enctype="multipart/form-data">

                        <div class="modal-body" id="contentTextFileds">


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Grabar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Motivo Glosas -->
        <div class="modal fade" id="modalMotivoGlosas" tabindex="-1" aria-labelledby="modalMotivoGlosasLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalMotivoGlosasLabel">Editar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" id="formEditMotivoGlosas" method="POST" enctype="multipart/form-data">
                        <div class="modal-body" id="loadModalEditMotivosGlosas">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php
}
    ?>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {
            //$('.content-table-glosas').load('/cw3/conlabweb3.0/apps/empresas/table-glosas.php');
            $('.content-motivo-glosa').load('/cw3/apps/empresas/table-motivo-glosas.php');
            //$('.content-notas').load('/cw3/conlabweb3.0/apps/empresas/table-notas-contables.php');
            $('#modalEntidadesBanc').load('/cw3/apps/empresas/modal-end-banc.php');
            $('.content-table-end-banc').load('/cw3/apps/empresas/table-end-banc.php');

            $.validator.setDefaults({
                submitHandler: function() {

                    $.ajax({
                        type: 'POST',
                        url: '/cw3/apps/empresas/crud.php?aux=4',
                        data: $('#formMotivoGlosas').serialize(),
                        success: function(respuesta) {
                            //alert("¡Registro Exitoso!");
                            Swal.fire({
                                position: "top-center",
                                icon: "success",
                                title: "¡Registro Exitoso!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            miDataTableEndBanc.ajax.reload();
                        }
                    });
                }

            });
            $('#formMotivoGlosas').validate({
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
        $(document).ready(function() {
            $.validator.setDefaults({
                submitHandler: function() {

                    $.ajax({
                        type: 'POST',
                        url: '/cw3/apps/empresas/crud.php?aux=11',
                        data: $('#formDatosEndBancEdit').serialize(),
                        success: function(respuesta) {
                            //alert("¡Registro Exitoso!");
                            Swal.fire({
                                position: "top-center",
                                icon: "success",
                                title: "¡Registro Exitoso!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            miDataTableEndBanc.ajax.reload();
                        }
                    });
                }
            });
            $('#formDatosEndBancEdit').validate({
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