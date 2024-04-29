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
        $id = 0;
    }

    //$id=1;
    //    echo $caso.'----'.$id;
    /* */
    $id_categoria_producto = "1"; //esa ctivo fijo
    $equipo = "";
    $localizacion = "";
    $fecha_comienzo = "";
    $id_proveedor = "";
    $meses_garantia = "";
    $meses_garantia_ext = "";
    $valor_anual_garantia = "";
    $tipo_mantenimiento = "";
    $desc_mantenimiento = "";
    $period_semanal = "";
    $resp_mantenimiento = "";
    $direccion_resp = "";
    $tef_resp = "";
    $periodicidad = "";
    $mesoption = "";
    $comienzo = "";
    $comienzo = "";
    $responsable = "";
    if ($id != "") {
        $cadena = "select P.id,P.equipo,P.localizacion,P.fecha_comienzo,P.id_proveedor,P.meses_garantia,P.meses_garantia_ext,periodicidad,
        P.valor_anual_garantia,P.tipo_mantenimiento,P.desc_mantenimiento,P.period_semanal,P.mesoption,P.comienzo,P.resp_mantenimiento,P.responsable,P.tef_resp,P.direccion_resp,P.estado
                from u116753122_cw3completa.preventiva P
                where 1=1
                    and P.id='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id']);
            $equipo = trim($filaP2['equipo']);
            $localizacion = trim($filaP2['localizacion']);
            $fecha_comienzo = trim($filaP2['fecha_comienzo']);
            $id_proveedor = trim($filaP2['id_proveedor']);
            $meses_garantia = trim($filaP2['meses_garantia']);
            $meses_garantia_ext = trim($filaP2['meses_garantia_ext']);
            $valor_anual_garantia = trim($filaP2['valor_anual_garantia']);
            $tipo_mantenimiento = trim($filaP2['tipo_mantenimiento']);
            $desc_mantenimiento = trim($filaP2['desc_mantenimiento']);
            $period_semanal = trim($filaP2['period_semanal']);
            $resp_mantenimiento = trim($filaP2['resp_mantenimiento']);
            $direccion_resp = trim($filaP2['direccion_resp']);
            $tef_resp = trim($filaP2['tef_resp']);
            $periodicidad = trim($filaP2['periodicidad']);
            $mesoption = trim($filaP2['mesoption']);
            $comienzo = trim($filaP2['comienzo']);
            $responsable = trim($filaP2['responsable']);
            $estado = trim($filaP2['estado']);
        }
    }

