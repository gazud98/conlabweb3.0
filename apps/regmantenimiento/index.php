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

    <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/Mantenimientos/assets/style.css">

</head>

<style>
    .content-wrapper {
        background-image: url('https://conlabweb3.tierramontemariana.org/assets/image/backcw3-v1.png');
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

    .fc-event-title {
        white-space: normal !important;
        overflow: visible;
        text-overflow: ellipsis;
        word-wrap: break-word;
        line-height: 1.2;
    }
</style>

<body>

    <div class="card border-info" style="width:100%;">

        <div class="card-header bg-light">
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;">Mantenimiento</a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Registro de Mantenimientos</strong></a>
                    </nav>
                </div>
                <div class="col-md-4 col-lg-4 text-center">
                    <h5 class="card-title card-title-rezise"><strong>Registro de Mantenimientos</strong></h5>
                </div>
                <div class="col-md-4 col-lg-4 text-right">

                    <div class="btn-group" role="group" aria-label="Basic example">
                        <!--<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAddContact" onclick="loadFormsAddContact()">Crear Contacto</button>-->
                        <button class="btn btn-outline-primary" onclick="loadFormsNewMantenimiento()" title="Registrar Mantenimiento" data-toggle="modal" data-target="#addMantenimientoModal"><i class="fa-solid fa-calendar-days"></i></button>
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
                            <input type="text" class="form-control" placeholder="Escribir palabra clave sobre Mantenimiento">-->
                        <label for="">Quién</label>
                        <input type="text" class="form-control" id="nombreMantenimiento" placeholder="Escribir Responsable">
                        <br>
                        <div class="row">
                            <label for=""></label>
                            <div class="col-md-12">
                                <label for="">Fecha:</label>
                                <input type="date" name="" id="fechaMantenimiento" class="form-control">
                            </div>
                        </div>
                        <br><button class="btn btn-primary" onclick="searchMantenimiento()">Buscar</button>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="fullcallendar" id="fullcallendar"></div>
                </div>
            </div>

        </div>


        <div id="addMantenimientoModal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header  bg-primary">
                        <h5 class="card-header bg-primary"><i class="fa-solid fa-screwdriver-wrench"></i> &nbsp;Registrar Mantenimiento
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color:white;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalContent">

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="miModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mantenimientos pendientes hoy</h5>
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

        <!-- Modal Reprogramar -->
        <div class="modal fade" id="modalReprogramar" tabindex="-1" aria-labelledby="modalReprogramarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="card-header bg-primary"><i class="fa-solid fa-screwdriver-wrench"></i> &nbsp;Reprogramar Mantenimiento
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="content-reprogramar-mantenimiento">

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success btn-sm" onclick="updateRepPrev()">Grabar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Mantenimiento -->
        <div class="modal fade" id="modalEditMantenimiento" tabindex="-1" aria-labelledby="modalEditMantenimientoLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header  bg-primary">
                        <h5 class="card-header bg-primary"><i class="fa-solid fa-screwdriver-wrench"></i> &nbsp;Editar Mantenimiento
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color:white;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="content-edit-Mantenimiento">

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
        // Función para realizar la solicitud AJAX
        function updateEventStatus() {
            $.ajax({
                url: 'https://conlabweb3.tierramontemariana.org/apps/regmantenimiento/update_event_status.php',
                method: 'GET',
                success: function(response) {
                    console.log(response); // Mostrar respuesta en la consola para depuración
                   
                },
                error: function(xhr, status, error) {
                    console.error("Error al actualizar el estado: ", error);
                }
            });
        }

        // Ejecutar la función cada 5 minutos (300000 milisegundos)
        setInterval(updateEventStatus, 300000);

       
        $(document).ready(function() {
            // Inicializa la tabla
            updateEventStatus();
            $('#modalContent').load('https://conlabweb3.tierramontemariana.org/apps/regmantenimiento/modal-new-Mantenimiento.php')


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
                events: 'https://conlabweb3.tierramontemariana.org/apps/regmantenimiento/obtener_datos.php',
                eventClick: function(info) {
                    // Abre tu modal aquí
                    mostrarModal(info);
                },
                dateClick: function(info) {
                    $('#addMantenimientoModal').modal();
                    $('#fecha').val(info.dateStr);
                },
                eventContent: function(arg) {
                    let eventTitle = document.createElement('div');
                    eventTitle.classList.add('fc-event-title');
                    eventTitle.innerHTML = '<b>' + arg.event.title + '</b><br>' + 'Responsable: ' + arg.event.extendedProps.responsable;

                    let arrayOfDomNodes = [eventTitle];
                    return {
                        domNodes: arrayOfDomNodes
                    };
                },
                eventDidMount: function(info) {
                    // Obtener la fecha de fin del evento
                    var endDate = info.event.end ? info.event.end : info.event.start;
                    var now = new Date();

                    // Calcular la diferencia en días
                    var timeDiff = endDate - now;
                    var dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                    // Aplicar estilo si la fecha final está cerca (menos de 3 días)
                    if (dayDiff <= 3) {
                        info.el.style.backgroundColor = 'red';
                    }
                },
                eventDrop: function(info) {

                    actualizarFechaEvento(info.event.id, info.event.start);
                },
                eventResize: function(info) {

                    actualizarFechaEvento(info.event.id, info.event.start);
                }
            });

            $('#btnSearchCalendar').click(function() {
                calendar.refetchEvents();
            });
            // Hacer que la variable `calendar` esté disponible globalmente
            window.calendar = calendar;

            calendar.render();
            calendar.setOption('contentHeight', 550);


        });

        function actualizarFechaEvento(eventId, newDate) {
            // Aquí debes enviar la nueva fecha del evento al servidor para su actualización
            // Ejemplo de AJAX para enviar la información al servidor
            $.ajax({
                url: 'https://conlabweb3.tierramontemariana.org/apps/regmantenimiento/update.php',
                method: 'POST',
                data: {
                    eventId: eventId,
                    newDate: newDate
                },
                success: function(response) {

                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Registro guardado correctamente!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.calendar.refetchEvents();
                },
                error: function(xhr, status, error) {
                    // Maneja los errores si es necesario
                }
            });
        }

        function mostrarModal(info) {
            // Obtener la información del evento desde el objeto info
            var id = info.event.id;

            loadFormsEditMantenimiento(id);
            $('#modalEditMantenimiento').modal();

        }

        function loadFormsNewMantenimiento() {
            $('#modalContent').load('https://conlabweb3.tierramontemariana.org/apps/regmantenimiento/modal-new-Mantenimiento.php')
        }

        function rescheduleMaintenance() {
            $('.content-reprogramar-mantenimiento').load('https://conlabweb3.tierramontemariana.org/apps/regmantenimiento/reschedule-maintenance.php')
        }

        function loadFormsEditMantenimiento(id) {
            $('.content-edit-Mantenimiento').load('https://conlabweb3.tierramontemariana.org/apps/regmantenimiento/edit-Mantenimiento.php', {
                id: id
            })
        }

        function searchMantenimiento() {

            nombre = $('#nombreMantenimiento').val();
            fecha = $('#fechaMantenimiento').val();

            if (nombre != "" || fecha != "") {
                $('#modalSearch').modal();
                $('.content-table-search').load('https://conlabweb3.tierramontemariana.org/apps/regmantenimiento/modal-search.php', {
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

        function loadFormsEditMantenimientoForSearch(id) {
            $('#modalSearch').modal('hide');
            $('#modalEditMantenimiento').modal();
            loadFormsEditMantenimiento(id);
        }
    </script>

</body>

</html>