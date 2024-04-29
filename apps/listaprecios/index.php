<?php


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

$id_users = $_SESSION['id_users'];

$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }
    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = 0;
    }


?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="https://conlabweb3.tierramontemariana.org/apps/listaprecios/assets/style.css">
    </head>

    <body>

        <div class="content-all col-md-12 container">

            <div class="group-btn">
                <button class="btn btn-sm" id="btnPasar" onclick="moverDatos()">Enviar <i class="fa-solid fa-chevron-right"></i></button>
                <!--<button class="btn btn-sm" id="btnUpdate" onclick="moverDatos()">Update <i class="fa-solid fa-pen-to-square"></i></button>-->
            </div>

            <div class="card">

                <div class="card-header text-center bg-info">
                    <strong>Creación de Listas de Precios</strong>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-8 container-fluid">

                            <div class="card">

                                <div class="card-header">

                                    <strong>Detalles</strong>

                                </div>

                                <div class="card-body">

                                    <form action="" id="formDetalleLista" method="POST" enctype="multipart/form-data">

                                        <div class="row">

                                            <div class="col-md-4">
                                                <label for="">Nombre: <span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" name="nombrelista" id="nombrelista" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Descripción:</label>
                                                <input type="text" class="form-control" name="descripcionlista" id="descripcionlista" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Descuento mínimo:</label>
                                                <input type="text" class="form-control" name="descuentominimo" id="descuentominimo">
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-1 mt-3">
                                                <button type="button" class="btn btn-success btn-sm" onclick="setDetalleLista()">Grabar</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="content-detalle-lista mt-3">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">



                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="card">

                                <div class="card-header">

                                    <strong>Lista Maestra</strong>

                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-4">
                                            <label for="">Nombre exámen: </label>
                                            <input type="text" class="form-control" name="nombreexamen" id="nombreexamen">
                                        </div>
                                        <!--<div class="col-md-2">
                                            <label for="">Frecuencia:</label>
                                            <select class="form-control" name="frecuencia" id="frecuencia">
                                                <option value="" disabled></option>
                                                <option value="1">No aplica</option>
                                                <option value="2">Programación</option>
                                                <option value="3">Red Apoyo</option>
                                                <option value="4">Rutina</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Tipo Examen:</label>
                                            <select class="form-control" name="tipoexamen" id="tipoexamen">
                                                <option value="" disabled></option>
                                                <option value="1">Insumo</option>
                                                <option value="2">Laboratorio Clínico</option>
                                                <option value="3">Salud Ocupacional</option>
                                                <option value="4">Servicio Adicional</option>
                                            </select>
                                        </div>-->
                                        <div class="col-md-2" style="margin-top: 26px;">
                                            <button class="btn btn-info btn-sm" id="btnSearch1">Buscar</button>
                                        </div>

                                    </div>

                                    <div class="row mt-3">

                                        <span><strong>Total exámenes: <span class="badge badge-warning" id="totalexas"></span></strong></span>

                                        <div class="content-table-examenes col-md-12 mt-3">


                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="card">

                                <div class="card-header">

                                    <strong>Acciones Sobre La Lista Base</strong>

                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-3">
                                            <label for="">Frecuencia:</label>
                                            <select class="form-control" name="frecuencialista" id="frecuencialista">
                                                <option value="" disabled></option>
                                                <option value="1">No aplica</option>
                                                <option value="2">Programación</option>
                                                <option value="3">Red Apoyo</option>
                                                <option value="4">Rutina</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5" style="margin-top: 30px;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                                                <label class="form-check-label" for="inlineRadio1">Incremento</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
                                                <label class="form-check-label" for="inlineRadio2">Descuento</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Porcentaje:</label>
                                            <input type="text" class="form-control" name="procentaje" id="procentaje">
                                        </div>
                                        <div class="col-md-2" style="margin-top: 26px;">
                                            <button type="button" class="btn btn-info btn-sm" onclick="updateProcentaje()">Aplicar</button>
                                        </div>


                                    </div>

                                </div>

                            </div>

                            <div class="card">

                                <div class="card-header">

                                    Lista De Precios Base

                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <!--<div class="col-md-4">
                                            <label for="">Nombre exámen: <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="nombreexamen2" id="nombreexamen2">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Frecuencia:</label>
                                            <select class="form-control" name="frecuenci2" id="frecuencia2">
                                                <option value="" disabled></option>
                                            </select>
                                        </div>
                                        <div class="col-md-2" style="margin-top: 30px;">
                                            <button class="btn btn-info btn-sm">Buscar</button>
                                        </div>-->

                                    </div>

                                    <div class="row mt-3">

                                        <span><strong>Total exámenes: <span class="badge badge-success" id="totalexalista"></span></strong></span>

                                        <div class="content-table-precio-examenes col-md-12 mt-3">


                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="./assets/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="./assets/plugins/jquery-validation/additional-methods.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://conlabweb3.tierramontemariana.org/apps/listaprecios/assets/index.js"></script>

    </body>

    </html>

<?php
}
?>