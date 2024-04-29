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

    <form action="">
        <div class="card">
            <div class="card-header">
                Datos Básicos
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Razón Social:</label>
                        <input type="text" class="form-control" name="razon" id="razon">
                    </div>
                    <div class="col-md-3">
                        <label for="">Nombre Comercial:</label>
                        <input type="text" class="form-control" name="nombrecomercial" id="nombrecomercial">
                    </div>
                    <!--<div class="col-md-2">
                        <label for="">Estado:</label>
                        <select class="form-control" name="estado" id="estado">
                            <option value="" selected disabled></option>
                        </select>
                    </div>-->
                    <div class="col-md-2">
                        <label for="">Tipo Identificación:</label>
                        <select class="form-control" name="tipoide" id="tipoide">
                            <option value="" selected disabled></option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Número Identificación:</label>
                        <input type="text" class="form-control" name="numide" id="numide">
                    </div>

                    <div class="col-md-2">
                        <label for="">Digito Verificación:</label>
                        <input type="text" class="form-control" name="digverificacion" id="digverificacion" style="width: 100px;">
                    </div>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Datos de Ubicación
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Departamento:</label>
                        <select class="form-control" name="dep" id="dep">
                            <option value="" selected disabled></option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Ciudad:</label>
                        <select class="form-control" name="ciudad" id="ciudad">
                            <option value="" selected disabled></option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Tipo de Vía:</label>
                        <select class="form-control" name="tipovia" id="tipovia">
                            <option value="" selected disabled></option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label for="">No. Vía:</label>
                        <input type="text" class="form-control" name="novia" id="novia">
                    </div>
                    <div class="col-md-1">
                        <label for="">Número Vivienda:</label>
                        <input type="text" class="form-control" name="novivienda" id="novivienda">
                    </div>
                    <div class="col-md-2">
                        <label for="">Teléfono:</label>
                        <input type="text" class="form-control" name="tel" id="tel">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="">Celular:</label>
                        <input type="text" class="form-control" name="cel" id="cel">
                    </div>
                    <div class="col-md-2">
                        <label for="">Email:</label>
                        <input type="text" class="form-control" name="email" id="email">
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
                    <div class="col-md-2">
                        <label for="">Nombres:</label>
                        <input type="text" class="form-control" name="replegal" id="replegal">
                    </div>
                    <div class="col-md-2">
                        <label for="">No. Id. Representante Legal:</label>
                        <input type="text" class="form-control" name="numiderep" id="numiderep">
                    </div>
                    <div class="col-md-2">
                        <label for="">Ejecutivo Comercial:</label>
                        <select class="form-control" name="tipoide" id="tipoide">
                            <option value="" selected disabled></option>
                        </select>
                    </div>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Contactos
            </div>
            <div class="card-body">
                <form action="">
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
                        <div class="content-table-contactos col-md-12">
                            
                        </div>
                    </div>
                </form>
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

        <hr>

        <div class="row mt-3">
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
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalReqInsumo">
                    <i class="fa-solid fa-vial"></i>
                    Requiere Insumos
                </button>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalDocumentos">
                    <i class="fa-solid fa-paperclip"></i>
                    Documentos
                </button>
                <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            </div>
        </div>

    </form>

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

        $('.content-table-contactos').load('/desarrolloV3/apps/empresas/table-contactos.php');

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