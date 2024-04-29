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

?>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->

    <link rel="stylesheet" type="text/css" href="https://cw3.tierramontemariana.org/apps/consultavisitas/assets/style.css">

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
    </style>

    <div class="card border-info" style="width:100%;">

        <div class="card-header bg-light ">
            <div class="row">
                <div class="col-md-12 col-lg-12 text-center">
                    <strong>Consulta de visitas</strong>
                </div>
            </div>
        </div>

        <div class="card-body">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fa-brands fa-searchengin"></i></button>
                </li>
                <!--<li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Consulta de negociaciones</button>
                </li>-->
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active p-4" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="" id="contentTableVistas" style="width: auto;">

                    </div>
                </div>
                <div class="tab-pane fade p-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <!--<div class="" id="contentTableNeg" style="width: auto;">

                    </div>-->
                </div>
            </div>

        </div>

        <!-- Modal Notas -->
        <div class="modal fade" id="exampleNotas" tabindex="-1" aria-labelledby="exampleNotasLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleNotasLabel">Comentarios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearNotes()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="formcontrol3" id="formcontrol3" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                            <br>
                            <!--<input type="text" id="idtask" name="idtask" disabled>-->
                            <div id="comentario" class="custom-scrollbar">
                                <p>
                                    <!-- Contenido de los comentarios -->
                                </p>
                            </div>
                            <textarea class="form-control" name="coments" id="coments" cols="30" rows="5" style="height: 50px !important;"></textarea>
                            <br>
                            <div class="col-md-12">
                                <label for="">Cambiar Estado:</label>
                                <select class="form-control" name="estado_act" id="estado_act">
                                    <option value="" selected disabled></option>
                                    <option value="1">En Proceso</option>
                                    <option value="2">Cerrado</option>
                                </select>
                            </div>
                            <input type="hidden" id="idcom" name="idcom">
                            <input type="hidden" id="id_tarea" name="id_tarea">
                            <input type="hidden" id="user" name="user" value="<?php echo $user; ?>">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clearNotes()">Cancelar</button>
                            <button type="button" class="btn btn-success" onclick="setComments()">Grabar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Notas Negociaciones -->
        <div class="modal fade" id="exampleNotasNeg" tabindex="-1" aria-labelledby="exampleNotasNegLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleNotasNegLabel">Comentarios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearNotes()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="formcontrol4" id="formcontrol4" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                            <br>
                            <!--<input type="text" id="idtask" name="idtask" disabled>-->
                            <div id="comentario2" class="custom-scrollbar">
                                <p>
                                    <!-- Contenido de los comentarios -->
                                </p>
                            </div>
                            <textarea class="form-control" name="coments2" id="coments2" cols="30" rows="5" style="height: 50px !important;"></textarea>
                            <br>
                            <div class="col-md-12">
                                <label for="">Cambiar Estado:</label>
                                <select class="form-control" name="estado_act2" id="estado_act2">
                                    <option value="" selected disabled></option>
                                    <option value="1">Pendiente</option>
                                </select>
                            </div>
                            <input type="hidden" id="idcom2" name="idcom2">
                            <input type="hidden" id="id_tarea2" name="id_tarea2">
                            <input type="hidden" id="user2" name="user2" value="<?php echo $user; ?>">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clearNotes()">Cancelar</button>
                            <button type="button" class="btn btn-success" onclick="setComments2()">Grabar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Maps -->
        <div class="modal fade" id="modalMap" tabindex="-1" aria-labelledby="modalMapLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalMapLabel">Ubicación de la Visita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="contentTableComments">

                        </div>
                        <div id="map" style="height: 400px;display:none;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <p id="direccion"></p>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
        <!-- jsPDF -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script>
            $(document).ready(function() {

                $('#contentTableVistas').load('https://cw3.tierramontemariana.org/apps/consultavisitas/tabla.php', {
                    user: <?php echo $user; ?>
                });
                $('#contentTableNeg').load('https://cw3.tierramontemariana.org/apps/consultavisitas/tabla-2.php');

            });

            function getTable(id) {
                $('.contentTableComments').load('https://cw3.tierramontemariana.org/apps/consultavisitas/tabla-3.php', {
                    id: id
                });
            }

            function getMap(id) {

                $.ajax({
                    type: 'POST',
                    url: 'https://cw3.tierramontemariana.org/apps/consultavisitas/mostrar-2.php?aux=4&id=' + id,
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

            function obtenerDireccion(latitud, longitud) {
                var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitud}&lon=${longitud}&addressdetails=1`;

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

            }

            function setComments() {

                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        // Obtiene las coordenadas
                        var latitud = position.coords.latitude;
                        var longitud = position.coords.longitude;

                        $.ajax({
                            type: 'POST',
                            url: 'https://cw3.tierramontemariana.org/apps/consultavisitas/crud.php?aux=1&lat=' + latitud + '&long=' + longitud,
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
                            url: 'https://cw3.tierramontemariana.org/apps/consultavisitas/crud.php?aux=2&lat=' + latitud + '&long=' + longitud,
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