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

$numero_orden = "";
$estado_ingreso = "";
$id_paciente = "";

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);

if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo json_encode(['error' => $error]);
} else {


    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = 0;
        }
    } else {
        $id = 0;
    }


    if ($id != "") {
        $cadena = "SELECT numero_orden, estado_ingreso, id_paciente FROM ingreso WHERE idingreso = '" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $numero_orden = trim($filaP2['numero_orden']);
            if ($filaP2['estado_ingreso'] == 'PA') {
                $estado_ingreso = "Pre-Admitido";
            }
            $id_paciente = trim($filaP2['id_paciente']);
        }
    }

    //echo $numero_orden;
}
?>

<style>
    #modal-info .modal-dialog {
        max-width: 600px !important;
        /* Ajusta el valor según tus necesidades */
    }

    #modal-info textarea {
        font-size: 11px;
        height: 200px;
        border: none;
        width: 100%;
        background-color: rgb(238, 238, 238);
    }

    .slide-text {
        overflow-x: hidden;
        overflow-y: auto;
        max-height: 150px;
        /* Ajusta la altura máxima según tus necesidades */
    }

    /* Estilos para WebKit (Chrome, Safari) */
    .slide-text::-webkit-scrollbar {
        width: 12px;
    }

    .slide-text::-webkit-scrollbar-thumb {
        background-color: #808080;
        /* Color del "pulgar" de la barra de desplazamiento (gris) */
        border-radius: 10px;
        /* Radio de borde del "pulgar" */
    }

    .slide-text::-webkit-scrollbar-track {
        background-color: #f1f1f1;
        /* Color de fondo de la barra de desplazamiento */
    }

    .slide-text::-webkit-scrollbar-thumb:hover {
        background-color: #606060;
        /* Cambia el color al pasar el mouse sobre la barra de desplazamiento */
    }
