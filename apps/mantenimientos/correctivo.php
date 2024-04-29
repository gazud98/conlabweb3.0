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
    $daño = "";
    $accidentada = "";
    $respuestos = "";
    $valor_servicio = "";
    $empresa = "";
    $precio = "";
    $telefono = "";
    $tecnico = "";
    $equipo = "";
    $mano_obra = "";
    $valor_factura = "";
    $estado = "";
    $localizacion = "";
    if ($id != "") {
        $cadena = "select P.id,P.daño,P.accidentada,P.respuestos,P.valor_servicio,P.empresa,P.precio,telefono,
        P.tecnico,P.mano_obra,P.valor_factura,P.estado,P.equipo,P.id_sede
                from correctivo P
                where 1=1
                    and P.id='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id']);
            $daño = trim($filaP2['daño']);
            $accidentada = trim($filaP2['accidentada']);
            $respuestos = trim($filaP2['respuestos']);
            $valor_servicio = trim($filaP2['valor_servicio']);
            $empresa = trim($filaP2['empresa']);
            $precio = trim($filaP2['precio']);
            $telefono = trim($filaP2['telefono']);
            $tecnico = trim($filaP2['tecnico']);
            $mano_obra = trim($filaP2['mano_obra']);
            $equipo = trim($filaP2['equipo']);
            $valor_factura = trim($filaP2['valor_factura']);
            $estado = trim($filaP2['estado']);
            $localizacion = trim($filaP2['id_sede']);
        }
        //echo $cadena;
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

    <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="<?php echo $status ?>">
    <input type="hidden" name="estado" id="estado" value="<?php echo $estado; ?>">
    <input type="hidden" name="tipmant" id="tipmant" value="C">
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
        <div class="col-md-2">
            <label style="font-size: 12px;">Equipo:</label>
            <select class="form-control" name="equipo" id="equipo" required>
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
            </select>
            <div id="equipox"></div>
        </div>
        <div class="col-md-4">
            <label style="font-size: 12px;">Daño:</label>
            <input type="input" class="form-control" name="daño" id="daño" value="<?php echo $daño; ?>" required></input>
            <div id="dañox"></div>
        </div>
        <div class="col-md-4">
            <label style="font-size: 12px;">Acción Tomada:</label>
            <input type="input" class="form-control" name="accidentada" id="accidentada" value="<?php echo $accidentada; ?>" required></input>
            <div id="accidentadax"></div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <label style="font-size: 12px;">Respuestos:</label>
            <input type="input" class="form-control" name="respuestos" id="respuestos" value="<?php echo $respuestos; ?>" required>
            <div id="respuestosx"></div>
        </div>
    </div>

    <hr>

    <div class="row">

        <div class="container" style="text-align:center;margin-right:3px;"> <label style="font-size: 12px;">Realizado Por:</label></div>

        <div class="col-md-2">
            <label style="font-size: 12px;">Fecha:</label>
            <input type="date" name="fechacorrectivo" id="fechacorrectivo" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label style="font-size: 12px;">Empresa:</label>
            <select class="form-control" name="empresa" id="empresa" required>
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
                        if (trim($filaP2a33['id_proveedores']) == $empresa) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a33['nombre_comercial'] . "</option>";
                    }
                }
                ?>
            </select>
            <div id="empresax"></div>
        </div>
        <div class="col-md-4">
            <label style="font-size: 12px;">Tecnico:</label>

            <input type="input" class="form-control" name="tecnico" id="tecnico" value="<?php echo $tecnico; ?>" required>
            <div id="tecnicox"></div>
        </div>
        <div class="col-md-2">
            <label style="font-size: 12px;">Telefono:</label>
            <input type="input" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>" required>
            <div id="telefonox"></div>
        </div>
        <div class="col-md-2">
            <label style="font-size: 12px;">Valor Factura:</label>
            <input type="number" class="form-control" name="valor_factura" id="valor_factura" value="<?php echo $valor_factura; ?>" required></input>
            <div id="valor_facturax"></div>
        </div>

    </div>

    <div class="row mt-3">

        <div class="col-md-2">
            <label style="font-size: 12px;">Num. Factura:</label>
            <input type="number" class="form-control" name="numfactura" id="numfactura" value="<?php echo ''; ?>" required></input>
        </div>

        <div class="col-md-2">
            <label style="font-size: 12px;">Fecha Factura:</label>
            <input type="date" class="form-control" name="fechafactura" id="fechafactura" value="<?php echo ''; ?>" required></input>
        </div>

    </div>

    <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#localizacion').change(function() {
                id = $('#localizacion').val();
                $.ajax({
                    method: 'POST',
                    url: 'https://conlabweb3.tierramontemariana.org/apps/mantenimientos/search-equipo.php?id=' + id,
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
                    setMantCor()
                }
            });
            $('#formCorrectivo').validate({
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

        function setMantCor() {
            $.ajax({
                type: 'POST',
                url: 'https://conlabweb3.tierramontemariana.org/apps/mantenimientos/crud-2.php?aux=1',
                data: $('#formCorrectivo').serialize(),
                success: function() {

                    $("#contentTableMant").load("https://conlabweb3.tierramontemariana.org/apps/mantenimientos/table.php");

                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '¡Registro Exitoso!',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $('#modalCorrectivo').modal('hide');

                }
            });

        } //de alvar datos
    </script>
<?php
}
?>