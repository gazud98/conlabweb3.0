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

    $num_resolucion = "";
    $fecha_resolucion = "";
    $act_eco_principal = "";
    $act_ind_comercio = "";
    $tarifa_mil = "";
    $tarifa_retencion = "";
    $res_fiscal = "";
    $empresa = "";

    $sql = "SELECT it.id, it.num_resolucion, it.fecha_resolucion, it.act_eco_principal, it.act_ind_comercio, it.tarifa_mil, 
    it.tarifa_retencion, it.res_fiscal, it.empresa FROM info_tributaria it, empresas e WHERE it.empresa = e.id_empresas 
    AND it.empresa = '$id'";

    $rest = mysqli_query($conetar, $sql);

    $row = mysqli_num_rows($rest);

    if ($row != 0) {
        while ($data = mysqli_fetch_array(($rest))) {
            $num_resolucion = $data['num_resolucion'];
            $fecha_resolucion = $data['fecha_resolucion'];
            $act_eco_principal = $data['act_eco_principal'];
            $act_ind_comercio = $data['act_ind_comercio'];
            $tarifa_mil = $data['tarifa_mil'];
            $tarifa_retencion = $data['tarifa_retencion'];
            $res_fiscal = $data['res_fiscal'];
            $empresa = $data['empresa'];
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">
        <strong>Aún no a ingresado información tributaria para ésta empresa, puede hacerlo en estos campos. <i class="fa-solid fa-arrow-down"></i>
        </strong>
      </div>';
    }

?>

    <style>
        .lista-res-fiscal li {
            list-style: none;
        }
    </style>

    <form action="" id="formInfoTributaria" method="POST" enctype="multipart/form-data">

        <div class="text-center" style="width: 50%;background:#F6EDF9;padding:5px;border-radius:5px;font-weight: 800;margin:auto;">
            Empresa: <?= $nombre_empresa['nombre_comercial'] ?></h5>
        </div>

        <input type="hidden" name="empresa" id="empresa" value="<?= $id ?>">

        <div class="text-center mt-4" style="width: 100%;background:#F0F8F4;padding:5px;border-radius:5px;font-weight: 800;">
            Información Tributaria</h5>
        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <label for="">Número de Resolución:</label>
                <input type="text" class="form-control" name="numresolucion" id="numresolucion" value="<?= $num_resolucion ?>" required>
            </div>
            <div class="col-md-3">
                <label for="">Fecha de Resolución:</label>
                <input type="date" class="form-control" name="fecharesolucion" id="fecharesolucion" value="<?= $fecha_resolucion ?>" required>
            </div>
            <div class="col-md-3">
                <label for="">Cod. Actividad Económica Principal:</label>
                <select class="form-control" name="codactividad" id="codactividad" style="width: 100% !important;">
                    <option value="">SELECCIONA:</option>
                    <?php

                    $sql = "SELECT id, descripcion FROM codigo_actividad_economicas";

                    $rest = mysqli_query($conetar, $sql);

                    while ($data = mysqli_fetch_array($rest)) {

                        if ($act_eco_principal == $data['id']) {

                    ?>

                            <option value="<?= $data['id'] ?>" selected><?= $data['descripcion'] ?></option>

                        <?php
                        } else {

                        ?>
                            <option value="<?= $data['id'] ?>"><?= $data['descripcion'] ?></option>
                    <?php

                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Cod. Actividad Industria Comercio:</label>
                <select class="form-control" name="codactividad2" id="codactividad2" style="width: 100% !important;" required>
                    <option value="">SELECCIONA:</option>
                    <?php

                    $sql = "SELECT id, descripcion FROM codigo_actividad_economicas";

                    $rest = mysqli_query($conetar, $sql);

                    while ($data = mysqli_fetch_array($rest)) {

                        if ($act_eco_principal == $data['id']) {

                    ?>

                            <option value="<?= $data['id'] ?>" selected><?= $data['descripcion'] ?></option>

                        <?php
                        } else {

                        ?>
                            <option value="<?= $data['id'] ?>"><?= $data['descripcion'] ?></option>
                    <?php

                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="text-center mt-4" style="width: 100%;background:#F9F7ED;padding:5px;border-radius:5px;font-weight: 800;">
                    Tarifas y Retenciones</h5>
                </div>

                <div class="row mt-4">
                    <div class="col-md-5">
                        <label for="">Tarifa Por Mil:</label>
                        <select class="form-control" name="tarifamil" id="tarifamil">
                            <option value="" selected disabled></option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">Tarifa Retención:</label>
                        <select class="form-control" name="tarifaretencion" id="tarifaretencion" style="width: 100% !important;" required>
                            <option value=""></option>
                            <?php

                            $sql = "SELECT id, descripcion FROM tarifas_para_retencion";

                            $rest = mysqli_query($conetar, $sql);

                            while ($data = mysqli_fetch_array($rest)) {

                                if ($act_eco_principal == $data['id']) {

                            ?>

                                    <option value="<?= $data['id'] ?>" selected><?= $data['descripcion'] ?></option>

                                <?php
                                } else {

                                ?>
                                    <option value="<?= $data['id'] ?>"><?= $data['descripcion'] ?></option>
                            <?php

                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-4 text-center" style="width: 100%;background:#EDF4F9;padding:5px;border-radius:5px;font-weight: 800;">
                    Responsabilidad Fiscal</h5>
                </div>

                <div class="row mt-4">
                    <ul class="lista-res-fiscal">
                        <?php

                        $sql = "SELECT id, descripcion FROM res_fiscal";

                        $rest = mysqli_query($conetar, $sql);

                        $idsGuardados = explode(',', $res_fiscal);

                        while ($data = mysqli_fetch_array($rest)) {

                            $checked = in_array($data['id'], $idsGuardados) ? 'checked' : '';

                        ?>
                            <li><span>
                                    <input type="checkbox" name="resfiscal[]" id="resfiscal<?= $data['id'] ?>" value="<?= $data['id'] ?>" <?= $checked ?>>
                                    <?= $data['descripcion'] ?>
                                </span></li>
                            <li>
                            <?php
                        }
                            ?>

                    </ul>
                </div>
            </div>
        </div>

        <input type="hidden" name="r_fiscal" id="r_fiscal" value="">

        <div class="col-md-12 text-right mt-5">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                <button class="btn btn-primary btn-sm"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {

        $('#codactividad').select2({
            language: "es",
            disabled: false
        });

        $('#codactividad').select2({
            language: "es",
            disabled: false
        });

        $('#codactividad2').select2({
            language: "es",
            disabled: false
        });
    })

    $(document).ready(function() {

        var opcionesSeleccionadas = [];

        // Escucha el evento change de los checkboxes
        $('input[type="checkbox"]').change(function() {
            opcionesSeleccionadas = [];

            // Recorre los checkboxes marcados y agrega sus valores al array
            $('input[type="checkbox"]:checked').each(function() {
                opcionesSeleccionadas.push($(this).val());
            });

            // Puedes usar el array opcionesSeleccionadas según tus necesidades
            $('#r_fiscal').val(opcionesSeleccionadas);

        });
    })

    $(document).ready(function() {

        $.validator.setDefaults({
            submitHandler: function() {

                $.ajax({
                    type: 'POST',
                    url: '/cw3/conlabweb3.0/apps/empresas/crud.php?aux=13',
                    data: $('#formInfoTributaria').serialize(),
                    success: function(respuesta) {
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "¡Registro Exitoso!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('.content-info-tributaria').load('/cw3/conlabweb3.0/apps/empresas/info-tributaria.php', {
                            id: <?= $empresa ?>
                        })
                        //alert("¡Registro Exitoso!");
                    }
                });

            }
        });
        $('#formInfoTributaria').validate({
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