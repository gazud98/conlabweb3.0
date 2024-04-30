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
    if (isset($_REQUEST['status'])) {
        $status = $_REQUEST['status'];
        if ($status == "-1") {
            $status = "";
        }
    } else {
        $status = 0;
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
    $estado = "";
    if ($id != "") {
        $cadena = "select P.id,P.equipo,P.id_sede,P.id_proveedor,P.meses_garantia,P.meses_garantia_ext,periodicidad,
        P.valor_anual_garantia,P.tipo_mantenimiento,P.desc_mantenimiento,P.period_semanal,P.mesoption,P.comienzo,P.fecha_final,
        P.resp_mantenimiento,P.responsable,P.tef_resp,P.direccion_resp,P.estado
                from preventiva P
                where 1=1
                    and P.id='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id']);
            $equipo = trim($filaP2['equipo']);
            $localizacion = trim($filaP2['id_sede']);
            //$fecha_comienzo = trim($filaP2['fecha_comienzo']);
            $id_proveedor = trim($filaP2['id_proveedor']);
            $meses_garantia = trim($filaP2['meses_garantia']);
            //$meses_garantia_ext = trim($filaP2['meses_garantia_ext']);
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
            $fecha_final = trim($filaP2['fecha_final']);
        }
    }

?>

    <style>
        .form-control {
            display: block;
            height: 45%;
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

    <form name="formEditPrev" id="formEditPrev" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="<?php echo $status ?>">
        <input type="hidden" name="tipmant" id="tipmant" value="P">
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
        <input type="hidden" name="period_semanal" id="period_semanal" value="<?php echo $period_semanal; ?>">
        <input type="hidden" name="mesoption" id="mesoption" value="<?php echo $mesoption; ?>">
        <input type="hidden" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>

        <div class="row">

            <div class="col-md-2">
                <label style="font-size: 12px;">Sede:</label>
                <select class="form-control" name="localizacion" id="localizacion" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena33 = "SELECT id_sedes, nombre
                                                    FROM sedes
                                                    where estado='1'";
                    $resultadP2a33 = $conetar->query($cadena33);
                    $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                    if ($numerfiles2a33 >= 1) {
                        while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                            echo "<option value='" . trim($filaP2a33['id_sedes']) . "'";
                            if (trim($filaP2a33['id_sedes']) == $localizacion) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a33['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <!--<input type="input" class="form-control" name="localizacion" id="localizacion" value="<?php echo $localizacion; ?>"></input>
                        <div id="localizacionx"></div>-->
            </div>

            <div class="col-md-4">
                <label style="font-size: 12px;">Equipo:</label>
                <select class="form-control" name="equipo" id="equipo" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena33 = "SELECT id_producto, nombre, referencia
                                                    FROM producto
                                                    where estado='1'
                                                    and id_categoria_producto ='1' and op_mantenimiento = '1'";
                    $resultadP2a33 = $conetar->query($cadena33);
                    $numerfiles2a33 = mysqli_num_rows($resultadP2a33);
                    if ($numerfiles2a33 >= 1) {
                        while ($filaP2a33 = mysqli_fetch_array($resultadP2a33)) {
                            echo "<option value='" . trim($filaP2a33['id_producto']) . "'";
                            if (trim($filaP2a33['id_producto']) == $equipo) {
                                echo ' selected';
                            }
                            echo '>' . $filaP2a33['nombre'] . ' - ' . $filaP2a33['referencia'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <!--<select class="form-control" name="equipo" id="equipo">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena33 = "SELECT id_producto, nombre
                                                    FROM producto
                                                    where estado='1'
                                                    and id_categoria_producto ='1' and op_mantenimiento = '1'";
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
                        </select>-->
                <div id="equipox"></div>
            </div>

            <div class="col-md-2">
                <label style="font-size: 12px;">Proveedor:</label>
                <select class="form-control" name="id_proveedor" id="id_proveedor" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena33 = "SELECT id_proveedores, nombre_comercial
                                                    FROM proveedores
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
            </div>

            <div class="col-md-2">
                <label style="font-size: 12px;">Garantia en Meses</label>
                <input type="input" class="form-control" name="meses_garantia" id="meses_garantia" value="<?php echo $meses_garantia; ?>" required></input>
                <div id="meses_garantiax"></div>
            </div>

            <!--<div class="col-md-2">
                <label style="font-size: 12px;">Valor Factura</label>
                        <input type="input" class="form-control" name="valorfactura" id="valorfactura" value=""></input>
            </div>-->

        </div>

        <!--<div class="row mt-3">
            
            <div class="col-md-2">
                <label style="font-size: 12px;">Num. Factura</label>
                        <input type="input" class="form-control" name="numfactura" id="numfactura" value=""></input>
            </div>
            
            <div class="col-md-2">
                <label style="font-size: 12px;">Fecha Factura</label>
                        <input type="date" class="form-control" name="fechafactura" id="fechafactura" value=""></input>
            </div>

        </div>-->

        <hr>

        <div class="row">


            <div class="container" style="text-align:center"> <label style="font-size: 12px;">Mantenimiento:</label></div>

            <div class="col-md-2">
                <label style="font-size: 12px;">Responsable:</label>
                <select class="form-control" name="responsable" id="responsable" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena33 = "SELECT id_proveedores, nombre_comercial
                                                    FROM proveedores
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
                <div id="responsablex"></div>
            </div>

            <div class="col-md-2">
                <label style="font-size: 12px;">Tipo:</label>
                <select class="form-control" name="id_tipo_mantenimiento" id="id_tipo_mantenimiento" required>
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
            </div>

            <div class="col-md-5">
                <label style="font-size: 12px;">Descripcion:</label>
                <textarea class="form-control" name="desc_mantenimiento" id="desc_mantenimiento" rows="1" cols="30"><?php echo $desc_mantenimiento; ?></textarea>
                <div id="desc_mantenimientox"></div>
            </div>

        </div>

        <div class="row">
            <table class="table-txt-order">
                <tr>
                    <td>
                        <label style="font-size: 12px;">Repetir:</label>

                        <select class="form-control" name="periodicidad" id="periodicidad" onchange="seleccionar1(this)" required>
                            <option selected="true" disabled="disabled"></option>
                            <option value="D" <?php if ($periodicidad == "D") {
                                                    echo " selected";
                                                } ?>>Diario</option>
                            <option value="S" <?php if ($periodicidad == "S") {
                                                    echo " selected";
                                                } ?>>Semanal</option>
                            <option value="Q" <?php if ($periodicidad == "Q") {
                                                    echo " selected";
                                                } ?>>Quincenal</option>
                            <option value="M" <?php if ($periodicidad == "M") {
                                                    echo " selected";
                                                } ?>>Mensual</option>
                            <option value="A" <?php if ($periodicidad == "A") {
                                                    echo " selected";
                                                } ?>>Anual</option>
                        </select>
                        <div id="periodicidad1x"></div>

                    </td>

                    <td>
                        <div id="period1" style="padding:6%;font-size:14px">

                        </div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Fecha inicio:</label>
                        <input type="date" class="form-control" name="comenzar" id="comenzar" value="" required></input>
                        <div id="comenzarx"></div>
                    </td>
                    <td>
                        <label style="font-size: 12px;">Fecha de Final</label>
                        <input type="date" class="form-control" name="fecha_final" id="fecha_final" value="" required>
                        <div id="fecha_comienzox"></div>
                    </td>
                    <!--<td>
                        <label style="font-size: 12px;">Rve.</label>
                        <input type="email" class="form-control" name="rve" id="rve" value="<?php echo $tef_resp; ?>"></input>
                        <div id="rvex"></div>
                    </td>-->

                </tr>
            </table>
        </div>

        <hr>

        <div class="container" style="text-align:center"> <label style="font-size: 12px;">Datos de contacto:</label></div>

        <div class="row">

            <div class="col-md-4">
                <label style="font-size: 12px;">Nombre:</label>
                <input type="input" class="form-control" name="resp_mantenimiento" id="resp_mantenimiento" value="<?php ?>"></input>
                <!--<select class="form-control" name="resp_mantenimiento" id="resp_mantenimiento">
                            <option selected="true" disabled="disabled"></option>
                            <?php
                            $cadena = "SELECT id_persona,nombre_1, nombre_2,apellido_1,apellido_2
                                                    FROM persona
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
                        </select>-->
                <!--<div id="resp_mantenimientox"></div>-->
            </div>

            <div class="col-md-4">
                <label style="font-size: 12px;">Direccion.</label>
                <input type="text" class="form-control" name="dir_resp" id="dir_resp" value="<?php echo $tef_resp; ?>"></input>
                <div id="dir_respx"></div>
            </div>

            <div class="col-md-4">
                <label style="font-size: 12px;">Tel.</label>
                <input type="text" class="form-control" name="tef_resp" id="tef_resp" value="<?php echo $tef_resp; ?>"></input>
                <div id="tef_respx"></div>
            </div>

        </div>

        <div class="row mt-3 p-2 text-right">
            <div class="col-md-12">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Grabar</button>
            </div>
        </div>

    </form>

    <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

    <script>
        function seleccionar1(sel) {
            var caso = $('option:selected', sel).attr('value');

            $("#period1").load('/cw3/conlabweb3.0/apps/mantenimientos/periodicidad.php', {
                caso: caso
            })

        }

        $(document).ready(function() {
            var periodicidad = $("#periodicidad").val();
            var period_semanal = $("#period_semanal").val();
            var mesoption = $("#mesoption").val();
            if (periodicidad === "S") {
                $("#period1").load('/cw3/conlabweb3.0/apps/mantenimientos/periodicidad.php', {
                    caso: 'S',
                    period_semanal: period_semanal,
                    mesoption: mesoption
                });
            } else if (periodicidad === "M") {
                $("#period1").load('/cw3/conlabweb3.0/apps/mantenimientos/periodicidad.php', {
                    caso: 'M'
                });
            }

            $('#localizacion').change(function() {
                id = $('#localizacion').val();
                $.ajax({
                    method: 'POST',
                    url: '/cw3/conlabweb3.0/apps/mantenimientos/search-equipo.php?id=' + id,
                    success: function(rest) {

                        if (rest == '0') {
                            $('#equipo').html('');
                        } else {
                            $('#equipo').html(rest);
                        }

                    }
                })
            })

        });

        $(document).ready(function() {
            $.validator.setDefaults({
                submitHandler: function() {
                    updateMant();
                }
            });
            $('#formEditPrev').validate({
                rules: {
                    optmante: {
                        required: true
                    },
                    id_sedes: {
                        required: true
                    },
                    descp: {
                        required: true
                    }
                },
                messages: {
                    optmante: {
                        required: ""
                    },
                    id_sedes: {
                        required: ""
                    },
                    descp: {
                        required: ""
                    }
                },

                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        })

        function updateMant() {
            var id = $("#id").val();
            var equipo = $("#equipo").val();
            var localizacion = $("#localizacion").val();
            //var fecha_comienzo = $("#fecha_comienzo").val();
            var id_proveedor = $("#id_proveedor").val();
            var modeeditstatus = $("#modeeditstatus").val();
            var meses_garantia = $("#meses_garantia").val();
            //var meses_garantia_ext = $("#meses_garantia_ext").val();
            var id_tipo_mantenimiento = $("#id_tipo_mantenimiento").val();
            var desc_mantenimiento = $("#desc_mantenimiento").val();
            var comenzar = $("#comenzar").val();
            var fechafinal = $("#fecha_final").val();
            //var rve = $("#rve").val();
            var resp_mantenimiento = $("#resp_mantenimiento").val();
            var dir_resp = $("#dir_resp").val();
            var tef_resp = $("#tef_resp").val();
            var periodicidad = $("#periodicidad").val();
            var responsable = $("#responsable").val();
            var tipmant = $("#tipmant").val();
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
                url: '/cw3/conlabweb3.0/apps/mantenimientos/crud.php?aux=2',
                data: {
                    id: id,
                    diassemana: diassemana,
                    equipo: equipo,
                    //fecha_comienzo: fecha_comienzo,
                    localizacion: localizacion,
                    id_proveedor: id_proveedor,
                    meses_garantia: meses_garantia,
                    //meses_garantia_ext: meses_garantia_ext,
                    id_tipo_mantenimiento: id_tipo_mantenimiento,
                    desc_mantenimiento: desc_mantenimiento,
                    comenzar: comenzar,
                    fechafinal: fechafinal,
                    //rve: rve,
                    resp_mantenimiento: resp_mantenimiento,
                    dir_resp: dir_resp,
                    tef_resp: tef_resp,
                    mesoption1: mesoption1,
                    modeeditstatus: modeeditstatus,
                    periodicidad: periodicidad,
                    tipmant: tipmant,
                    responsable: responsable
                },
                success: function() {

                    //alert('Hola');

                    $("#contentTableMant").load("/cw3/conlabweb3.0/apps/mantenimientos/table.php");

                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Registro Exitoso!',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $('#modalEditar').modal('hide');

                }
            });
        }
    </script>
<?php
}
?>