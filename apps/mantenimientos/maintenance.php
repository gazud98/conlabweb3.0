<?php

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

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
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
        $id = 0;
    }

    $id_categoria_producto = "1";
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
        $cadena = "SELECT P.id,P.equipo,P.id_sede,P.id_proveedor,P.meses_garantia,P.meses_garantia_ext,periodicidad,
        P.valor_anual_garantia,P.tipo_mantenimiento,P.desc_mantenimiento,P.period_semanal,P.mesoption,P.comienzo,P.fecha_final,
        P.resp_mantenimiento,P.responsable,P.tef_resp,P.direccion_resp,P.estado
                FROM preventiva P
                WHERE 1=1
                    AND P.id='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id']);
            $equipo = trim($filaP2['equipo']);
            $localizacion = trim($filaP2['id_sede']);
            $id_proveedor = trim($filaP2['id_proveedor']);
            $meses_garantia = trim($filaP2['meses_garantia']);
            $valor_anual_garantia = trim($filaP2['valor_anual_garantia']);
            $tipo_mantenimiento = trim($filaP2['tipo_mantenimiento']);
            $desc_mantenimiento = trim($filaP2['desc_mantenimiento']);
            $period_semanal = trim($filaP2['period_semanal']);
            $resp_mantenimiento = trim($filaP2['resp_mantenimiento']);
            $direccion_resp = trim($filaP2['direccion_resp']);
            $tef_resp = trim($filaP2['tef_resp']);
            $periodicidad = trim($filaP2['periodicidad']);
            $mesoption = trim($filaP2['mesoption']);
            $comienzo = date('d-m-Y', strtotime(trim($filaP2['comienzo'])));
            $responsable = trim($filaP2['responsable']);
            $estado = trim($filaP2['estado']);
            $fecha_final = date('d-m-Y', strtotime(trim($filaP2['fecha_final'])));
        }
    }

