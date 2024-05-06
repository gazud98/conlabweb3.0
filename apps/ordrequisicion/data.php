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

    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];

        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = "0";
    }



    date_default_timezone_set('America/Bogota');
    $fechaActual = date('d-m-Y');
?>
  

    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="status" id="status" value="X">
        <input type="hidden" id="id_users" name="id_users" value="<?php echo $iduser ?>">

        <div class="form-group">
            <p style="font-size:14px;">Por favor, elige los parámetros para agregar los elementos a la tabla. Después de seleccionar los elementos, haz clic en el botón "Confirmar" para crear la solicitud.</p>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <label>Producto<span style="color: red;">*</span></label>
                    <select class="select2" name="id_producto" id="id_producto" style="width: 100%;" onchange="seleccionar(this)">
                        <option selected="true" disabled="disabled" required value=""> </option>
                        <?php
                        $cadena = "SELECT a.id_producto, a.nombre,a.cantidad_presentacion
                FROM u116753122_cw3completa.producto a
                where a.estado='1' and a.id_categoria_producto in (3,5)  ORDER BY a.nombre ASC";
                        $resultadP2a = $conetar->query($cadena);
                        $numerfiles2a = mysqli_num_rows($resultadP2a);
                        if ($numerfiles2a >= 1) {
                            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {

                                echo "<option value='" . trim($filaP2a['id_producto']) . "' nom_insumo='" . trim($filaP2a['nombre']) . "'";
                                echo '>' . $filaP2a['nombre'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 col-sm-4">
                    <label>Departamento<span style="color: red;">*</span></label>

                    <select class="select2" name="id_departamento" id="id_departamento" style="width: 100%;font-size:11px;">
                        <option value=""></option>
                        <?php
                        $cadena = "SELECT id, nombre
                                                    FROM u116753122_cw3completa.departamentos
                                                    where estado='1'";
                        $resultadP2a = $conetar->query($cadena);
                        $numerfiles2a = mysqli_num_rows($resultadP2a);
                        if ($numerfiles2a >= 1) {
                            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                echo "<option value='" . trim($filaP2a['id']) . "'";
                                echo '>' . $filaP2a['nombre'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 col-sm-4">
                    <label>Sede<span style="color: red;">*</span></label>
                    <select class="select2" name="id_sede" id="id_sede" style="width: 100%;font-size:13px;">
                        <option selected="true" disabled="disabled" value=""> </option>
                        <?php
                        $cadena = "SELECT id_sedes, nombre
                                                    FROM u116753122_cw3completa.sedes
                                                    where estado='1'";
                        $resultadP2a = $conetar->query($cadena);
                        $numerfiles2a = mysqli_num_rows($resultadP2a);
                        if ($numerfiles2a >= 1) {
                            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                echo "<option value='" . trim($filaP2a['id_sedes']) . "'";
                                echo '>' . $filaP2a['nombre'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <label>Centro de Costo<span style="color: red;">*</span></label>
                    <select class="select2" name="ccosto" id="ccosto" style="width: 100%;font-size:13px;">
                        <option selected="true" disabled="disabled" value=""></option>
                        <?php
                        $cadena = "SELECT id, nombre
                                                    FROM u116753122_cw3completa.centro_costos 
                                                    where estado='1'";
                        $resultadP2a = $conetar->query($cadena);
                        $numerfiles2a = mysqli_num_rows($resultadP2a);
                        if ($numerfiles2a >= 1) {
                            while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                                echo "<option value='" . trim($filaP2a['id']) . "' ";
                                echo '>' . $filaP2a['nombre'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2 col-sm-2">
                    <label style="font-size: 14px;">Cantidad <span style="color: red;">*</span></label>
                    <input type="number" class="form-control" name="cantidad" id="cantidad" style="height: 45%!important">

                </div>
                <div class="col-md-2 col-sm-2" id="cantbodega">
                    <?php include ("infbodega.php") ?>
                </div>
                <div class="col-md-2 col-sm-2">
                    <label style="font-size: 14px;">Fecha Vencimiento</label>
                    <input type="input" class="form-control" name="fecha" id="fecha" value="" readonly style="height: 45%!important">
                </div>
                <div class="col-md-2 col-sm-2 pt-3">
                    <button type="submit" value="Enviar" class="btn btn-outline-primary" id="envio"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Agregar</button>
                    <button type="button" class="btn btn-outline-primary" id="limpiar"><i class="fa-solid fa-eraser"></i>&nbsp;&nbsp;Limpiar</button>

                </div>
            </div>
        </div>
    </form>


    <div id="val"></div>





<?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    $('document').ready(function () {

        $(".select2")
            .select2()
            .on('select2:select', function () {
                $(this).trigger('blur');
            });


        $.validator.setDefaults({
            submitHandler: function () {

                enviar();


            }
        });
        $('#formcontrol').validate({
            rules: {
                id_producto: {
                    required: true
                },
                id_departamento: {
                    required: true
                },
                id_sede: {
                    required: true
                },
                ccosto: {
                    required: true
                },
                cantidad: {
                    required: true
                }
            },
            messages: {
                id_producto: {
                    required: "Este campo es requerido."
                },
                id_departamento: {
                    required: "Este campo es requerido."
                },
                id_sede: {
                    required: "Este campo es requerido."
                },
                ccosto: {
                    required: "Este campo es requerido."
                },
                cantidad: {
                    required: "Este campo es requerido."
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                // Colocar el mensaje de error debajo del campo
                error.addClass('invalid-feedback');
                error.addClass('error-message');
                error.insertAfter(element);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $('#limpiar').click(function () {
            limpiarCampos();
        });
    });

    function limpiarCampos() {
        // Limpiar el valor de los campos
        $('#id_producto').val('').trigger('change');
        $('#id_departamento').val('').trigger('change');
        $('#id_sede').val('').trigger('change');
        $('#ccosto').val('').trigger('change');
        $('#cantidad').val('');
        $('#fecha').val('');

        // Eliminar las clases de validación y mensajes de error
        $('#formcontrol').find('.is-invalid').removeClass('is-invalid');
        $('#formcontrol').find('.error-message').remove();
    }
    function seleccionar(sel) {
        var idx = $('option:selected', sel).attr('value');
       
        var nom_insumo = $('option:selected', sel).attr('nom_insumo');
        var iduser = $("#id_users").val();

        if (typeof idx !== 'undefined' && idx !== null && idx !== '') {
            // Ejecutar el código aquí si idx no es undefined, null o una cadena vacía
            $("#val").load('https://conlabweb3.tierramontemariana.org/apps/ordrequisicion/validator.php', {
                idx: idx,
                nom_insumo: nom_insumo,
                iduser: iduser
            });

            $("#cantbodega").load('https://conlabweb3.tierramontemariana.org/apps/ordrequisicion/infbodega.php', {
                idx: idx
            });
        } else {
            // No hacer nada si idx es undefined, null o una cadena vacía
        }
    }

    function seleccionarDepartamento(sel) {
        var idd = $('option:selected', sel).attr('value');


        $("#idprod").load('https://conlabweb3.tierramontemariana.org/apps/ordrequisicion/producto.php', {
            idd: idd
        })


    }


    function seleccionarResp(sel) {
        $("#id_producto").removeAttr('disabled');
    }
</script>