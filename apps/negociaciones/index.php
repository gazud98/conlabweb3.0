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
    $user = $_SESSION['id_users'];
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/negociaciones/assets/style.css">
    </head>

    <style>
        .card-title-rezise {
            width: 100%;
            color: #164085;
            text-align: center;
            position: relative;
            margin-top: 9px;
        }
    </style>

    <body>

        <div class="card border-info" style="width:100%;margin:auto;">

            <div class="card-header bg-light">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <nav class="breadcrumbs">
                            <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><?php echo $moduraiz; ?></a>
                            <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Negociaciones</a>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-4 text-center">
                        <h5 class="card-title card-title-rezise"><strong>Consultar Negociaciones</strong></h5>
                    </div>
                    <div class="col-md-4 col-lg-4">
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 p-2">
                        <h5 style="color: #008E16;font-size:15px;" id="titleInfo">Campos de busqueda y/o filtro. <i class="fa-solid fa-arrow-down"></i></h5>
                        <div class="card card-body content-filters mt-2 mb-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Estado:</label>
                                    <select name="estado" id="estado" class="form-control">
                                        <option value="" selected disabled>SELECCIONA:</option>
                                        <option value="1">En proceso</option>
                                        <option value="2">Terminado</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <br><label for="">Fecha de inicial:</label>
                                    <input type="date" name="fecha_i" id="fecha_i" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <br><label for="">Fecha de realización:</label>
                                    <input type="date" name="fecha_f" id="fecha_f" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <br><button type="button" class="btn btn-primary btn-sm" id="btnFilter3" style="width: 100%;"><i class="fa-solid fa-filter"></i> Filtrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 p-2">
                        <h5 style="color: #008E16;font-size:15px;" id="titleInfo">Tiene que seleccionar una negociación (empresa o médico) de la tabla para ver los detalles. <i class="fa-solid fa-arrow-down"></i></h5>
                        <div class="text-center" style="width: 50%;background:#F6EDF9;padding:5px;border-radius:5px;font-weight: 800;margin:auto;">
                            Listado de negociaciones</h5>
                        </div>
                        <div id="contentTableNegociaciones"></div>
                    </div>
                    <div class="col-md-5">
                        <div class="card text-center">
                            <div class="card-header">
                                Detalles del proceso de negociación
                            </div>
                            <div class="card-body" id="contentViewProcessNeg">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal Notas Visitas-->
        <div class="modal fade" id="exampleNotas" tabindex="-1" aria-labelledby="exampleNotasLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleNotasLabel">Registrar visita</h5>
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
                                <label for="">Ajecutiva (o) comercial:</label>
                                <input type="text" name="eje_comercial" id="eje_comercial" class="form-control" disabled>
                            </div>

                            <div class="col-md-12 mt-4">
                                <label for="">Cambiar Estado:</label>
                                <select class="form-control" name="estado_act" id="estado_act">
                                    <option value="" selected disabled></option>
                                    <option value="1">Pendiente</option>
                                </select>
                            </div>
                            <input type="hidden" id="idcom" name="idcom">
                            <input type="hidden" id="id_tarea" name="id_tarea">
                            <input type="hidden" id="user" name="user" value="<?php echo $user; ?>">
                            <input type="hidden" id="idpersona" name="idpersona">
                            <input type="hidden" id="idcita" name="idcita">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clearNotes()">Cancelar</button>
                            <button type="button" class="btn btn-success" onclick="setComments()">Grabar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cw3.tierramontemariana.org/apps/negociaciones/assets/index.js"></script>
        <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function() {
                $('#contentViewProcessNeg').load('https://conlabweb3.tierramontemariana.org/apps/negociaciones/show-neg.php');
            })

            function getComments(id) {
                $('#id_tarea').val(id);

                $.ajax({
                    type: 'POST',
                    url: 'https://conlabweb3.tierramontemariana.org/apps/negociaciones/crud.php?aux=2&id=' + id,
                    success: function(res) {
                        data = JSON.parse(res);

                        // Limpiar contenido existente
                        $('#comentario').empty();

                        data.forEach((element, index) => {
                            // Crear elementos de comentario con formato similar a Facebook
                            var commentItem = $('<div class="comment-item">');
                            var commentAvatar = $('<img class="comment-avatar" src="https://conlabweb3.tierramontemariana.org/assets/image/user2-160x160.jpg" alt="User Avatar" style="width: 40px; height: 40px; display: inline-block; border-radius: 65%;">');
                            var commentContent = $('<div class="comment-content" style="display: inline-block; vertical-align: top; max-width: 400px;">');
                            var commentHeader = $('<div class="comment-header" style="display: inline-block; margin-left: 10px; vertical-align: top;">');
                            var commentUserName = $('<strong>').text(element.usuario);
                            var commentTime = $('<span class="comment-time" style="font-size: 0.8em;">').text(calcularTiempoTranscurrido(element.fecha));
                            var commentText = $('<p>').text(element.descripcion);

                            // Agregar elementos al comentario
                            commentHeader.append(commentUserName, '&nbsp;', commentTime);
                            commentContent.append(commentHeader, commentText);
                            commentItem.append(commentAvatar, commentContent);

                            // Agregar comentario al contenedor
                            $('#comentario').append(commentItem);

                            // Agregar hr entre comentarios, excepto después del último
                            if (index < data.length - 1) {
                                $('#comentario').append('<hr>');
                            }

                            // Actualizar otros elementos según sea necesario
                            $('#idcom').val(element.id);
                            // $('#fechacoment').html(element.fecha);
                            // $('#nomuser').html(element.usuario);
                        });
                    }
                });

                getInfoPeople()
            }

            function calcularTiempoTranscurrido(fechaPublicacion) {
                var fechaActual = new Date();
                var fechaComentario = new Date(fechaPublicacion);
                var diferencia = fechaActual - fechaComentario;
                var segundos = Math.floor(diferencia / 1000);
                var minutos = Math.floor(segundos / 60);
                var horas = Math.floor(minutos / 60);
                var dias = Math.floor(horas / 24);

                if (dias > 0) {
                    return dias + (dias === 1 ? ' día' : ' días') + ' atrás';
                } else if (horas > 0) {
                    return horas + (horas === 1 ? ' hora' : ' horas') + ' atrás';
                } else if (minutos > 0) {
                    return minutos + (minutos === 1 ? ' minuto' : ' minutos') + ' atrás';
                } else {
                    return 'Hace unos segundos';
                }
            }

            function setComments() {

                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        // Obtiene las coordenadas
                        var latitud = position.coords.latitude;
                        var longitud = position.coords.longitude;

                        $.ajax({
                            type: 'POST',
                            url: 'https://conlabweb3.tierramontemariana.org/apps/negociaciones/crud.php?aux=1&lat=' + latitud + '&long=' + longitud,
                            data: $('#formcontrol3').serialize(),
                            success: function() {
                                Swal.fire({
                                    position: "top-center",
                                    icon: "success",
                                    title: "¡Registro guardado exitosamente!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#exampleNotas').modal('hide');
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
                $('#coments').html('');
            }
        </script>

    </body>

    </html>

<?php
}
?>