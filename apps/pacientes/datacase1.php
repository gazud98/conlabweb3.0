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
    $id_categoria_producto = "1"; //esa ctivo fijo
    $nombre = "";
    $id_user_mod = 0;
    $fecha_mod = "";
    $motivo_mod = "";
    $estado = "1";


    if ($id != "") {
        $cadena = "select id_sedes ,P.nombre,P.estado,P.id_user_mod,P.fecha_mod,P.motivo_mod
                    from u116753122_cw3completa.sedes P
                    where P.id_sedes='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_sedes']);
            $nombre = trim($filaP2['nombre']);
            $id_user_mod = trim($filaP2['id_user_mod']);
            $fecha_mod = trim($filaP2['fecha_mod']);
            $motivo_mod = trim($filaP2['motivo_mod']);
            $estado = trim($filaP2['estado']);
        }
    }

?>

    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%;padding: 0px;">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">


        <div class="row">
            <!--<div class="col-md-3 col-lg-3 ">
                                    <?php
                                    //                                       if($id != ""){
                                    //                                            $parametroacodificar="Codigo: ".$id."\nReferencia: ".$referencia."\nNombre: ".$nombre;
                                    //                                             include('../../apps/genqr.php');
                                    //                                        }else {
                                    //                                       echo "<img src='assets/image/qr.png'>";
                                    //                                        }
                                    ?>
                                </div>-->
            <div class="col-md-9 col-lg-9">
                <div class="row">
                    <div class="col-md-6 col-lg-6" id="codigo" style="margin-left: 6px;">
                        <label style="font-size: 12px;">Codigo:</label>
                        <input type="input" class="form-control" style="border:1px solid #CDCDCD; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12">
                    <label style="font-size: 12px;">Nombre:</label>
                    <input type="input" class="form-control required" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required></input>
                </div>
                <div class="col-md-12 col-lg-12" id="errorform">

                </div>
            </div>
        </div>
        <div>
            <input type="text" class="form-control" name="iduserx" id="iduserx" style="display:none;" value="<?php echo $iduser ?>"></input>
        </div>
        <div id="tablemod" style="
        display:none;
        margin-top:7%;">
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