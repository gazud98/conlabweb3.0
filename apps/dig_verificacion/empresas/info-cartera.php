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


    <div class="">
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
        <div class="card">
            <div class="card-header">
                Información Económica
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Cupo Crédito:</label>
                        <input type="number" class="form-control" name="cupocredito" id="cupocredito">
                    </div>
                    <div class="col-md-2">
                        <label for="">Cupo Consumido Crédito:</label>
                        <input type="number" class="form-control" name="cupocredito2" id="cupocredito2">
                    </div>
                    <div class="col-md-1">
                        <label for="">Días de Pago:</label>
                        <input type="number" class="form-control" name="diaspago" id="diaspago">
                    </div>
                    <div class="col-md-1">
                        <label for="">Estado Cartera:</label>
                        <select class="form-control" name="estadocartera" id="estadocartera">
                            <option value="" selected disabled></option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Fecha del Cobro Jurídico:</label>
                        <input type="date" class="form-control" name="fechacobro" id="fechacobro">
                    </div>
                    <div class="col-md-2">
                        <label for="">Motivo Cobro Jurídico:</label>
                        <input type="number" class="form-control" name="motivo" id="motivo">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="col-md-12 text-right">
        <button class="btn btn-primary btn-sm"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
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