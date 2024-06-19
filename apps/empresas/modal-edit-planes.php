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

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $sql = "SELECT p.id, e.nombre_comercial, p.nombre_plan, d.nombre, p.estado, p.descripcion_plan, p.id_empresa, p.id_lista_base, 
    p.tipo_plan, p.concepto_pagar, p.requisito_facturacion, p.descuento_plan, p.frecuencia_plan, p.porcentaje_plan FROM 
    planes_empresa p, empresas e, detalle_listas d, concepto_pagar c, req_facturacion r, tipo_planes t, frecuencia f 
    WHERE p.id_empresa = e.id_empresas AND p.id_lista_base = d.id AND p.concepto_pagar = c.id AND p.requisito_facturacion = r.id 
    AND p.tipo_plan = t.id AND p.frecuencia_plan = f.id AND p.id = '$id'";

    $rest = mysqli_query($conetar, $sql);

    while ($data = mysqli_fetch_array($rest)) {
        $id = $data['id'];
        $nombre_comercial = $data['nombre_comercial'];
        $nombre_plan = $data['nombre_plan'];
        $estado = $data['estado'];
        $descripcion_plan = $data['descripcion_plan'];
        $id_empresa = $data['id_empresa'];
        $id_lista_base = $data['id_lista_base'];
        $tipo_plan = $data['tipo_plan'];
        $concepto_pagar = $data['concepto_pagar'];
        $requisito_facturacion = $data['requisito_facturacion'];
        $descuento_plan = $data['descuento_plan'];
        $frecuencia_plan = $data['frecuencia_plan'];
        $porcentaje_plan = $data['porcentaje_plan'];
    }

    echo $data;
}

?>

<form id="formEditPlanes" method="POST" enctype="multipart/form-data">
    <div class="row">

        <input type="hidden" name="idplan" value="<?php echo $id; ?>">

        <div class="col-md-4">
            <label for="">Nombre del Plan:</label>
            <input type="text" class="form-control" name="nombreplan" id="nombreplan" value="<?php echo $nombre_plan; ?>" required>
        </div>

        <div class="col-md-4">
            <label for="">Lista Base:</label>
            <select name="listabaseplan" id="listabaseplan" class="form-control" required>
                <option value="" selected disabled>SELECCIONA:</option>
                <?php
                $sql = "SELECT id, nombre, descripcion, descuento_minimo, estado FROM detalle_listas ORDER BY id DESC";

                $rest = mysqli_query($conetar, $sql);

                while ($data = mysqli_fetch_array($rest)) {
                    echo "<option value='" . trim($data['id']) . "'";
                    if (trim($data['id']) == $id_lista_base) {
                        echo ' selected';
                    }
                    echo '>' . $data['nombre'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="col-md-2">
            <label for="">Estado:</label>
            <select name="estadoplan" id="estadoplan" class="form-control" required>
                <option value="1" selected>Activo</option>
                <option value="2">Inactivo</option>
            </select>
        </div>

        <div class="col-md-2">
            <label for="">Tipo de plan:</label>
            <select name="tipoplan" id="tipoplan" class="form-control">
                <option value="" selected disabled>SELECCIONA:</option>
                <?php

                $sql = "SELECT id, descripcion, estado FROM tipo_planes";

                $rest = mysqli_query($conetar, $sql);

                while ($data = mysqli_fetch_array($rest)) {
                    echo "<option value='" . trim($data['id']) . "'";
                    if (trim($data['id']) == $id_lista_base) {
                        echo ' selected';
                    }
                    echo '>' . $data['descripcion'] . "</option>";
                }

                ?>
            </select>
        </div>

    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <label for="">Descripcion:</label>
            <textarea name="descripcionplan" id="descripcionplan" cols="30" rows="2" class="form-control" value="<?php echo $descripcion_plan; ?>" required></textarea>
        </div>
        <div class="col-md-4">
            <label for="">Conceptos a pagar:</label>
            <select name="conectopagar" id="conectopagar" class="form-control">
                <option value="" selected disabled>SELECCIONA:</option>
                <?php

                $sql = "SELECT id, descripcion, estado FROM concepto_pagar";

                $rest = mysqli_query($conetar, $sql);

                while ($data = mysqli_fetch_array($rest)) {
                    echo "<option value='" . trim($data['id']) . "'";
                    if (trim($data['id']) == $id_lista_base) {
                        echo ' selected';
                    }
                    echo '>' . $data['descripcion'] . "</option>";
                }
                ?>

            </select>
        </div>
        <div class="col-md-4">
            <label for="">Requisitos facturación:</label>
            <select name="reqfacturacion" id="reqfacturacion" class="form-control">
                <option value="" selected disabled>SELECCIONA:</option>
                <?php

                $sql = "SELECT id, descripcion, estado FROM req_facturacion";

                $rest = mysqli_query($conetar, $sql);

                while ($data = mysqli_fetch_array($rest)) {
                    echo "<option value='" . trim($data['id']) . "'";
                    if (trim($data['id']) == $id_lista_base) {
                        echo ' selected';
                    }
                    echo '>' . $data['descripcion'] . "</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <label for="">Frecuencia:</label>
            <select name="frecuenciaplan" id="frecuenciaplan" class="form-control" required>
                <option value="" selected disabled>SELECCIONA:</option>
                <?php

                $sql = "SELECT id, descripcion, estado FROM frecuencia";

                $rest = mysqli_query($conetar, $sql);

                while ($data = mysqli_fetch_array($rest)) {
                    echo "<option value='" . trim($data['id']) . "'";
                    if (trim($data['id']) == $id_lista_base) {
                        echo ' selected';
                    }
                    echo '>' . $data['descripcion'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="">Descuento/Incremento:</label>
            <select name="descuentoplan" id="descuentoplan" class="form-control" required>
                <option value="" selected disabled>SELECCIONA:</option>
                <option value="1">Descuento</option>
                <option value="2">Incremento</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="">Porcentaje:</label>
            <input type="text" name="porcentajeplan" id="porcentajeplan" class="form-control" value="<?php echo $porcentaje_plan; ?>" required>
        </div>
    </div>

    <div class="text-right mt-5">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success btn-sm">Grabar</button>
        </div>
    </div>

</form>

<script>
    $(document).ready(function() {
        $.validator.setDefaults({
            submitHandler: function() {

                ide = $('#idempresafact').val();

                if (ide == 0 || ide == '') {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "No has seleccionado una empresa!",
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/cw3/conlabweb3.0/apps/empresas/crud.php?aux=8',
                        data: $('#formEditPlanes').serialize(),
                        success: function(respuesta) {
                            if (respuesta == 'ok') {
                                //                     alert('Termiando');
                            }
                            Swal.fire({
                                position: "top-center",
                                icon: "success",
                                title: "¡Registro Exitoso!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            //alert("¡Registro Exitoso!");
                            $('#modalEditPlan').modal('hide');
                            $('.content-table-planes').load('/cw3/conlabweb3.0/apps/empresas/table-planes-empresa.php', {
                                id: <?= $id ?>
                            });
                        }
                    });
                }

            }
        });
        $('#formEditPlanes').validate({
            rules: {
                nombre: {
                    required: true
                },
                simbolo: {
                    required: true
                },
                decimal: {
                    required: true
                },
            },
            messages: {
                nombre: {
                    required: "Este campo no puede estar vacío"
                },
                simbolo: {
                    required: "Este campo no puede estar vacío"
                },
                decimal: {
                    required: "Este campo no puede estar vacío"
                },
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
</script>