</style>
<form name="form-examen" id="form-examen" action="" method="POST" enctype="multipart/form-data" style="width:100%">
    <input type="hidden" id="aux" name="aux" value="1">
    <input type="hidden" id="numero_orden" name="numero_orden" value="<?php echo $numero_orden; ?>">
    <input type="hidden" id="id_paciente" name="id_paciente" value="<?php echo $id_paciente; ?>">

    <div class="row">
        <div class="col-md-3 col-lg-3">
            <label>Examen</label>
            <select class="form-control" id="id_examen" name="id_examen" required disabled>
                <option selected="true" disabled="disabled"></option>
                <?php
                $cadena = "SELECT id, nombre_examen
                                                    FROM lista_precio";
                $resultadP2a = $conetar->query($cadena);
                $numerfiles2a = mysqli_num_rows($resultadP2a);
                if ($numerfiles2a >= 1) {
                    while ($filaP2a = mysqli_fetch_array($resultadP2a)) {
                        echo "<option value='" . trim($filaP2a['id']) . "'";

                        echo '>' . $filaP2a['nombre_examen'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>


        <div class="col-md-2 col-lg-2">
            <label>Prioridad</label>
            <select class="form-control" id="prioridad" name="prioridad" required disabled>
                <option selected="true" disabled="disabled"></option>
                <option value="1">Rutina</option>
                <option value="2">Urgente</option>
                <option value="3">Asap</option>
            </select>
        </div>
        <div class="col-md-2 col-lg-2">
            <label>Tipo muestra variable:</label>
            <select class="form-control" id="tp_muestra" name="tp_muestra">
                <option selected="true" disabled="disabled"></option>
                <option value="1">Abceso anorectal</option>
            </select>
        </div>
        <div class="col-md-2 col-lg-2">
            <label>Exámen estímulo:</label>
            <select class="form-control" id="examen_estimulo" name="examen_estimulo">
                <option selected="true" disabled="disabled"></option>
                <option value="1">Abceso anorectal</option>
            </select>
        </div>
        <!--<div class="col-md-3 col-lg-3">
                <label>Observaciones</label>
                <textarea class="form-control" id="observacion" name="observacion" disabled></textarea>
            </div>-->
        <div class="col-md-2 col-lg-2 mt-4">

            <button type="submit" class="btn btn-info" id="btnagregar"> Agregar </button>
        </div>
    </div>
</form>
<hr class="dotted">
<div class="row mb-3">
    <div class="col-md-6 col-lg-6 mt-4">
        <div id="idtotal">
            <label id="lblttl">Total Examenes:&nbsp;<span class="badge badge-pill badge-danger" id="ttlspan"></span></label>&nbsp;&nbsp;&nbsp;<label id="lblttl">Valor Total Examen<span id="ttlvlr">&nbsp;</span></label>
        </div>
    </div>
    <div class="col-md-6 col-lg-6" style="text-align:center;">
        <div class="container " id="divstatus" style="border: 1px dotted; width:20%;padding:1px;">
            <label>Estado del Paciente:</label>
            <span class="badge badge-warning"><?php echo $estado_ingreso ?></span>
        </div>
    </div>
</div>

<div class="slide-text">
    <table class="table table-striped table-hover table-head-fixed text-nowrap table-sm tabla-examen" style="margin-top: 2px;">
        <thead>
            <tr>
                <th style="text-align:center;">Cod. Cups</th>
                <th style="text-align:left;">Examen</th>
                <th style="text-align:left;">Prioridad</th>
                <th>Valor</th>
                <th>Observaciones</th>
                <th style="text-align:center;">Acciones</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<div class="row mt-3">
    <div class="col-md-1 col-lg-1 mt-4">
        <input type="button" class="btn btn-info" style="display: none;" id="btndocumentos" value="Documentos">
    </div>
    <div class="col-md-6 col-lg-6">
        <label style="display: none;">Documento Pendiente por Entregar</label>
        <input type="input" style="display: none;" class="form-control">
    </div>
    <div class="col-md-4 col-lg-4" style="text-align:center;">
        <label>Enviar Resultados email</label><br>
        <div class="custom-control custom-checkbox" style="display: inline-block; margin-right: 20px;">
            <input type="checkbox">
            <label>Medico</label>
        </div>
        <div class="custom-control custom-checkbox" style="display: inline-block;">
            <input type="checkbox">
            <label>Paciente</label>
        </div>
    </div>
</div>

<div class="row mt-2">

    <div class="card-footer bg-light" style="width:90%;margin:auto;">
        <div class="col-md-12 col-lg-12" style="text-align:right">
            <!--<button disabled type="button" class="btn btn-success" id="btnpago" data-toggle="modal" data-target="#pagosModal" style=" font-size: 12px !important;  width: 65px;padding:3px;color:white;">
                            Pagos
                            &nbsp; <i class="fa-solid fa-sack-dollar"></i>
                        </button>-->
            <!--<a href="#contentPagos" onclick="pagosSend(<?php echo $numero_orden; ?>, <?php echo $id_paciente; ?>)" type="button" class="btn btn-success" id="btnpago" style=" font-size: 12px !important;  width: 65px;padding:3px;color:white;" disabled>
                Pagos
                &nbsp; <i class="fa-solid fa-sack-dollar"></i>
            </a>
            <button type="button" class="btn btn-primary" id="btnpiegpag" data-toggle="modal" data-target="#modalDomicilios">
                Domicilios <span class="badge badge-light">0</span>
            </button>-->
            <button type="button" class="btn btn-primary" id="btnpiegpag">
                Mensajes <span class="badge badge-light">0</span>
            </button>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="    background-color: rgb(0, 188, 212) !important;
    color: white;">
                <h8 class="modal-title" id="exampleModalLabel">Requisitos Examen</h8>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-6 ml-auto"><label>Requisitos del Paciente</label><textarea>Se sugiere Recolectar muestra de orina al final de la jornada laboral y mejor a finales de la semana laboral.</textarea></div>
                            <div class="col-md-6 ml-auto"><label>Requisitos de la Muestra</label><textarea>Orina al azar: 30 mL. Enviar en frasco bien cerrado</textarea></div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {

        $('.content-table').load('https://cw3.tierramontemariana.org/apps/ingresopaciente/table-domicilios.php');

        miDataTable = $('.tabla-examen').DataTable({
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
                url: 'https://cw3.tierramontemariana.org/apps/ingresopaciente/tabla-examen.php', // Página PHP que devuelve los datos en formato JSON
                type: 'GET', // Método de la petición (GET o POST según corresponda)
                dataType: 'json', // Tipo de datos esperado en la respuesta
                dataSrc: '', // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                data: function(d) {

                    d.numero_orden = $('#numero_orden').val();
                    d.id_paciente = $('#id_paciente').val();

                }, // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
            },
            "columns": [{
                    "data": "codigo_cups"
                },
                {
                    "data": "nombre_examen"
                },
                {
                    "data": "estado",
                    "render": function(data, type, full, meta) {
                        var estadoText = "";

                        if (data === "2") {
                            estadoText = '<span class="badge badge-danger" style="font-size: 12px;">Urgente</span>';
                        } else if (data === "1") {
                            estadoText = '<span class="badge badge-success" style="font-size: 12px;">Rutina</span>';
                        } else if (data === "3") {
                            estadoText = '<span class="badge badge-info" style="font-size: 12px;">Asap</span>';
                        }

                        return estadoText;
                    }
                },
                {
                    "data": "valor",
                    "render": function(data, type, row, meta) {
                        // Formatea el valor con puntos y sin decimales
                        return '$' + parseFloat(data).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    }
                },
                {
                    "data": "observacion"
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        var editarLink = '<a href="#"  data-toggle="modal" data-target="#modal-info"style="color: #E8A200;" title="Informacion"><i style="font-size:15px;" id="icon" class="fa-solid fa-circle-info"></i><span></span></a>';
                        var borrarLink = '<a href="#" onclick="borrarExamen(' + full.codigo + ');" data-toggle="modal" style="color: #CE2222;" title="Eliminar"><i id="icon" style="font-size:15px;" class="fa-solid fa-trash-can"></i><span></span></a>';
                        return editarLink + ' ' + borrarLink;
                    }
                }
            ],
            "initComplete": function(settings, json) {
                // Accede al API de DataTable para obtener el número de registros
                var registros = miDataTable.rows().count();

                // Actualiza el contenido del span con el id "ttlspan"
                $("#ttlspan").text(registros);

                // Calcula el valor total sumando los valores de la columna "valor"
                var valorTotal = miDataTable.column(3).data().reduce(function(acc, val) {
                    return acc + parseFloat(val);
                }, 0);

                // Actualiza el contenido del span con el id "ttlvlr"
                $("#ttlvlr").text(' $' + valorTotal.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, "."));

            },
            "drawCallback": function(settings) {
                // Se llama después de cada redibujado de la tabla
                // Accede al API de DataTable para obtener el número de registros
                var registros = miDataTable.rows().count();

                // Actualiza el contenido del span con el id "ttlspan"
                $("#ttlspan").text(registros);

                // Calcula el valor total sumando los valores de la columna "valor"
                var valorTotal = miDataTable.column(3).data().reduce(function(acc, val) {
                    return acc + parseFloat(val);
                }, 0);

                // Actualiza el contenido del span con el id "ttlvlr"
                $("#ttlvlr").text(' $' + valorTotal.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, "."));

            }

        });


    });
    $(document).ready(function() {
        $('#id_examen').select2({
            language: "es"
        });
        $('#tip_muestra').select2({
            language: "es"
        });
        $('#estimulo').select2({
            language: "es"
        });
        $('#prioridad').select2({
            language: "es"
        });

    });


    function agregarExamen() {
        $.ajax({
            type: 'POST',
            url: 'https://cw3.tierramontemariana.org/apps/ingresopaciente/agregar-paciente.php',
            data: $('#form-examen').serialize(),
            success: function(data) {
                // Recargar DataTable con nuevos datos
                miDataTable.ajax.reload();
                $('#pagos').load('https://cw3.tierramontemariana.org/apps/ingresopaciente/view-pagos.php', {
                    numero_orden: <?php echo $numero_orden; ?>
                });

                Swal.fire({
                    icon: 'success',
                    title: '¡Satisfactorio!',
                    text: '¡Agregado con Éxito!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    timer: 1500,
                });

                if (data == 1) {
                    Swal.fire({
                        icon: 'danger',
                        title: '¡Atención!',
                        text: '¡Este exámen ya está agregado!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                        timer: 1500,
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Satisfactorio!',
                        text: '¡Agregado con Éxito!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                        timer: 1500,
                    });
                }
            }
        });
    }


    function borrarExamen(id) {
        Swal.fire({
            title: "¿Estas seguro?",
            text: "No se puede revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Borralo!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'https://cw3.tierramontemariana.org/apps/ingresopaciente/agregar-paciente.php',
                    data: {
                        id: id,
                        aux: 2
                    },
                    success: function(data) {
                        cargarDatos();
                        Swal.fire({
                            title: "¡Borrado!",
                            text: "Tu archivo ha sido borrado",
                            icon: "success"
                        });

                    },
                    error: function(xhr, status, error) {
                        // Manejar errores si es necesario
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: 'Hubo un problema al eliminar.',
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK',
                            cancelButtonText: 'Cancelar'
                        })
                    }
                });

            }
        });


    }

    $(document).ready(function() {
        $.validator.setDefaults({
            submitHandler: function() {

                agregarExamen();



            }
        });
        $('#form-examen').validate({
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
    });


    function cargarDatos() {
        $.ajax({
            url: 'https://cw3.tierramontemariana.org/apps/ingresopaciente/tabla-examen.php', // Página PHP que devuelve los datos en formato JSON
            type: 'GET', // Método de la petición (GET o POST según corresponda)
            dataType: 'json', // Tipo de datos esperado en la respuesta
            success: function(data) {
                // Limpiar el DataTable y cargar los nuevos datos
                miDataTable.clear().rows.add(data).draw();
            },
            error: function(xhr, status, error) {
                // Manejar errores si es necesario
                console.error('Error al obtener datos:', status, error);
            }
        });
    }

    function pagosSend(numero_orden, id_paciente) {

        $('#pagos').load('https://cw3.tierramontemariana.org/apps/ingresopaciente/view-pagos.php', {
            numero_orden: numero_orden,
            id_paciente: id_paciente
        });
    }

    $('#contentModalDomicilios').load('https://cw3.tierramontemariana.org/apps/ingresopaciente/modal-domicilios.php', {
        idpac: <?php echo $id_paciente; ?>,
        numorden: <?php echo $numero_orden; ?>,
    });

</script>