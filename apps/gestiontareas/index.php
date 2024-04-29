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
    echo $error;
} else {

    $user = $_SESSION['id_users'];
}

?>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Agrega enlaces a tus hojas de estilo aquí -->
    <link rel="stylesheet" type="text/css" href="https://cw3.tierramontemariana.org/apps/gestiontareas/assets/style.css">
</head>

<body>
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
    <main>



        <div class="divcontainer">



            <div class="row mt-1">
                <div class="card" style="width:100%;margin:auto;">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="getPersona()"><i class="fa-solid fa-plus"></i> Asignar Tarea</button>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label style="font-size: 12px;">Responsable:</label>
                                <select class="form-control" name="responsableh" id="responsableh">
                                    <option value="" disabled selected></option>
                                    <?php

                                    $cadena = "SELECT id_persona, CONCAT(nombre_1, ' ', nombre_2, ' ', apellido_1, ' ', apellido_2) as nombre FROM persona";

                                    $resultadP2 = $conetar->query($cadena);

                                    $numerfiles2a = mysqli_num_rows($resultadP2);

                                    if ($numerfiles2a >= 1) {
                                        while ($filaP2 = mysqli_fetch_array($resultadP2)) {

                                            echo '<option value="' . $filaP2['id_persona'] . '">' . $filaP2['nombre'] . '</option>';
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2" style="margin-top: 27px;">
                                <button type="button" class="btn btn-info btn-sm" id="btnSearchh" onclick="loadNumRows()"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="btn btn-success active" id="v-pills-home-tab" data-toggle="pill" data-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" style="color: white;">Hoy
                                        <span class="badge badge-light" id="span-today">0</span></button>
                                    <button class="btn btn-danger" id="v-pills-profile-tab" data-toggle="pill" data-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="color: white; margin-top:5px;">Vencidas <span class="badge badge-light" id="span-expire">
                                            0
                                        </span></button>
                                    <button class="btn btn-warning" id="v-pills-messages-tab" data-toggle="pill" data-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" style="color: black; margin-top:5px;">Proceso <span class="badge badge-light" id="span-process">
                                            0
                                        </span></button>
                                    <button class="btn btn-pink" id="v-pills-settings-tab" data-toggle="pill" data-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false" style="color: white; margin-top:5px;">Futuras <span class="badge badge-light" id="span-futures">
                                            0 </span></button>
                                    <button class="btn btn-dark" id="v-pills-closed-tab" data-toggle="pill" data-target="#v-pills-closed" type="button" role="tab" aria-controls="v-pills-closed" aria-selected="false" style="color: white; margin-top:5px;">Cerradas <span class="badge badge-light" id="span-close">
                                            0
                                        </span></button>
                                    <!--<button class="btn btn-oliva" id="v-pills-closed-tab" data-toggle="pill" data-target="#v-pills-closed" type="button" role="tab" aria-controls="v-pills-closed" aria-selected="false" style="color: white; margin-top:5px;">Total <span class="badge badge-light">0</span></button>-->
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                                        <div class="content-table-h">

                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                                    </div>
                                    <div class="tab-pane fade" id="v-pills-closed" role="tabpanel" aria-labelledby="v-pills-closed-tab">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- Modal Tareas -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva Tarea</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="formcontrol" id="formcontrol" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Tarea:</label>
                                    <textarea class="form-control" name="tarea" id="tarea" cols="30" rows="3" style="height: 50px !important;"></textarea>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-4">
                                    <label for="">Fecha inicio:</label>
                                    <input type="date" class="form-control" name="fechaini" id="fechaini">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Fecha Fin:</label>
                                    <input type="date" class="form-control" name="fechafin" id="fechafin">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Prioridad</label>
                                    <select class="form-control" name="prioridad" id="prioridad">
                                        <option value="" selected disabled></option>
                                        <option value="1">Alta</option>
                                        <option value="2">Media</option>
                                        <option value="3">Baja</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <label for="">Responsable:</label>
                                    <select class="form-control" name="responsable" id="responsable">
                                        <option selected="true" disabled="disabled"></option>
                                        <?php

                                        $cadena = "SELECT id_persona, CONCAT(nombre_1, ' ', nombre_2, ' ', apellido_1, ' ', apellido_2) as nombre FROM persona";

                                        $resultadP2 = $conetar->query($cadena);

                                        $numerfiles2a = mysqli_num_rows($resultadP2);

                                        if ($numerfiles2a >= 1) {
                                            while ($filaP2 = mysqli_fetch_array($resultadP2)) {

                                                echo '<option value="' . $filaP2['id_persona'] . '">' . $filaP2['nombre'] . '</option>';
                                            }
                                        }

                                        ?>

                                    </select>
                                </div>
                            </div>

                            <!--<div class="row mt-1">
                                <div class="col-md-12">
                                    <label for="">Comentarios:</label>
                                    <textarea class="form-control" name="coments" id="coments" cols="30" rows="3" style="height: 50px !important;"></textarea>
                                </div>
                            </div>-->

                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <label for="">Estado:</label>
                                    <select class="form-control" name="estado" id="estado">
                                        <option value="2">En Proceso</option>
                                        <option value="3">Cerrado</option>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" id="id_users" name="id_users" value="<?php echo $user; ?>">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success" onclick="saveData(<?php echo $user ?>)">Grabar</button>
                        </div>
                    </form>
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


        <!-- Modal Edit Estado -->
        <div class="modal fade" id="modalEditEstado" tabindex="-1" aria-labelledby="modalEditEstadoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditEstadoLabel">Editar Estado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="formcontrol2" id="formcontrol2" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="row">

                                <div class="col-md-2">
                                    <label for="">Id:</label>
                                    <input type="text" class="form-control" id="iden2" value="" disabled>
                                    <input type="hidden" name="ide" id="ide2">
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-12">
                                    <label for="">Estado:</label>
                                    <select class="form-control" name="estado" id="estado">
                                        <option value="2">En Proceso</option>
                                        <option value="3">Cerrado</option>
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success" onclick="updateEstado()">Grabar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
   
            $(".content-table-h").load("https://cw3.tierramontemariana.org/apps/gestiontareas/table-tareas-hoy.php");
            $("#v-pills-profile").load("https://cw3.tierramontemariana.org/apps/gestiontareas/table-tareas-v.php");
            $("#v-pills-messages").load("https://cw3.tierramontemariana.org/apps/gestiontareas/table-tareas-p.php");
            $("#v-pills-settings").load("https://cw3.tierramontemariana.org/apps/gestiontareas/table-tareas-f.php");
            $("#v-pills-closed").load("https://cw3.tierramontemariana.org/apps/gestiontareas/table-tareas-c.php");
        });

      
        function loadNumRows() {
            user = $('#responsableh').val();

            $.ajax({
                type: 'POST',
                url: 'https://cw3.tierramontemariana.org/apps/gestiontareas/num-rows-today.php',
                dataType: 'json', // Tipo de datos esperado en la respuesta
                data: {
                    user: user
                },
                success: function(rows) {

                    $("#span-today").text(rows);
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    // Puedes manejar el error mostrando un mensaje o realizando alguna otra acción
                    $("#span-today").text('0');
                }
            });
            $.ajax({
                type: 'POST',
                url: 'https://cw3.tierramontemariana.org/apps/gestiontareas/num-rows-expire.php',
                dataType: 'json', // Tipo de datos esperado en la respuesta
                data: {
                    user: user
                },
                success: function(rows) {

                    $("#span-expire").text(rows);
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    // Puedes manejar el error mostrando un mensaje o realizando alguna otra acción
                    $("#span-expire").text('0');
                }
            });
            $.ajax({
                type: 'POST',
                url: 'https://cw3.tierramontemariana.org/apps/gestiontareas/num-rows-process.php',
                dataType: 'json', // Tipo de datos esperado en la respuesta
                data: {
                    user: user
                },
                success: function(rows) {

                    $("#span-process").text(rows);
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    // Puedes manejar el error mostrando un mensaje o realizando alguna otra acción
                    $("#span-process").text('0');
                }
            });
            $.ajax({
                type: 'POST',
                url: 'https://cw3.tierramontemariana.org/apps/gestiontareas/num-rows-futures.php',
                dataType: 'json', // Tipo de datos esperado en la respuesta
                data: {
                    user: user
                },
                success: function(rows) {

                    $("#span-futures").text(rows);
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    // Puedes manejar el error mostrando un mensaje o realizando alguna otra acción
                    $("#span-futures").text('0');
                }
            });
            $.ajax({
                type: 'POST',
                url: 'https://cw3.tierramontemariana.org/apps/gestiontareas/num-rows-close.php',
                dataType: 'json', // Tipo de datos esperado en la respuesta
                data: {
                    user: user
                },
                success: function(rows) {

                    $("#span-close").text(rows);
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    // Puedes manejar el error mostrando un mensaje o realizando alguna otra acción
                    $("#span-close").text('0');
                }
            });


        }

        function saveData() {

            $.ajax({
                type: 'POST',
                url: 'https://cw3.tierramontemariana.org/apps/gestiontareas/crud.php?aux=1',
                data: $('#formcontrol').serialize(),
                success: function() {
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "¡Registro guardado exitosamente!",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    cargarDatosh();
                    cargarDatosc();
                    cargarDatosf();
                    cargarDatosp();
                    cargarDatosv();
                    $('#exampleModal').modal('hide');
                }
            });
        }
        /*function getPersona() {
            $.ajax({
                type: 'POST',
                url: '/cw3/apps/gestiontareas/mostrar-2.php?aux=1',
                success: function(res) {

                    alert('Hola');

                    alert(res);

                    res.forEach(element => {
                        $('#responsable').append('<option value="' + element['id'] + '">' + element['nombre'] + '</option>');
                    });

                }
            });
        }*/
    </script>
</body>

</html>