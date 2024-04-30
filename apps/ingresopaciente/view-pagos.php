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
    echo json_encode(['error' => $error]);
} else {

    $num_orden = "";

    if (isset($_REQUEST['numero_orden'])) {
        $num_orden = $_REQUEST['numero_orden'];
    }

    $sql = "SELECT id, id_paciente, SUM(valor) AS valor_pago, numero_orden FROM examen_temp WHERE numero_orden =  '$num_orden'";

    //echo $sql;

    $rest = mysqli_query($conetar, $sql);

    while ($data = mysqli_fetch_array($rest)) {
        $valor_pago = $data['valor_pago'];
        $id_paciente = $data['id_paciente'];
    }
}

?>

<!--<div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">N° Identificación:</label>
                                        <input type="text" class="form-control" name="numide" id="numide">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Nombre Completo:</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre">
                                    </div>
                                </div>
                            </div>
                        </div>-->
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-req-fact">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Requisito Facturación</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!--<div class="col-md-6" style="text-align: right !important;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Centro Ingreso:</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Médico:</label>
                                            <select name="medico" id="medico" class="form-control"></select>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="">Empresa:</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Plan:</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>-->
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <strong>Conceptos a Facturar</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Tipo Servicio:</label>
                        <select name="" id="" class="form-control"></select>
                    </div>
                    <div class="col-md-3">
                        <label for="">Valor Servicio:</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Cantidad unidades:</label>
                        <input type="number" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-3" style="margin-top: 28px;">
                        <button type="button" class="btn btn-primary btn-sm" style="border-radius: 20px;">Agregar</button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label for="">Exámenes Rutina <span class="badge badge-secondary">1</span></label>
                        <label for="">Exámenes Especiales <span class="badge badge-secondary">0</span></label>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Valor Concepto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="row">
                    <div class="col-md-12" style="text-align: left;">
                        <label for="">Total concepto: <span class="badge badge-secondary">$0</span></label>
                        <br><label for="">Valor Exámenes: <span class="badge badge-secondary">$<?php echo $valor_pago; ?></span></label>
                        <hr>
                        <label for="">Valor Pagar Empresa: <span class="badge badge-secondary">$0</span></label>
                        <br><label for="">Valor Pagar Paciente: <span class="badge badge-secondary">$<?php echo $valor_pago; ?></span></label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <strong>Detalles de Pago</strong>
            </div>
            <div class="card-body">

                <form name="form-detalle-pago" id="form-detalle-pago" action="" method="POST" enctype="multipart/form-data" style="width: 100%;">
                    <input type="hidden" id="numero_orden" name="numero_orden" value="<?php echo $num_orden; ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Forma de Pago:<span style="color: red;">*</span></label>
                            <select name="formapago" id="formapago" class="form-control" required>
                                <option value="" disabled selected>SELECCIONA:</option>
                                <option value="1">Efectivo</option>
                                <option value="2">Tajeta débito</option>
                                <option value="3">Transferecnia</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Tipo Tarjeta:</label>
                            <select name="tipotarjeta" id="tipotarjeta" class="form-control" disabled></select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Doc:</label>
                            <input type="text" name="doc" id="doc" class="form-control" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="">Valor:<span style="color: red;">*</span></label>
                            <input type="text" name="valor" id="valor" class="form-control" required disabled>
                        </div>
                        <div class="col-md-2" style="margin-top: 28px;">
                            <button type="submit" class="btn btn-primary btn-sm" style="border-radius: 20px;">Agregar</button>
                        </div>
                    </div>
                </form>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <table class="table" id="tableDetallePago">
                            <thead>
                                <tr>
                                    <th>Fecha Ingreso</th>
                                    <th>Forma de Pago</th>
                                    <th>Documento</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Saldo:</strong></td>
                                    <td><strong style="color:red;">$<?php echo $valor_pago; ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>



</div>
<div class="card-footer">
    <form name="formSavePago" id="formSavePago" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="numorden_pago" id="numorden_pago" value="<?php echo $num_orden; ?>">
        <input type="hidden" name="tipo_pago" id="tipo_pago">
        <input type="hidden" name="valor_pago" id="valor_pago">
        <input type="hidden" name="fecha_ingreso" id="fecha_ingreso">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4 text-right">
                <button type="button" class="btn btn-primary" id="btnpiegpag" data-toggle="modal" data-target="#modalDomicilios">
                    Domicilios <span class="badge badge-light">0</span>
                </button>
                <button type="button" class="btn btn-primary btn-sm" onclick="setDetallePago()">Grabar</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {

        miDataTablePago = $('#tableDetallePago').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
            },
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": false,
            "ajax": {
                url: 'https://conlabweb3.tierramontemariana.org/apps/ingresopaciente/get-pago.php?numorden=<?php echo $num_orden; ?>', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '', // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                data: function(d) {

                }, // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
            },
            "columns": [{
                    "data": "fecha_ingreso",
                    "render": function(data, type, full, meta) {
                        return full.fecha_ingreso;
                        $('#fecha_ingreso').val(full.fecha_ingreso)
                    }
                },
                {
                    "data": "forma_pago",
                    "render": function(data, type, full, meta) {
                        if (full.forma_pago == 1) {
                            return 'Efectivo';
                        } else if (full.forma_pago == 2) {
                            return 'Tarjeta débito';
                        }
                        $('#tipo_pago').val(full.forma_pago)
                    }
                },
                {
                    "data": "documento",
                    "render": function(data, type, full, meta) {
                        if (full.documento == "") {
                            return '';
                        } else {
                            return full.documento;
                        }
                    }
                },
                {
                    "data": "valor",
                    "render": function(data, type, full, meta) {
                        return full.valor;
                        $('#valor_pago').val(full.valor)
                    }
                },

            ],
        });

        $('#formapago').change(function() {
            $('#valor').prop('disabled', false);
        })

    });
    $(document).ready(function() {
        $.validator.setDefaults({
            submitHandler: function() {

                $.ajax({
                    type: 'POST',
                    url: 'https://conlabweb3.tierramontemariana.org/apps/ingresopaciente/send-pago.php',
                    data: $('#form-detalle-pago').serialize(),
                    success: function(data) {
                        // Recargar DataTable con nuevos datos
                        miDataTablePago.ajax.reload();

                        Swal.fire({
                            icon: 'success',
                            title: '¡Satisfactorio!',
                            text: '¡Agregado con Éxito!',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                            timer: 1500,
                        });
                    }
                });

            }
        });
        $('#form-detalle-pago').validate({
            rules: {
                id_examen: {
                    required: true
                },
                prioridad: {
                    required: true
                }
            },
            messages: {
                id_examen: {
                    required: ""
                },
                prioridad: {
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

    function setDetallePago() {
        $.ajax({
            type: 'POST',
            url: 'https://conlabweb3.tierramontemariana.org/apps/ingresopaciente/set-detalle-pago.php',
            data: $('#formSavePago').serialize(),
            success: function(data) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Satisfactorio!',
                    text: '¡Agregado con Éxito!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    timer: 1500,
                });
            }
        });
    }
</script>