?>

    <style>
        .form-control {
            display: block;
            height: 2%;
            width: 100%;
            padding: 2px;
            font-size: 13px;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;

            border-radius: 0.25rem;
            box-shadow: inset 0 0 0 rgba(0, 0, 0, 0);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .table-txt-order {
            width: 100%;
        }

        .table-txt-order tr,
        tr td {
            width: 100px;
            padding-left: 10px;
        }
    </style>

    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data" style="width:100%">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
        <input type="hidden" name="period_semanal" id="period_semanal" value="<?php echo $period_semanal; ?>">
        <input type="hidden" name="mesoption" id="mesoption" value="<?php echo $mesoption; ?>">

        <div class="row">

            <table class="table-txt-order">
                <tr>
                    <td>
                        <label style="font-size: 12px;">Codigo:</label>
                        <input type="input" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Equipo:</label>
                        <select class="form-control" name="equipo" id="equipo">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena33 = "SELECT id_producto, nombre
                                                    FROM u116753122_cw3completa.producto
                                                    where estado='1'
                                                    and id_categoria_producto ='3'";
                            $resultadP2a33 = $conetar->query($cadena33);
                            $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                            if ($numerfiles2a33 >= 1) {
                                while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                                    echo "<option value='" . trim($filaP2a33['id_producto']) . "'";
                                    if (trim($filaP2a33['id_producto']) == $equipo) {
                                        echo ' selected';
                                    }
                                    echo '>' . $filaP2a33['nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div id="equipox"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Localizacion:</label>
                        <input type="input" class="form-control" name="localizacion" id="localizacion" value="<?php echo $localizacion; ?>"></input>
                        <div id="localizacionx"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Fecha de Inicio</label>
                        <input type="date" class="form-control" name="fecha_comienzo" id="fecha_comienzo" value="<?php echo $fecha_comienzo; ?>">
                        <div id="fecha_comienzox"></div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="row">

            <table class="table-txt-order">

                <tr>
                    <td>
                        <label style="font-size: 12px;">Proveedor:</label>
                        <select class="form-control" name="id_proveedor" id="id_proveedor">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena33 = "SELECT id_proveedores, nombre_comercial
                                                    FROM u116753122_cw3completa.proveedores
                                                    where estado='1'";
                            $resultadP2a33 = $conetar->query($cadena33);
                            $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                            if ($numerfiles2a33 >= 1) {
                                while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                                    echo "<option value='" . trim($filaP2a33['id_proveedores']) . "'";
                                    if (trim($filaP2a33['id_proveedores']) == $id_proveedor) {
                                        echo ' selected';
                                    }
                                    echo '>' . $filaP2a33['nombre_comercial'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div id="id_proveedorx"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Garantia en Meses</label>
                        <input type="input" class="form-control" name="meses_garantia" id="meses_garantia" value="<?php echo $meses_garantia; ?>"></input>
                        <div id="meses_garantiax"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Garantia en Meses Extendida</label>
                        <input type="input" class="form-control" name="meses_garantia_ext" id="meses_garantia_ext" value="<?php echo $meses_garantia_ext; ?>"></input>
                        <div id="meses_garantia_extx"></div>
                    </td>

                </tr>

            </table>
        </div>

        <hr>

        <div class="row">


            <div class="container" style="text-align:center"> <label style="font-size: 12px;">Mantenimiento:</label></div>
            <table class="table-txt-order">

                <tr>

                    <td>
                        <label style="font-size: 12px;">Responsable Mantenimiento:</label>
                        <select class="form-control" name="responsable" id="responsable">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena = "SELECT id_persona,nombre_1, nombre_2,apellido_1,apellido_2
                                                    FROM u116753122_cw3completa.persona
                                                    where estado='1'";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id_persona']) . "'";
                                    if (trim($filaP2a['id_persona']) == $responsable) {
                                        echo ' selected';
                                    }
                                    echo '>' . $filaP2a['nombre_1'] . " " . $filaP2a['nombre_2'] . " " . $filaP2a['apellido_1'] . " " . $filaP2a['apellido_2'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div id="responsablex"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Tipo:</label>
                        <select class="form-control" name="id_tipo_mantenimiento" id="id_tipo_mantenimiento">
                            <option selected="true" disabled="disabled"></option>
                            <option value="MP" <?php if ($tipo_mantenimiento == "MP") {
                                                    echo " selected";
                                                } ?>>Productivo</option>
                            <option value="MPV" <?php if ($tipo_mantenimiento == "MPV") {
                                                    echo " selected";
                                                } ?>>Preventivo</option>
                            <option value="MPD" <?php if ($tipo_mantenimiento == "MPD") {
                                                    echo " selected";
                                                } ?>>Predictivo</option>
                            <option value="MC" <?php if ($tipo_mantenimiento == "MC") {
                                                    echo " selected";
                                                } ?>>Correctivo</option>
                        </select>
                        <div id="id_tipo_mantenimientox"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Descripcion:</label>
                        <textarea class="form-control" name="desc_mantenimiento" id="desc_mantenimiento"><?php echo $desc_mantenimiento; ?></textarea>
                        <div id="desc_mantenimientox"></div>
                    </td>
                </tr>

            </table>

        </div>

        <div class="row">
            <table class="table-txt-order">
                <tr>
                    <td>
                        <label style="font-size: 12px;">Repetir Cada:</label>

                        <select class="form-control" name="periodicidad" id="periodicidad" onchange="seleccionar1(this)">
                            <option selected="true" disabled="disabled"></option>
                            <option value="D" <?php if ($periodicidad == "D") {
                                                    echo " selected";
                                                } ?>>Dia</option>
                            <option value="S" <?php if ($periodicidad == "S") {
                                                    echo " selected";
                                                } ?>>Semana</option>
                            <option value="M" <?php if ($periodicidad == "M") {
                                                    echo " selected";
                                                } ?>>Mes</option>
                            <option value="A" <?php if ($periodicidad == "A") {
                                                    echo " selected";
                                                } ?>>Año</option>
                        </select>
                        <div id="periodicidad1x"></div>

                    </td>

                    <td>
                        <div id="period1" style="padding:6%;font-size:14px">

                        </div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Comenzando:</label>
                        <input type="date" class="form-control" name="comenzar" id="comenzar" value="<?php echo $comienzo; ?>"></input>
                        <div id="comenzarx"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Rve.</label>
                        <input type="email" class="form-control" name="rve" id="rve" value="<?php echo $tef_resp; ?>"></input>
                        <div id="rvex"></div>
                    </td>

                </tr>
            </table>
        </div>

        <hr>
        <div class="row">
            <table class="table-txt-order">
                <tr>


                    <td>
                        <label style="font-size: 12px;">Persona que hace el Mantenimiento:</label>
                        <select class="form-control" name="resp_mantenimiento" id="resp_mantenimiento">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena = "SELECT id_persona,nombre_1, nombre_2,apellido_1,apellido_2
                                                    FROM u116753122_cw3completa.persona
                                                    where estado='1'";
                            $resultadP2a = $conetar->query($cadena);
                            $numerfiles2a = mysqli_num_rows($resultadP2a);
                            if ($numerfiles2a >= 1) {
                                while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                    echo "<option value='" . trim($filaP2a['id_persona']) . "'";
                                    if (trim($filaP2a['id_persona']) == $resp_mantenimiento) {
                                        echo ' selected';
                                    }
                                    echo '>' . $filaP2a['nombre_1'] . " " . $filaP2a['nombre_2'] . " " . $filaP2a['apellido_1'] . " " . $filaP2a['apellido_2'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <div id="resp_mantenimientox"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Direccion.</label>
                        <input type="email" class="form-control" name="dir_resp" id="dir_resp" value="<?php echo $tef_resp; ?>"></input>
                        <div id="dir_respx"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Tel.</label>
                        <input type="email" class="form-control" name="tef_resp" id="tef_resp" value="<?php echo $tef_resp; ?>"></input>
                        <div id="tef_respx"></div>
                    </td>
                </tr>
            </table>
        </div>

        <hr>


    </form>



    <script>
        function seleccionar1(sel) {
            var caso = $('option:selected', sel).attr('value');


            $("#period1").load('https://cw3.tierramontemariana.org/apps/preventivo/periodicidad.php', {
                caso: caso
            })


        }
        $(document).ready(function() {
            var periodicidad = $("#periodicidad").val();
            var period_semanal = $("#period_semanal").val();
            var mesoption = $("#mesoption").val();
            if (periodicidad === "S") {
                $("#period1").load('https://cw3.tierramontemariana.org/apps/preventivo/periodicidad.php', {
                    caso: 'S',
                    period_semanal: period_semanal,
                    mesoption: mesoption
                });
            } else if (periodicidad === "M") {
                $("#period1").load('https://cw3.tierramontemariana.org/apps/preventivo/periodicidad.php', {
                    caso: 'M'
                });
            }


        });
        $(document).ready(function() {


            $('#successbtn').click(function() {
                var equipo = $("#equipo").val();
                var localizacion = $("#localizacion").val();
                var fecha_comienzo = $("#fecha_comienzo").val();
                var id_proveedor = $("#id_proveedor").val();
                var meses_garantia = $("#meses_garantia").val();
                var meses_garantia_ext = $("#meses_garantia_ext").val();
                var id_tipo_mantenimiento = $("#id_tipo_mantenimiento").val();
                var desc_mantenimiento = $("#desc_mantenimiento").val();
                var responsable = $("#responsable").val()
                var periodicidad = $("#periodicidad").val();
                var comenzar = $("#comenzar").val();
                var rve = $("#rve").val();
                var resp_mantenimiento = $("#resp_mantenimiento").val();
                var dir_resp = $("#dir_resp").val();
                var tef_resp = $("#tef_resp").val();


                /* var codigo_act_eco_1 = $("#codigo_act_eco_1").val();
                 var codigo_act_ind_comer = $("#codigo_act_ind_comer").val();*/
                //   var observaciones = $("#observaciones").val();
                if (equipo == null) {
                    equipo = '';
                }
                if (id_proveedor == null) {
                    id_proveedor = '';
                }
                if (id_tipo_mantenimiento == null) {
                    id_tipo_mantenimiento = '';
                }
                if (periodicidad == null) {
                    periodicidad = '';
                }
                if (responsable == null) {
                    responsable = '';
                }
                if (resp_mantenimiento == null) {
                    resp_mantenimiento = '';
                }
                if (equipo.trim() === '') {
                    $("#equipo").css("border", "thin solid red");
                    $("#equipox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#equipo").css("border", "thin solid rgb(233,236,239)");
                    $("#equipox").empty();
                }

                if (localizacion.trim() === '') {
                    $("#localizacion").css("border", "thin solid red");
                    $("#localizacionx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#localizacion").css("border", "thin solid rgb(233,236,239)");
                    $("#localizacionx").empty();
                }

                if (fecha_comienzo.trim() === '') {
                    $("#fecha_comienzo").css("border", "thin solid red");
                    $("#fecha_comienzox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#fecha_comienzo").css("border", "thin solid rgb(233,236,239)");
                    $("#fecha_comienzox").empty();
                }
                if (id_proveedor.trim() === '') {
                    $("#id_proveedor").css("border", "thin solid red");
                    $("#id_proveedorx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#id_proveedor").css("border", "thin solid rgb(233,236,239)");
                    $("#id_proveedorx").empty();
                }
                if (meses_garantia.trim() === '') {
                    $("#meses_garantia").css("border", "thin solid red");
                    $("#meses_garantiax").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#meses_garantia").css("border", "thin solid rgb(233,236,239)");
                    $("#meses_garantiax").empty();
                }
                if (meses_garantia_ext.trim() === '') {
                    $("#meses_garantia_ext").css("border", "thin solid red");
                    $("#meses_garantia_extx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#meses_garantia_ext").css("border", "thin solid rgb(233,236,239)");
                    $("#meses_garantia_extx").empty();
                }
                if (responsable.trim() === '') {
                    $("#responsable").css("border", "thin solid red");
                    $("#responsablex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#responsable").css("border", "thin solid rgb(233,236,239)");
                    $("#responsablex").empty();
                }
                if (id_tipo_mantenimiento.trim() === '') {
                    $("#id_tipo_mantenimiento").css("border", "thin solid red");
                    $("#id_tipo_mantenimientox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#id_tipo_mantenimiento").css("border", "thin solid rgb(233,236,239)");
                    $("#id_tipo_mantenimientox").empty();
                }
                if (desc_mantenimiento.trim() === '') {
                    $("#desc_mantenimiento").css("border", "thin solid red");
                    $("#desc_mantenimientox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#desc_mantenimiento").css("border", "thin solid rgb(233,236,239)");
                    $("#desc_mantenimientox").empty();
                }
                if (periodicidad.trim() === '') {
                    $("#periodicidad").css("border", "thin solid red");
                    $("#periodicidadx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#periodicidad").css("border", "thin solid rgb(233,236,239)");
                    $("#periodicidadx").empty();
                }
                if (comenzar.trim() === '') {
                    $("#comenzar").css("border", "thin solid red");
                    $("#comenzarx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#comenzar").css("border", "thin solid rgb(233,236,239)");
                    $("#comenzarx").empty();
                }
                if (rve.trim() === '') {
                    $("#rve").css("border", "thin solid red");
                    $("#rvex").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#rve").css("border", "thin solid rgb(233,236,239)");
                    $("#rvex").empty();
                }
                if (resp_mantenimiento.trim() === '') {
                    $("#resp_mantenimiento").css("border", "thin solid red");
                    $("#resp_mantenimientox").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#resp_mantenimiento").css("border", "thin solid rgb(233,236,239)");
                    $("#resp_mantenimientox").empty();
                }
                if (dir_resp.trim() === '') {
                    $("#dir_resp").css("border", "thin solid red");
                    $("#dir_respx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#dir_resp").css("border", "thin solid rgb(233,236,239)");
                    $("#dir_respx").empty();
                }
                if (tef_resp.trim() === '') {
                    $("#tef_resp").css("border", "thin solid red");
                    $("#tef_respx").html("<span style='color:red; font-size: 14px;font-family: 'Open Sans';'>Este campo no puede estar vacío.</span>");
                    return;
                } else {
                    $("#tef_resp").css("border", "thin solid rgb(233,236,239)");
                    $("#tef_respx").empty();
                }



                collapseanshow('A');

            });

        });

        $(document).ready(function() {
            $('#cancelbtn').click(function() {
                $("#equipo").css("border", "thin solid rgb(233,236,239)");
                $("#equipox").empty();
                $("#localizacion").css("border", "thin solid rgb(233,236,239)");
                $("#localizacionx").empty();
                $("#fecha_comienzo").css("border", "thin solid rgb(233,236,239)");
                $("#fecha_comienzox").empty();
                $("#id_proveedor").css("border", "thin solid rgb(233,236,239)");
                $("#id_proveedorx").empty();
                $("#meses_garantia").css("border", "thin solid rgb(233,236,239)");
                $("#meses_garantiax").empty();
                $("#meses_garantia_ext").css("border", "thin solid rgb(233,236,239)");
                $("#meses_garantia_extx").empty();
                $("#id_tipo_mantenimiento").css("border", "thin solid rgb(233,236,239)");
                $("#id_tipo_mantenimientox").empty();
                $("#desc_mantenimiento").css("border", "thin solid rgb(233,236,239)");
                $("#desc_mantenimientox").empty();
                $("#periodicidad").css("border", "thin solid rgb(233,236,239)");
                $("#periodicidadx").empty();
                $("#comenzar").css("border", "thin solid rgb(233,236,239)");
                $("#comenzarx").empty();
                $("#rve").css("border", "thin solid rgb(233,236,239)");
                $("#rvex").empty();
                $("#resp_mantenimiento").css("border", "thin solid rgb(233,236,239)");
                $("#resp_mantenimientox").empty();
                $("#dir_resp").css("border", "thin solid rgb(233,236,239)");
                $("#dir_respx").empty();
                $("#tef_resp").css("border", "thin solid rgb(233,236,239)");
                $("#tef_respx").empty();
                $("#responsable").css("border", "thin solid rgb(233,236,239)");
                $("#responsablex").empty();

            });
        });


        function savedata() {
            var id = $("#id").val();
            var equipo = $("#equipo").val();
            var localizacion = $("#localizacion").val();
            var fecha_comienzo = $("#fecha_comienzo").val();
            var id_proveedor = $("#id_proveedor").val();
            var modeeditstatus = $("#modeeditstatus").val();
            var meses_garantia = $("#meses_garantia").val();
            var meses_garantia_ext = $("#meses_garantia_ext").val();
            var id_tipo_mantenimiento = $("#id_tipo_mantenimiento").val();
            var desc_mantenimiento = $("#desc_mantenimiento").val();
            var comenzar = $("#comenzar").val();
            var rve = $("#rve").val();
            var resp_mantenimiento = $("#resp_mantenimiento").val();
            var dir_resp = $("#dir_resp").val();
            var tef_resp = $("#tef_resp").val();
            var periodicidad = $("#periodicidad").val();
            var responsable = $("#responsable").val();
            mesoption1 = $("#mesoption1").val();
            sunday = $('input:checkbox[name=sunday1]:checked').val();
            monday = $('input:checkbox[name=monday1]:checked').val();
            tuesday = $('input:checkbox[name=tuesday1]:checked').val();
            wednesday = $('input:checkbox[name=wednesday1]:checked').val();
            thursday = $('input:checkbox[name=thursday1]:checked').val();
            friday = $('input:checkbox[name=friday1]:checked').val();
            saturday = $('input:checkbox[name=saturday1]:checked').val();
            if (sunday == null) {
                sunday = "N";
            } else {
                sunday + ",";
            }
            if (monday == null) {
                monday = "N";
            }
            if (tuesday == null) {
                tuesday = "N";
            }
            if (wednesday == null) {
                wednesday = "N";
            }
            if (thursday == null) {
                thursday = "N";
            }
            if (friday == null) {
                friday = "N";
            }
            if (saturday == null) {
                saturday = "N";
            }
            diassemana = sunday + "," + monday + "," + tuesday + "," + wednesday + "," + thursday + "," + friday + "," + saturday;
            $.ajax({
                type: 'POST',
                url: 'https://cw3.tierramontemariana.org/apps/preventivo/crud.php',
                data: {
                    id: id,
                    diassemana: diassemana,
                    equipo: equipo,
                    fecha_comienzo: fecha_comienzo,
                    localizacion: localizacion,
                    id_proveedor: id_proveedor,
                    meses_garantia: meses_garantia,
                    meses_garantia_ext: meses_garantia_ext,
                    id_tipo_mantenimiento: id_tipo_mantenimiento,
                    desc_mantenimiento: desc_mantenimiento,
                    comenzar: comenzar,
                    rve: rve,
                    resp_mantenimiento: resp_mantenimiento,
                    dir_resp: dir_resp,
                    tef_resp: tef_resp,
                    mesoption1: mesoption1,
                    modeeditstatus: modeeditstatus,
                    periodicidad: periodicidad,
                    responsable: responsable
                },
                success: function() {

                    $("#thetable").load("https://cw3.tierramontemariana.org/apps/preventivo/thedatatable.php");

                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Registro Exitoso!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });



            inhabilitacmpos();
        } //de alvar datos
    </script>
<?php
}
?>