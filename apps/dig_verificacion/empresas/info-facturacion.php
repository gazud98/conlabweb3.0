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


    <div class="row">
        <!--<div class="col-md-2">
                <label for="">Procedencia:</label>
                <select class="form-control" name="proc" id="proc">
                    <option value="" selected disabled></option>
                </select>
            </div>-->
        <!--<div class="col-md-2">
                <label for="">Médico:</label>
                <select class="form-control" name="medico" id="medico">
                    <option value="" selected disabled></option>
                </select>
            </div>-->
        <!--<div class="col-md-2">
                <label for="">Diagnóstico:</label>
                <select class="form-control" name="diag" id="diag">
                    <option value="" selected disabled></option>
                </select>
            </div>-->
        <div class="col-md-2">
            <label for="">Día Radicación 1er Periodo:</label>
            <input type="text" class="form-control" name="rad1" id="rad1">
        </div>
        <div class="col-md-2">
            <label for="">Día Radicación 2do Periodo:</label>
            <input type="text" class="form-control" name="rad2" id="rad2">
        </div>
        <div class="col-md-2">
            <label for="">Tipo de Factura:</label>
            <select class="form-control" name="tipofact" id="tipofact">
                <option value="" selected disabled></option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="">Formato de Factura:</label>
            <select class="form-control" name="formatofact" id="formatofact">
                <option value="" selected disabled></option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="">Cant. Pacientes Por Mes:</label>
            <input type="text" class="form-control" name="cantpacientes" id="cantpacientes">
        </div>
        <div class="col-md-2">
            <label for="">Formato Anexo:</label>
            <select class="form-control" name="formatoanexo" id="formatoanexo">
                <option value="" selected disabled></option>
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-1">
            <label for="">No. Copias:</label>
            <input type="text" class="form-control" name="nocopias" id="nocopias">
        </div>
        <div class="col-md-1">
            <label for="">¿Requiere Rips?:</label>
            <select class="form-control" name="reqrips" id="reqrips">
                <option value="" selected disabled></option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="">Cant. Pacientes Factura:</label>
            <input type="text" class="form-control" name="catpacientesfac" id="catpacientesfac">
        </div>
        <div class="col-md-1">
            <label for="">N°. RIA:</label>
            <input type="text" class="form-control" name="noria" id="noria">
        </div>
        <div class="col-md-1">
            <label for="">Tipo de Usuario:</label>
            <select class="form-control" name="tipousuario" id="tipousuario">
                <option value="" selected disabled></option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="">Notas Empresa:</label>
            <!--<input type="text" class="form-control" name="notasempresa" id="notasempresa">-->
            <textarea class="form-control" name="notasempresa" id="notasempresa" cols="30" rows="2"></textarea>
        </div>
        <div class="col-md-3">
            <label for="">Otras Notas:</label>
            <!--<input type="text" class="form-control" name="otrasnotas" id="otrasnotas">-->
            <textarea class="form-control" name="otrasnotas" id="otrasnotas" cols="30" rows="2"></textarea>
        </div>
    </div>

    <hr>

    <div class="content-info-table-ingreso mt-3" style="font-size: 20px;">
        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalPlan">Crear Plan</button>
    </div>

    <div class="content-table-ingreso mt-2">

    </div>

    <div class="col-md-12 text-right">
        <button class="btn btn-primary btn-sm"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
    </div>

    <!-- Modal Plan -->
    <div class="modal fade" id="modalPlan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <label for="">Nombre:</label>
                        <input type="text" class="form-control" name="nombreplan" id="nombreplan">
                        <br><label for="">Descripción:</label>
                        <textarea name="descpplan" id="descpplan" cols="30" rows="5" class="form-control"></textarea>
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

<!-- jquery-validation -->
<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!--<script src="assets/plugins/jquery/jquery.min.js"></script>-->

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

        $('.content-table-ingreso').load('/desarrolloV3/apps/empresas/tableinfofac.php');

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