<?php
//Si bahy consulta

// echo __FILE__.'>dd.....<br>';
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


//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {

?>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="/cw3/apps/gestiontareas/assets/style.css">

    <div class="card border-info" style="width:100%;">

        <div class="card-header bg-light ">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addNegociaciones">Nueva negociación</button>
                </div>
                <div class="col-md-6 col-lg-6 text-right">
                    <strong>Creación de negociaciones y Visitas</strong>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="col-md-12 col-lg-12">

                <div class="fullcallendar" id="fullcallendar" style="width: auto;">

                </div>

            </div>
        </div>

        <!-- Modal Visitas HTML -->
        <div id="addCitaModal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Nueva Cita</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-2 p-3">
                                    <label for="">Fecha:</label>
                                    <input class="form-control" type="date" name="fecha" id="fecha">
                                </div>
                                <div class="col-md-2 p-3">
                                    <label for="">Hora:</label>
                                    <input class="form-control" type="time" name="hora" id="hora">
                                </div>
                                <div class="col-md-3 p-3">
                                    <label for="">Tipo de visita:</label>
                                    <select name="tipovisita" id="tipovisita" class="form-control">

                                    </select>
                                </div>
                            </div>

                            <hr>
                            <label for="">Persona de contacto:</label>

                            <div class="row">
                                <div class="col-md-4 p-3">
                                    <label for="">Nombre:</label>
                                    <input class="form-control" type="text" name="nombrecontacto" id="nombrecontacto">
                                </div>
                                <div class="col-md-4 p-3">
                                    <label for="">Celular:</label>
                                    <input class="form-control" type="text" name="celularcontacto" id="celularcontacto">
                                </div>
                                <div class="col-md-4 p-3">
                                    <label for="">Email:</label>
                                    <input class="form-control" type="text" name="emailcontacto" id="emailcontacto">
                                </div>
                            </div>

                            <hr>
                            <label for="">Persona de contacto:</label>

                            <div class="row">
                                <div class="col-md-12">
                                    <textarea class="form-control" name="comentario" id="comentario" cols="30" rows="3"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-danger btn-close-modal" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-success" value="Aceptar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Neg HTML -->
        <div id="addNegociaciones" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Nueva Negociación</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Selecciona negociación:</label>
                                    <select name="empresa" id="empresa" class="form-control">
                                        <option value="" selected disabled></option>
                                    </select>
                                </div>
                                <div class="col-md-6 p-3">
                                    <label for="">Empresa:</label>
                                    <select name="empresa" id="empresa" class="form-control">
                                        <option value="" selected disabled></option>
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-2 p-3">
                                    <label for="">Fecha de inicio:</label>
                                    <input class="form-control" type="date" name="fecha" id="fecha">
                                </div>
                                <div class="col-md-5 p-3">
                                    <label for="">Vendedor:</label>
                                    <select name="vendedor" id="vendedor" class="form-control">
                                        <option value="" selected disabled></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-danger btn-close-modal" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-success" value="Aceptar">
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <?php
        include('thefinder.php'); //modal de busqueda personalizado

        include('apps/thedata.php'); //scriops de control
        ?>

        <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.9/index.global.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.9/index.global.min.js'></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>

        <script>
            $(document).ready(function() {
                obtener();
                var calendarEl = document.getElementById('fullcallendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    dateClick: function(info) {

                        $('#addCitaModal').modal('show');

                        $('#fecha').val(info.dateStr);

                    },
                    themeSystem: 'bootstrap',
                    locale: 'es',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth'
                    }
                });
                calendar.render();
                calendar.setOption('contentHeight', 550);

                $('.close').click(function() {
                    $('#addCitaModal').modal('hide');
                })

                $('.btn-close-modal').click(function() {
                    $('#addCitaModal').modal('hide');
                })


            });

            function obtener() {

                $("#table").load("<?php echo base_url . 'apps/' . $p . '/tabla.php'; ?>");

            }

            function guardarDatos() {
                data = $('#formcontrol').serialize();
                $.ajax({
                    method: 'POST',
                    url: '/cw3/apps/negociaciones/crud.php',
                    data: data,
                    success: function(rest) {

                    }
                })
            }
        </script>
    <?php
}
    ?>