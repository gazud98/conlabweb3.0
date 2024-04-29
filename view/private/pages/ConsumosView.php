<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consumos</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="assets/plugins/fullcalendar/main.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- Fullcalendar -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <!-- Fullcalendar responsive-->
    <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Fullcalendar buttom -->
    <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- select serach responsive-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>
<style>
    .content-wrapper {
        background-image: url('https://conlabweb3.tierramontemariana.org/apps/medicos/assets/backcw3-v1.png');
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Consumos</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="bredcrumb-item mr-4">
                                    <div class="form-group">
                                        <select class="form-control form-control-sm" name="sede_user_default">
                                            <option value="all">General</option>
                                            <?php if (!empty($sedes)) {
                                                foreach ($sedes as $sed => $se) {  ?>
                                                    <option value="<?= $se['id_sedes'] ?>" <?= $this->auth->get_sede_default() == $se['id_sedes'] ? 'selected' : '' ?>> Sede: <?= $se['nombre'] ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Consumos</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="sticky-top mb-3">
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h4 class="card-title"><span class="btn text-right  text-white" onclick="refresh_iframe(urlx)"><i class="fa fa-home"> </i> &nbsp;&nbsp; <b> KIT ACTIVOS </b></span></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="input-group mb-4">
                                            <!-- /btn-group -->


                                            <div class="buscarkits w-100" style="display: block;padding-bottom:20px;">

                                                <input type="input" name="buscarkit" id="buscarkit" onkeyup="buscadorKits();" placeholder="Buscar Kits" class="form-control">

                                            </div>
                                            <div class="search-box w-100 pb-3" style="display: block;">
                                                <form id="searchForm" action="#" role="search">
                                                    <input type="search" name="search_data" id="search_data" placeholder="Crear Kit ......" class="form-control" onkeyup="ajaxSearches();" autocomplete="off">
                                                    <div id="suggestions" class="dropdown-menu text-capitalize w-100" aria-labelledby="dropdownMenuLink" style="display: none;">
                                                        <div id="autoSuggestionsList"></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="accordion" id="list_kit_open"></div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card card-primary">
                                <div class="card-header display-5" id="title-prueba">MÓDULO DE CONSUMOS</div>
                                <div class="card-body p-0">
                                    <div id="calendar"></div>
                                    <div id="table-history" class="card">
                                        <div class="card-header">
                                            <h3 class="card-title"><b>Histórico de consumos por pruebas</b></h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table id="table_kit_history" class="table table-bordered table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                       
                                                        <th>Sedes</th>
                                                        <th>Referencia</th>
                                                        <th>Nombre</th>
                                                        <th>Fecha Apertura</th>
                                                        <th>Expiración</th>
                                                        <th>Estado</th>
                                                        <th>Nº de Pruebas</th>
                                                        <th>% de rendimiento</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                      
                                                        <th>Sedes</th>
                                                        <th>Referencia</th>
                                                        <th>Nombre</th>
                                                        <th>Fecha Apertura</th>
                                                        <th>Expiración</th>
                                                        <th>Estado</th>
                                                        <th>Nº de Pruebas</th>
                                                        <th>% de rendimiento</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            <div class="modal fade show" id="modal-default" aria-modal="true" role="dialog">
                <div class="modal-dialog"></div>
            </div>
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
        <!-- fullCalendar 2.2.5 -->
        <script src="assets/plugins/moment/moment.min.js"></script>
        <!-- fullCalendar 2.2.5 -->
        <script src="assets/plugins/fullcalendar/main.js"></script>
        <!-- fullCalendar lang  -->
        <script src='assets/plugins/fullcalendar/locales/es.js'></script>
        <!-- combox datatable -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
        <script>
            let urlx = '?c=consumos';
            var method_kit_action;
            var table;

            function buscadorKits() {

                // Obtener el valor del campo de entrada

                var pint = $('#buscarkit').val();
                var id = $("select[name='sede_user_default']").val();

                // Realizar una solicitud AJAX al servidor
                $.ajax({
                    type: 'GET',
                    url: "?c=consumos&a=get_list_info_live_kit", // El archivo PHP que maneja la búsqueda
                    data: {
                        id: id,
                        pint: pint
                    },
                    success: function(data) {


                        // Mostrar los resultados en el elemento con id "searchResults"
                        $('#list_kit_open').html(data)
                    }
                });


            }


            $(document).ready(function() {
                var id = $("select[name='sede_user_default']").val();
                //datatables
                get_datatables(id);
                get_list_info_live_kit(id);

                $("select[name='sede_user_default']").change(function() {
                    var id = $("select[name='sede_user_default']").val();
                    $("select[name='sede_user_default'] option:selected").each(function() {
                        var name = $("select[name='sede_user_default'] option:selected").text();
                        get_list_info_live_kit(id);
                        refresh_datatables(id, name);
                    })
                    /*$.post("?c=consumos&a=change_user_sede", { id: id}).done(function(data) { refresh_iframe(urlx) }, "json"); //change session id */
                });

            });

            function refresh_datatables(id, name = '') {

                $('#title-prueba').text('MÓDULO DE CONSUMOS -- ' + name).addClass('bg-primary text-uppercase').removeClass('bg-warning');;
                $('#calendar').empty();
                $('#table-history').css('display', 'block').removeClass('d-none');;
                table.destroy();
                get_datatables(id);
            }

            function get_datatables(id) {



                table = $('#table_kit_history').DataTable({
                    "language": {
                        "url": "assets/plugins/datatables/datatables-es-ES.json"
                    },
                    "autoWidth": false,
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.

                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": "?c=consumos&a=lits_kit_history&id=" + id,
                        "type": "POST"
                    },
                    //Set column definition initialisation properties.
                    "columnDefs": [{
                        "targets": [0], //first column / numbering column
                        "className": "dt-center",
                        "targets": [6, 7], //first column / numbering column 
                        "orderable": false, //set not orderable
                    }, ],
                });
            }

            function ajaxSearches() {
                var input_data = $('#search_data').val();
                if (input_data.length <= 1) {
                    $('#suggestions').hide();
                    //$('#pleaseWaitDialog').modal('hide'); // show loading
                } else {
                    var post_data = {
                        'search_data': input_data
                    };
                    if (input_data.length > 2) {
                        // $('#pleaseWaitDialog').modal('show'); // show loading
                        $.ajax({
                            type: "POST",
                            url: "?c=consumos&a=search_kit",
                            data: post_data,
                            success: function(data) {
                                // return success
                                if (data.length > 0) {
                                    $('#suggestions').show();
                                    $('#autoSuggestionsList').addClass('auto_list');
                                    $('#autoSuggestionsList').html(data);
                                }
                                //$('#pleaseWaitDialog').modal('hide'); // show loading
                            }
                        });
                    }
                }
            }

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var calendarEl = document.getElementById('calendar');


            function start_calendar(id, date_start, name = 'Prueba Seleccionada') {

                $('#title-prueba').text(name).addClass('bg-primary').removeClass('bg-warning');
                $('#table-history').css('display', 'none');
                let today = '<?= date('Y-m-d', strtotime("+1 days")); ?>';

                var calendar = new FullCalendar.Calendar(calendarEl, {

                    locale: 'es',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    themeSystem: 'bootstrap',
                    contentHeight: 'auto',
                    editable: true,
                    selectable: true,
                    events: '?c=consumos&a=calendar_kit&kit=' + id,
                    validRange: {
                        start: date_start,
                        end: today,
                    },
                    eventContent: function(arg, createElement) {
                        var pruebas = arg.event.extendedProps.pruebas;
                        var calibradores = arg.event.extendedProps.calibradores;
                        var controles = arg.event.extendedProps.controles;
                        var verificaciones = arg.event.extendedProps.verificaciones;
                        var diluciones = arg.event.extendedProps.diluciones;
                        var venc_equipos = arg.event.extendedProps.venc_equipos;
                        var estado = arg.event.extendedProps.estado;
                        let italicEl = document.createElement('p');
                        italicEl.innerHTML = '<div class="p-1">Nº pruebas:<b> ' + pruebas + '</b><br>' +
                            'Nº calibradores: <b>' + calibradores + '</b><br>' +
                            'Nº controles: <b>' + controles + '</b><br>' +
                            'Nº repeticioness: <b>' + verificaciones + '</b><br>' +
                            'Nº diluciones: <b>' + diluciones + '</b><br>' +
                            'Vencido en Equipos: <b>' + venc_equipos + '</b></div>';
                        let arrayOfDomNodes = [italicEl]
                        return {
                            domNodes: arrayOfDomNodes
                        }
                    },
                    eventClick: function(arg) {
                        kit_day(arg.event.extendedProps.start, id, arg.event.extendedProps.id, date_start, name);
                        if (arg.event.extendedProps.estado != 1) {
                            arg.el.style.borderColor = 'red';
                        }
                    },
                    select: function(arg) {
                        kit_day(arg.start, id, null, date_start, name);
                    },

                });
                calendar.refetchEvents();
                calendar.render();
            }


            function kit_live(id) {

                var id = $('#list_kit_open #heading' + id).data('id');
                var estado = $('#list_kit_open #heading' + id).data('status');
                var date_start = $('#list_kit_open #heading' + id).data('start');
                var name = $('#list_kit_open #heading' + id).data('name');

                if (estado == 3) {
                    $('#title-prueba').text('EL Kit de ' + name + ' ha expirado.')
                        .removeClass('bg-primary')
                        .addClass('bg-warning text-bold text-uppercase');
                    $('#table-history').addClass('d-none');
                    $('#calendar').empty()
                        .html('<P class="lead p-3">El tiempo de vigencia de este kit ha expirado. Por favor, reemplácelo. Recuerde cerrar este kit antes de abrir uno nuevo. ¡Gracias!</p>');
                } else {
                    start_calendar(id, date_start, name);
                }

            };

            function show_kit_live(id, estado, date_start, name) {
                if (estado == 3) {
                    $('#title-prueba').text('Kit expirado: El periodo de validez de este kit ha concluido. Por favor, reemplácelo.').removeClass('bg-primary').addClass('bg-warning');
                } else {
                    start_calendar(id, date_start, name);
                }
            }

            function update_kit_live(kit, status) {
                var sede = $("select[name='sede_user_default']").val();
                method_kit_action = 'add_live';
                if (status == 1) {
                    start_calendar(id);
                } else if (status == 2) {
                    $.post("?c=consumos&a=consumos_modal", {
                            id: 1,
                            id_info_kit: kit,
                            sede: sede
                        })
                        .done(function(data) {
                            $('#modal-default .modal-dialog').html(data);
                            $('#modal-default').modal('show');
                        });
                } else if (status == 3) {
                    alert('Este kit debe cerrarse obligatoriamente ya que ha expirado. Por favor, proceda a cerrarlo. ¡Gracias!');
                }
            }

            function kit_day(date, kit, id = null, date_start = null, name_examen = null) {
                method_kit_action = 'add_day';
                var d = new Date();
                var day = new Date('d');
                var month = d.getMonth() + 1;
                var day = d.getDate();
                var today = d.getFullYear() + "-" + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;

                var f = new Date();
                var day = new Date('f');
                var month = f.getMonth() + 1;
                var day = f.getDate() - 2;
                var fchmin = f.getFullYear() + "-" + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;

                var day = new Date('date');
                var month = date.getMonth() + 1;
                var day = date.getDate();
                var date = date.getFullYear() + "-" + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;

                if (date >= fchmin && date <= today) {

                    if (today == date || id != null) {
                        $.post("?c=consumos&a=consumos_modal", {
                                id: 2,
                                id_info_live: kit,
                                id_info_day: id,
                                start: date,
                                date_start: date_start,
                                name: name_examen
                            })
                            .done(function(data) {
                                $('#modal-default .modal-dialog').html(data);
                                $('#modal-default').modal('show');
                            });
                    } else if (date !== today) {
                        $.post("?c=consumos&a=consumos_modal", {
                                id: 2,
                                id_info_live: kit,
                                id_info_day: id,
                                start: date,
                                date_start: date,
                                name: name_examen
                            })
                            .done(function(data) {
                                $('#modal-default .modal-dialog').html(data);
                                $('#modal-default').modal('show');
                            });
                    }
                }
            }


            function kit_info() {
                method_kit_action = 'add_kit';
                $.post("?c=consumos&a=consumos_modal", {
                    id: 3
                }).done(function(data) {
                    $('#modal-default .modal-dialog').html(data);
                    $('#modal-default').modal('show');
                });
            }


            function consolidados_info_live_kit(id) {

                method_kit_action = 'show_kit';
                $.post("?c=consumos&a=consolidado_info_live_kit_by_id", {
                    id: id
                }).done(function(data) {
                    $('#modal-default .modal-dialog').html(data);
                    $('#modal-default').modal('show');
                });

            }

            function show_info_live_kit(id, estado) {
                $.post("?c=consumos&a=show_consolidado_info_live_kit_by_id", {
                    id: id
                }).done(function(data) {
                    $('#collapse' + id).html(data);
                    if (estado == 3) {
                        $('#calendar').empty();
                        $('#title-prueba').text('Kit expirado: El periodo de validez de este kit ha concluido. Por favor, reemplácelo.').removeClass('bg-primary').addClass('bg-warning');
                    }
                });
            }

            function get_list_info_live_kit(id) {
              
                $.get("?c=consumos&a=get_list_info_live_kit", {
                    id: id
                }).done(function(data) {
                    $('#list_kit_open').html(data)
                });
            }

            function save_kit_day() {

                $('.modal').css('z-index', 50);
                $('#btnkit').text('Guardando...'); //change button text
                $('#btnkit').attr('disabled', true); //set button disable 
                $('.form-control').removeClass('is-invalid is-valid'); // clear error class
                $('.help-block').empty(); // clear error string
                if (method_kit_action == 'add_day') {
                    var url = "?c=consumos&a=ajax_save_info_kit_day";
                    var form = $('#form_info_kit_day').serialize();
                } else if (method_kit_action == 'add_live') {
                    var url = "?c=consumos&a=ajax_save_info_live";
                    var form = $('#form_info_kit_live').serialize();
                } else if (method_kit_action == 'add_kit') {
                    var url = "?c=consumos&a=ajax_save_info_kit";
                    var form = $('#form_info_kit').serialize();
                }
                $.ajax({
                    url: url,
                    type: "POST",
                    data: form,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == true) {
                            if (method_kit_action == 'add_day') {
                                start_calendar(data.id, data.start, data.name);
                                show_info_live_kit(data.id)
                                $('#modal-default').modal('hide');
                            } else if (method_kit_action == 'add_live') {
                                $('#modal-default').modal('hide');
                                refresh_iframe(urlx);
                            } else if (method_kit_action == 'add_kit') {
                                $('#modal-default').modal('hide');
                            }
                        } else {
                            for (var i = 0; i < data.inputerror.length; i++) {
                                if (data.error_string[i] != '') {
                                    $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                                } else {
                                    $('[name="' + data.inputerror[i] + '"]').addClass('is-valid');
                                }
                                $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                                if (method_kit_action == 'add_day' & data.inputerror[i] == 'comprobar_pruebas') {
                                    $('#form_info_kit_day #comprobar_pruebas').text(data.error_string[i]);
                                }
                            }
                        }

                        $('#btnkit').text('Guardar!'); //change button text
                        $('#btnkit').attr('disabled', false); //set button enable          
                        $('.modal').css('z-index', 1050);

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error al enviar los datos');
                        $('#btnkit').text('Guardar!'); //change button text
                        $('#btnkit').attr('disabled', false); //set button enable          
                        $('.modal').css('z-index', 1050);
                    }
                });
            } //end login form


            function close_kit(id) {
                if (confirm('¿Está seguro de que desea cerrar este kit? Tenga en cuenta que este proceso es irreversible.')) {
                    $.ajax({
                        url: "?c=consumos&a=close_kit",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            if (data.status == true) {
                                $('#modal-default').modal('hide');
                                refresh_iframe('?c=consumos');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error al enviar los datos');
                        }
                    });
                }
            }

            function close_day(id, kit, date_start = null) {
                if (confirm('¿Está seguro de que desea cerrar el día? Recuerde que este proceso es irreversible.')) {
                    $.ajax({
                        url: "?c=consumos&a=close_day",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            if (data.status == true) {
                                $('#modal-default').modal('hide');
                                start_calendar(kit, date_start);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error al enviar los datos');
                        }
                    });
                }
            }

            function refresh_iframe(urlx) {
                parent.refresh_iframe(urlx);
            }
        </script>
</body>

</html>