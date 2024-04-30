<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Costos</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- Fullcalendar -->
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <!-- select serach responsive-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Costos</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Costos</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-4" style="display:none">
                                    <label style="font-size:12px;">Sedes del Laboratorio</label>
                                    <div class="input-group mb-4">
                                        <!-- /btn-group -->
                                        <select class="selectpicker" data-live-search="true" data-width="100%" name="search_data_sede" placeholder="Buscar por sede" onchange="sedeCosto(this)">
                                            <option value=" ">General</option>
                                            <?php if (!empty($sedes)) {
                                                foreach ($sedes as $sed => $se) {  ?>
                                                    <option value="<?= $se['id_sedes'] ?>" nombre_sede="<?= $se['name'] ?>"></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label style="font-size:12px;">Examenes Costeados</label>
                                    <div class="input-group mb-4">
                                        <!-- /btn-group -->
                                        <select class="selectpicker" data-live-search="true" data-width="100%" name="search_data_examen" id="search_data_examen" placeholder="Buscar por examen">
                                            <option value="">Seleccione un Examen</option>
                                            <?php if (!empty($examenes)) {
                                                foreach ($examenes as $key => $exa) {  ?>
                                                    <option value="<?= $exa['id_examenes'] ?>"><?= $exa['nombre_examen'] ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3" style="display:none">
                                    <div class="input-group mb-4">
                                        <!-- /btn-group -->
                                        <div class="search-box w-100" style="display: block;">
                                            <label style="font-size:12px;">Periodo Costeado</label>
                                            <input type="month" name="search_data_date" placeholder="Buscar por fecha" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 d-flex align-content-end flex-wrap" style="display:none">
                                    <button id="btn-buscar" class="btn btn-primary btn-block mb-4" onclick="buscar()">Buscar</button>
                                </div>
                            </div>
                            <div class="row" style="display:none">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6>DETALLES GENERALES</h6>
                                            <div class="row" id="detalle-general">
                                                <div class="col-12 col-md-6 col-lg-3">
                                                    <div class="form-group">
                                                        <label style="font-size:12px;">Valor del Examen &nbsp; <br> &nbsp; CONSUMOS </label>
                                                        <input type="number" class="form-control" name="valor_pruebas" placeholder="Ingrese el costo de la prueba">
                                                        <small class="form-text text-muted">Este dato se genera de forma automática del programa de consumos.</small>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-3">
                                                    <div class="form-group">
                                                        <label style="font-size:12px;">Examenes Facturados &nbsp; <br> &nbsp; CONSUMOS </label>
                                                        <input type="number" class="form-control" name="n_examenes" placeholder="Ingrese el número de pruebas">
                                                        <small class="form-text text-muted">Este dato se genera de forma automática del programa de consumos.</small>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label style="font-size:12px;">Promedio de Pruebas facturadas &nbsp; <br> &nbsp; CONTABILIDAD </label>
                                                        <input type="number" class="form-control" name="n_examenes_promedio" placeholder="Ingrese el promedio de Pruebas">
                                                        <small class="form-text text-muted">El Promedio de pruebas es el promedio de todas las pruebas facturadas X mes.</small>
                                                        <input type="hidden" name="costos_productos">
                                                        <input type="hidden" name="costos_indirecto">
                                                        <input type="hidden" name="costo_mano_obra">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-2">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <a class="btn btn-primary btn-block" onclick="calcular()">Recalcular</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-lg-12 ">
                                    <div id="suggestions" class="dropdown-menu text-capitalize w-100" aria-labelledby="dropdownMenuLink" style="display: none;">
                                        <div id="autoSuggestionsList"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="accordion" id="accordionProductos">
                                        <div class="card">
                                            <div class="card-header d-flex" id="headingProductos">
                                                <span class="float-left btn btn-link btn-block text-left">
                                                    <i class="fa fa-flask green"></i> &nbsp;Materia Prima
                                                </span>
                                                <a class="float-right" href="#" data-toggle="collapse" data-target="#collapseProductos" aria-expanded="false" aria-controls="collapseProductos">
                                                    <i class="fa fa-chevron-down"></i>
                                                </a>
                                            </div>
                                            <div id="collapseProductos" class="collapse" aria-labelledby="headingProductos" data-parent="#accordionProductos">
                                                <div class="card-body">
                                                    <button class="btn btn-primary btn-block" style="width:100px;font-size:14px;" id="agregarColumnaBtn">Agregar&nbsp;&nbsp;<i class="fa-solid fa-square-plus"></i></button>

                                                    <table id="tab_materia_prima" class="table table-striped table-bordered table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th><i class="fa-solid fa-user-check"></i></th>
                                                         
                                                                <th>Descripción</th>
                                                                <th class="text-center">Valor</th>
                                                                <td></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>

                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                    
                                                                <td>&nbsp;</td>
                                                                <td style="font-size:16px; font-weight: bold;text-align: right;"><input type="input" id="totalmateria" style="border:none;text-align:center;" value="0"></td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion" id="accordionIndirectos">
                                        <div class="card">
                                            <div class="card-header d-flex" id="headingIndirectos">
                                                <span class="float-left btn btn-link btn-block text-left">
                                                    <i class="fa fa-tags"></i> &nbsp;Costos Indirectos
                                                </span>
                                                <a class="float-right" href="#" data-toggle="collapse" data-target="#collapseIndirectos" aria-expanded="false" aria-controls="collapseIndirectos">
                                                    <i class="fa fa-chevron-down"></i>
                                                </a>
                                            </div>
                                            <div id="collapseIndirectos" class="collapse" aria-labelledby="headingIndirectos" data-parent="#accordionIndirectos">
                                                <div class="card-body">
                                                    <button class="btn btn-primary btn-block" style="width:100px;font-size:14px;" id="agregarColumnaCostosBtn">Agregar&nbsp;&nbsp;<i class="fa-solid fa-square-plus"></i></button>
                                                    <table id="tab_costos_indirectos" class="table table-striped table-bordered table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th><i class="fa-solid fa-user-check"></i></th>
                                                                <th>Motivo Costos</th>
                                                                <th class="text-right">Valor</th>

                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>

                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>

                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td style="font-size:16px; font-weight: bold;text-align: right;"><input type="input" id="total_costos_indirecto" style="border:none;text-align:center;" value="0"></td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion" id="accordionManoObra">
                                        <div class="card">
                                            <div class="card-header d-flex" id="headingManoObra">
                                                <span class="float-left btn btn-link btn-block text-left">
                                                    <i class="fa fa-sign-language"></i> &nbsp; Costos Mano De Obra Directa
                                                </span>
                                                <a class="float-right" href="#" data-toggle="collapse" data-target="#collapseManoObra" aria-expanded="false" aria-controls="collapseManoObra">
                                                    <i class="fa fa-chevron-down"></i>
                                                </a>
                                            </div>
                                            <div id="collapseManoObra" class="collapse" aria-labelledby="headingManoObra" data-parent="#accordionManoObra">
                                                <div class="card-body">
                                                    <button class="btn btn-primary btn-block" style="width:100px;font-size:14px;" id="agregarColumnaManobraBtn">Agregar&nbsp;&nbsp;<i class="fa-solid fa-square-plus"></i></button>
                                                    <table id="tab_mano_obra" class="table table-striped table-bordered table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th><i class="fa-solid fa-user-check"></i></th>
                                                                <th>Cargo</th>
                                                                <th class="text-right">Tiempo de la Prueba</th>
                                                                <th class="text-right">Salario</th>

                                                                <td>&nbsp;</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>


                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>

                                                                <td style="font-size:16px; font-weight: bold;text-align: right;"><input type="input" id="total_mano_obra" style="border:none;text-align:center;" value="0"></td>
                                                                <td>&nbsp;</td>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12 mt-4">
                            <div class="card bg-white radius-10 mt-5">
                                <h4 class="card-header bg-primary"><i class="fa fa-info"></i> &nbsp; Resumen de costos</h4>
                                <div class="card-body">
                                    <form class="p-2">
                                        <div class="form-group row" style="display:none;">
                                            <label class="col-6 col-form-label">Costo del examen</label>
                                            <div class="col-6">
                                                <input name="costo_real" id="costo_real" type="number" readonly class="form-control" min="0" value="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <small class="col-12 text-justify form-text text-muted">Si desea calcular el Costo Incluyendo los gastos Administrativos,
                                                Digite la Cifra de este rubro aquí</small>
                                            <div class="col-lg-6">
                                                <input name="costo_administrativo" id="costo_administrativo" type="number" class="form-control" min="0" value="0">
                                            </div>
                                            <div class="col-lg-6">
                                                <a class="btn btn-primary btn-block" onclick="calcular()">Recalcular</a>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-6 col-form-label text-justify">Costo total</label>
                                            <div class="col-lg-6">
                                                <input name="costo_examen_final" id="costo_examen_final" type="number" readonly class="form-control" min="0" value="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <a class="btn btn-primary btn-block" onclick="calcular()">Recalcular</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            <div class="modal fade show" id="modal-default" aria-modal="true" role="dialog">
                <div class="modal-dialog"></div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <div id="editmodal" class="modal fade show" aria-modal="true" role="dialog">

            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formeditar" action="#" method="POST">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Costo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body" id="modalshow">

                        </div>
                        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="E">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-success" data-dismiss="modal" onclick="editar()" value="Aceptar">Aceptar</button>
                        </div>
                </div>
            </div>
        </div>
        <div id="editmodalmateria" class="modal fade show" aria-modal="true" role="dialog">

            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formeditar" action="#" method="POST">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Materia Prima</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body" id="modalshowmateria">

                        </div>
                        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="E">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-success" data-dismiss="modal" onclick="editarmateria()" value="Aceptar">Aceptar</button>
                        </div>
                </div>
            </div>
        </div>

        <div id="editmodalmanobra" class="modal fade show" aria-modal="true" role="dialog">

            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formeditar" action="#" method="POST">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Mano Obra</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body" id="modalshowmanobra">

                        </div>
                        <input type="hidden" name="modeeditstatus" id="modeeditstatus" value="E">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" value="Cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-success" data-dismiss="modal" onclick="editarmanobra()" value="Aceptar">Aceptar</button>
                        </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery UI -->
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- AdminLTE App -->
        <script src="assets/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="assets/dist/js/demo.js"></script>

        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

        <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
        <script>
            function sedeCosto(sel) {
                var id = $('option:selected', sel).attr('value');
                var nom_sede = $('option:selected', sel).attr('nombre_sede');
                $('#sedenom').val(nom_sede);
            }
            $(document).ready(function() {
                miDataTable = $('#tab_materia_prima').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                    },
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": false,
                    "info": false,
                    "autoWidth": false,
                    "responsive": false,
                    "ajax": {
                        url: '/cw3/conlabweb3.0/apps/costos/mostrar.php', // Página PHP que devuelve los datos en formato JSON
                        type: 'GET', // Método de la petición (GET o POST según corresponda)
                        dataType: 'json', // Tipo de datos esperado en la respuesta
                        dataSrc: '', // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                        data: function(d) {
                            // Agrega parámetros personalizados aquí

                            d.examen = $("select[name='search_data_examen']").val();

                        },
                    },
                    "columns": [{
                            "data": null,
                            "render": function(data, type, full, meta) {
                                return '<input type="checkbox" onclick="seleccionarmateria(' + full.thefile + ')" name="fileselectmp" id="fileselectmp' + full.thefile + '" costo_materia="' + full.valor + '"  value="' + full.codigo + '">';
                            }

                        }, {
                            "data": "descripcion"
                        },
                        {
                            "data": "valor"
                        },
                        {
                            "data": null,
                            "render": function(data, type, full, meta) {
                                var editarLink = '<a href="#" onclick="accionesMateria(' + full.codigo + ', \'E\', ' + full.thefile + ');" data-target="#editmodalmateria" data-toggle="modal"  id="edit' + full.thefile + '" style="color: #E8A200;" title="Editar"><i style="font-size:18px;" id="icon" class="fa-solid fa-pen-to-square"></i><span></span></a>';

                                var borrarLink = '<a href="#" onclick="accionesMateria(' + full.codigo + ', \'B\', ' + full.thefile + ');" id="borrar' + full.thefile + '" style="color: #E8A200;" title="Borrar"><i style="font-size:18px;color: #CE2222;"  id="icon" class="fa-solid fa-trash-can"></i><span></span></a>';


                                return editarLink + ' ' + borrarLink;
                            }
                        }
                    ]
                });
                $('#btn-buscar').click(function() {
                    miDataTable.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
                });
            });

            $(document).ready(function() {
                miDataTable2 = $('#tab_costos_indirectos').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                    },
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": false,
                    "info": false,
                    "autoWidth": false,
                    "responsive": false,
                    "ajax": {
                        url: '/cw3/conlabweb3.0/apps/costos/mostrarcostos.php', // Página PHP que devuelve los datos en formato JSON
                        type: 'GET', // Método de la petición (GET o POST según corresponda)
                        dataType: 'json', // Tipo de datos esperado en la respuesta
                        dataSrc: '', // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                        data: function(d) {
                            // Agrega parámetros personalizados aquí
                            d.sede = $("select[name='search_data_sede']").val();
                            d.examen = $("select[name='search_data_examen']").val();
                            d.date = $("input[name='search_data_date']").val();
                        },
                    },
                    "columns": [{
                            "data": null,
                            "render": function(data, type, full, meta) {
                                return '<input type="checkbox" onclick="seleccionar(' + full.thefile + ')" name="fileselectc" id="fileselectc' + full.thefile + '" costo_examen="' + full.valor + '"  value="' + full.codigo + '">';
                            }
                        },
                        {
                            "data": "motivo_costo"
                        },
                        {
                            "data": "valor"
                        },
                        {
                            "data": null,
                            "render": function(data, type, full, meta) {
                                var editarLink = '<a href="#" onclick="acciones(' + full.codigo + ', \'E\', ' + full.thefile + ');" data-target="#editmodal" data-toggle="modal"  id="edit' + full.thefile + '" style="color: #E8A200;" title="Editar"><i style="font-size:18px;" id="icon" class="fa-solid fa-pen-to-square"></i><span></span></a>';

                                var borrarLink = '<a href="#" onclick="acciones(' + full.codigo + ', \'B\', ' + full.thefile + ');" id="borrar' + full.thefile + '" style="color: #E8A200;" title="Borrar"><i style="font-size:18px;color: #CE2222;"  id="icon" class="fa-solid fa-trash-can"></i><span></span></a>';


                                return editarLink + ' ' + borrarLink;
                            }
                        }
                    ],
                    /*    "footerCallback": function(row, data, start, end, display) {
                            var api = this.api();


                            // Calcular el total para la columna "costo_prueba"
                            var totalCostoExamen = api.column(3, {
                                    page: 'current'
                                }).data()
                                .reduce(function(a, b) {
                                    return parseInt(a) + parseInt(b);
                                }, 0);

                            // Agregar los totales al footer

                            $('#total_costos_indirecto').val(totalCostoExamen.toFixed(3));
                        }*/
                });
                $('#btn-buscar').click(function() {
                    miDataTable2.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
                });
            });

            function seleccionarmateria() {
                var sumtotalm = 0;

                $('[id^="fileselectmp"]').each(function() {
                    if ($(this).prop("checked")) {
                        var costo_materia = parseFloat($(this).attr('costo_materia'));
                        if (!isNaN(costo_materia)) {
                            sumtotalm += costo_materia;
                        }
                    }
                });

                $("#totalmateria").val(sumtotalm);
            }

            function seleccionar() {
                var sumtotalc = 0;

                $('[id^="fileselectc"]').each(function() {
                    if ($(this).prop("checked")) {
                        var costo_examen = parseFloat($(this).attr('costo_examen'));
                        if (!isNaN(costo_examen)) {
                            sumtotalc += costo_examen;
                        }
                    }
                });

                $("#total_costos_indirecto").val(sumtotalc);
            }



            function seleccionarmanobra() {
                var sumtotal = 0;

                $('[id^="fileselectmo"]').each(function() {
                    if ($(this).prop("checked")) {
                        var costo_examen = parseFloat($(this).attr('costo_examen'));
                        sumtotal += costo_examen;
                    }
                });

                $("#total_mano_obra").val(sumtotal);
            }




            $(document).ready(function() {
                miDataTable3 = $('#tab_mano_obra').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                    },
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": false,
                    "info": false,
                    "autoWidth": false,
                    "responsive": false,
                    "ajax": {
                        url: '/cw3/conlabweb3.0/apps/costos/mostrarmanobra.php', // Página PHP que devuelve los datos en formato JSON
                        type: 'GET', // Método de la petición (GET o POST según corresponda)
                        dataType: 'json', // Tipo de datos esperado en la respuesta
                        dataSrc: '', // Indicar que los datos provienen directamente del objeto JSON (sin propiedad adicional)
                        data: function(d) {
                            // Agrega parámetros personalizados aquí
                            d.sede = $("select[name='search_data_sede']").val();
                            d.examen = $("select[name='search_data_examen']").val();
                            d.date = $("input[name='search_data_date']").val();
                        },
                    },
                    "columns": [{
                            "data": null,
                            "render": function(data, type, full, meta) {
                                return '<input type="checkbox" onclick="seleccionarmanobra(' + full.thefile + ')" name="fileselectmo" id="fileselectmo' + full.thefile + '" costo_examen="' + full.salario + '"  value="' + full.codigo + '">';
                            }
                        }, {
                            "data": "cargo"
                        }, {
                            "data": "tiempo"
                        },
                        {
                            "data": "salario"
                        },
                        {
                            "data": null,
                            "render": function(data, type, full, meta) {
                                var editarLink = '<a href="#" onclick="accionesManobra(' + full.codigo + ', \'E\', ' + full.thefile + ');" data-target="#editmodalmanobra" data-toggle="modal"  id="edit' + full.thefile + '" style="color: #E8A200;" title="Editar"><i style="font-size:18px;" id="icon" class="fa-solid fa-pen-to-square"></i><span></span></a>';

                                var borrarLink = '<a href="#" onclick="accionesManobra(' + full.codigo + ', \'B\', ' + full.thefile + ');" id="borrar' + full.thefile + '" style="color: #E8A200;" title="Borrar"><i style="font-size:18px;color: #CE2222;"  id="icon" class="fa-solid fa-trash-can"></i><span></span></a>';


                                return editarLink + ' ' + borrarLink;
                            }
                        }
                    ]
                });
                $('#btn-buscar').click(function() {
                    miDataTable3.ajax.reload(); // Recarga los datos de la tabla con los nuevos parámetros
                });
            });

            function cargarDatos() {
                $.ajax({
                    url: '/cw3/conlabweb3.0/apps/costos/mostrar.php', // Página PHP que devuelve los datos en formato JSON
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

            function cargarDatosCostos() {
                $.ajax({
                    url: '/cw3/conlabweb3.0/apps/costos/mostrarcostos.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    success: function(data) {
                        // Limpiar el DataTable y cargar los nuevos datos
                        miDataTable2.clear().rows.add(data).draw();
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores si es necesario
                        console.error('Error al obtener datos:', status, error);
                    }
                });
            }


            function cargarManobra() {
                $.ajax({
                    url: '/cw3/conlabweb3.0/apps/costos/mostrarmanobra.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'GET', // Método de la petición (GET o POST según corresponda)
                    dataType: 'json', // Tipo de datos esperado en la respuesta
                    success: function(data) {
                        // Limpiar el DataTable y cargar los nuevos datos
                        miDataTable3.clear().rows.add(data).draw();
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores si es necesario
                        console.error('Error al obtener datos:', status, error);
                    }
                });
            }

            function calculaRendimiento() {
                valore = $('#valor').val();
                desc = $('#desc').val();
                var valor_pruebas = $('[name="valor_pruebas"]').val();
                var n_examenes = $('[name="n_examenes"]').val();
                var n_examenes_promedio = $('[name="n_examenes_promedio"]').val();
                var sede = $("select[name='search_data_sede']").val();
                var examen = $("select[name='search_data_examen']").val();
                var date = $("input[name='search_data_date']").val();
                var rendimiento = (n_examenes_promedio / n_examenes) * 100;
                var totalvalor = n_examenes_promedio * valor_pruebas;
                $.ajax({
                    url: '/cw3/conlabweb3.0/apps/costos/agregar.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'POST', // Método de la petición (GET o POST según corresponda)
                    data: {
                        valore: valore,
                        desc: desc,
                        valor_pruebas: totalvalor,
                        n_examenes: n_examenes,
                        n_examenes_totales: n_examenes_promedio,
                        sede: sede,
                        examen: examen,
                        date: date,
                        rendimiento: rendimiento,
                        status: 'MP'
                    },
                    success: function(data) {
                        cargarDatos();
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores si es necesario
                        console.error('Error al obtener datos:', status, error);
                    }
                });
            }

            function editar() {
                var ide = $('#idcod').val();
                var motivo_costo = $('#motivo_costo').val();
                var valor = $('#valor').val();
                var n_examenes_promedio = $('[name="n_examenes_promedio"]').val();
                var totalcostos = n_examenes_promedio * valor;
                $.ajax({
                    type: 'POST',
                    url: '/cw3/conlabweb3.0/apps/costos/acciones.php',
                    data: {
                        id: ide,
                        motivo: motivo_costo,
                        valor: valor,
                        totalcostos: totalcostos,
                        caso: 'E',
                        pant: 'C'
                    },
                    success: function(respuesta) {
                        cargarDatosCostos();
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: '¡Registro borrado con exito!',
                            showConfirmButton: false,
                            timer: 1500
                        })

                    }
                });
            }

            function editarmateria() {
                var idmat = $('#idmat').val();
                var descripcion = $('#descripcion').val();
                var valormat = $('#valormat').val();

                $.ajax({
                    type: 'POST',
                    url: '/cw3/conlabweb3.0/apps/costos/acciones.php',
                    data: {
                        idmat: idmat,
                        descripcion: descripcion,
                        valormat: valormat,
                        caso: 'E',
                        pant: 'MP'
                    },
                    success: function(respuesta) {
                        cargarDatos();
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: '¡Registro borrado con exito!',
                            showConfirmButton: false,
                            timer: 1500
                        })

                    }
                });
            }

            function editarmanobra() {
                var idmano = $('#idmano').val();
                var cargo = $('#cargo').val();
                var tiempo = $('#tiempo').val();
                var salario = $('#salario').val();
                $.ajax({
                    type: 'POST',
                    url: '/cw3/conlabweb3.0/apps/costos/acciones.php',
                    data: {
                        idmano: idmano,
                        cargo: cargo,
                        tiempo: tiempo,
                        salario: salario,
                        caso: 'E',
                        pant: 'MO'
                    },
                    success: function(respuesta) {
                        cargarManobra();
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: '¡Registro borrado con exito!',
                            showConfirmButton: false,
                            timer: 1500
                        })

                    }
                });
            }

            function acciones(id, caso, thefile) {

                if (caso == "B") {
                    Swal.fire({
                        text: "¿Desea borrar el registro?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminar!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: '/cw3/conlabweb3.0/apps/costos/acciones.php',
                                data: {
                                    id: id,
                                    caso: 'B',
                                    pant: 'C'
                                },
                                success: function(respuesta) {
                                    cargarDatosCostos();
                                    Swal.fire({
                                        position: 'top',
                                        icon: 'success',
                                        title: '¡Registro borrado con exito!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })

                                }
                            });
                        }
                    })
                } else if (caso == "E") {
                    $('#modalshow').load('/cw3/conlabweb3.0/apps/costos/modal.php', {
                        id: id
                    });




                }
            }

            function accionesMateria(id, caso, thefile) {

                if (caso == "B") {
                    Swal.fire({
                        text: "¿Desea borrar el registro?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminar!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: '/cw3/conlabweb3.0/apps/costos/acciones.php',
                                data: {
                                    idmat: id,
                                    caso: 'B',
                                    pant: 'MP'
                                },
                                success: function(respuesta) {
                                    cargarDatos();
                                    Swal.fire({
                                        position: 'top',
                                        icon: 'success',
                                        title: '¡Registro borrado con exito!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })

                                }
                            });
                        }
                    })
                } else if (caso == "E") {
                    $('#modalshowmateria').load('/cw3/conlabweb3.0/apps/costos/modalmateria.php', {
                        id: id
                    });

                }
            }

            function accionesManobra(id, caso, thefile) {

                if (caso == "B") {
                    Swal.fire({
                        text: "¿Desea borrar el registro?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminar!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: '/cw3/conlabweb3.0/apps/costos/acciones.php',
                                data: {
                                    idmano: id,
                                    caso: 'B',
                                    pant: 'MO'
                                },
                                success: function(respuesta) {
                                    cargarManobra();
                                    Swal.fire({
                                        position: 'top',
                                        icon: 'success',
                                        title: '¡Registro borrado con exito!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })

                                }
                            });
                        }
                    })
                } else if (caso == "E") {
                    $('#modalshowmanobra').load('/cw3/conlabweb3.0/apps/costos/modalmanobra.php', {
                        id: id
                    });

                }
            }

            function calcularCostos() {
                var motivo = $('#motivo').val();
                var valorcosto = $('#valorcosto').val();
                var n_examenes_promedio = $('[name="n_examenes_promedio"]').val();
                var sede = $("select[name='search_data_sede']").val();
                var examen = $("select[name='search_data_examen']").val();
                var date = $("input[name='search_data_date']").val();
                var totalcostos = n_examenes_promedio * valorcosto;
                $.ajax({
                    url: '/cw3/conlabweb3.0/apps/costos/agregar.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'POST', // Método de la petición (GET o POST según corresponda)
                    data: {
                        valorcosto: valorcosto,
                        n_examenes_totales: n_examenes_promedio,
                        sede: sede,
                        examen: examen,
                        date: date,
                        totalcostos: totalcostos,
                        motivo: motivo,
                        status: 'C'
                    },
                    success: function(data) {
                        cargarDatosCostos();
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores si es necesario
                        console.error('Error al obtener datos:', status, error);
                    }
                });
            }

            function calcularManoObra() {
                var cargo = $('#cargo').val();
                var tiempo = $('#tiempo').val();
                var salario = $('#salario').val();
                var n_examenes_promedio = $('[name="n_examenes_promedio"]').val();
                var sede = $("select[name='search_data_sede']").val();
                var examen = $("select[name='search_data_examen']").val();
                var date = $("input[name='search_data_date']").val();
                var totalmanobra = n_examenes_promedio * salario;
                $.ajax({
                    url: '/cw3/conlabweb3.0/apps/costos/agregar.php', // Página PHP que devuelve los datos en formato JSON
                    type: 'POST', // Método de la petición (GET o POST según corresponda)
                    data: {
                        cargo: cargo,
                        tiempo: tiempo,
                        salario: salario,
                        sede: sede,
                        examen: examen,
                        date: date,
                        totalmanobra: totalmanobra,
                        status: 'MO'
                    },
                    success: function(data) {
                        cargarManobra();
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores si es necesario
                        console.error('Error al obtener datos:', status, error);
                    }
                });
            }

            $(document).ready(function() {
                // Función para agregar una columna a la tabla
                function agregarColumna() {
                    // Obtén la tabla por su ID
                    var tabla = $("#tab_materia_prima");

                    // Agrega una nueva fila al cuerpo de la tabla
                    var nuevaFila = '<tr>';
                    nuevaFila += '<td>&nbsp;</td>';
                    nuevaFila += '<td><input type="text" id="desc" value="" style="width:100%"></td>';
                    nuevaFila += '<td class="text-left""><input type="number" id="valor" style="width:100%" value="" style="text-align:right" onchange="calculaRendimiento()"></td>';
                    nuevaFila += '</tr>';

                    tabla.find("tbody").append(nuevaFila);
                }

                // Maneja el clic en el botón "Agregar Columna"
                $("#agregarColumnaBtn").click(function() {
                    agregarColumna();
                });

                function agregarColumnaCostos() {
                    // Obtén la tabla por su ID
                    var tabla = $("#tab_costos_indirectos");

                    // Agrega una nueva fila al cuerpo de la tabla
                    var nuevaFila = '<tr>';
                    nuevaFila += '<td>&nbsp;</td>';
                    nuevaFila += '<td class="text-left""><input type="input" id="motivo" style="width:100%" value="" style="text-align:right" ></td>';
                    nuevaFila += '<td><input type="number" id="valorcosto" value="" style="width:100%" onchange="calcularCostos()"></td>';

                    nuevaFila += '<td>&nbsp;</td>';
                    nuevaFila += '</tr>';

                    tabla.find("tbody").append(nuevaFila);
                }

                $("#agregarColumnaCostosBtn").click(function() {
                    agregarColumnaCostos();
                });

                function agregarColumnaManobra() {
                    // Obtén la tabla por su ID
                    var tabla = $("#tab_mano_obra");

                    // Agrega una nueva fila al cuerpo de la tabla
                    var nuevaFila = '<tr>';
                    nuevaFila += '<td>&nbsp;</td>';
                    nuevaFila += '<td class="text-left""><input type="input" id="cargo" style="width:100%" value="" style="text-align:right" ></td>';
                    nuevaFila += '<td><input type="input" id="tiempo" value="" style="width:100%" </td>';
                    nuevaFila += '<td><input type="number" id="salario" value="" style="width:100%" onchange="calcularManoObra()"></td>';
                    nuevaFila += '</tr>';

                    tabla.find("tbody").append(nuevaFila);
                }

                $("#agregarColumnaManobraBtn").click(function() {
                    agregarColumnaManobra();
                });


            });

            function buscar() {
                var sede = $("select[name='search_data_sede']").val();
                var examen = $("select[name='search_data_examen']").val();
                var date = $("input[name='search_data_date']").val();

                $("select[name='search_data_sede'] option:selected").each(function() {
                    if ($("select[name='search_data_examen']").val() != '' & $("input[name='search_data_date']").val() != '') {
                        get_consumos_by_data(examen, date, sede)
                    }
                });


                var sede = $("select[name='search_data_sede']").val();
                var examen = $("select[name='search_data_examen']").val();
                var date = $("input[name='search_data_date']").val();
                $("select[name='search_data_examen'] option:selected").each(function() {
                    if ($("select[name='search_data_examen']").val() != '' & $("input[name='search_data_date']").val() != '') {
                        get_consumos_by_data(examen, date, sede)
                    }
                });



                var sede = $("select[name='search_data_sede']").val();
                var examen = $("select[name='search_data_examen']").val();
                var date = $("input[name='search_data_date']").val();
                $("input[name='search_data_date']").each(function() {
                    if ($("select[name='search_data_examen']").val() != '' & $("input[name='search_data_date']").val() != '') {
                        get_consumos_by_data(examen, date, sede)
                    }
                });


            }



            function get_consumos_by_data(examen, periodo, sedes = null) {


                $.post("?c=costos&a=get_consumos_by_data", {
                        sedes: sedes,
                        id: examen,
                        date: periodo
                    },
                    function(data) {
                        if (data.status == true) {
                            $('input[name="valor_pruebas"]').val(data.examen_valor)
                            $('input[name="n_examenes"]').val(data.examen_facturados)
                            $('input[name="n_examenes_promedio"]').val(data.totalpruebas)
                        }
                    }, "json");
            }

            function ajaxSearches() {

                var input_data_examen = $('[name="search_data_examen"]').val();
                var input_data_date = $('[name="search_data_date"]').val();
                var input_data_sede = $('[name="search_data_sede"]').val();
                var table = $('#table_materia_prima tbody');
                var table2 = $('#table_costos_indirectos tbody');
                var table3 = $('#table_mano_obra tbody');

                var valor_pruebas = $('[name="valor_pruebas"]');
                var n_examenes = $('[name="n_examenes"]');
                var n_examenes_totales = $('[name="n_examenes_totales"]');


                var costos_productos = $('[name="costos_productos"]');
                var costos_indirecto = $('[name="costos_indirecto"]');
                var costo_mano_obra = $('[name="costo_mano_obra"]');

                var costo_real = $('[name="costo_real"]');
                var costo_administrativo = $('[name="costo_administrativo"]');
                var costo_examen_final = $('[name="costo_examen_final"]');

                $('#suggestions').removeClass('is-invalid');

                if (input_data_examen < 1 || input_data_date == '') {

                    $('#suggestions').hide();

                } else {
                    if (valor_pruebas.val() == '' || n_examenes.val() == '' || n_examenes_totales.val() == '') {

                        if (valor_pruebas.val() == '') {
                            $('#detalle-general input').addClass('is-invalid');
                        } else {
                            $('#detalle-general input').addClass('is-valid');
                        }
                        if (n_examenes.val() == '') {
                            $('#detalle-general input').addClass('is-invalid');
                        } else {
                            $('#detalle-general input').addClass('is-valid');
                        }
                        if (n_examenes_totales.val() == '') {
                            $('#detalle-general input').addClass('is-invalid');
                        } else {
                            $('#detalle-general input').addClass('is-valid');
                        }

                    } else {
                        var post_data = {
                            'examen': input_data_examen,
                            'date': input_data_date,
                            'sede': input_data_sede
                        };

                        $.ajax({
                            type: "POST",
                            url: "?c=costos&a=search_costos",
                            data: post_data,
                            dataType: 'JSON',
                            success: function(data) {

                                if (data.length > 0) {
                                    table.empty();
                                    table2.empty();
                                    table3.empty();
                                    if (data[0].length > 0) {
                                        for (var i = 0; i < data[0].length; i++) {
                                            row = $('<tr></tr>');
                                            var tddescripcion = $('<td></td>').text(data[0][i]['descripcion']);
                                            var tdvalor = $('<td class="text-right"></td>').text('$ ' + data[0][i]['valor']);
                                            var tdrendimiento = $('<td class="text-right"></td>').text(data[0][i]['rendimiento']);
                                            var tdvalexamen = $('<td class="text-right"></td>').text('$ ' + parseInt(data[0][i]['valor'] / n_examenes.val()));
                                            row.append(tddescripcion, tdvalor, tdrendimiento, tdvalexamen);
                                            table.append(row);
                                        }
                                        $('#collapseProductos').collapse('show');
                                    } else {
                                        table.append($('<tr><td colspan ="3">No se encontraron resultados.</td></tr>'));
                                    }
                                    if (data[1].length > 0) {
                                        for (var a = 0; a < data[1].length; a++) {
                                            row2 = $('<tr></tr>');
                                            var tdsede = $('<td></td>').text(data[1][a]['sede'] === undefined ? ' GENERAL ' : data[1][a]['sede']);
                                            var tdcostos = $('<td></td>').text(data[1][a]['descripcion']);
                                            var tdvalor = $('<td class="text-right"></td>').text('$ ' + data[1][a]['valor']);
                                            var tdvalexamen = $('<td class="text-right"></td>').text('$ ' + parseInt(data[1][a]['valor'] / n_examenes_totales.val()));
                                            row2.append(tdsede, tdcostos, tdvalor, tdvalexamen);
                                            table2.append(row2);
                                        }
                                        $('#collapseIndirectos').collapse('show');
                                    } else {
                                        table2.append($('<tr><td colspan ="4">No se encontraron resultados.</td></tr>'));
                                    }
                                    if (data[2].length > 0) {
                                        for (var c = 0; c < data[2].length; c++) {
                                            row3 = $('<tr></tr>');
                                            var tdsede = $('<td></td>').text(data[2][c]['sede'] === undefined ? ' GENERAL ' : data[2][c]['sede']);
                                            var tdcargo = $('<td></td>').text(data[2][c]['cargo']);
                                            var tdsalario = $('<td class="text-right"></td>').text('$ ' + data[2][c]['salario']);
                                            var tdtiempo = $('<td class="text-right"></td>').text(data[2][c]['tiempo_prueba'] + ' MIN');
                                            //Costo por {[( examen salario / Dias laborados ) / horas laborales ] / 60 } * duración de la prueba 
                                            var tdvalexamen = $('<td class="text-right"></td>').text('$ ' + data[2][c]['costo_examen']);
                                            row3.append(tdsede, tdcargo, tdtiempo, tdsalario, tdvalexamen);
                                            table3.append(row3);
                                        }
                                        $('#collapseManoObra').collapse('show');
                                    } else {
                                        table3.append($('<tr><td colspan ="5">No se encontraron resultados.</td></tr>'));
                                    }

                                    sum1 = parseInt(data[3]['valor'] / n_examenes.val());
                                    sum2 = parseInt(data[4]['valor'] / n_examenes_totales.val());
                                    sum3 = parseInt(data[5]['valor']),
                                        sumf1 = parseInt(valor_pruebas.val()) + sum1 + sum2 + sum3;
                                    sumf2 = sumf1 + (parseInt(costo_administrativo.val() / n_examenes_totales.val()));

                                    costos_productos.val(sum1);
                                    $('#total_materia_prima').text(' $ ' + sum1);
                                    costos_indirecto.val(sum2);
                                    $('#total_costos_indirecto').text(' $ ' + sum2);
                                    costo_mano_obra.val(sum3);
                                    $('#total_mano_obra').text(' $ ' + sum3);
                                    $('#total_mano_obra').text(' $ ' + sum3);
                                    costo_real.val(sumf1)
                                    costo_examen_final.val(sumf2)

                                }
                            }
                        });
                    }
                }
            }

            function calcular() {
                var id_examen = $('#search_data_examen').val();
                var totalmateria = $('#totalmateria').val();
                var total_costos_indirecto = $('#total_costos_indirecto').val();
                var costo_administrativo = $('#costo_administrativo').val();
                var total_mano_obra = $('#total_mano_obra').val();

                var resultado = parseInt(total_mano_obra) + parseInt(totalmateria) + parseInt(total_costos_indirecto) + parseInt(costo_administrativo);
                $('#costo_examen_final').val(resultado);



                $('[id^="fileselectmp"]').each(function() {
                    if ($(this).prop("checked")) {
                        // Obtener el código de la fila correspondiente en DataTable
                        var codigo = $(this).val();

                        $.ajax({
                            method: 'POST',
                            url: '/cw3/conlabweb3.0/apps/costos/calculo.php',
                            data:{id_examen:id_examen,codigo:codigo,costo_administrativo:costo_administrativo,tipo:'MT'},
                            type:'JSON',
                            success: function(respuesta) {
                              
                                Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: 'Calculo Generado.',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        })
                    }
                });
                $('[id^="fileselectc"]').each(function() {
                    if ($(this).prop("checked")) {
                        // Obtener el código de la fila correspondiente en DataTable
                        var codigo = $(this).val();

                        $.ajax({
                            method: 'POST',
                            url: '/cw3/conlabweb3.0/apps/costos/calculo.php',
                            data:{id_examen:id_examen,codigo:codigo,costo_administrativo:costo_administrativo,tipo:'CI'},
                            type:'JSON',
                            success: function(respuesta) {
                              
                                Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: 'Calculo Generado.',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        })
                    }
                });
                $('[id^="fileselectmo"]').each(function() {
                    if ($(this).prop("checked")) {
                        // Obtener el código de la fila correspondiente en DataTable
                        var codigo = $(this).val();

                        $.ajax({
                            method: 'POST',
                            url: '/cw3/conlabweb3.0/apps/costos/calculo.php',
                            data:{id_examen:id_examen,codigo:codigo,costo_administrativo:costo_administrativo,tipo:'MO'},
                            type:'JSON',
                            success: function(respuesta) {
                              
                                Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: 'Calculo Generado.',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        })
                    }
                });




            }



            function recalculate() {
                ajaxSearches();
            }
        </script>
</body>

</html>