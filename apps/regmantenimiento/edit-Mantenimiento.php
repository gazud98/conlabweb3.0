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

    $id = 0;

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $query = "SELECT id, id_equipo, id_sede, id_departamento, fecha_inicio, fecha_final, id_proveedor, responsable, descripcion, garantia_dias, 
    danio, accion, respuestos, frecuencia, tipo_mantenimiento, estado, cod_repuesto,id_area
    FROM mantenimientos WHERE id = '$id'";

    $result = $conetar->query($query);

    if ($result) {
        $row = $result->fetch_assoc();

        $fecha_inicio = $row['fecha_inicio'];
        $id_sede = $row['id_sede'];
        $id_equipo = $row['id_equipo'];
        $id_departamento = $row['id_departamento'];
        $fecha_final = $row['fecha_final'];
        $id_proveedor = $row['id_proveedor'];
        $responsable = $row['responsable'];
        $descripcion = $row['descripcion'];
        $garantia_dias = $row['garantia_dias'];
        $danio = $row['danio'];
        $accion = $row['accion'];
        $respuestos = $row['respuestos'];
        $frecuencia = $row['frecuencia'];
        $tipo_mantenimiento = $row['tipo_mantenimiento'];
        $estado = $row['estado'];
        $id_area = $row['id_area'];
        $cod_repuesto = $row['cod_repuesto'];
    }
}
?>

<div class="row">
    <div class="col-md-3">
        <label for="" style="font-size: 12px;">Tipo de Mantenimiento:</label>
        <select name="tipmant" id="tipmant" class="form-control" disabled>
            <option value="1" <?= ($tipo_mantenimiento == 'P') ? 'selected' : '' ?>>Preventivo</option>
            <option value="2" <?= ($tipo_mantenimiento == 'C') ? 'selected' : '' ?>>Correctivo</option>
        </select>
    </div>
