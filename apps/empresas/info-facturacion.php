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

    $id = "";

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $cadena = "SELECT nombre_comercial FROM empresas WHERE id_empresas = '$id'";

    $res = mysqli_query($conetar, $cadena);

    $nombre_empresa = mysqli_fetch_array($res);

    $id_info = "";
    $id_empresa = "";
    $dia_rad_1 = "";
    $dia_rad_2 = "";
    $tipo_factura = "";
    $formato_factura = "";
    $cant_pacientes_mes = "";
    $formato_anexo = "";
    $numero_copias = "";
    $requiere_rips = "";
    $cant_pacientes_factura = "";
    $numero_ria = "";
    $tipo_usuario = "";
    $notas_empresa = "";
    $otras_notas = "";
    $nombre_comercial = "";

    $sql = "SELECT f.id, f.id_empresa, f.dia_rad_1, f.dia_rad_2, f.tipo_factura, f.formato_factura, f.cant_pacientes_mes, f.formato_anexo, 
    f.numero_copias, f.requiere_rips, f.cant_pacientes_factura, f.numero_ria, f.tipo_usuario, f.notas_empresa, f.otras_notas, e.nombre_comercial 
    FROM info_facturacion f, empresas e WHERE f.id_empresa = e.id_empresas AND f.id_empresa = '$id'";

    $rest = mysqli_query($conetar, $sql);

    $row = mysqli_num_rows($rest);

    if ($row != 0) {
        while ($data = mysqli_fetch_array($rest)) {

            $id_info = $data['id'];
            $id_empresa = $data['id_empresa'];
            $dia_rad_1 = $data['dia_rad_1'];
            $dia_rad_2 = $data['dia_rad_2'];
            $tipo_factura = $data['tipo_factura'];
            $formato_factura = $data['formato_factura'];
            $cant_pacientes_mes = $data['cant_pacientes_mes'];
            $formato_anexo = $data['formato_anexo'];
            $numero_copias = $data['numero_copias'];
            $requiere_rips = $data['requiere_rips'];
            $cant_pacientes_factura = $data['cant_pacientes_factura'];
            $numero_ria = $data['numero_ria'];
            $tipo_usuario = $data['tipo_usuario'];
            $notas_empresa = $data['notas_empresa'];
            $otras_notas = $data['otras_notas'];
            $nombre_comercial = $data['nombre_comercial'];
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">
        <strong>Aún no a ingresado información de facturación para ésta empresa, puede hacerlo en estos campos. <i class="fa-solid fa-arrow-down"></i>
        </strong>
      </div>';
    }

?>

    <form action="" id="formInfoFacturacion" method="POST" enctype="multipart/form-data">

        <div class="text-center" style="width: 100%;background:#F0F8F4;padding:5px;border-radius:5px;font-weight: 800;">
            Empresa: <?= $nombre_empresa['nombre_comercial'] ?></h5>
        </div>

        <div class="row mt-4">

            <input type="hidden" name="idempresafact" value="<?= $id ?>">
            <div class="col-md-2">
                <label for="">Día Radicación 1er Periodo:</label>
                <input type="number" class="form-control" name="rad1" id="rad1" value="<?= $dia_rad_1 ?>" required>
            </div>
            <div class="col-md-2">
                <label for="">Día Radicación 2do Periodo:</label>
                <input type="number" class="form-control" name="rad2" id="rad2" value="<?= $dia_rad_2 ?>" required>
            </div>
            <div class="col-md-2">
                <label for="">Tipo de Factura:</label>
                <select class="form-control" name="tipofact" id="tipofact" required>
                    <option value="" selected disabled>SELECCIONA:</option>
                    <?php

                    $sql = "SELECT id, descripcion, estado FROM tipo_factura";

                    $rest = mysqli_query($conetar, $sql);

                    while ($element = mysqli_fetch_array($rest)) {

                        if ($tipo_factura == $element['id']) {

                    ?>

                            <option value="<?php echo $element['id']; ?>" selected><?php echo $element['descripcion']; ?></option>

                        <?php
                        } else {

                        ?>
                            <option value="<?php echo $element['id']; ?>"><?php echo $element['descripcion']; ?></option>
                    <?php

                        }
                    }

                    ?>

                </select>
            </div>
            <div class="col-md-2">
                <label for="">Formato de Factura:</label>
                <select class="form-control" name="formatofact" id="formatofact" required>
                    <option value="" selected disabled>SELECCIONA:</option>
                    <?php

                    $sql = "SELECT id, descripcion, estado FROM formato_factura";

                    $rest = mysqli_query($conetar, $sql);

                    while ($element = mysqli_fetch_array($rest)) {

                        if ($formato_factura == $element['id']) {
                    ?>

                            <option value="<?php echo $element['id']; ?>" selected><?php echo $element['descripcion']; ?></option>

                        <?php }

                        ?>
                        <option value="<?php echo $element['id']; ?>"><?php echo $element['descripcion']; ?></option>

                    <?php

                    } ?>
                </select>
            </div>
            <div class="col-md-2">
                <label for="">Cant. Pacientes Por Mes:</label>
                <input type="number" class="form-control" name="cantpacientes" id="cantpacientes" value="<?= $cant_pacientes_mes ?>" required>
            </div>
            <div class="col-md-2">
                <label for="">Formato Anexo:</label>
                <select class="form-control" name="formatoanexo" id="formatoanexo" required>
                    <option value="" selected disabled>SELECCIONA:</option>
                    <?php

                    $sql = "SELECT id, descripcion, estado FROM formatos_anexo";

                    $rest = mysqli_query($conetar, $sql);

                    while ($element = mysqli_fetch_array($rest)) {

                        if ($formato_anexo == $element['id']) {
                    ?>

                            <option value="<?php echo $element['id']; ?>" selected><?php echo $element['descripcion']; ?></option>

                        <?php }
                        ?>
                        <option value="<?php echo $element['id']; ?>"><?php echo $element['descripcion']; ?></option>

                    <?php
                    } ?>
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-1">
                <label for="">No. Copias:</label>
                <input type="number" class="form-control" name="nocopias" id="nocopias" value="<?= $numero_copias ?>" required>
            </div>
            <div class="col-md-1">
                <label for="">¿Requiere Rips?:</label>
                <select class="form-control" name="reqrips" id="reqrips" required>
                    <option value="" selected disabled></option>
                    <option value="1">SI</option>
                    <option value="2">NO</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="">Cant. Pacientes Factura:</label>
                <input type="number" class="form-control" name="catpacientesfac" id="catpacientesfac" value="<?= $cant_pacientes_factura ?>" required>
            </div>
            <div class="col-md-1">
                <label for="">N°. RIA:</label>
                <input type="number" class="form-control" name="noria" id="noria" value="<?= $numero_ria ?>" required>
            </div>
            <div class="col-md-1">
                <label for="">Tipo de Usuario:</label>
                <select class="form-control" name="tipousuario" id="tipousuario" required>
                    <option value="" selected disabled>SELECCIONA:</option>
                    <?php

                    $sql = "SELECT id, descripcion, estado FROM tipo_usuarios";

                    $rest = mysqli_query($conetar, $sql);

                    while ($element = mysqli_fetch_array($rest)) {

                        if ($tipo_usuario == $element['id']) {
                    ?>

                            <option value="<?php echo $element['id']; ?>" selected><?php echo $element['descripcion']; ?></option>

                        <?php }

                        ?>
                        <option value="<?php echo $element['id']; ?>"><?php echo $element['descripcion']; ?></option>
                    <?php
                    } ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Notas Empresa:</label>
                <!--<input type="text" class="form-control" name="notasempresa" id="notasempresa">-->
                <textarea class="form-control" name="notasempresa" id="notasempresa" cols="30" rows="2" required><?= $notas_empresa ?></textarea>
            </div>
            <div class="col-md-3">
                <label for="">Otras Notas:</label>
                <!--<input type="text" class="form-control" name="otrasnotas" id="otrasnotas">-->
                <textarea class="form-control" name="otrasnotas" id="otrasnotas" cols="30" rows="2" required><?= $otras_notas ?></textarea>
            </div>
        </div>

        <div class="col-md-12 text-right mt-4">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                <button type="submit" class="btn btn-primary btn-sm" onclick=""><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            </div>
        </div>
    </form>

<?php
}
?>

<!-- jquery-validation -->
<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!--<script src="assets/plugins/jquery/jquery.min.js"></script>-->

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('.content-table-ingreso').load('https://conlabweb3.tierramontemariana.org/apps/empresas/tableinfofac.php');
    })

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
                        url: 'https://conlabweb3.tierramontemariana.org/apps/empresas/crud.php?aux=5',
                        data: $('#formInfoFacturacion').serialize(),
                        success: function(respuesta) {
                            Swal.fire({
                                position: "top-center",
                                icon: "success",
                                title: "¡Registro Exitoso!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('.content-modal-info-fact').load('https://conlabweb3.tierramontemariana.org/apps/empresas/info-facturacion.php', {
                                id: <?= $id ?>
                            })
                            //alert("¡Registro Exitoso!");
                        }
                    });
                }

            }
        });
        $('#formInfoFacturacion').validate({
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