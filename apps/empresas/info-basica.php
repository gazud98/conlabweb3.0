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


?>

    <div class="row">
        <div class="col-md-6">
            <form id="formDatosBasicos" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        Datos Básicos
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4">
                                <label for="">Tipo Identificación:</label>
                                <?php include('tp-iden.php'); ?>
                            </div>
                            <div class="col-md-2">
                                <label for="">N° Identificación:</label>
                                <input type="text" class="form-control" name="numide" id="numide" required>
                            </div>

                            <div class="col-md-1">
                                <label for="">DV:</label>
                                <input type="text" class="form-control" name="digverificacion" id="digverificacion" required>
                            </div>

                            <div class="col-md-5">
                                <label for="">Razón Social:</label>
                                <input type="text" class="form-control" name="razon" id="razon" required>
                            </div>
                            <!--<div class="col-md-2">
                        <label for="">Estado:</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="" selected disabled></option>
                        </select>
                    </div>-->
                        </div>

                        <div class="row mt-3">

                            <div class="col-md-4">
                                <label for="">Nombre Comercial:</label>
                                <input type="text" class="form-control" name="nombrecomercial" id="nombrecomercial" required>
                            </div>

                            <div class="col-md-2">
                                <label for="">Teléfono Fijo:</label>
                                <input type="text" class="form-control" name="tel" id="tel" required>
                            </div>
                            <div class="col-md-2">
                                <label for="">Celular:</label>
                                <input type="text" class="form-control" name="cel" id="cel" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Correo:</label>
                                <input type="text" class="form-control" name="email" id="email" required>
                            </div>

                        </div>

                        <div class="row mt-3">

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Datos de Ubicación
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Departamento:</label>
                                <select class="form-control" name="dep" id="dep" required>
                                    <option value="" selected disabled></option>
                                    <?php
                                    $sql = "SELECT id, nombre FROM departamento";
                                    $rest = mysqli_query($conetar, $sql);
                                    while ($data = mysqli_fetch_array($rest)) {
                                    ?>
                                        <option value="<?php echo $data['id']; ?>"><?php echo $data['nombre']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Ciudad:</label>
                                <select class="form-control" name="ciudad" id="ciudad" required>
                                    
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Tipo de Vía:</label>
                                <select class="form-control" name="tipovia" id="tipovia" required>
                                    <option value="" selected disabled></option>
                                    <option value="Calle">Calle</option>
                                    <option value="Carrera">Carrera</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">No. Vía:</label>
                                <input type="text" class="form-control" name="novia" id="novia" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <label for="">No. Vivienda:</label>
                                <input type="text" class="form-control" name="novivienda" id="novivienda" required>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card">
                    <div class="card-header">
                        Representante Legal
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Nombres:</label>
                                <input type="text" class="form-control" name="replegal" id="replegal" required>
                            </div>
                            <div class="col-md-3">
                                <label for="">No. Documento:</label>
                                <input type="text" class="form-control" name="numiderep" id="numiderep" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Ejecutivo Comercial:</label>
                                <select class="form-control" name="tipoide" id="tipoide">
                                    <option value="" selected disabled></option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                <!--<div class="row mt-3">
                    <div class="col-md-2">
                        <span>
                            <input type="checkbox" name="empfacturar" id="empfacturar">
                            <strong>Empresa a Facturar</strong>
                        </span>
                    </div>
                    <div class="col-md-2">
                        <span>
                            <input type="checkbox" name="bloqres" id="bloqres">
                            <strong>Bloquear Resultados</strong>
                        </span>
                    </div>
                    <div class="col-md-2">
                        <span>
                            <input type="checkbox" name="reqmen" id="reqmen">
                            <strong>Requiere Mensajería</strong>
                        </span>
                    </div>
                    <div class="col-md-2">
                        <span>
                            <input type="checkbox" name="mosexa" id="mosexa">
                            <strong>Mostrar Exámenes</strong>
                        </span>
                    </div>
                    <div class="col-md-2">
                        <span>
                            <input type="checkbox" name="reqlogo" id="reqlogo">
                            <strong>Requiere Logo</strong>
                        </span>
                    </div>
                </div>-->

                <div class="row mt-4">

                    <div class="col-md-6">
                        <!--<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalReqInsumo">
                    <i class="fa-solid fa-vial"></i>
                    Requiere Insumos
                </button>-->
                        <!--<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalDocumentos">
                    <i class="fa-solid fa-paperclip"></i>
                    Documentos
                </button>-->
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                    </div>
                </div>

            </form>

        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Lista de Empresas
                </div>
                <div class="card-body">
                    <div class="content-table-empresas" id="contentTableEmpresas">

                    </div>
                    <div id="contentTableEmpresas2">

                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-info btn-sm" onclick="confirmRadioSelected()" data-toggle="modal" data-target="#modalCrearPlan"><i class="fa-solid fa-clipboard-list"></i> Crear plan</button>
                        <a href="#formInfoFacturacion" class="btn btn-warning btn-sm" onclick="confirmRadioSelected()"><i class="fa-solid fa-file-invoice-dollar"></i> Agregar info. Facturación</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Planes
                </div>
                <div class="card-body">
                    <div id="contentTablePlanesEmpresa">

                    </div>
                </div>
            </div>

        </div>
    </div>

    <hr>

    <div class="row mt-5">

        <div class="col-md-12">
            <div class="card" id="cardInfoFact">
                <div class="card-header">
                    <strong>Información de Facturación</strong>
                </div>
                <div class="card-body">
                    <form action="" id="formInfoFacturacion" method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <input type="hidden" name="idempresafact" id="idempresafact">
                            <div class="col-md-2">
                                <label for="">Día Radicación 1er Periodo:</label>
                                <input type="number" class="form-control" name="rad1" id="rad1" required>
                            </div>
                            <div class="col-md-2">
                                <label for="">Día Radicación 2do Periodo:</label>
                                <input type="number" class="form-control" name="rad2" id="rad2" required>
                            </div>
                            <div class="col-md-2">
                                <label for="">Tipo de Factura:</label>
                                <select class="form-control" name="tipofact" id="tipofact" required>
                                    <option value="" selected disabled>SELECCIONA:</option>
                                    <?php

                                    $sql = "SELECT id, descripcion, estado FROM tipo_factura";

                                    $rest = mysqli_query($conetar, $sql);

                                    while ($element = mysqli_fetch_array($rest)) {

                                    ?>

                                        <option value="<?php echo $element['id']; ?>"><?php echo $element['descripcion']; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Formato de Factura:</label>
                                <select class="form-control" name="formatofact" id="formatofact" required>
                                    <option value="" selected disabled>SELECCIONA:</option>
                                    <?php

                                    $sql = "SELECT id, descripcion, estado FROM formato_factura";

                                    $rest = mysqli_query($conetar, $sql);

                                    while ($element = mysqli_fetch_array($rest)) {

                                    ?>

                                        <option value="<?php echo $element['id']; ?>"><?php echo $element['descripcion']; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Cant. Pacientes Por Mes:</label>
                                <input type="number" class="form-control" name="cantpacientes" id="cantpacientes" required>
                            </div>
                            <div class="col-md-2">
                                <label for="">Formato Anexo:</label>
                                <select class="form-control" name="formatoanexo" id="formatoanexo" required>
                                    <option value="" selected disabled>SELECCIONA:</option>
                                    <?php

                                    $sql = "SELECT id, descripcion, estado FROM formatos_anexo";

                                    $rest = mysqli_query($conetar, $sql);

                                    while ($element = mysqli_fetch_array($rest)) {

                                    ?>

                                        <option value="<?php echo $element['id']; ?>"><?php echo $element['descripcion']; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-1">
                                <label for="">No. Copias:</label>
                                <input type="number" class="form-control" name="nocopias" id="nocopias" required>
                            </div>
                            <div class="col-md-1">
                                <label for="">¿Requiere Rips?:</label>
                                <select class="form-control" name="reqrips" id="reqrips" required>
                                    <option value="" selected disabled></option>
                                    <option value="1">SI</option>
                                    <option value="2">NO</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Cant. Pacientes Factura:</label>
                                <input type="number" class="form-control" name="catpacientesfac" id="catpacientesfac" required>
                            </div>
                            <div class="col-md-1">
                                <label for="">N°. RIA:</label>
                                <input type="number" class="form-control" name="noria" id="noria" required>
                            </div>
                            <div class="col-md-1">
                                <label for="">Tipo de Usuario:</label>
                                <select class="form-control" name="tipousuario" id="tipousuario" required>
                                    <option value="" selected disabled>SELECCIONA:</option>
                                    <?php

                                    $sql = "SELECT id, descripcion, estado FROM tipo_usuarios";

                                    $rest = mysqli_query($conetar, $sql);

                                    while ($element = mysqli_fetch_array($rest)) {

                                    ?>

                                        <option value="<?php echo $element['id']; ?>"><?php echo $element['descripcion']; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Notas Empresa:</label>
                                <!--<input type="text" class="form-control" name="notasempresa" id="notasempresa">-->
                                <textarea class="form-control" name="notasempresa" id="notasempresa" cols="30" rows="2" required></textarea>
                            </div>
                            <div class="col-md-3">
                                <label for="">Otras Notas:</label>
                                <!--<input type="text" class="form-control" name="otrasnotas" id="otrasnotas">-->
                                <textarea class="form-control" name="otrasnotas" id="otrasnotas" cols="30" rows="2" required></textarea>
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-sm" onclick=""><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                        </div>
                    </form>

                    <!--<div class="content-table-ingreso">

                    </div>-->

                </div>
            </div>
        </div>

    </div>

    <!--<div class="card">
        <div class="card-header">
            Contactos
        </div>
        <div class="card-body">
            <form action="" id="formAddContacto">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">No. Identificación:</label>
                        <input type="text" class="form-control" name="numiden" id="numiden">
                    </div>
                    <div class="col-md-3">
                        <label for="">Nombres y Apellidos:</label>
                        <input type="text" class="form-control" name="nomape" id="nomape">
                    </div>
                    <div class="col-md-2">
                        <label for="">Teléfono Fijo:</label>
                        <input type="text" class="form-control" name="telfijo" id="telfijo">
                    </div>
                    <div class="col-md-2">
                        <label for="">Celular:</label>
                        <input type="text" class="form-control" name="celularcontacto" id="celularcontacto">
                    </div>
                    <div class="col-md-2">
                        <label for="">Email:</label>
                        <input type="text" class="form-control" name="emailcontacto" id="emailcontacto">
                    </div>
                    <div class="col-md-1" style="margin-top: 31px;">
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="content-table-contactos col-md-12" style="overflow-x: scroll;">

                    </div>
                </div>
            </form>
        </div>
    </div>-->

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


<?php
}
?>

<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

        $('#contentTableEmpresas2').load('https://conlabweb3.tierramontemariana.org/apps/empresas/table-empresas.php');

        $.validator.setDefaults({
            submitHandler: function() {

                ide = $('#idempresafact').val();

                if (ide == 0 || ide == '') {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No has seleccionado una empresa!",
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/cw3/apps/empresas/crud.php?aux=1',
                        data: $('#formDatosBasicos').serialize(),
                        success: function(respuesta) {
                            if (respuesta == 'ok') {
                                //                     alert('Termiando');
                            }
                            Swal.fire({
                                position: "top-center",
                                icon: "success",
                                title: "¡Registro Exitoso!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            //alert("¡Registro Exitoso!");
                        }
                    });
                }

            }
        });
        $('#formDatosBasicos').validate({
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

        /* --- */

        $.validator.setDefaults({
            submitHandler: function() {

                ide = $('#idempresafact').val();

                if (ide == 0 || ide == '') {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No has seleccionado una empresa!",
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/cw3/apps/empresas/crud.php?aux=5',
                        data: $('#formInfoFacturacion').serialize(),
                        success: function(respuesta) {
                            Swal.fire({
                                position: "top-center",
                                icon: "success",
                                title: "¡Registro Exitoso!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            //alert("¡Registro Exitoso!");
                        }
                    });
                }

            }
        });
        $('#formInfoFacturacion').validate({
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

    })

    $(document).ready(function() {
        $('#dep').change(function() {
            loadCities();
        })
    })

    function loadCities() {

        id = $('#dep').val();

        $.ajax({
            url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/ciudades.php',
            data: {
                id: id
            },
            success: function(res) {
                $('#ciudad').html(res);
            }
        })

    }
</script>