</div>
<form name="formEditMant" id="formEditMant" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
    <div class="row mt-2">
        <div class="col-12 col-md-3">
            <label style="font-size: 12px;">Sede:</label>
            <select class="form-control select2" name="localizacion" id="localizacion" required style="width:100%;">
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena33 = "SELECT id_sedes, nombre FROM sedes WHERE estado='1'";
                $resultadP2a33 = $conetar->query($cadena33);
                if ($resultadP2a33->num_rows >= 1) {
                    while ($filaP2a33 = $resultadP2a33->fetch_assoc()) {
                        echo "<option value='" . trim($filaP2a33['id_sedes']) . "'";
                        if (trim($filaP2a33['id_sedes']) == $id_sede) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a33['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-12 col-md-3">
            <label style="font-size: 12px;">Departamento:</label>
            <select class="form-control select2" name="departamento" id="departamento" required style="width:100%;" onchange='areaFunc(this);'>
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena33 = "SELECT id, nombre FROM departamentos WHERE estado='1'";
                $resultadP2a33 = $conetar->query($cadena33);
                if ($resultadP2a33->num_rows >= 1) {
                    while ($filaP2a33 = $resultadP2a33->fetch_assoc()) {
                        echo "<option value='" . trim($filaP2a33['id']) . "'";
                        if (trim($filaP2a33['id']) == $id_departamento) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a33['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-12 col-md-3">

            <div id="area-id">
                <label for="area" style="font-size: 11px;">Area</label>
                <select class="select2" name="area" id="area" style="width: 100%;" required>
                    <option selected="true" disabled="disabled"></option>
                    <?php
                    $cadena = "SELECT id, nombre FROM  u116753122_cw3completa.area_laboratorio where estado='1'  ";
                    $resultadP2a = $conetar->query($cadena);
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id']) . "'";
                        if (trim($filaP2a['id']) == $id_area) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>

        </div>
        <div class="col-12 col-md-3">
            <label style="font-size: 12px;">Equipo:</label>
            <select class="form-control select2" name="equipo" id="equipo" required style="width:100%;">
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena33 = "SELECT id_producto, nombre, referencia FROM producto WHERE estado='1' AND id_categoria_producto ='1' AND op_mantenimiento = '1'";
                $resultadP2a33 = $conetar->query($cadena33);
                if ($resultadP2a33->num_rows >= 1) {
                    while ($filaP2a33 = $resultadP2a33->fetch_assoc()) {
                        echo "<option value='" . trim($filaP2a33['id_producto']) . "'";
                        if (trim($filaP2a33['id_producto']) == $id_equipo) {
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
            <select class="form-control select2" name="id_proveedor" id="id_proveedor" required style="width:100%;">
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena33 = "SELECT id_proveedores, nombre_comercial FROM proveedores WHERE estado='1'";
                $resultadP2a33 = $conetar->query($cadena33);
                if ($resultadP2a33->num_rows >= 1) {
                    while ($filaP2a33 = $resultadP2a33->fetch_assoc()) {
                        echo "<option value='" . trim($filaP2a33['id_proveedores']) . "'";
                        if (trim($filaP2a33['id_proveedores']) == $id_proveedor) {
                            echo ' selected';
                        }
                        echo '>' . $filaP2a33['nombre_comercial'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-2">
            <label style="font-size: 12px;">Garantía en días:</label>
            <input type="text" class="form-control" name="meses_garantia" id="meses_garantia" value="<?php echo $garantia_dias ?>" required>
        </div>
        <div class="col-md-6">
            <label style="font-size: 12px;">Responsable:</label>
            <input type="text" class="form-control" name="responsable" id="responsable" value="<?php echo $responsable ?>" required>
        </div>
    </div>

    <div id="contentCorrectivo" <?= ($tipo_mantenimiento == 'P') ? 'style="display:none"' : '' ?>>
        <div class="row mt-2">
            <div class="col-md-3">
                <label for="">Daño:</label>
                <input type="text" name="danio" id="danio" class="form-control" value="<?php echo $danio ?>" <?= ($tipo_mantenimiento == 'C') ? 'required' : '' ?>>
            </div>
            <div class="col-md-3">
                <label for="">Acción tomada:</label>
                <input type="text" name="accion" id="accion" class="form-control" value="<?php echo $accion ?>" <?= ($tipo_mantenimiento == 'C') ? 'required' : '' ?>>
            </div>
            <div class="col-md-2">
                <label for="">¿Repuestos?</label>
                <select name="reqrep" id="reqrep" class="form-control" <?= ($tipo_mantenimiento == 'C') ? 'required' : '' ?>>
                    <option value="0" <?= ($respuestos == 0) ? 'selected' : '' ?>>NO</option>
                    <option value="1" <?= ($respuestos == 1) ? 'selected' : '' ?>>SI</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="">Añadir repuestos::</label>
                <input type="text" name="repuestos" id="repuestos" class="form-control" value="<?php echo $respuestos ?>" <?= ($tipo_mantenimiento == 'C') ? 'required' : '' ?>>
            </div>
        </div>
    </div>



    <div class="row mt-2">

        <div class="col-md-3">
            <label for="">Fecha de inicio:</label>
            <input type="date" name="comenzar" id="comenzar" class="form-control" value="<?php echo $fecha_inicio ?>" required>
        </div>
        <div class="col-md-3" id="contentPreventivo" <?= ($tipo_mantenimiento == 'C') ? 'style="display:none"' : '' ?>>
            <label style="font-size: 12px;">Frecuencia:</label>
            <select class="form-control" name="periodicidad" id="periodicidad" <?= ($tipo_mantenimiento == 'P') ? 'required' : '' ?>>
                <option selected="true" disabled="disabled" id="optionSelected"></option>
                <option value="D" <?= ($frecuencia == "D") ? 'selected' : '' ?>>Diario</option>
                <option value="S" <?= ($frecuencia == "S") ? 'selected' : '' ?>>Semanal</option>
                <option value="Q" <?= ($frecuencia == "Q") ? 'selected' : '' ?>>Quincenal</option>
                <option value="M" <?= ($frecuencia == "M") ? 'selected' : '' ?>>Mensual</option>
                <option value="A" <?= ($frecuencia == "A") ? 'selected' : '' ?>>Anual</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="">Fecha de final:</label>
            <input type="date" name="fecha_final" id="fecha_final" class="form-control" value="<?php echo $fecha_final ?>" required>
        </div>

    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <label for="">Descripción:</label>
            <textarea type="text" name="descripcion" id="descripcion" class="form-control" rows="4" cols="50" required><?php echo $descripcion ?></textarea>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary btn-sm" id="btn-save">Guardar</button>
        </div>
    </div>
</form>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script>
    function areaFunc(sel) {
        var id = $('option:selected', sel).attr('value');
        $("#area-id").load("https://conlabweb3.tierramontemariana.org/apps/regmantenimiento/area.php", {
            id: id
        });
    }
    $(document).ready(function() {
        // Inicializar select2
        $(".select2").select2();


        $.validator.setDefaults({
            submitHandler: function() {

                $.ajax({
                    method: 'POST', // Método HTTP (en este caso, POST)
                    url: 'https://conlabweb3.tierramontemariana.org/apps/regmantenimiento/crud.php?aux=2&tipmant=' + encodeURIComponent('<?php echo $tipo_mantenimiento ?>'),
                    data: $('#formEditMant').serialize(), // Datos del formulario serializados
                    success: function(response) {
                        // Manejo de la respuesta exitosa
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "Registro guardado correctamente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modalEditMantenimiento').modal('hide');
                        window.calendar.refetchEvents();
                    },
                    error: function(xhr, status, error) {
                        // Manejo de errores
                        console.error('Error en la solicitud AJAX:', error);
                    }
                });

            }
        });
        $('#formEditMant').validate({
            rules: {
                localizacion: {
                    required: true
                },
                departamento: {
                    required: true
                },
                equipo: {
                    required: true
                },
                id_proveedor: {
                    required: true
                },
                meses_garantia: {
                    required: true
                },
                responsable: {
                    required: true
                },
                danio: {
                    required: function() {
                        return $('#tipmant').val() == '2';
                    }
                },
                accion: {
                    required: function() {
                        return $('#tipmant').val() == '2';
                    }
                },
                reqrep: {
                    required: function() {
                        return $('#tipmant').val() == '2';
                    }
                },
                repuestos: {
                    required: function() {
                        return $('#tipmant').val() == '2';
                    }
                },
                comenzar: {
                    required: true
                },
                periodicidad: {
                    required: function() {
                        return $('#tipmant').val() == '1';
                    }
                },
                fecha_final: {
                    required: true
                },
                descripcion: {
                    required: true
                }
            },
            messages: {
                localizacion: {
                    required: "Por favor, ingrese la localización"
                },
                departamento: {
                    required: "Por favor, ingrese el departamento"
                },
                equipo: {
                    required: "Por favor, ingrese el equipo"
                },
                id_proveedor: {
                    required: "Por favor, ingrese el ID del proveedor"
                },
                meses_garantia: {
                    required: "Por favor, ingrese los meses de garantía"
                },
                responsable: {
                    required: "Por favor, ingrese el responsable"
                },
                danio: {
                    required: "Por favor, ingrese el daño"
                },
                accion: {
                    required: "Por favor, ingrese la acción"
                },
                reqrep: {
                    required: "Por favor, seleccione si requiere repuestos"
                },
                comenzar: {
                    required: "Por favor, ingrese la fecha de comienzo"
                },
                periodicidad: {
                    required: "Por favor, ingrese la periodicidad"
                },
                fecha_final: {
                    required: "Por favor, ingrese la fecha final"
                },
                descripcion: {
                    required: "Por favor, ingrese la descripción"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                error.addClass('error-message');
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });


    });
</script>