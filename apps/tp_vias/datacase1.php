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
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv . bbserver1);
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
    $id_categoria_producto = "1"; //esa ctivo fijo
    $nombre = "";
    $simbolo = "";
    $factor = "";
    $redondeo = "";
    $conversion = "";
    $cantidad_decimal = "";
    $id_user_mod = 0;
    $fecha_mod = "";
    $motivo_mod = "";
    $estado = "";


    if ($id != "") {
        $cadena = "select id_unidad_medida,nombre	,simbolo,factor	,
                    redondeo,conversion, cantidad_decimal, estado,id_user_mod,fecha_mod,motivo_mod
                    from cw3completa.unidad_medida 
                    where id_unidad_medida='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_unidad_medida']);
            $nombre = trim($filaP2['nombre']);
            $estado = trim($filaP2['estado']);
            $simbolo = trim($filaP2['simbolo']);
            $factor = trim($filaP2['factor']);
            $redondeo = trim($filaP2['redondeo']);
            $conversion = trim($filaP2['conversion']);
            $cantidad_decimal = trim($filaP2['cantidad_decimal']);
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

            <div class="col-md-9 col-lg-9 ">
                <div class="row mb-2">
                    <div class="col-md-6 col-lg-6 ">
                        <label style="font-size: 12px;">Codigo:</label>
                        <input type="input" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>
                        <?php if ($estado == '0') {
                            echo "<span style='color:red;'> Inhabilitado</span>";
                        } ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Nombre:</label>
                <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
                <div id="nombrex"></div>
            </div>
            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Simbolo:</label>
                <input type="input" class="form-control" name="simbolo" id="simbolo" value="<?php echo $simbolo; ?>"></input>
                <div id="simbolox"></div>
            </div>
            <div class="col-md-3 col-lg-3 ">
                <label style="font-size: 12px;">Cantidad Decimal:</label>
                <input type="input" class="form-control" name="cantidad_decimal" id="cantidad_decimal" value="<?php echo $cantidad_decimal; ?>"></input>
                <div id="cantidad_decimalx"></div>
            </div>

        </div>

        <!--   <div class="row mb-2">
                                        <div class="col-md-4 col-lg-4 ">
                                                <label style="font-size: 12px;">Conversison:</label>
                                                <input type="input" class="form-control"  name="conversion" id="conversion" value="<?php echo $conversion; ?>"></input>
                                        </div> 
                                                <div class="col-md-4 col-lg-4 ">
                                                <label style="font-size: 12px;">Factor:</label>
                                                <input type="input" class="form-control"  name="factor" id="factor" value="<?php echo $factor; ?>"></input>
                                        </div>   
                                        <div class="col-md-4 col-lg-4 ">
                                                <label style="font-size: 12px;">Redondeo:</label>
                                                <input type="input" class="form-control"  name="redondeo" id="redondeo" value="<?php echo $redondeo; ?>"></input>
                                        </div>     
                            </div> -->
        <div>
            <input type="text" class="form-control" name="iduserx" id="iduserx" style="display:none;" value="<?php echo $iduser ?>"></input>
        </div>
        <div id="tablemod" style="display:none;margin-top:11%;">
            <div class="row mb-2 mt-5 p-1" style="border:thin dotted gray;">
                <div class="container" style="text-align: center;">
                    <label style="font-size: 14px;">Ultima Modificacion:</label>
                </div>
                <?php
                $cadena48 = "select username from cw3completa.persona_users where id_persona=" . $id_user_mod;
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
    $(document).ready(function() {
        $('#successbtn').click(function() {
            var nombre = $("#nombre").val();
            var simbolo = $("#simbolo").val();
            var cantidad_decimal = $("#cantidad_decimal").val();
            var motmod = $("#motmod").val();
            var iduserx = $("#iduserx").val();
            if (nombre.trim() === '') {
                $("#nombre").css("border", "thin solid red");
                $("#nombrex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#nombre").css("border", "thin solid rgb(233,236,239)");
                $("#nombrex").empty();
            }
            if (simbolo.trim() === '') {
                $("#simbolo").css("border", "thin solid red");
                $("#simbolox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#simbolo").css("border", "thin solid rgb(233,236,239)");
                $("#simbolox").empty();
            }
            if (cantidad_decimal.trim() === '') {
                $("#cantidad_decimal").css("border", "thin solid red");
                $("#cantidad_decimalx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#cantidad_decimal").css("border", "thin solid rgb(233,236,239)");
                $("#cantidad_decimalx").empty();
            }
            if (iduserx.trim() === '') {
                collapseanshow('A');


            } else {
                if (motmod.trim() === '') {
                    $("#motmod").css("border", "thin solid red");
                    $("#motmodx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>El campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#motmod").css("border", "thin solid rgb(233,236,239)");
                    $("#motmodx").empty();
                }
                collapseanshow('A');

            }

        });

    });

    $(document).ready(function() {
        $('#cancelbtn').click(function() {
            $("#nombre").css("border", "thin solid rgb(233,236,239)");
            $("#nombrex").empty();
            $("#simbolo").css("border", "thin solid rgb(233,236,239)");
            $("#simbolox").empty();
            $("#cantidad_decimal").css("border", "thin solid rgb(233,236,239)");
            $("#cantidad_decimalx").empty();
        });
    });
</script>