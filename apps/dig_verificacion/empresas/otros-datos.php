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
                <label for="">Tipo de Vía:</label>
                <select class="form-control" name="tipovia" id="tipovia">
                    <option value="" selected disabled></option>
                </select>
            </div>-->
        <div class="col-md-2">
            <label for="">Representante Legal:</label>
            <input type="text" class="form-control" name="replegal" id="replegal">
        </div>
        <div class="col-md-3">
            <label for="">No. Identificación Presentante Legal:</label>
            <input type="text" class="form-control" name="numiderep" id="numiderep">
        </div>
        <div class="col-md-2">
            <label for="">Ejecutivo Comercial:</label>
            <select class="form-control" name="tipoide" id="tipoide">
                <option value="" selected disabled></option>
            </select>
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