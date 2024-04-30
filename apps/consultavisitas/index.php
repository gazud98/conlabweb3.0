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

    $user = $_SESSION['id_users'];

    $moduraiz = $_SESSION['moduraiz'];

?>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->

    <link rel="stylesheet" type="text/css" href="/cw3/conlabweb3.0/apps/consultavisitas/assets/style.css">

    <style>
        /* Estilos personalizados del scrollbar */
        .custom-scrollbar {
            overflow-y: auto;
            max-height: 200px;
            margin-bottom: 5%;
            scrollbar-width: thin;
            /* Para navegadores Firefox */
            scrollbar-color: gray lightgray;
            /* Para navegadores Firefox */
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 12px;
            /* Ancho del scrollbar para navegadores WebKit (Chrome, Safari, etc.) */
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: gray;
            /* Color del "palo" del scrollbar */
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background-color: lightgray;
            /* Color del fondo del scrollbar */
        }

        .card-title-rezise {
            width: 100%;
            color: #164085;
            text-align: center;
            position: relative;
            margin-top: 9px;
        }
    </style>

    <div class="card" style="width:100%;">

        <div class="card-header bg-light">
            <div class="row">
                <div class="col-md-4 col-lg-4">
                    <nav class="breadcrumbs">
                        <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                        <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Consulta de visitas</strong></a>
                    </nav>
                </div>
                <div class="col-md-4 col-lg-4 text-center">
                    <h5 class="card-title-rezise"><strong>Consulta de visitas</strong></h5>
                </div>
                <div class="col-md-4 col-lg-4 text-right">
                </div>
            </div>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-2">
                    <h5 style="color: #008E16;font-size:15px;" id="titleInfo">Campos de busqueda y/o filtro. <i class="fa-solid fa-arrow-down"></i></h5>
                    <div class="content-filters card card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Fecha de Inical:</label>
                                <input type="date" name="fecha1" id="fecha1" class="form-control">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="">Fecha de Final:</label>
                                <input type="date" name="fecha2" id="fecha2" class="form-control">
                            </div>
                            <div class="col-md-12 mt-2" id="filterAsesorx">

                            </div>
                            <div class="col-md-12 mt-4">
                                <button type="button" style="width: 100%;" class="btn btn-primary btn-sm" id="btnFilter2"><i class="fa-solid fa-filter"></i> Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-10 text-right">
                    <h5 style="color: #008E16;font-size:15px;" id="titleInfo">Puede ver la ubicación y dirección en donde se hizo la vista danclick en el botón <strong>"Revisar"</strong>. <i class="fa-solid fa-arrow-down"></i></h5>
                    <div id="contentTableVistas">

                    </div>
                </div>

            </div>



        </div>

    </div>

    <!-- Modal Maps -->
    <div class="modal fade" id="modalMap" tabindex="-1" aria-labelledby="modalMapLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMapLabel">Detalles de la Visita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Ejecutiva (o) comercial:</label>
                            <div id="ejecom"></div>
                        </div>
                        <div class="col-md-12">
                            <br><label for="">Dirección de la visita:</label>
                            <div id="direccion"></div>
                        </div>
                        <div class="col-md-12">
                            <br><label for="">Ubicación:</label>
                            <div id="map" style="height: 200px;display:none;"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> &nbsp; Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <?php

    include('apps/thedata.php'); //scriops de control
    ?>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.9/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.9/index.global.min.js'></script>
    <script src="https://npmcdn.com/@turf/turf/turf.min.js">
    </script>

    <script>
        $(document).ready(function() {

            $('#contentTableVistas').load('/cw3/conlabweb3.0/apps/consultavisitas/tabla.php', {
                user: <?php echo $user; ?>
            });
            $('#contentTableNeg').load('/cw3/conlabweb3.0/apps/consultavisitas/tabla-2.php');


        });

        function getTable(id) {
            $('.contentTableComments').load('/cw3/conlabweb3.0/apps/consultavisitas/tabla-3.php', {
                id: id
            });
        }

        function getMap(id) {

            $.ajax({
                type: 'POST',
                url: '/cw3/conlabweb3.0/apps/consultavisitas/crud.php?aux=3&id=' + id,
                success: function(res) {

                    data = JSON.parse(res);

                    data.forEach(element => {

                        if (element.lat != '' && element.long != '') {

                            $('#map').css('display', 'block');

                            var mymap = L.map('map').setView([element.lat, element.long], 15);

                            var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${element.lat}&lon=${element.long}&addressdetails=1`;

                            fetch(url)
                                .then(response => response.json())
                                .then(data => {
                                    var direccion = data.display_name;

                                    L.marker([element.lat, element.long]).addTo(mymap)
                                        .bindPopup(direccion);

                                    document.getElementById("direccion").innerHTML = "Dirección: " + direccion;
                                    document.getElementById("ejecom").innerHTML = element.vendedor;

                                })
                                .catch(error => {
                                    console.error("Error al obtener la dirección:", error);
                                });


                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(mymap);

                        } else {

                            $('#map').css('display', 'none');

                        }

                    });

                }
            })

        }

        function obtenerDireccion(id) {

            $.ajax({
                type: 'POST',
                url: '/cw3/conlabweb3.0/apps/consultavisitas/crud.php?aux=3&id=' + id,
                success: function(res) {

                    data = JSON.parse(res);

                    data.forEach(element => {

                        if (element.lat != '' && element.long != '') {

                            $('#map').css('display', 'block');

                            var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${element.lat}&lon=${element.long}&addressdetails=1`;

                            fetch(url)
                                .then(response => response.json())
                                .then(data => {
                                    // Extrae la dirección desde los datos obtenidos
                                    var direccion = data.display_name;

                                    // Muestra la dirección en el elemento con id "direccion"
                                    document.getElementById("direccion").innerHTML = "Dirección: " + direccion;
                                })
                                .catch(error => {
                                    console.error("Error al obtener la dirección:", error);
                                });

                        } else {

                            $('#map').css('display', 'none');

                        }

                    });

                }
            })

        }

        function setComments() {

            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Obtiene las coordenadas
                    var latitud = position.coords.latitude;
                    var longitud = position.coords.longitude;

                    $.ajax({
                        type: 'POST',
                        url: '/cw3/conlabweb3.0/apps/consultavisitas/crud.php?aux=1&lat=' + latitud + '&long=' + longitud,
                        data: $('#formcontrol3').serialize(),
                        success: function() {
                            Swal.fire({
                                position: "top-center",
                                icon: "success",
                                title: "¡Registro guardado exitosamente!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });

                }, function(error) {
                    // En caso de error
                    console.error("Error al obtener la ubicación:", error.message);
                });
            } else {
                alert("Tu navegador no soporta geolocalización.");
            }

        }

        function setComments2() {

            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Obtiene las coordenadas
                    var latitud = position.coords.latitude;
                    var longitud = position.coords.longitude;

                    $.ajax({
                        type: 'POST',
                        url: '/cw3/conlabweb3.0/apps/consultavisitas/crud.php?aux=2&lat=' + latitud + '&long=' + longitud,
                        data: $('#formcontrol4').serialize(),
                        success: function() {
                            Swal.fire({
                                position: "top-center",
                                icon: "success",
                                title: "¡Registro guardado exitosamente!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });

                }, function(error) {
                    // En caso de error
                    console.error("Error al obtener la ubicación:", error.message);
                });
            } else {
                alert("Tu navegador no soporta geolocalización.");
            }

        }

        function clearNotes() {
            $('#comentario').html('');
            $('#fechacoment').html('');
            $('#nomuser').html('');
        }
    </script>
<?php
}
?>