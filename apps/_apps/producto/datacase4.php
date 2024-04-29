<?php
//     presntadio n par todos lod produtos tipo SERVICIOS
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
    // echo $caso.'----'.$id;
    /* */

    $id_categoria_producto = "4";
    $referencia = "";
    $nombre = "";
    $id_departamento = "";
    $id_sede = "";
    $estado = "";
    $id_user_mod = 0;
    $fecha_mod = "";
    $motivo_mod = "";
    if ($id != "") {
        $cadena = "select id_producto,referencia,id_categoria_producto,nombre,estado, id_departamento, id_sede,id_user_mod,fecha_mod,motivo_mod
                    from u116753122_cw3completa.producto
                    where id_producto='" . $id . "'";
        //                 echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_producto']);
            $id_categoria_producto = "4";
            $referencia = trim($filaP2['referencia']);
            $id_departamento = trim($filaP2['id_departamento']);
            $id_sede = trim($filaP2['id_sede']);
            $nombre = trim($filaP2['nombre']);
            $estado = trim($filaP2['estado']);
            $id_user_mod = trim($filaP2['id_user_mod']);
            $fecha_mod = trim($filaP2['fecha_mod']);
            $motivo_mod = trim($filaP2['motivo_mod']);
        }
    }


?>

    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
        <input type="hidden" name="id_categoria_producto" id="id_categoria_producto" value="4">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">


        <div class="row mb-2">
            <div class="col-md-3 col-lg-3 ">
                <?php
                if ($id != "") {
                    $parametroacodificar = "Codigo: " . $id . "\nReferencia: " . $referencia . "\nNombre: " . $nombre;
                    include('../../apps/genqr.php');
                } else {
                    echo "<img src='assets/image/qr.png'>";
                }
                ?>
            </div>
            <div class="col-md-9 col-lg-9 ">
                <div class="row mb-2">
                    <div class="col-md-6 col-lg-6 ">
                        <label style="font-size: 12px;">Codigo:</label>
                        <input type="input" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>
                        <?php if ($estado == '0') {
                            echo "<span style='color:red;'> Inhabilitado</span>";
                        } ?>
                    </div>
                    <div class="col-md-6 col-lg-6 ">
                        <label style="font-size: 12px;">Referencia:</label>
                        <input type="input" class="form-control" name="referencia" name="referencia" id="referencia" value="<?php echo $referencia; ?>"></input>
                        <div id="referenciax"></div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12">
                    <label style="font-size: 12px;">Nombre:</label>
                    <input type="input" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>"></input>
                    <div id="nombrex"></div>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Departamento</label>
                <select class="form-control" name="id_departamento" id="id_departamento">
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id, nombre
                                                    FROM u116753122_cw3completa.departamentos
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id']) . "'";
                            if (trim($filaP2a['id']) == $id_departamento) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <div id="id_departamentox"></div>
            </div>
            <div class="col-md-6 col-lg-6">
                <label style="font-size: 12px;">Sede</label>
                <select class="form-control" name="id_sede" id="id_sede">
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id_sedes, nombre
                                                    FROM u116753122_cw3completa.sedes
                                                    where estado='1'";
                    $resultadP2a = $conetar->query($cadena);
                    $numerfiles2a = mysqli_num_rows($resultadP2a);
                    if ($numerfiles2a >= 1) {
                        while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                            echo "<option value='" . trim($filaP2a['id_sedes']) . "'";
                            if (trim($filaP2a['id_sedes']) == $id_sede) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <div id="id_sedex"></div>
            </div>

        </div>
        <div>
            <input type="text" class="form-control" name="iduserx" id="iduserx" style="display:none"  value="<?php echo $iduser ?>"></input>
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
    $(document).ready(function() {
        $("#successbtn").click(function() {
            var referencia = $('#referencia').val();
            var nombre = $('#nombre').val();
            var motmod = $("#motmod").val();
        var iduserx = $("#iduserx").val();
            var id_departamento = $('#id_departamento').val();
            var id_sede = $('#id_sede').val();
            if (id_departamento == null) {
                id_departamento = '';
            }
            if (id_sede == null) {
                id_sede = '';
            }
            if (referencia.trim() === '') {
                $("#referencia").css("border", "thin solid red");
                $("#referenciax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#referencia").css("border", "thin solid rgb(233,236,239)");
                $("#referenciax").empty();
            }
            if (nombre.trim() === '') {
                $("#nombre").css("border", "thin solid red");
                $("#nombrex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#nombre").css("border", "thin solid rgb(233,236,239)");
                $("#nombrex").empty();
            }
            if (id_departamento.trim() === '') {
                $("#id_departamento").css("border", "thin solid red");
                $("#id_departamentox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#id_departamento").css("border", "thin solid rgb(233,236,239)");
                $("#id_departamentox").empty();
            }
            if (id_sede.trim() === '') {
                $("#id_sede").css("border", "thin solid red");
                $("#id_sedex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                return;
            } else {
                $("#id_sede").css("border", "thin solid rgb(233,236,239)");
                $("#id_sedex").empty();
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
            $("#id_sede").css("border", "thin solid rgb(233,236,239)");
            $("#id_sedex").empty();
            $("#id_departamento").css("border", "thin solid rgb(233,236,239)");
            $("#id_departamentox").empty();
            $("#nombre").css("border", "thin solid rgb(233,236,239)");
            $("#nombrex").empty();
            $("#referencia").css("border", "thin solid rgb(233,236,239)");
            $("#referenciax").empty();
            $("#motmod").css("border", "thin solid rgb(233,236,239)");
            $("#motmodx").empty();
        });
    });
</script>