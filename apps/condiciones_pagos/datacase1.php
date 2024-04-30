<?php
//si hay consulta
//     presntadio n par todos los departamento

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


    include('reglasdenavegacion.php');

    //echo '..............................'.$_REQUEST['id'].'...';

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
    //$id=1;
    //    echo $caso.'----'.$id;
    /* */
    // $id_categoria_producto = "1"; //esa ctivo fijo
    $nombre = "";
    $codigo    = "";
    $id_centro_costo = "";
    $id_empleado = "";
    $predeterminada = "";
    $estado = "";
    $id_user_mod = 0;
    $fecha_mod = "";
    $motivo_mod = "";

    if ($id != "") {
        $cadena = "select id,nombre,numero,estado,id_user_mod,fecha_mod,motivo_mod
                    from u116753122_cw3completa.condicion_pago
                    where id='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id']);
            $nombre = trim($filaP2['nombre']);
            $estado = trim($filaP2['estado']);
            $numero = trim($filaP2['numero']);
            $id_user_mod = trim($filaP2['id_user_mod']);
            $fecha_mod = trim($filaP2['fecha_mod']);
            $motivo_mod = trim($filaP2['motivo_mod']);
        }
    }

?>

    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">


        <div class="row mb-2">

            <div class="col-md-12 col-lg-12 ">
                <div class="row mb-2">
                    <div class="col-md-6 col-lg-6 " id="codigo">
                        <label style="font-size: 12px;">Codigo:</label>
                        <input type="input" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>
                    </div>
                    <!--  <div class="col-md-4 col-lg-4">
                        <label style="font-size: 12px;">Es Predeterminada</label>
                        <select class="form-control" name="predeterminada" id="predeterminada">
                            <?php
                            echo "<option value='0'";
                            if ('0' == $predeterminada) {
                                echo ' selected';
                            }
                            echo '>NO</option>';
                            echo "<option value='1'";
                            if ('1' == $predeterminada) {
                                echo ' selected';
                            }
                            echo '>SI</option>';
                            ?>
                        </select>
                    </div>-->
                </div>

            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-8 col-lg-8">
                <label style="font-size: 12px;">Nombre:</label>
                <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
                <div class="col-md-12 col-lg-12" id="errorform">
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <label style="font-size: 12px;">Numero Dias:</label>
                <input type="number" class="form-control" name="numero" id="numero" value="<?php echo $numero; ?>"></input>
                <div class="col-md-12 col-lg-12" id="errorform1">
                </div>
            </div>
        </div>


        <div>
            <input type="text" class="form-control" name="iduserx" id="iduserx" style="display:none;" value="<?php echo $iduser ?>"></input>
        </div>
        <div id="tablemod" style="display:none;margin-top:11%;">
            <div class="row mb-2 mt-5 p-1" style="border:thin dotted gray;">
                <div class="container" style="text-align: center;">
                    <label style="font-size: 14px;">Ultima Modificacion:</label>
                </div>
                <?php
                $cadena48 = "select username from u116753122_cw3completa.persona_users where id_persona=" . $id_user_mod;
                $resultadP2axz = $conetar->query($cadena48);
                $numerfiles2axz = mysqli_num_rows($resultadP2axz);
                if ($numerfiles2axz >= 1) {
                    $filaP2axz = mysqli_fetch_array($resultadP2axz);
                    $nombre_usuario = $filaP2axz['username'];
                } else {
                    $nombre_usuario = "";
                }
                ?>
                <div class="col-md-3 col-lg-3 ">
                    <label style="font-size: 12px;">Usuario:</label>
                    <input type="text" class="form-control" name="usernamemod" id="usernamemod" value="<?php echo $nombre_usuario ?>" readonly></input>

                </div>
                <div class="col-md-3 col-lg-3 ">
                    <label style="font-size: 12px;">Fecha:</label>
                    <input type="text" class="form-control" name="fechmod" id="fechmod" value="<?php echo $fecha_mod ?>" readonly></input>

                </div>
                <div class="col-md-6 col-lg-6">
                    <label style="font-size: 12px;">Motivo:</label>

                    <textarea class="form-control" name="motmod" id="motmod"><?php echo $motivo_mod ?></textarea>
                    <div id="motmodx"></div>
                </div>
            </div>
        </div>



    </form>


<?php
}
?>
<script>
    function validarCampo(caso) {

        var valor = $("#nombre").val();
        var numero = $("#numero").val();
        if (valor.trim() === '' && numero.trim() === '') {
            $("#nombre").css("border", "thin solid red");
            $("#errorform").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
            $("#numero").css("border", "thin solid red");
            $("#errorform1").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
            return false;
        } else if (numero.trim() === '') {
            $("#numero").css("border", "thin solid red");
            $("#errorform1").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
            $("#nombre").css("border", "thin solid rgb(233,236,239)");
            $("#errorform").empty();
            return false;
        } else if (valor.trim() === '') {
            $("#nombre").css("border", "thin solid red");
            $("#errorform").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
            $("#numero").css("border", "thin solid rgb(233,236,239)");
            $("#errorform1").empty();
            return false;
        } else {
            collapseanshow(caso);
            $("#nombre").css("border", "thin solid rgb(233,236,239)");
            $("#errorform").empty();
            $("#numero").css("border", "thin solid rgb(233,236,239)");
            $("#errorform1").empty();
        }

    };
    $(document).ready(function() {
        $('#cancelbtn').on('click', function() {
            $("#nombre").css("border", "thin solid rgb(233,236,239)");
            $("#errorform").empty();
            $("#numero").css("border", "thin solid rgb(233,236,239)");
            $("#errorform1").empty();
        });

    })

    function savedata() {
        $.ajax({
            type: 'POST',
            url: '/cw3/conlabweb3.0/apps/condiciones_pagos/crud.php',
            data: $('#formcontrol').serialize(),
            success: function(respuesta) {
                if (respuesta == 'ok') {
                    //                     alert('Termiando');
                }
                $("#codigo").load('/cw3/conlabweb3.0/apps/condiciones_pagos/codigo.php');
                $("#thetable").load('/cw3/conlabweb3.0/apps/condiciones_pagos/thedatatable.php',{});
            }
        });


        inhabilitacmpos();
    } //de alvar datos
</script>