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
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="/cw3/conlabweb3.0/apps/negociaciones/assets/style.css">
    </head>

    <body>

        <div class="card border-info" style="width:80%;margin:auto;">

            <div class="card-header bg-light">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <!--<button class="btn btn-primary" data-toggle="modal" data-target="#addNegociaciones">Nueva negociación</button>-->
                    </div>
                    <div class="col-md-4 col-lg-4 text-center">
                        <strong>Negociaciones</strong>
                    </div>
                    <div class="col-md-4 col-lg-4">
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="col-md-12 col-lg-12">

                    <div id="contentTableNegociaciones"></div>

                </div>
            </div>

            <!-- Modal Neg HTML -->
            <div id="addNegociaciones" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form name="formcontrolNeg" id="formcontrolNeg" action="" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h4 class="modal-title">Nueva Negociación</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Empresa:</label>
                                        <select name="empresa" id="empresa" class="form-control">
                                            <option value="" disabled></option>
                                            <option value="1">Didier SAS</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Fecha de inicio:</label>
                                        <input class="form-control" type="date" name="fechainicio" id="fechainicio">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Fecha final:</label>
                                        <input class="form-control" type="date" name="fechafinal" id="fechafinal">
                                    </div>
                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-md-2">
                                        <label for="">Estado:</label>
                                        <select name="estadoneg" id="estadoneg" class="form-control">
                                            <option value="1">En Proceso</option>
                                            <option value="2">Terminado</option>
                                        </select>
                                    </div>

                                    <div class="col-md-10">
                                        <label for="">Comentario:</label>
                                        <textarea class="form-control" name="comentario_neg" id="comentario_neg" cols="30" rows="3"></textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-danger btn-close-modal" data-dismiss="modal" value="Cancelar">
                                <input type="button" class="btn btn-success" value="Aceptar" onclick="guardarDatos2()">
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
                                        <option value="1">En Proceso</option>
                                        <option value="2">Terminado</option>
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


        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/cw3/conlabweb3.0/apps/negociaciones/assets/index.js"></script>
        <script src="https://kit.fontawesome.com/6dc75479dc.js" crossorigin="anonymous"></script>

        <script>

        </script>

    </body>

    </html>

<?php
}
?>