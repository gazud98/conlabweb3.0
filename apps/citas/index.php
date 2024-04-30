<?php
// Incluir el archivo de configuración según la ruta
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

// Conexión a la base de datos
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {
    $moduraiz = $_SESSION['moduraiz'];
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <!-- fullCalendar -->
        <link rel="stylesheet" href="assets/plugins/fullcalendar/main.css">
        <!-- Fullcalendar -->
        <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <!-- Fullcalendar responsive-->
        <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <!-- Fullcalendar buttom -->
        <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- Fullcalendar responsive-->
        <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

        <link rel="stylesheet" href="/cw3/conlabweb3.0/apps/citas/assets/style.css">

    </head>

    <style>
        .content-wrapper {
            background-image: url('/cw3/conlabweb3.0/assets/image/backcw3-v1.png');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .fc-daygrid-event {
            font-size: 12px !important;
            color: #fff !important;
            background-color: #008A15;
            border: 1px solid #008A15;
            padding: 2px;
            border-radius: 2px;
        }

        .fc-daygrid-event:hover {
            background-color: #429A50 !important;
        }

        .fc-header-toolbar {
            padding: 0px !important;
            margin-bottom: 5px !important;
        }

        .fc-daygrid-event-dot {
            border-color: #fff !important;
        }

        #fullcallendar {
            width: 100%;
            height: 75vh;
        }

        .card-title-rezise {
            width: 100%;
            color: #164085;
            text-align: center;
            position: relative;
            margin-top: 9px;
        }
    </style>

    <body>

        <div class="card border-info" style="width:100%;">

            <div class="card-header bg-light">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <nav class="breadcrumbs">
                            <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                            <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Creación de Citas</strong></a>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-4 text-center">
                        <h5 class="card-title card-title-rezise"><strong>Creación de Citas</strong></h5>
                    </div>
                    <div class="col-md-4 col-lg-4 text-right">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <!--<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAddContact" onclick="loadFormsAddContact()">Crear Contacto</button>-->
                            <button class="btn btn-outline-primary" onclick="loadFormsNewCita()" data-toggle="modal" data-target="#addCitaModal">Crear cita</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-2">
                        <h5 style="color: #008E16;font-size:15px;" id="titleInfo">Campos de busqueda y/o filtro. <i class="fa-solid fa-arrow-down"></i></h5>
                        <div class="card card-body">
                            <!--<label for="">Qué</label>
                            <input type="text" class="form-control" placeholder="Escribir palabra clave sobre cita">-->
                            <label for="">Quién</label>
                            <input type="text" class="form-control" id="nombreCita" placeholder="Escribir médico o empresa">
                            <br>
                            <div class="row">
                                <label for=""></label>
                                <div class="col-md-12">
                                    <label for="">Fecha:</label>
                                    <input type="date" name="" id="fechaCita" class="form-control">
                                </div>
                            </div>
                            <br><button class="btn btn-primary" onclick="searchCita()">Buscar</button>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="fullcallendar" id="fullcallendar"></div>
                    </div>
                </div>

            </div>

            <!-- Modal Visitas HTML -->
            <div id="addCitaModal" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="modalContent">

                    </div>
                </div>
            </div>

            <div class="modal fade" id="miModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Citas pendientes hoy</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Tabla dentro del modal -->
                            <span id="contacto"></span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Add Contact -->
            <div class="modal fade" id="modalAddContact" tabindex="-1" aria-labelledby="modalAddContactLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddContactLabel">Craer Contacto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="content-add-contact">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Cita -->
            <div class="modal fade" id="modalEditCita" tabindex="-1" aria-labelledby="modalEditCitaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditCitaLabel">Editar Cita</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="content-edit-cita">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal  -->
            <div class="modal fade" id="modalSearch" tabindex="-1" aria-labelledby="modalSearchLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Resultados de búsqueda</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="content-table-search">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- jQuery -->
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <!-- Fullcalendar -->
        <link rel="stylesheet" href="assets/plugins/fullcalendar/main.css">
        <script src="assets/plugins/moment/moment.min.js"></script>
        <script src="assets/plugins/fullcalendar/main.js"></script>
        <script src='assets/plugins/fullcalendar/locales/es.js'></script>

        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
        <script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                // Inicializa la tabla

                $('#modalContent').load('/cw3/conlabweb3.0/apps/citas/modal-new-cita.php')


                miDataTable = $('#miTabla').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                    },
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": false,
                    "info": false,
                    "autoWidth": true,
                    "responsive": true
                });

            });


            $(document).ready(function() {
                var calendarEl = document.getElementById('fullcallendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    themeSystem: 'bootstrap',
                    locale: 'es',
                    editable: true,
                    selectable: true,
                    contentHeight: 'auto',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,listWeek'
                    },
                    titleFormat: {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    },
                    events: '/cw3/conlabweb3.0/apps/citas/obtener_datos.php',
                    eventClick: function(info) {
                        // Abre tu modal aquí
                        mostrarModal(info);
                    },
                    dateClick: function(date, jsEvent, view) {
                        $('#addCitaModal').modal();
                        $('#fecha').val(date.dateStr);
                    }

                });

                $('#btnSearchCalendar').click(function() {
                    $('#calendar').fullCalendar('rerenderEvents');
                })

                calendar.render();
                calendar.setOption('contentHeight', 550);

            });

            function mostrarModal(info) {
                // Obtener la información del evento desde el objeto info
                var id = info.event.id;

                $('#modalEditCita').modal();
                loadFormsEditCita(id);
            }

            function loadFormsNewCita() {
                $('#modalContent').load('/cw3/conlabweb3.0/apps/citas/modal-new-cita.php')
            }

            function loadFormsAddContact() {
                $('.content-add-contact').load('/cw3/conlabweb3.0/apps/citas/modal-contact.php')
            }

            function loadFormsEditCita(id) {
                $('.content-edit-cita').load('/cw3/conlabweb3.0/apps/citas/edit-cita.php', {
                    id: id
                })
            }

            function searchCita() {

                nombre = $('#nombreCita').val();
                fecha = $('#fechaCita').val();

                if (nombre != "" || fecha != "") {
                    $('#modalSearch').modal();
                    $('.content-table-search').load('/cw3/conlabweb3.0/apps/citas/modal-search.php', {
                        nombre: nombre,
                        fecha: fecha
                    })
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Ingrese un nombre o una fecha para buscar.",
                    });
                }

            }

            function loadFormsEditCitaForSearch(id){
                $('#modalSearch').modal('hide');
                $('#modalEditCita').modal();
                loadFormsEditCita(id);
            }

        </script>

    </body>

    </html>

<?php
}
?>