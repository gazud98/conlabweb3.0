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

    $cupo = "";
    $cupo_consumido = "";
    $dias_pago = "";
    $estado = "";
    $fecha = "";
    $motivo_cobro = "";
    $empresa = "";

    $sql = "SELECT ef.id, ef.cupo, ef.cupo_consumido, ef.dias_pago, ef.estado, ef.fecha, ef.motivo_cobro, ef.empresa, em.nombre_comercial
    FROM info_economica ef, empresas em WHERE ef.empresa = em.id_empresas AND ef.empresa = '$id'";

    $rest = mysqli_query($conetar, $sql);

    $row = mysqli_num_rows($rest);

    $data = array();

    if ($row != 0) {

        while ($data = mysqli_fetch_array($rest)) {
            $cupo = $data['cupo'];
            $cupo_consumido = $data['cupo_consumido'];
            $dias_pago = $data['dias_pago'];
            $estado = $data['estado'];
            $fecha = $data['fecha'];
            $motivo_cobro = $data['motivo_cobro'];
            $empresa = $data['empresa'];
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">
        <strong>Aún no a ingresado información de cartera para ésta empresa, puede hacerlo en estos campos. <i class="fa-solid fa-arrow-down"></i>
        </strong>
      </div>';
    }

?>


    <form action="" id="formDatosEconomicos" method="POST" enctype="multipart/form-data">

        <div class="text-center" style="width: 100%;background:#F0F8F4;padding:5px;border-radius:5px;font-weight: 800;">
            Empresa: <?= $nombre_empresa['nombre_comercial'] ?></h5>
        </div>

        <input type="hidden" name="empresa" value="<?= $id ?>">

        <div class="row mt-4">
            <div class="col-md-2">
                <label for="">Cupo Crédito:</label>
                <input type="number" class="form-control" name="cupocredito" id="cupocredito" value="<?= $cupo ?>" required>
            </div>
            <div class="col-md-3">
                <label for="">Cupo Consumido Crédito:</label>
                <input type="number" class="form-control" name="cupocredito2" id="cupocredito2" value="<?= $cupo_consumido ?>" required>
            </div>
            <div class="col-md-2">
                <label for="">Días de Pago:</label>
                <input type="number" class="form-control" name="diaspago" id="diaspago" value="<?= $dias_pago ?>" required>
            </div>
            <div class="col-md-2">
                <label for="">Estado Cartera:</label>
                <select class="form-control" name="estadocartera" id="estadocartera" required>
                    <option value="" disabled></option>
                    <?php

                    $sql = "SELECT id, descripcion, estado FROM estados_cartera";

                    $rest = mysqli_query($conetar, $sql);

                    while ($element = mysqli_fetch_array($rest)) {

                        if ($estado == $element['id']) {

                    ?>

                            <option value="<?php echo $element['id']; ?>" selected><?php echo $element['descripcion']; ?></option>

                        <?php } else {

                        ?>
                            <option value="<?php echo $element['id']; ?>"><?php echo $element['descripcion']; ?></option>
                    <?php

                        }
                    } ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Fecha del Cobro Jurídico:</label>
                <input type="date" class="form-control" name="fechacobro" id="fechacobro" value="<?= $fecha ?>" required>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-3">
                <label for="">Motivo Cobro Jurídico:</label>
                <input type="text" class="form-control" name="motivo" id="motivo" value="<?= $motivo_cobro ?>" required>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        $.validator.setDefaults({
            submitHandler: function() {

                $.ajax({
                    type: 'POST',
                    url: '/cw3/apps/empresas/crud.php?aux=3',
                    data: $('#formDatosEconomicos').serialize(),
                    success: function(respuesta) {
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "¡Registro Exitoso!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('.content-info-cartera').load('https://cw3.tierramontemariana.org/apps/empresas/info-cartera.php', {
                            id: <?= $empresa ?>
                        })
                        //alert("¡Registro Exitoso!");
                    }
                });

            }
        });
        $('#formDatosEconomicos').validate({
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


    function setInfoEconomic() {



    }
</script>