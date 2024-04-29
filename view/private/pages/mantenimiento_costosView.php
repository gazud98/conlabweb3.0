<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Mantenimiento de Costos</title>
            <!-- Google Font: Source Sans Pro -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
            <!-- Fullcalendar -->
            <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
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
                            <h1>Mantenimiento de Costos</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Mantenimiento de Costos</li>
                            </ol>
                        </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                         <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button id="costos_indirectos" class="btn btn-link btn-block text-left collapsed" onclick="get_datatables('costos_indirectos')" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Valor de Costos Indirectos
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-header">
                                        <div class="btn-group float-right" role="group" aria-label="Basic example">
                                            <button id="button_costos1" type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Crear Valor</button>
                                            <button id="button_costos2" type="button" class="btn btn-secondary btn-sm" onclick="get_datatables('descripcion_costos')"><i class="fa fa-info"></i> Descripciones de Costos </button>
                                        </div>
                                    </div>
                                    <div class="card-body" id="card_costos_indirectos">
                                       <table id="table_costos_indirectos" class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>Año del Costo</th>
                                                    <th>Mes del Costo</th>
                                                    <th>Sede del Costo</th>
                                                    <th>Descripción</th>
                                                    <th>Valor</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>Año del Costo</th>
                                                    <th>Mes del Costo</th>
                                                    <th>Sede del Costo</th>
                                                    <th>Descripción</th>
                                                    <th>Valor</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </tfoot>
                                       </table>
                                    </div>
                                    <div class="card-body d-none"  id="card_descripcion_costos">
                                            <table id="table_descripcion_costos" class="table table-bordered table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Nº</th>
                                                        <th>Descripcion</th>
                                                        <th>Areas Laboratorio</th>
                                                        <th>Costo fijo</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Nº</th>
                                                        <th>Descripcion</th>
                                                        <th>Areas Laboratorio</th>
                                                        <th>Costo fijo</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" onclick="get_datatables('gastos_fijos')" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                          Gastos Fijos
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body" id="card_gastos_fijos">
                                       <table id="table_gastos_fijos" class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>Año del Gasto</th>
                                                    <th>Mes del Gasto</th>
                                                    <th>Sede del Gasto</th>
                                                    <th>Descripción</th>
                                                    <th>Valor</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>Año del Gasto</th>
                                                    <th>Mes del Gasto</th>
                                                    <th>Sede del Gasto</th>
                                                    <th>Descripción</th>
                                                    <th>Valor</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </tfoot>
                                       </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" onclick="get_datatables('mano_obra')" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                          Mano de Obra directa
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body" id="card_mano_obra">
                                       <table id="table_mano_obra" class="table table-bordered table-striped table-sm" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>Periodo</th>
                                                    <th>Sede</th>
                                                    <th>Sección</th>
                                                    <th>Area del Laboratorio</th>
                                                    <th>Cargo / empleado</th>
                                                    <th>Tiempo</th>
                                                    <th>Costo</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>Periodo </th>
                                                    <th>Sede</th>
                                                    <th>Sección</th>
                                                    <th>Area del Laboratorio</th>
                                                    <th>Cargo / empleado</th>
                                                    <th>Tiempo</th>
                                                    <th>Costo</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </tfoot>
                                       </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingfour">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" onclick="get_datatables('examenes_empleados')" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
                                          Asignación de Examenes a Empleados
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordionExample">
                                    <div class="card-body" id="card_examenes_empleados">
                                       <table id="table_examenes_empleados" class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>Examen</th>
                                                    <th>Empleado</th>
                                                    <th>Tiempo de la Prueba</th>
                                                    <th>Fecha de Creación</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>Examen</th>
                                                    <th>Empleado</th>
                                                    <th>Tiempo de la Prueba</th>
                                                    <th>Fecha de Creación</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </tfoot>
                                       </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingfive">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" onclick="get_datatables('productos_examenes')" type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
                                          Asignación de Productos a Examenes
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordionExample">
                                    <div class="card-body table-responsive" id="card_productos_examenes">
                                       <table id="table_productos_examenes" class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>Producto</th>
                                                    <th>Examen</th>
                                                    <th>Fecha de creación</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nº</th>
                                                    <th>Producto</th>
                                                    <th>Examen</th>
                                                    <th>Fecha de creación</th>
                                                    <th>Estado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </tfoot>
                                       </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
                <div class="modal fade show" id="modal-default" aria-modal="true" role="dialog"><div class="modal-dialog"></div></div>
            </div>
            <!-- /.content-wrapper -->

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
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script>
           
            function get_datatables(id){
                var table = $('#table_'+id);
                if( id == 'descripcion_costos'){
                    $('#card_'+id).removeClass('d-none');
                    $('#card_costos_indirectos').addClass('d-none');
                    $('#button_costos1').attr('onclick','').text('Crear Valor');
                    $('#button_costos2').attr('onclick','get_datatables("costos_indirectos")').text('valor de los costos');
                }else if( id == 'costos_indirectos'){
                    $('#card_costos_indirectos').removeClass('d-none');
                    $('#card_descripcion_costos').addClass('d-none');
                    $('#button_costos1').attr('onclick','').text('Crear Descripición');
                    $('#button_costos2').attr('onclick','get_datatables("descripcion_costos")').text('Descripciones de Costos');
                }
                //verifica que no exita un datatable invocado anteriormente
                if (!$.fn.DataTable.isDataTable('#table_'+id)) {  action_datatable(id); } 
            }

            function action_datatable(id){
                var table = $('#table_'+id);
                table.DataTable({ 
                        "language": {
                            "url": "assets/plugins/datatables/datatables-es-ES.json"
                        },
                        "autoWidth": false,
                        "processing": true, //Feature control the processing indicator.
                        "serverSide": true, //Feature control DataTables' server-side processing mode.
                        "order": [], //Initial no order.
                        // Load data for the table's content from an Ajax source
                        "ajax": {
                            "url": "?c=costos&a=list_"+id,
                            "type": "POST"
                        },
                        //Set column definition initialisation properties.
                        "columnDefs": [{ 
                            "targets": [ 0 ], //first column / numbering column
                            "orderable": false, //set not orderable
                            "className": "dt-center", 
                            "targets": [ 3 ]
                        }],
                });
            }
        </script>
    </body>
</html>