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

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv . bbserver1);
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


    <div class="card">
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
                    <!--<div class="col-md-2">
                        <label for="">Estado:</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="" selected disabled></option>
                        </select>
                    </div>-->
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
            <div class="content-table-glosas mt-4">

            </div>
        </div>
    </div>

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

            <div class="content-motivo-glosa mt-2">

            </div>
        </div>
    </div>

    <div class="card">
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

            <div class="content-notas mt-2">

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-gradient-light">
            <strong>Otras Opciones</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-building-columns"></i> Entidades Bancarias</button>
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-list"></i> Actividad de Seguimiento</button>
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-bookmark"></i> Motivo de Seguimiento</button>
                </div>
            </div>
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
                    <form action="">
                        <label for="">Descripcion:</label>
                        <input type="text" class="form-control" name="descglosa" id="descglosa">
                        <br><label for="">Estado:</label>
                        <select class="form-control" name="estadoglosas" id="estadoglosas">
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
                        <input type="text" class="form-control" name="descnotas" id="descnotas">
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

<?php
}
?>

<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>

<script>
    function validarCampo(caso) {

        var valor = $("#nombre").val();
        var motmod = $("#motmod").val();
        var iduserx = $("#iduserx").val();
        if (valor.trim() === '') {
            $("#nombre").css("border", "thin solid red");
            $("#errorform").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>El campo Nombre no puede estar vacío.</span>");
            return;
        } else {
            $("#nombre").css("border", "thin solid rgb(233,236,239)");
            $("#errorform").empty();
        }
        if (iduserx.trim() === '') {
            collapseanshow(caso);


        } else {
            if (motmod.trim() === '') {
                $("#motmod").css("border", "thin solid red");
                $("#motmodx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>El campo no puede estar vacío.</span>");
                return;
            } else {
                $("#motmod").css("border", "thin solid rgb(233,236,239)");
                $("#motmodx").empty();
            }
            collapseanshow(caso);

        }



    };
    $(document).ready(function() {
        $('#cancelbtn').on('click', function() {
            $("#nombre").css("border", "thin solid rgb(233,236,239)");
            $("#errorform").empty();
            $("#motmod").css("border", "thin solid rgb(233,236,239)");
            $("#motmodx").empty();
        });

        $('.content-table-glosas').load('/desarrolloV3/apps/empresas/table-glosas.php');
        $('.content-motivo-glosa').load('/desarrolloV3/apps/empresas/table-motivo-glosas.php');
        $('.content-notas').load('/desarrolloV3/apps/empresas/table-notas-contables.php');
    })


    function savedata() {

        $.ajax({
            type: 'POST',
            url: '/desarrolloCW3V3/apps/sedes/crud.php',
            data: $('#formcontrol').serialize(),
            success: function(respuesta) {
                if (respuesta == 'ok') {
                    //                     alert('Termiando');
                }
                $("#codigo").load('/desarrolloCW3V3/apps/sedes/codigo.php', {});
                $("#thetable").load('/desarrolloCW3V3/apps/sedes/thedatatable.php', {
                    iduser: <?php echo $iduser ?>
                });

                alert("¡Registro Exitoso!");
            }
        });


        inhabilitacmpos();
    } //de alvar datos
</script>