?>

    <style>
        label {
            font-size: 12px !important;
        }

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

        #period1 {
            font-size: 11px;
            padding: 6px;
            background-color: #EEF7FB;
            border-radius: 5px;
        }

        #itemFechas {
            text-align: center;
            margin-left: 7px;
            padding: 5px;
            background-color: #EDF4F5;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        #contentFechasItem {
            text-align: center;
        }
    </style>

    <div class="row">
        <div class="col-md-3">
            <label for="" style="font-size: 12px;">Tipo de Mantenimiento:</label>
            <select name="tipmant" id="tipmant" class="form-control">
                <option value="" selected disabled>SELECCIONAR:</option>
                <option value="1">Preventivo</option>
                <option value="2">Correctivo</option>
            </select>
        </div>
    </div>

    <form name="formMant" id="formMant" action="" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
        <input type="hidden" name="period_semanal" id="period_semanal" value="<?php echo $period_semanal; ?>">
        <input type="hidden" name="mesoption" id="mesoption" value="<?php echo $mesoption; ?>">
        <input type="hidden" class="form-control" style="border:thin solid transparent; " readonly name="id" id="id" value="<?php echo $id; ?>"></input>

        <div class="row mt-2">

            <div class="col-md-4">
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
            </div>

            <div class="col-md-4">
                <label style="font-size: 12px;">Departamento:</label>
                <select class="form-control" name="departamento" id="departamento" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id, nombre FROM departamentos where estado='1'";
                    $resultadP2a = $conetar->query($cadena);

                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                    ?>
                        <option value="<?php echo $filaP2a['id']; ?>"><?php echo $filaP2a['nombre']; ?></option>
                    <?php
                    }
                    ?>
                </select>
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
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4">
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
                <label style="font-size: 12px;">Garantia en días:</label>
                <input type="input" class="form-control" name="meses_garantia" id="meses_garantia" value="<?php echo $meses_garantia; ?>" required></input>
                <div id="meses_garantiax"></div>
            </div>
            <div class="col-md-6">
                <label style="font-size: 12px;">Responsable:</label>
                <input type="text" class="form-control" name="responsable" id="responsable" required>
                <!--<select class="form-control" name="responsable" id="responsable" required>
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
                <div id="responsablex"></div>-->
            </div>
        </div>

        <div id="contentCorrectivo">
            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="">Daño:</label>
                    <input type="text" name="danio" id="danio" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="">Acción tomada:</label>
                    <input type="text" name="accion" id="accion" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="">¿Repuestos?</label>
                    <select name="reqrep" id="reqrep" class="form-control" required>
                        <option value="" disabled selected></option>
                        <option value="1">SI</option>
                        <option value="2">NO</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="">Añadir repuestos:</label>
                    <textarea class="form-control" name="repuestos" id="repuestos" rows="1" cols="30"></textarea>
                </div>
            </div>
        </div>

        <!--<div class="mt-4 text-center" style="background-color: #EDF4F5; padding:5px; border-radius:5px; margin-bottom:10px; font-size:13px;">
            <strong>Descripción del Mantenimiento:</strong>
        </div>-->

        <div class="row mt-2">

            <div class="col-md-3">
                <label style="font-size: 12px;">Fecha próximo mantenimiento:</label>
                <input type="date" class="form-control" style="overflow: hidden;height: 45% !important;" name="comenzar" id="comenzar" value="<?php echo $comienzo; ?>" required></input>
                <div id="comenzarx"></div>
            </div>

            <div class="col-md-3" id="contentPreventivo">
                <label style="font-size: 12px;">Frecuencia:</label>

                <select class="form-control" style="overflow: hidden;height: 45% !important;" name="periodicidad" id="periodicidad" onchange="seleccionar1(this)" required>
                    <option selected="true" disabled="disabled" id="optionSelected"></option>
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
            </div>

            <!--<div class="col-md-4" id="contentPreventivo2">
                <div id="period1">
                    <Label>Se repite:</Label>
                    <br><span>Según lo elegido.</span>
                </div>
            </div>-->

            <div class="col-md-3" id="fechaFinal">
                <label style="font-size: 12px;">Fecha de finalización:</label>
                <input type="date" class="form-control" style="overflow: hidden;height: 45% !important;" name="fecha_final" id="fecha_final" value="<?php echo $fecha_final; ?>" required>
                <div id="fecha_comienzox"></div>
            </div>

            <div class="col-md-3" id="fechaFinalCorrectivo" style="display: none;">
                <label style="font-size: 12px;">Fecha de finalización:</label>
                <input type="date" class="form-control" style="overflow: hidden;height: 45% !important;" name="fecha_final_cor" id="fecha_final_cor" value="<?php echo $fecha_final; ?>" required>
                <div id="fecha_comienzox"></div>
            </div>

            <!--<div class="col-md-4" id="proxFechas" style="display:none;">
                <label for="">Proximas fechas de mantenimeinto. </label>
                <div id="contentFechas" style="background-color: #EDF4F5; border-radius:5px; margin-bottom:10px; font-size:13px;">
                    ---
                </div>
            </div>-->

            <div class="col-md-2" id="viewDates" style="display: none;">
                <label for="">Ver fechas:</label>
                <button type="button" class="btn btn-primary btn-xs" id="btnVerFechas" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" disabled><i class="fa-solid fa-eye"></i></button>
            </div>

        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="collapse fecha-collapse" id="collapseExample">
                    <div class="card card-body" id="contentItemsFechas">

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label style="font-size: 12px;">Descripcion:</label>
                <textarea class="form-control" name="desc_mantenimiento" id="desc_mantenimiento" rows="2" cols="30"><?php echo $desc_mantenimiento; ?></textarea>
                <div id="desc_mantenimientox"></div>
            </div>
        </div>

        <div class="mt-4 text-center" style="background-color: #EDF4F5; padding:5px; border-radius:5px; margin-bottom:10px; font-size:13px;">
            <strong>Datos de contacto:</strong>
        </div>

        <div class="row">

            <div class="col-md-4">
                <label style="font-size: 12px;">Nombre:</label>
                <input type="input" class="form-control" name="resp_mantenimiento" id="resp_mantenimiento" value="<?php ?>"></input>
            </div>

            <div class="col-md-4">
                <label style="font-size: 12px;">Direccion:</label>
                <input type="text" class="form-control" name="dir_resp" id="dir_resp" value="<?php echo $tef_resp; ?>">
                <div id="dir_respx"></div>
            </div>

            <div class="col-md-4">
                <label style="font-size: 12px;">Teléfono o Celular:</label>
                <input type="text" class="form-control" name="tef_resp" id="tef_resp" value="<?php echo $tef_resp; ?>">
                <div id="tef_respx"></div>
            </div>

        </div>

        <div class="row mt-2">
            <div class="col-md-4">
                <label style="font-size: 12px;">Email:</label>
                <input type="text" class="form-control" name="emailcontacto" id="emailcontacto" value="">
                <div id="tef_respx"></div>
            </div>
        </div>

        <div class="col-md-12 text-center mt-5">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success btn-sm" id="btnSaveMant" disabled>Grabar</button>
            </div>
        </div>

    </form>

    <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="/cw3/conlabweb3.0/apps/mantenimientos/assets/index.js"></script>

    <script>
        $(document).ready(function() {
            $.validator.setDefaults({
                submitHandler: function() {

                    tipmant = $('#tipmant').val();

                    returnFechasOnly();

                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Registro guardado correctamente!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#meses_garantia').val('')
                    $('#responsable').val('')
                    $('#optionSelected').prop('selected', true);
                    miDataTable.ajax.reload();
                    if (tipmant != 1) {
                        $('#modalMant').modal('hide');
                    }

                }
            });
            $('#formMant').validate({
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

        $(document).ready(function() {
            $('#reqrep').change(function() {
                req = $('#reqrep').val();

                if (req == 1) {
                    $('#repuestos').prop('disabled', false);
                } else if (req == 2) {
                    $('#repuestos').prop('disabled', true);
                }
            })

            $('#fecha_final').change(function() {
                $('#contentItemsFechas').load('/cw3/conlabweb3.0/apps/mantenimientos/items-fecha.php')
                $('#btnVerFechas').prop('disabled', false);
            })

            $('#periodicidad').change(function() {
                //$('#comenzar').prop('disabled', false);
                $('#contentItemsFechas').load('/cw3/conlabweb3.0/apps/mantenimientos/items-fecha.php')
                $('#btnVerFechas').prop('disabled', false);
            })

            $('#btnVerFechas').click(function() {
                $('#contentItemsFechas').load('/cw3/conlabweb3.0/apps/mantenimientos/items-fecha.php')
            })
        })

        function mostrarFechas() {

            $('#contentItemsFechas').load('/cw3/conlabweb3.0/apps/mantenimientos/items-fecha.php')

        }

        function returnFechasOnly() {
            let fecha = $('#comenzar').val();
            let fechaFinal = $('#fecha_final').val();
            fechaInicioMs = new Date(fecha).getTime();
            fechaFinalMs = new Date(fechaFinal).getTime();
            const fechasDespuesDe7Dias = [];
            let aux = 0;

            $.ajax({
                method: 'POST',
                url: '/cw3/conlabweb3.0/apps/mantenimientos/crud.php?aux=1&tipmant=' + tipmant + '&fechas=' + new Date(fechaInicioMs).toISOString().split('T')[0],
                data: $('#formMant').serialize(),
                success: function() {

                }
            })

            fechasDespuesDe7Dias.push(new Date(fechaInicioMs).toISOString().split('T')[0]);

            if ($('#periodicidad').val() == 'S') {
                aux += 7;
            } else if ($('#periodicidad').val() == 'Q') {
                aux += 15;
            } else if ($('#periodicidad').val() == 'M') {
                aux += 30;
            } else if ($('#periodicidad').val() == 'A') {
                aux += 360;
            }

            const semanaEnMilisegundos = aux * 24 * 60 * 60 * 1000; // 7 días en milisegundos

            while (fechaInicioMs + semanaEnMilisegundos <= fechaFinalMs) {

                fechaInicioMs += semanaEnMilisegundos;

                let fechaDespuesDe7Dias = new Date(fechaInicioMs);

                $.ajax({
                    method: 'POST',
                    url: '/cw3/conlabweb3.0/apps/mantenimientos/crud.php?aux=1&tipmant=' + tipmant + '&fechas=' + fechaDespuesDe7Dias.toISOString().split('T')[0],
                    data: $('#formMant').serialize(),
                    success: function() {
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "Registro guardado correctamente!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
                fechasDespuesDe7Dias.push(fechaDespuesDe7Dias.toISOString().split('T')[0]);
            }

            return fechasDespuesDe7Dias;
        }

        function setProxDates(fecha) {

            id_activo = $('#equipo').val();

            $.ajax({
                method: 'POST',
                url: '/cw3/conlabweb3.0/apps/mantenimientos/crud.php?aux=5',
                data: {
                    fecha: fecha,
                    id_activo: id_activo
                },
                success: function() {

                }
            })

        }
    </script>
<?php
}
?>