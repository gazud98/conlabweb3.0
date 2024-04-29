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

//echo $id_users;
//echo $p; //viene con el modulo activo

// //echo base_url.'.......<br>'.'...'.hostname.','.db_login.','.db_pass.','.bbserver1.'----<br>';
$conetar = new mysqli(hostname, db_login, db_pass, cw3ctrlsrv . bbserver1);
if ($conetar->connect_errno) {
    $error = "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
    echo $error;
} else {


    include('reglasdenavegacion.php');


    // echo $sctrl1;
    $nmbapp = "MÉDICOS";
    //echo ".................".$sctrl4."-----------";
    if (isset($_REQUEST['iduser'])) {
        $iduser = $_REQUEST['iduser'];
        if ($iduser == "-1") {
            $iduser = "";
        }
    } else {
        $iduser = 0;
    }

    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        if ($id == "-1") {
            $id = "";
        }
    } else {
        $id = "";
    }

    //$id=1;
    //    echo $caso.'----'.$id;
    /* */
    $id_categoria_producto = "1"; //esa ctivo fijo
    $id_tipo_identificacion = "";
    $documento = "";
    $nombre_1 = "";
    $nombre_2 = "";
    $apellido_1 = "";
    $apellido_2 = "";
    $id_tipo_genero = "";
    $estado = "";
    $fecha_nacimiento = "";
    $direccion = "";
    $telefono = "";
    $movil = "";
    $ciudad = "";
    $departamento = "";
    $direccion_alterna = "";
    $telefono_alterno = "";
    $fecha_ingreso = "";
    $fecha_retiro = "";
    $email = "";
    $id_sede = "";
    $id_cargos = "";
    $id_departamento = "";
    $detalle_cargo = "";
    $tarjeta_profesional = "";
    $empresa_temporal = "";
    $estado = "1";


    if ($id != "") {
        $cadena = "select P.id_persona,P.id_tipo_identificacion, P.documento, P.nombre_1, P.nombre_2, P.apellido_1, P.apellido_2, P.id_tipo_genero, P.estado,
                    P.fecha_nacimiento,P.direccion, P.telefono, P.movil, P.ciudad, P.direccion_alterna, P.telefono_alterno,
                    PE.fecha_ingreso, PE.fecha_retiro,
                    PE.email, PE.id_sede,PE.id_cargos, PE.detalle_cargo, PE.tarjeta_profesional, PE.empresa_temporal,PE.id_departamento,P.departamento
                from cw3completa.persona P,
                    cw3completa.persona_empleados PE
                where  P.id_persona=PE.id_persona
                    and P.id_persona='" . $id . "'";
        //                     echo $cadena;
        $resultadP2 = $conetar->query($cadena);
        $numerfiles2 = mysqli_num_rows($resultadP2);
        if ($numerfiles2 >= 1) {
            $filaP2 = mysqli_fetch_array($resultadP2);
            $id = trim($filaP2['id_persona']);
            $id_tipo_identificacion = trim($filaP2['id_tipo_identificacion']);
            $documento = trim($filaP2['documento']);
            $nombre_1 = trim($filaP2['nombre_1']);
            $nombre_2 = trim($filaP2['nombre_2']);
            $apellido_1 = trim($filaP2['apellido_1']);
            $apellido_2 = trim($filaP2['apellido_2']);
            $id_tipo_genero = trim($filaP2['id_tipo_genero']);
            $estado = trim($filaP2['estado']);
            $fecha_nacimiento = trim($filaP2['fecha_nacimiento']);
            $direccion = trim($filaP2['direccion']);
            $telefono = trim($filaP2['telefono']);
            $movil = trim($filaP2['movil']);
            $ciudad = trim($filaP2['ciudad']);
            $departamento = trim($filaP2['departamento']);
            $direccion_alterna = trim($filaP2['direccion_alterna']);
            $telefono_alterno = trim($filaP2['telefono_alterno']);
            $fecha_ingreso = trim($filaP2['fecha_ingreso']);
            $fecha_retiro = trim($filaP2['fecha_retiro']);
            $email = trim($filaP2['email']);
            $id_sede = trim($filaP2['id_sede']);
            $id_departamento = trim($filaP2['id_departamento']);
            $id_cargos = trim($filaP2['id_cargos']);
            $detalle_cargo = trim($filaP2['detalle_cargo']);
            $tarjeta_profesional = trim($filaP2['tarjeta_profesional']);
            $empresa_temporal = trim($filaP2['empresa_temporal']);
        }
    }
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

    </head>

    <style>
        .content-table {
            width: 100%;
            height: auto;
            background-color: #fff;
        }

        .table-wrapper {
            background: #fff;
            padding: 10px;
            margin: 0;
            border-radius: 5px;
            height: 580px;
            border: 1px solid #E3E3E3;
            height: auto;
        }

        .table-title .table-sedes {
            width: 800px;
        }

        .table-title {
            padding-bottom: 15px;
            color: #0045A5;
            padding: 16px 30px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {
            vertical-align: middle;
            border: 1px solid #DCDCDC;
            word-wrap: break-word;
            padding: 2px;
            text-align: center;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }


        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }

        .breadcrumbs {
            border: 1px solid #cbd2d9;
            border-radius: 0.3rem;
            display: inline-flex;
            overflow: hidden;
        }

        .breadcrumbs__item {
            background: #fff;
            color: #333;
            outline: none;
            padding: 0.55em 0.55em 0.55em 1.15em;
            position: relative;
            text-decoration: none;
            transition: background 0.2s linear;
            font-size: 13px;
        }

        .breadcrumbs__item:hover:after,
        .breadcrumbs__item:hover {
            background: #edf1f5;
        }

        .breadcrumbs__item:focus:after,
        .breadcrumbs__item:focus,
        .breadcrumbs__item.is-active:focus {
            background: #0045A5;
            color: #fff;
        }

        .breadcrumbs__item:after,
        .breadcrumbs__item:before {
            background: white;
            bottom: 0;
            clip-path: polygon(50% 50%, -50% -50%, 0 100%);
            content: "";
            left: 100%;
            position: absolute;
            top: 0;
            transition: background 0.2s linear;
            width: 1em;
            z-index: 1;
        }

        .breadcrumbs__item:before {
            background: #cbd2d9;
            margin-left: 1px;
        }

        .breadcrumbs__item:last-child {
            border-right: none;
        }

        .breadcrumbs__item.is-active {
            background: #edf1f5;
        }

        .page-item .page-link {
            position: relative;
            display: block;
            padding: 0.2rem 0.2rem;
            margin-left: 0;
            line-height: 1.25;
            background-color: #fff;
            border: 1px solid #dee2e6;
            font-size: 14px;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #0045A5;
            border-color: #0045A5;
        }

        #icon:hover {
            background-color: rgb(242, 242, 242);
            color: black;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button a {
            padding: 0.8em;
        }

        .dataTables_info {
            font-size: 14px;
        }

        #nav-datos-paciente {
            padding: 30px;
        }
    </style>
    </style>

    <body>

        <div class="content-table">

            <div class="table-wrapper">
                <div class="table-title" style="padding: 30px;">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="">
                                <nav class="breadcrumbs">
                                    <a href="#" class="breadcrumbs__item" style="text-decoration: none;"><i class="fa-solid fa-house"></i></a>
                                    <a href="#" class="breadcrumbs__item is-active" style="text-decoration: none;">Empresas</a>
                                </nav>
                                <!--<label class="card-title" style="color: rgb(1,103,183);font-size: 13px;float: right;"><strong><?php echo $uppercaseruta; ?></strong> </label>-->
                            </div>
                        </div>
                        <div class="col-md-4" style="text-align: center; padding: 10px">
                            <h4><strong>Creación de Empresas</strong></h4>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="font-size: 13px;">

                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left coll-1" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Información Básica de la Empresa
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="content-info-basic">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left coll-2" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Datos De Ubicacion De la Sede
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="content-datos-contacto">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left coll-3" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Otros Datos
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="content-datos">

                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left coll-4" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Información de Facturación
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="" id="datos-facturacion"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingFive">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left coll-5" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Información de Cartera
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="" id="info-cartera"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingSix">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left coll-5" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        Glosas
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSix" class="collapse show" aria-labelledby="headingSix" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="" id="info-glosas"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingSeven">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left coll-5" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                        Información Tributaria e Impuestos
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="" id="info-tributaria"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


        </div>

        <!-- Modal Insumos -->
        <div class="modal fade" id="modalReqInsumo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 700px; margin-left:-170px;">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="exampleModalLabel">Requiere Insumos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="row col-md-12">
                                <div class="col-md-7">
                                    <label for="">Producto o Insumos:</label>
                                    <select class="form-control" name="producto" id="tipoide">
                                        <option value="" selected disabled></option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Cantidad:</label>
                                    <input type="text" class="form-control" name="cantpro" id="cantpro">
                                </div>
                                <div class="col-md-1" style="margin-top: 32px;">
                                    <button type="button" class="btn btn-primary">Agregar</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="content-table-req-insumos col-md-12 mt-4">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Documentos -->
        <div class="modal fade" id="modalDocumentos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 700px; margin-left:-170px;">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="exampleModalLabel">Adjuntar Documentos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="row col-md-12">
                                <div class="col-md-7">
                                    <label for="">Tipo de Documento:</label>
                                    <select class="form-control" name="producto" id="tipoide">
                                        <option value="" selected disabled></option>
                                    </select>
                                </div>
                                <div class="col-md-5" style="margin-top: 32px;">
                                    <button type="button" class="btn btn-success"><i class="fa-solid fa-upload"></i> Subir Archivo</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="content-table-docs col-md-12 mt-4">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="editsedeModal" class="modal fade">
            <?php include("modal-editar.php") ?>
        </div>

        <?php include("apps/thedata.php") ?>

        <script>
            $(document).ready(function() {

                $('.content-info-basic').load('/desarrolloV3/apps/empresas/info-basica.php');
                $('.content-datos-contacto').load('/desarrolloV3/apps/empresas/datos-contacto.php');
                $('.content-datos').load('/desarrolloV3/apps/empresas/otros-datos.php');
                $('#datos-facturacion').load('/desarrolloV3/apps/empresas/info-facturacion.php');
                $('#info-cartera').load('/desarrolloV3/apps/empresas/info-cartera.php');
                $('.content-table-req-insumos').load('/desarrolloV3/apps/empresas/table-req-insumos.php');
                $('.content-table-docs').load('/desarrolloV3/apps/empresas/table-docs.php');
                $('#info-glosas').load('/desarrolloV3/apps/empresas/glosas.php');
                $('#info-tributaria').load('/desarrolloV3/apps/empresas/info-tributaria.php');

            })
        </script>

    </body>

    </html>

<?php
}
?>